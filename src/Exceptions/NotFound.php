<?php

namespace Processmanager;

use Mockery\Exception;

class NotFound extends Exception
{

    public static function processWasNotFound()
    {
        return "Process Alias Was not found in the database";

    }

    public static function processStepWasNotFound()
    {
        return " Step Alias was not found in the database";

    }

    public static function processStepStatusWasNotFound()
    {
        return "Process Step Status  was not found in the database";

    }

}
