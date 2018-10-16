<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/6/18
 * Time: 1:45 PM
 */

namespace Alireza1992\ProcessManager;

use Illuminate\Support\Facades\DB;
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
        DB::transaction(function () use ($processStep, $processStepStatus, $userId, $objectId) {
            {
                return PMEvent::create([
                    'process_step_id' => $processStep->id,
                    'process_step_status_id' => $processStepStatus->id,
                    'object_id' => $objectId,
                    'user_id' => $userId
                ]);

            }
        });
    }

    /**
     * @param $alias
     * @return mixed
     */
    private static function findProcess($alias)
    {
        if ($process = PMProcess::where('alias', $alias)->first()) {
            return $process;
        } else {
            throw new NotFound(NotFound::processWasNotFound());
        }
    }

    /**
     * @param $stepAlias
     * @param $processId
     * @return mixed
     */
    private static function findProcessStep($stepAlias, $processId)
    {
        if ($processStep = PMProcessStep::where(['process_id' => $processId, 'alias' => $stepAlias])->first()) {
            return $processStep;
        } else {
            throw new NotFound(NotFound::processStepWasNotFound());

        }
    }

    /**
     * @param $stepStatusAlias
     * @param $processStepId
     * @return mixed
     */
    private static function findProcessStepStatus($stepStatusAlias, $processStepId)
    {
        if ($processStepStatus = PMProcessStepStatus::where(['process_step_id' => $processStepId, 'alias' => $stepStatusAlias])->first()) {
            return $processStepStatus;
        } else {
            throw new NotFound(NotFound::processStepStatusWasNotFound());

        }


    }

}