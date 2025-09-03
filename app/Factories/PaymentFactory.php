<?php
namespace App\Factories;
use InvalidArgumentException;
use App\Contracts\PaymentServiceInterface;
use App\Services\Payments\{MyFatoorahService, StripService, PayPalSerivce, FawryService, TestService};


class PaymentFactory
{

    public static function make(string $method = 'test', string $currency = 'USD'): PaymentServiceInterface
    {

        return match ($method) {
            'fawry'      => new FawryService($currency),
            'myfatoorah' => new MyFatoorahService($currency),
            'stripe'     => new StripService($currency),
            'paypal'     => new PayPalSerivce($currency),
            'test'       => new TestService($currency),
            default      => throw new InvalidArgumentException("Unsupported payment method: {$method}"),
        };
    }
}

