<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
   

     public function boot()
     {

         \Log::info('Boot method called in AppServiceProvider.');
     
         View::composer('*', function ($view) {
             $view->with('employee', Auth::user());
         });


         Blade::directive('pageTitle', function () {
            return "<?= ucwords(str_replace('.', ' ', Route::currentRouteName())); ?>";
         });

         Blade::directive('breadcrumbs', function () {
            return "<?= json_encode(explode('.', Route::currentRouteName())); ?>";
         });
         
     }
     

}
