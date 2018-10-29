<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/29/18
 * Time: 1:44 PM
 */

namespace ProcessManager\Models;


class NotificationProcess
{

    public function check($event)
    {
        $findNotifications= PMEventNotification::where('step_id',$event->process_step_id)->get();
        dd('check');


    }


}