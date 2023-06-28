<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::macro('toFormattedDate',function(){
            return $this->format('d/m/Y');
        });
        Carbon::macro('toFormattedTime',function(){
            return $this->format('h:i A');
        });

        Carbon::macro('toFormattedYear',function(){
            return $this->format('Y');
        });
    }
}
