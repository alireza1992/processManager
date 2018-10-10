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
        $routeConfig = [
            'namespace' => 'Alireza1992\Processmanager\Controllers',
            'prefix' => 'admin/process-managers',
            'middleware' => ['web', 'admin'],
        ];
        $this->getRouter()->group($routeConfig, function($router) {
//            $router->resource('process', 'ProcessController');
            $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        });
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        $this->loadViewsFrom(__DIR__.'/views', 'process-managers');
        // Publish a config file
        $configPath = __DIR__.'/../config/process-manager.php';
        $this->publishes([
            $configPath => config_path('process-manager.php'),
        ], 'config');
    }

    /**
     * Get the active router.
     *
     * @return Router
     */
    protected function getRouter()
    {
        return $this->app['router'];
    }


    public function register()
    {

        $this->app->bind('EventLogger',function (){
           return new Events();
        });

    }

}