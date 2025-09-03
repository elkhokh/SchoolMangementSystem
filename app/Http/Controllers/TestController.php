<?php

namespace App\Http\Controllers;

use App\Factories\PaymentFactory;
use App\Http\Requests\checkoutRequest;
use App\Contracts\PaymentServiceInterface;


class TestController extends Controller
{

//     protected $paymentFactory ;
// // خد بالك انك عامل اوبجكت من انترفيس ودا مش بينفع بس انا هخلي لارفيل يعمل  دا عن طريق السيرفيس بروفيدر
//     public function __construct(PaymentServiceInterface $paymentServiceInterface) //service container
//     {
//         $this->paymentFactory = $paymentServiceInterface;

//     }

    public function checkout(checkoutRequest $request)
    {
        // $amount = $request->validated()['amount'];
        // $this->paymentService->pay($amount);

        $amount = $request->validated()['amount'];
    $method = $request->input('method', 'test'); // default test

    $service = PaymentFactory::make($method, 'EGP');
    $service->pay($amount);



    }
}
