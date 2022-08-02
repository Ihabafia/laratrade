<?php

namespace App\Actions\Commands;

use App\Models\Communication;
use App\Services\NotificationsVariables;

class UpdateVars
{
    /**
     * @param MasterCommunication|null $notification
     * @return void
     */
    public function __invoke(Communication $notification = null)
    {
        if($notification) {
            $notifications = collect([$notification]);
        }

        if(! $notification) {
            $notifications = Communication::all();
        }

        if($notifications->count() == 0) {
            return;
        }

        foreach ($notifications as $notification) {
            $notificationVariables = new NotificationsVariables();

            if(!$notification->method) {
                continue;
            }

            $vars = $notificationVariables->{$notification->method}();

            $notification->variables = $vars;
            $notification->save();
        }

        return $vars;
    }
}
