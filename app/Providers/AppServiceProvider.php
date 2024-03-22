<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use App\Models\Client;
use App\Models\Employee;

use Illuminate\Support\Facades\Validator;
use App\Models\Permission;

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

         View::composer('components.layout', function ($view) {
            $view->with('clients', Client::all());
        });

        View::composer('*', function ($view) {
            $view->with('employees', Employee::all());
        });

        // PERMISSIONS
        Validator::extend('unique_permission', function ($attribute, $value, $parameters, $validator) { 
            $employeeId = $validator->getData()['Employee_ID'];
     
            $exists = Permission::where('Employee_ID', $employeeId)
                ->where('Page_ID', $value)
                ->exists();
    
            if ($exists) { 
                $validator->errors()->add($attribute, 'Permission for selected page already exists for the employee.');
            }
        
            return !$exists;
        });
         
     }
     

}
