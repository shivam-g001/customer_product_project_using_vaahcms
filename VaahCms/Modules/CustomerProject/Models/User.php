<?php namespace VaahCms\Modules\CustomerProject\Models;

use WebReinvent\VaahCms\Models\Notification;
use WebReinvent\VaahCms\Models\User as UserBase;

class  User extends UserBase
{
    public function notify($id)
    {
        $user = \VaahCms\Modules\CustomerProject\Models\User::find($id);

     /*   dd($user);*/



        $notification = \WebReinvent\VaahCms\Models\Notification::where('slug', "send-welcome-email")->first();
        if($notification)
        {
            $inputs = [
                    "user_id" => $user->id,
                    "notification_id" => $notification->id,
                    "custom_url" => 'https://vaah.dev',
                ];

            \WebReinvent\VaahCms\Models\Notification::send(
                $notification, $user, $inputs
            );
        }

        return "Notification sent successfully";
    }
}
