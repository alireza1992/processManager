<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/27/18
 * Time: 4:20 PM
 */

namespace ProcessManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use ProcessManager\Models\PMEventNotification;


class NotificationParameters extends Model
{

    /**
     * @param $request
     */
    public function notification($request)
    {
        foreach ($request['processMode'] as $stepId => $modes) {
        $record = new PMEventNotification();
            $record->step_id =$stepId ;
            $record->process_id =$request['processId'];
            $record->body = $request['body'];
            $record->status = $request['status'];
//      $request->log_count = ;
//      $request->target_count = ;
            $record->save();
        }


    }

    /**
     * @param $request
     */
    public function customContact($request)
    {

        foreach ($request['mobile'] as $mobile)
            if ($mobile !== "") {
                DB::table('event_notification_custom_contacts')->insert([
                    'notification_id' => $request['notificationId'],
                    'contact' => $mobile,
                    'created_at' => Carbon::now()

                ]);
            }
        foreach ($request['email'] as $email)
            if ($email !== "") {
                DB::table('event_notification_custom_contacts')->insert([
                    'notification_id' => $request['notificationId'],
                    'contact' => $email,
                    'created_at' => Carbon::now()

                ]);
            }
    }

    /**
     * @param $request
     */
    public function targetUsers($request)
    {
        foreach ($request['userMode'] as $user => $modes) {
            foreach ($modes as $mode) {
                DB::table('event_notification_target_users')->insert([
                    'notification_id' => $request['notificationId'],
                    'user_id' => $user,
                    'mode' => $mode,
                    'created_at' => Carbon::now()
                ]);
            }
        }
    }

    /**
     * @param $request
     */
    public function targetUserGroups($request)
    {
        foreach ($request['groupMode'] as $user => $modes) {
            foreach ($modes as $mode) {
                DB::table('event_notification_target_user_groups')->insert([
                    'notification_id' => $request['notificationId'],
                    'group_id' => $user,
                    'mode' => $mode,
                    'created_at' => Carbon::now()
                ]);
            }
        }
    }

    /**
     * @param $request
     */
    public function inProcess($request)
    {
        foreach ($request['processMode'] as $stepId => $modes) {
            foreach ($modes as $mode) {
                DB::table('event_notification_target_inProcesses')->insert([
                    'notification_id' => $request['notificationId'],
                    'step_id' => $stepId,
                    'mode' => $mode,
                    'created_at' => Carbon::now()
                ]);
            }
        }
    }

    public function conditions($request)
    {
        foreach ($request['conditionStatus'] as $key => $item) {
//            foreach ($modes as $mode) {
                DB::table('event_notification_conditions')->insert([
                    'notification_id' => $request['notificationId'],
                    'status_id' => $item,
                    'created_at' => Carbon::now()
                ]);
//            }
        }
    }


}

