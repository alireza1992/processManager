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

class Events
{
    public static function Log($processAlias , $stepAlias , $stepStatusAlias , $objectId , $userId)
    {

        $process = self::findProcess($processAlias);
        $processStep = self::findProcessStep($stepAlias, $process->id);
        $processStepStatus = self::findProcessStepStatus($stepStatusAlias, $processStep->id);
        $insertEvent = Event::create([
            'process_step_id' => $processStep->id,
            'process_step_status_id' => $processStepStatus->id,
            'object_id' => $objectId,
            'user_id' => $userId
        ]);
        dd($insertEvent);


    }

    /**
     * @param $alias
     * @return mixed
     */
    private static function findProcess($alias)
    {
        return Process::where('alias',$alias)->first();
    }

    /**
     * @param $stepAlias
     * @param $processId
     * @return mixed
     */
    private static function findProcessStep($stepAlias , $processId)
    {
        return ProcessStep::where(['process_id'=>$processId ,'alias' =>$stepAlias])->first();
    }

    /**
     * @param $stepStatusAlias
     * @param $processStepId
     * @return mixed
     */
    private static function findProcessStepStatus($stepStatusAlias , $processStepId)
    {
        return ProcessStepStatus::where(['process_step_id'=>$processStepId ,'alias' =>$stepStatusAlias])->first();
    }

}