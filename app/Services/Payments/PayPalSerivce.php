<?php
namespace App\Services\Payments;

use App\Contracts\PaymentServiceInterface;

class PayPalSerivce implements PaymentServiceInterface
{

        protected $curreny ;

    public function __construct($curreny){
        $this->curreny = $curreny;
    }
    public function pay($amount):void
    {
        echo $amount . $this->curreny .'  was paid by paypal ';
    }
}
