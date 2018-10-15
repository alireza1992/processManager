<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/6/18
 * Time: 1:45 PM
 */

namespace Alireza1992\ProcessManager;


use Alireza1992\ProcessManager\Models\PMEvent;
use Alireza1992\ProcessManager\Models\PMProcess;
use Alireza1992\ProcessManager\Models\PMProcessStep;
use Alireza1992\ProcessManager\Models\PMProcessStepStatus;


class Events
{
    public static function log($processAlias, $stepAlias, $stepStatusAlias, $objectId, $userId)
    {
        $process = self::findProcess($processAlias);
        $processStep = self::findProcessStep($stepAlias, $process->id);
        $processStepStatus = self::findProcessStepStatus($stepStatusAlias, $processStep->id);
        $insertEvent = PMEvent::create([
            'process_step_id' => $processStep->id,
            'process_step_status_id' => $processStepStatus->id,
            'object_id' => $objectId,
            'user_id' => $userId
        ]);
        return 'done';
    }

    /**
     * @param $alias
     * @return mixed
     */
    private static function findProcess($alias)
    {
        return PMProcess::where('alias', $alias)->first();
    }

    /**
     * @param $stepAlias
     * @param $processId
     * @return mixed
     */
    private static function findProcessStep($stepAlias, $processId)
    {
        return PMProcessStep::where(['process_id' => $processId, 'alias' => $stepAlias])->first();
    }

    /**
     * @param $stepStatusAlias
     * @param $processStepId
     * @return mixed
     */
    private static function findProcessStepStatus($stepStatusAlias, $processStepId)
    {
        return PMProcessStepStatus::where(['process_step_id' => $processStepId, 'alias' => $stepStatusAlias])->first();
    }

}