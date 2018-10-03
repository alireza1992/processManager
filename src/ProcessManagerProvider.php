<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/2/18
 * Time: 4:43 PM
 */

namespace Alireza1992\ProcessManager;


use Carbon\Laravel\ServiceProvider;

class ProcessManagerProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }

    public function register()
    {


    }

}