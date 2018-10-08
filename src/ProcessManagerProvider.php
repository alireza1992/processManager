<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/2/18
 * Time: 4:43 PM
 */

namespace Alireza1992\ProcessManager;



use Illuminate\Support\ServiceProvider;

class ProcessManagerProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
    }

    public function register()
    {

        $this->app->bind('EventLogger',function (){
           return new Events();
        });

    }

}