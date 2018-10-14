<?php

namespace Alireza1992\ProcessManager\Controllers;

use Alireza1992\ProcessManager\Models\PMProcessStep;
use Alireza1992\ProcessManager\Models\PMProcessStepVariable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProcessStepVariableController extends Controller
{

    /**
     * @var ProcessStepVariableServices
     */
    protected $processStepVariableServices;

    /**
     * ProcessController constructor.
     * @param ProcessServices $processStepVariableServices
     */
    public function __construct(PMProcessStepVariable $processStepVariableServices)
    {
        $this->processStepVariableServices = $processStepVariableServices;
        $this->processStepServices = new PMProcessStep();
    }

    public function index(Request $request)
    {


        $process_step_variables = $this->processStepVariableServices->paginate($request);

        return view('processmanager::process-step-variable.index', compact('process_step_variables'));
    }

    public function create()
    {
        $process_steps = $this->processStepServices->getPluck();
        return view('processmanager::process-step-variable.create', compact('process_steps'));
    }

    public function store(Request $request)
    {
        $this->processStepVariableServices->store($request);

        return redirect()->route('admin.process-managers.process-step-variable.index');
    }

    public function edit($id)
    {
        $process_step_variable = $this->processStepVariableServices->find($id);
        $process_steps = $this->processStepServices->getPluck();
        return view('processmanager::process-step-variable.edit', compact('process_steps', 'process_step_variable'));
    }

    public function update(Request $request, $id)
    {
        $this->processStepVariableServices->store($request, $id);

        return redirect()->route('admin.process-managers.process-step-variable.index');
    }
}
