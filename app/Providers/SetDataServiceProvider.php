<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Session;
class SetDataServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->country();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function country(){
        // $ip      = getenv("REMOTE_ADDR");
        $ip      = "220.158.205.5";
        $result  = unserialize(@file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
        // dd($result);
        Session::put('country_name', $result);
        
    }
}
