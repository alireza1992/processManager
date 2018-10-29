<?php

namespace Processmanager\Controllers;

use Processmanager\Models\PMProcessStep;
use Processmanager\Models\PMProcessStepVariable;
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

        return view('Processmanager::process-step-variable.index', compact('process_step_variables'));
    }

    public function create()
    {
        $process_steps = $this->processStepServices->getPluck();
        return view('Processmanager::process-step-variable.create', compact('process_steps'));
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
        return view('Processmanager::process-step-variable.edit', compact('process_steps', 'process_step_variable'));
    }

    public function update(Request $request, $id)
    {
        $this->processStepVariableServices->store($request, $id);

        return redirect()->route('admin.process-managers.process-step-variable.index');
    }
}
