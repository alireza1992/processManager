<?php

namespace Alireza1992\ProcessManager\Controllers;

//use App\Http\Controllers\Controller;
use Alireza1992\ProcessManager\Models\PMProcess;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Alireza1992\ProcessManager\models\PMProcess;
//use Alireza1992\ProcessManager\Requests\ProcessRequest;
use Illuminate\Routing\Controller as BaseController;

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
    public function __construct(PMProcess $processServices)
    {
        $this->processServices = $processServices;
    }

    public function index(Request $request)
    {


        $processes = $this->processServices->paginate($request);

        return view('processmanager::process.index', compact('processes'));
    }

    public function create()
    {
        return view('processmanager::process.create');
    }

    public function store(Request $request)
    {
        $this->processServices->store($request);

        return redirect()->route('admin.process-managers.process.index');
    }

    public function edit($id)
    {
        $process = $this->processServices->find($id);
        return view('processmanager::process.edit', compact('process'));
    }

    public function update(Request $request, $id)
    {
        $this->processServices->store($request, $id);

        return redirect()->route('admin.process-managers.process.index');
    }
}
