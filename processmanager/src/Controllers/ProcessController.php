<?php

namespace Alireza1992\ProcessManager\Controllers;

use Alireza1992\ProcessManager\ProcessRequest;
use Alireza1992\ProcessManager\ProcessServices;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProcessController extends Controller
{

    /**
     * @var ProcessServices
     */
    protected $processServices;

    /**
     * ProcessController constructor.
     * @param ProcessServices $processServices
     */
    public function __construct(ProcessServices $processServices)
    {
        $this->processServices = $processServices;
    }

    public function index(Request $request)
    {
        $processes = $this->processServices->paginate($request);

        return view(__DIR__.'views.process.index', compact('processes'));
    }

    public function create($id)
    {
        $process = $this->processServices->find($id);
        return view(__DIR__.'views.process.edit', compact('process'));
    }

    public function store(ProcessRequest $request)
    {
        $this->processServices->store($request);

        return redirect()->route(__DIR__.'views.process.index');
    }

    public function edit($id)
    {
        $process = $this->processServices->find($id);
        return view(__DIR__.'views.process.edit', compact('process'));
    }

    public function update(ProcessRequest $request, $id)
    {
        $this->processServices->store($request, $id);

        return redirect()->route(__DIR__.'views.process.index');
    }
}
