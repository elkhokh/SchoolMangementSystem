<?php
namespace App\Contracts;

interface PaymentServiceInterface{
    //any class when implment from this class must make method in here

    public function pay($amount):void;

}
