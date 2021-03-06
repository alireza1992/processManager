<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/6/18
 * Time: 1:45 PM
 */

namespace Processmanager;

use Illuminate\Support\Facades\DB;
use Processmanager\Models\PMEvent;
use Processmanager\Models\PMProcess;
use Processmanager\Models\PMProcessStep;
use Processmanager\Models\PMProcessStepStatus;
use Processmanager\Models\PMProcessStepVariable;
use Processmanager\Models\PMEventVariableValue;


class Events
{

    public static function log($processAlias, $stepAlias, $stepStatusAlias, $objectId, $userId,$data)
    {
        $process = self::findProcess($processAlias);
        $processStep = self::findProcessStep($stepAlias, $process->id);
        $processStepStatus = self::findProcessStepStatus($stepStatusAlias, $processStep->id);
        DB::transaction(function () use ($processStep, $processStepStatus, $userId, $objectId, $data) {
            {
                $eventCreate =  PMEvent::create([
                    'process_step_id' => $processStep->id,
                    'process_step_status_id' => $processStepStatus->id,
                    'object_id' => $objectId,
                    'user_id' => $userId
                ]);
                self::processStepVariables($eventCreate->id, $processStep->id, $data);
//        (new NotificationProcess())->check($eventCreate);
            }
        });
    }
    /**
     * @param $alias
     * @return mixed
     */
    private static function findProcess($alias)
    {
        if (!$process = PMProcess::where('alias', $alias)->first()) {
            throw new NotFound(NotFound::processWasNotFound());
        }
            return $process;

    }

    /**
     * @param $stepAlias
     * @param $processId
     * @return mixed
     */
    private static function findProcessStep($stepAlias, $processId)
    {
        if (!$processStep = PMProcessStep::where(['process_id' => $processId, 'alias' => $stepAlias])->first()) {
            throw new NotFound(NotFound::processStepWasNotFound());
        }
            return $processStep;
    }

    /**
     * @param $stepStatusAlias
     * @param $processStepId
     * @return mixed
     */
    private static function findProcessStepStatus($stepStatusAlias, $processStepId)
    {
        if (!$processStepStatus = PMProcessStepStatus::where(['process_step_id' => $processStepId, 'alias' => $stepStatusAlias])->first()) {
            throw new NotFound(NotFound::processStepStatusWasNotFound());
        }
            return $processStepStatus;


    }

    /**
     * @param $eventId
     * @param $processStepId
     * @param $data
     */
    private static function processStepVariables($eventId, $processStepId, $data)
    {

        foreach ($data as  $index=>$variable) {
            $findRecord[]= PMProcessStepVariable::where(['alias'=>$index,'process_step_id'=>$processStepId])->first();
            foreach ($findRecord as $item) {
                PMEventVariableValue::create([
                    'event_id' => $eventId,
                    'process_step_variable_id' => $item->id,
                    'value' => $variable,
                ]);
            }
        }

    }

}