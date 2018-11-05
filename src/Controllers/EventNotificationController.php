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
use Processmanager\Models\NotificationParameters;

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
    public function __construct(PMEventNotification $eventNotificationService, NotificationParameters $notificationParameters)
    {
        $this->eventNotificationService = $eventNotificationService;
        $this->notificationParameters = $notificationParameters;
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
        $notification = $this->eventNotificationService->store($request);
        return redirect()->route('admin.process-managers.event-notification.stepChoose', [$notification->process_id, $notification->id]);
    }

    /**
     * @param $processId
     * @param PMProcessStep $PMProcessStep
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function stepChoose($processId, $notificationId, PMProcessStep $PMProcessStep)
    {
        $processSteps = PMProcessStep::with('group')->where('process_id', $processId)->orderBy('priority', 'asc');
        $pluck = $processSteps->pluck('name', 'id');
        $array = $processSteps->get();
        return view('Processmanager::event-notification.stepChoose', compact('array', 'pluck', 'processId', 'notificationId'));
    }

    /**
     * @param Request $request
     * @param PMProcessStepVariable $
     */
    public function stepVariables(\Illuminate\Http\Request $request, PMProcessStepVariable $PMProcessStepVariable, PMProcessStep $PMProcessStep)
    {
        $processStep = $PMProcessStep->where('process_id', Request::segment(4))->first();
        $record = $PMProcessStep->find($request->id);
        $availableVariables = $PMProcessStepVariable->with('process_step', 'process_step.statuses')->where('process_step_id', '<=', $request->id)->where('process_step_id', '>=', $processStep->id)->get();
        $stepAdmins = PMProcessStep::with('group')
            ->where('process_id', Request::segment(4))
            ->where('presenter_group_id', '>=', $record->presenter_group_id)->where('presenter_group_id', '<=', $processStep->presenter_group_id)
            ->groupBy('presenter_group_id')
            ->get();
        $admins = \App\Models\Admin::all();
        $userGroups = \App\Models\Group::with('admins')->get();


        return response()->json(view('Processmanager::event-notification.conditions', compact('processStep', 'availableVariables', 'stepAdmins', 'record', 'userGroups', 'admins'))->render());
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

    public function saveParameters(\Illuminate\Http\Request $request)
    {
//        dd($request->all());
        $input = $request->all();

        $this->notificationParameters->notification($input);

        if ($request->mobile || $request->email) {
            $this->notificationParameters->customContact($input);
        }
        if ($request->userMode) {
            $this->notificationParameters->targetUsers($input);
        }
        if ($request->groupMode) {
            $this->notificationParameters->targetUserGroups($input);
        }
        if ($request->processMode) {
            $this->notificationParameters->inProcess($input);
        }
        if ($request->conditionStatus) {
            $this->notificationParameters->conditions($input);
        }
        return redirect('admin/process-managers/event-notification');

    }
}
