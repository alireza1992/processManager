<?php

namespace Processmanager\Controllers;

use Processmanager\Models\PMProcess;
use Processmanager\Models\PMProcessStep;
use Processmanager\Models\PMProcessStepStatus;
use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class ProcessStepStatusController extends Controller
{

    /**
     * @var ProcessStepStatusServices
     */
    protected $processStepStatusServices;

    /**
     * ProcessController constructor.
     * @param ProcessServices $processStepStatusServices
     */
    public function __construct(PMProcessStepStatus $processStepStatusServices)
    {
        $this->processStepStatusServices = $processStepStatusServices;
        $this->processStepServices = new PMProcessStep();
    }

    public function index(Request $request)
    {


        $process_step_statuses = $this->processStepStatusServices->paginate($request);

        return view('Processmanager::process-step-status.index', compact('process_step_statuses'));
    }

    public function create()
    {
        $process_steps = $this->processStepServices->getPluck();
        return view('Processmanager::process-step-status.create', compact('process_steps'));
    }

    public function store(Request $request)
    {
        $this->processStepStatusServices->store($request);

        return redirect()->route('admin.process-managers.process-step-status.index');
    }

    public function edit($id)
    {
        $process_step = $this->processStepStatusServices->find($id);
        $process_steps = $this->processStepServices->getPluck();
        return view('Processmanager::process-step-status.edit', compact('process_step', 'process_steps'));
    }

    public function update(Request $request, $id)
    {
        $this->processStepStatusServices->store($request, $id);

        return redirect()->route('admin.process-managers.process-step-status.index');
    }
}
