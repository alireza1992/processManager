<?php

namespace Alireza1992\ProcessManager;

use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class NotFound extends Exception
{

    public function processWasNotFound()
    {
        dd('Process Was Not Found');
//        return view('processmanager::errors.404');
    }

    public function processStepWasNotFound()
    {
        dd('Process Step Was Not Found');
    }

    public function processStepStatusWasNotFound()
    {
        dd('Process Step Status Was Not Found');
    }

}
