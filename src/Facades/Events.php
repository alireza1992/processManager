<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/6/18
 * Time: 1:38 PM
 */

namespace Processmanager\Facades;


use Illuminate\Support\Facades\Facade;

class Events extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'Events';
    }

}