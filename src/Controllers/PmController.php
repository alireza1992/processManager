<?php

namespace Alireza1992\ProcessManager\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PmController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
