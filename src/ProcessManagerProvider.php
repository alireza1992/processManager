<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/2/18
 * Time: 4:43 PM
 */

namespace Processmanager;


use Illuminate\Support\ServiceProvider;

class ProcessManagerProvider extends ServiceProvider
{

    protected $models = ['Models/PMEvent', 'Models/PMProcess', 'Models/PMProcessStep', 'Models/PMProcessStepStatus',
        'Models/PMProcessStepVariable' , 'Models/PMEventNotification' , 'Events' , 'Exceptions/NotFound',
        'Models/PMEventVariableValue',
        ];

    public function boot()
    {

        // Publish a config file
        $configPath = __DIR__ . '/config/process-manager.php';
        $this->publishes([
            $configPath => config_path('process-manager.php'),
        ], 'config');

        $viewPath = __DIR__ . '/views';
        $this->loadViewsFrom($viewPath, 'Processmanager');
        //Publish views
        $this->publishes([
            $viewPath => config('process-manager.resource-views'),
        ], 'views');
        foreach ($this->models as $model) {
            include __DIR__ . "/{$model}.php";
        }

        $routeConfig = [
            'namespace' => 'Processmanager\Controllers',
        ];
        $this->getRouter()->group($routeConfig, function ($router) {
            $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        });
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

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

//        foreach ($this->models as $model) {
//            $interface = 'Processmanager\Contracts\\' . $model . '::class';
//            $this->app->singleton($interface, function () {
//                $modelName = 'Processmanager\Models\\' . $model . '()';
//                return new $modelName;
//            });
//        }

    }

//
//    /**
//     * {@inheritdoc}
//     */
//    public function provides()
//    {
//        return [
//            PMEvent::class,
//        ];
//    }

}