<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Load helpers from FaturHelper
        if(File::exists(base_path('vendor/ajifatur/faturhelper/src'))){
            foreach(glob(base_path('vendor/ajifatur/faturhelper/src').'/Helpers/*.php') as $filename){
                require_once $filename;
            }
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
