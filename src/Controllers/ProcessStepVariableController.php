<?php

namespace Alireza1992\ProcessManager\Controllers;

use Alireza1992\ProcessManager\Models\PMProcess;
use Alireza1992\ProcessManager\Models\PMProcessStep;
use Alireza1992\ProcessManager\Models\PMProcessStepVariable;
use App\Http\Controllers\Controller;
use App\Models\Group;
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


        $process_steps = $this->processStepVariableServices->paginate($request);

        return view('processmanager::process-step-variable.index', compact('process_step_variables'));
    }

    public function create()
    {
        $process_steps = $this->processStepServices->getPluck();
        $groups = $this->groups->pluck('name', 'id');
        return view('processmanager::process-step-variable.create', compact('processes', 'groups'));
    }

    public function store(Request $request)
    {
        $this->processStepVariableServices->store($request);

        return redirect()->route('admin.process-managers.process-step-variable.index');
    }

    public function edit($id)
    {
        $process_step = $this->processStepVariableServices->find($id);
        $processes = $this->processServices->get();
        $groups = $this->groups->pluck('name', 'id');
        return view('processmanager::process-step-variable.edit', compact('process_step', 'groups', 'processes'));
    }

    public function update(Request $request, $id)
    {
        $this->processStepVariableServices->store($request, $id);

        return redirect()->route('admin.process-managers.process-step-variable.index');
    }
}
