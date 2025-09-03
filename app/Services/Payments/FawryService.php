<?php
namespace App\Services\Payments;

use App\Contracts\PaymentServiceInterface;

class FawryService implements PaymentServiceInterface
{

        protected $curreny ;

    public function __construct(string $curreny = 'USD'){
        $this->curreny = $curreny;
    }
    public function pay($amount):void
    {
        echo $amount . $this->curreny .'  was paid by fawrey ';
    }
}
