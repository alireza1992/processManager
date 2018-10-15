<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/2/18
 * Time: 4:43 PM
 */

namespace Alireza1992\ProcessManager;


use Alireza1992\ProcessManager\Models\PMProcess;
use Illuminate\Support\ServiceProvider;

class ProcessManagerProvider extends ServiceProvider
{

    public function boot()
    {
        include __DIR__ . '/Models/PMProcess.php';
        include __DIR__ . '/Models/PMProcessStep.php';
        include __DIR__ . '/Models/PMProcessStepStatus.php';
        include __DIR__ . '/Models/PMProcessStepVariable.php';
        include __DIR__ . '/Exceptions/NotFound.php';


        $routeConfig = [
            'namespace' => 'Alireza1992\Processmanager\Controllers',
            'prefix' => 'admin/process-managers',
            'middleware' => ['web', 'admin'],
        ];
            $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
//        $this->getRouter()->group($routeConfig, function ($router) {
//           $router->resource('process', 'ProcessController');
//        });
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        // Publish a config file
        $configPath = __DIR__ . '/config/process-manager.php';
        $this->publishes([
            $configPath => config_path('process-manager.php'),
        ], 'config');

        $viewPath = __DIR__ . '/views';
        $this->loadViewsFrom($viewPath, 'processmanager');
        //Publish views
        $this->publishes([
            $viewPath => config('process-manager.resource-views'),
        ], 'views');


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

        $this->app->bind('EventLogger', function () {
            return new Events();
        });

        $this->app->bind('PMProcess', function () {
            return new PMProcess();
        });

    }

}