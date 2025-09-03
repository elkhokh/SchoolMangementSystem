<?php

namespace App\Providers;


use App\Factories\PaymentFactory;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
// use App\Services\Payments\PaymentFactory;
use Illuminate\Support\ServiceProvider;
use App\Contracts\PaymentServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    //     protected $policies = [
//     'App\Models\Classes' => 'App\Policies\ClassesPolicy',
//     'App\Models\Attendances' => 'App\Policies\AttendancesPolicy',
// ];
    public function register(): void
    {
        // $currency = config('app.curreny', 'USD');
        // $payment_method = config('app.payment_method', 'myfatoorah');

        // $this->app->bind(PaymentServiceInterface::class, function ($app) use ($currency, $payment_method) {
        //     return PaymentFactory::make($payment_method, $currency);

            // if ($payment_method === 'myfatoorah') {
            //     return new MyFatoorahService($currency);
            // } elseif ($payment_method === 'fawry') {
            //     return new FawryService($currency);
            // } elseif ($payment_method == 'test') {
            //     return new TestService($currency);
            // } elseif ($payment_method === 'strip') {
            //     return new StripService($currency);
            // } elseif ($payment_method === 'paypal') {
            //     return new PayPalSerivce($currency);
            // }
        // });

        // $this->app->bind(TestService::class, function ($app) use ($currency) {
        //     return new TestService($currency); // to send to CUrrency in consturct USD
        // });
        // $this->app->bind(MyFatoorahService::class, function ($app) use ($currency) {
        //     return new MyFatoorahService($currency); // to send to CUrrency in consturct USD
        // });
        // $this->app->bind(PayPalSerivce::class, function ($app) use ($currency) {
        //     return new PayPalSerivce($currency); // to send to CUrrency in consturct USD
        // });
        // $this->app->bind(StripService::class, function ($app) use ($currency) {
        //     return new StripService($currency); // to send to CUrrency in consturct USD
        // });
        // $this->app->bind(FawryService::class, function ($app) use ($currency) {
        //     return new FawryService($currency); // to send to CUrrency in consturct USD
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //strict mode
        Model::shouldBeStrict(!app()->isProduction());
        //lazy loading
        Model::preventLazyLoading(!app()->isProduction());
        //mass assignment
        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());
        Paginator::useBootstrap();
    }
}
