<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

                 // فعل strict mode فقط في بيئة التطوير
    Model::shouldBeStrict(!app()->isProduction());

    // امنع lazy loading لو حابب
    Model::preventLazyLoading(!app()->isProduction());

    // امنع mass assignment الخاطئ
    Model::preventSilentlyDiscardingAttributes(!app()->isProduction());

    Paginator::useBootstrap();
    }
}
