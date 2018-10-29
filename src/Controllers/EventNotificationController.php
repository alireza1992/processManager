<?php

namespace Processmanager\Controllers;

/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/17/18
 * Time: 3:09 PM
 */
use App\Http\Controllers\Controller;
use Request;
use Processmanager\Models\PMEventNotification;
use Processmanager\Models\PMProcess;
use Processmanager\Models\PMProcessStep;
use Processmanager\Models\PMProcessStepVariable;

class EventNotificationController extends Controller
{

    /**
     * @var $eventNotificationService
     */
    protected $eventNotificationService;

    /**
     * ProcessController constructor.
     * @param $eventNotificationService $eventNotificationService
     */
    public function __construct(PMEventNotification $eventNotificationService)
    {
        $this->eventNotificationService = $eventNotificationService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(\Illuminate\Http\Request $request)
    {

        $notifications = $this->eventNotificationService->paginate($request);
        return view('Processmanager::event-notification.index', compact('notifications'));
    }

    /**
     * @param PMProcess $PMProcess
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(PMProcess $PMProcess)
    {
        $processes = $PMProcess->orderByDesc('id')->pluck('name', 'id');
        return view('Processmanager::event-notification.create', compact('processes'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $process = $this->eventNotificationService->store($request);
        return redirect()->route('admin.process-managers.event-notification.stepChoose', $process->process_id);
    }

    /**
     * @param $processId
     * @param PMProcessStep $PMProcessStep
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function stepChoose($processId, PMProcessStep $PMProcessStep)
    {
        $processSteps = PMProcessStep::with('group')->where('process_id', $processId)->orderBy('priority', 'asc');
        $pluck=$processSteps->pluck('name','id');
        $array= $processSteps->get();
        return view('Processmanager::event-notification.stepChoose', compact('array','pluck','processId'));
    }

    /**
     * @param Request $request
     * @param PMProcessStepVariable $
     */
    public function stepVariables(\Illuminate\Http\Request $request, PMProcessStepVariable $PMProcessStepVariable, PMProcessStep $PMProcessStep)
    {
        $processStep = $PMProcessStep->where('process_id',Request::segment(4))->first();
        $ajaxResult = $PMProcessStepVariable->with('process_step')->where('process_step_id','<=',$request->id)->where('process_step_id','>=',$processStep->id)->get();
        return $ajaxResult;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $process = $this->eventNotificationService->find($id);
        return view('Processmanager::process.edit', compact('process'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(\Illuminate\Http\Request $request, $id)
    {
        $this->eventNotificationService->store($request, $id);
        return redirect()->route('admin.process-managers.process.index');
    }
}
