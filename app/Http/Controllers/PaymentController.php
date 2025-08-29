<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('payment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $students= Students::with('user')->get();
    return view('payment.create',['students'=>$students]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $amount_all= 5000;
        $student=Students::find($request->student_id);

    $response_payment= $this->sendPayment($request->amount , $student->user->name);

    $InvoiceId = $response_payment['Data']['InvoiceId'];
    $InvoiceURL = $response_payment['Data']['InvoiceURL'];

    // dd($response_payment);
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

    return redirect($InvoiceURL);

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
        ])->withoutVerifying()->timeout(60)->acceptJson()->send('POST',$url,['json'=>$data ,
            ]);
            return $res->json();
    }

    public function getStatusPayment($paymentId){
            //don't forget slash*********************************
        $url =$url =env('MYFATOORAH_BASE_URL').'v2/GetPaymentStatus';

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
        // return $request;
    $paymentId= $request->paymentId;
    $get_status = $this->getStatusPayment($paymentId);

    if($get_status["IsSuccess"]==true){

        $InvoiceId = $get_status['Data']['InvoiceId'];
        $InvoiceStatus =$get_status['Data']['InvoiceStatus'];
    }

    $payment=  Payment::where('payment_id',$InvoiceId)->first();

//     	"Pending"
// "Paid"
// "Canceled"
    if($InvoiceStatus == "Paid" ){
    $payment->update(
        [
            "payment_status"=>"paid"
        ]
        );
        return redirect()->route('payments.index')->with('success','payment successfully');
    }
    if($InvoiceStatus == "Canceled" ){
    $payment->update(
        [
            "payment_status"=>"unpaid"
        ]
        );
        return redirect()->route('payments.index')->with('error','payment failded');
    }
    return redirect()->route('payments.index')->with('error','payment failded');

    }
    /**
     * Display the specified resource.
     */
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
