<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ActivateUserNotification;
use Illuminate\Auth\Events\Registered;

class ReSendNotificationController extends Controller
{
    public function resend(User $user)
    {
        /*if(! $user->temp || $user->password_change_at) {
            return route('login')
                ->withStatus('This is expired');
        }*/

        $user->notify(new ActivateUserNotification);

        return view('auth.verify-email', compact('user'));
    }
}
