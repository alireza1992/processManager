<?php

namespace Processmanager\Controllers;

use Processmanager\Models\PMProcess;
use Processmanager\Models\PMProcessStep;
use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class ProcessStepController extends Controller
{

    /**
     * @var ProcessServices
     */
    protected $processStepServices;

    /**
     * ProcessController constructor.
     * @param ProcessServices $processStepServices
     */
    public function __construct(PMProcessStep $processStepServices)
    {
        $this->processStepServices = $processStepServices;
        $this->groups = new Group();
        $this->processServices = new PMProcess();
    }

    public function index(Request $request)
    {


        $process_steps = $this->processStepServices->paginate($request);

        return view('processmanager::process-step.index', compact('process_steps'));
    }

    public function create()
    {
        $processes = $this->processServices->getPluck();
        $groups = $this->groups->pluck('name', 'id');
        return view('processmanager::process-step.create', compact('processes', 'groups'));
    }

    public function store(Request $request)
    {
        $this->processStepServices->store($request);

        return redirect()->route('admin.process-managers.process-step.index');
    }

    public function edit($id)
    {
        $process_step = $this->processStepServices->find($id);
        $processes = $this->processServices->getPluck();
        $groups = $this->groups->pluck('name', 'id');
        return view('processmanager::process-step.edit', compact('process_step', 'groups', 'processes'));
    }

    public function update(Request $request, $id)
    {
        $this->processStepServices->store($request, $id);

        return redirect()->route('admin.process-managers.process-step.index');
    }
}
