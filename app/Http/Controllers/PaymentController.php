<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\StorePaymentRequest;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    try{
    $query = Payment::with('student.user');

    if ($request->has('search')) {
        $search = $request->get('search');
        $query->whereHas('student.user', function($relation) use ($search) {
        $relation->where('name', 'like', "%$search%");
        });
    }
    $payments = $query->latest()->paginate(10);
    return view('admin.payment.index', ['payments'=>$payments]);
        // return view('admin.payment.index');
        } catch (\Throwable $th) {
        Log::channel("student")->error($th->getMessage() . $th->getFile() . $th->getLine());
        session()->flash('Error');
        return view('admin.payment.index');
    }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $students= Students::with('user')->get();
    return view('admin.payment.create',['students'=>$students]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest  $request)
    {
    // dd($request->all());                                           "_token" => "Wv7kJeoJVGwafV3GY8HgWfyxXkxA7OQGOgU0jKb4"
//   "student_id" => "2"
//   "payment_type" => "myfatoorah"
//   "amount" => "2400"
        $amount_all= 5000;
        $student=Students::find($request->student_id);

        DB::beginTransaction();
    try {
//cash
        if ($request->payment_type === 'cash') {
            Payment::create([
                'student_id'   => $request->student_id,
                'payment_type' => 'cash',
                'payment_status' => 'paid',
                'amount_all'   => $amount_all,
                'remaining'    => $amount_all - $request->amount,
                'current_paid' => $request->amount,
            ]);

            DB::commit();
            session()->flash('success');
            return redirect()->route('payments.index');
        }
        else {
//MyFatoorah
    $response_payment= $this->sendPayment($request->amount , $student->user->name);

    $InvoiceId = $response_payment['Data']['InvoiceId'];
    $InvoiceURL = $response_payment['Data']['InvoiceURL'];

    // dd($response_payment);
//       "IsSuccess" => true
//   "Message" => "Invoice Created Successfully!"
//   "ValidationErrors" => null
//   "Data" => array:4 [▼
//     "InvoiceId" => 6075551
//     "InvoiceURL" => "https://demo.MyFatoorah.com/KWT/ie/01072607555141-2dc8d7c3"
//     "CustomerReference" => null
//     "UserDefinedField" => null

    Payment::create([
        'student_id'=> $request->student_id,
        'payment_type'=>$request->payment_type,
        // 'payment_status'=>'pending',
        'payment_id'=>$InvoiceId,
        'payment_url'=>$InvoiceURL,
        'amount_all'=>$amount_all,
        'remaining'=>$amount_all-$request->amount,
        'current_paid'=>$request->amount,
    ]);

    DB::commit();
    return redirect($InvoiceURL);
}
    } catch (\Throwable $th) {
        DB::rollBack();
        Log::channel("student")->error( $th->getMessage().$th->getFile().$th->getLine());
        session()->flash('Error');
        return redirect()->route('payments.index');
    }
    }
    public function sendPayment($amount , $student_name ){
        // method - header - body - url
        $url =env('MYFATOORAH_BASE_URL').'v2/SendPayment';
        $data= [
    //Fill required data
    'InvoiceValue'       => $amount,
    'CustomerName'       => $student_name,
    'NotificationOption' => 'LNK', //'SMS', 'EML', or 'ALL'
        //Fill optional data
        'DisplayCurrencyIso' => 'EGP',
        //'MobileCountryCode'  => $phone[0],
        //'CustomerMobile'     => $phone[1],
        //'CustomerEmail'      => 'email@example.com',
        'CallBackUrl'          => route('callback'),
        //'ErrorUrl'           => 'https://example.com/callback.php', //or 'https://example.com/error.php'
        'Language'             => 'en', //or 'ar'
        //'CustomerReference'  => 'orderId',
        //'CustomerCivilId'    => 'CivilId',
        //'UserDefinedField'   => 'This could be string, number, or array',
        //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
        //'CustomerAddress'    => $customerAddress,
        //'InvoiceItems'       => $invoiceItems,
        //'Suppliers'          => $suppliers,
];
        $res = Http::withHeaders([
            "Authorization"=>'Bearer '.env('MYFATOORAH_API_KEY'),
        ])->withoutVerifying()->timeout(60)->acceptJson()->send('POST',$url,['json'=>$data]);
            return $res->json();
    }
    public function getStatusPayment($paymentId){
            //don't forget slash*********************************
        $url =env('MYFATOORAH_BASE_URL').'v2/GetPaymentStatus';
        $data= [
        "Key"=>$paymentId,
        "KeyType"=>"PaymentId",
        ];
        $res = Http::withHeaders([
            "Authorization"=>'Bearer '.env('MYFATOORAH_API_KEY'),
        ])->withoutVerifying()->timeout(60)->acceptJson()->send('POST',$url,['json'=>$data ,
            ]);
            return $res->json();
    }
    public function callback(Request $request){
        try {
            DB::beginTransaction();
        // return $request;
    $paymentId= $request->paymentId;
    $get_status = $this->getStatusPayment($paymentId);

    if($get_status["IsSuccess"]==true){

        $InvoiceId = $get_status['Data']['InvoiceId'];
        $InvoiceStatus =$get_status['Data']['InvoiceStatus'];
    }
    $payment=  Payment::where('payment_id',$InvoiceId)->first();
//  "Pending"
// "Paid"
// "Canceled"
    if($InvoiceStatus == "Paid" ){
    $payment->update(
        [
            "payment_status"=>"paid"
        ]
        );
        // return redirect()->route('payments.index')->with('success','payment successfully');
        session()->flash('success');
        DB::commit();
        return redirect()->route('payments.index');
    }
    if($InvoiceStatus == "Canceled" ){
    $payment->update(
        [
            "payment_status"=>"unpaid"
        ]
        );
        session()->flash('Error');
        DB::commit();
        return redirect()->route('payments.index');
        // return redirect()->route('payments.index')->with('error','payment failded');
    }
    } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Payment Callback Error: " . $th->getMessage());
        session()->flash('Error');
        return redirect()->route('payments.index');
        }

    // return redirect()->route('payments.index')->with('error','payment failded');
    }

    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
