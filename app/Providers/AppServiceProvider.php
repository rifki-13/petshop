<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function( $view )
        {
            $cart = app('App\Http\Controllers\StoreController')->getCart();
            $reserv = app('App\Http\Controllers\StoreController')->getReservasi();

                $view->with( 'cart', $cart )
                    ->with('reservasi', $reserv);
        } );
    }
}
