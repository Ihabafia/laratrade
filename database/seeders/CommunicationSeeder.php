<?php

namespace Database\Seeders;

use App\Models\Communication;
use App\Services\Address;
use Illuminate\Database\Seeder;

class CommunicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mtc = Communication::create([
            'slug' => 'new-user-activation-notification-email',
            'type' => 'Email',
            'title' => 'New User Activation Notification',
            'subject' => 'Welcome to LaraTrade Tracker. Please activate your account!',
            'body' => '<p>Dear {@first_name@},</p><p>Welcome to LaraTrade Tracker. Please click on the bottom below to activate your account.</p><p>{_{@link@},success,Activate &amp; Login_}</p>',
            'method' => 'newUserActivationNotification',
            'variables' => null,

        ]);
    }
}
