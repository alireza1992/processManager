<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/6/18
 * Time: 1:45 PM
 */

namespace Alireza1992\ProcessManager;


use App\Event;
use App\Process;
use App\ProcessStep;
use App\ProcessStepStatus;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class Events
{

    public static function log($processAlias, $stepAlias, $stepStatusAlias, $objectId, $userId)
    {
        $process = self::findProcess($processAlias);
        $processStep = self::findProcessStep($stepAlias, $process->id);
        $processStepStatus = self::findProcessStepStatus($stepStatusAlias, $processStep->id);
         DB::transaction(function () use ($processStep, $processStepStatus, $userId, $objectId){ {
             Event::create([
                 'process_step_id' => $processStep->id,
                 'process_step_status_id' => $processStepStatus->id,
                 'object_id' => $objectId,
                 'user_id' => $userId
             ]);
         }});

    }

    /**
     * @param $alias
     * @return mixed
     */
    private static function findProcess($alias)
    {

        if ($process=Process::where('alias', $alias)->first()) {
            return $process;
        } else {
            $e = new NotFound();
           return $e->processWasNotFound();
        }
    }

    /**
     * @param $stepAlias
     * @param $processId
     * @return mixed
     */
    private static function findProcessStep($stepAlias, $processId)
    {
        if ($processStep=ProcessStep::where(['process_id' => $processId, 'alias' => $stepAlias])->first()) {
            return $processStep;
        } else {
            $e = new NotFound();
            return $e->processStepWasNotFound();
        }


    }

    /**
     * @param $stepStatusAlias
     * @param $processStepId
     * @return mixed
     */
    private static function findProcessStepStatus($stepStatusAlias, $processStepId)
    {
        if ($processStepStatus=ProcessStepStatus::where(['process_step_id' => $processStepId, 'alias' => $stepStatusAlias])->first()) {
            return $processStepStatus;
        } else {
            $e = new NotFound();
            return $e->processStepStatusWasNotFound();
        }

    }

}