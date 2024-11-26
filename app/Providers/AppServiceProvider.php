<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

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
        // Chia sẻ biến $userEmail với tất cả các view
        view()->composer('*', function ($view) {
            $view->with('userEmail', Auth::check() ? Auth::user()->email : null);
        });

        Paginator::useBootstrap();
    }

}
