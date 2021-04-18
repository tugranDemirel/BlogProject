<?php

namespace App\Providers;

use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;

/* Butun sayfalarda gecerli olabilmesi icin burada ilgili tabloyu cagirdik butun viewlere bu vasita ile gonderiyoruz*/
use App\Models\Config;

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
        view()->share('config', Config::find(1));

    }
}
