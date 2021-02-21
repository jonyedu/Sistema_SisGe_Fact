<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $helperFolder = app_path('Helpers');
        if(File::exists($helperFolder)){
            $helperFildesInFolder = File::files($helperFolder);
            foreach ($helperFildesInFolder as $helper){
                require_once($helper->getPathname());
            }
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
