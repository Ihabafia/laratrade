<?php

namespace App\Listeners;

use App\Enums\AssetTypeEnum;
use App\Enums\CurrencyEnum;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateADefaultAccount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $event->user->accounts()->create([
            'name' => 'Personal',
            'cash' => [
                'CAD' => 0,
                'USD' => 0,
            ]
        ]);

        $event->user->assets()->createMany(array([
            'ticker' => 'CASH',
            'description' => 'Cash Deposits / Withdrawals CAD',
            'type' => AssetTypeEnum::Cash,
            'currency' => CurrencyEnum::CAD,
        ],
        [
            'ticker' => 'CASH',
            'description' => 'Cash Deposits / Withdrawals USD',
            'type' => AssetTypeEnum::Cash,
            'currency' => CurrencyEnum::USD,
        ]));
    }
}
