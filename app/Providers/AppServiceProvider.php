<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Http::macro('ebw_crm', function () {
            return Http::asForm()->withToken(\config('ebw-crm.auth_token'))->baseUrl(\config('ebw-crm.base_url'));
        });
    }
}
