<?php

namespace App\Listeners;

use App\Enums\AssetTypeEnum;
use App\Enums\CurrencyEnum;
use App\Enums\Enums;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateADefaultPortfolio
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
        $portfolio = $event->user->portfolios()->create([
            'name' => 'Personal',
            'description' => 'Personal Portfolio',
        ]);

        $portfolio->assets()->createMany(array([
            'user_id' => $event->user->id,
            'ticker' => 'CASH',
            'description' => 'Cash Deposits / Withdrawals CAD',
            'type' => Enums::Cash,
            'currency' => CurrencyEnum::CAD,
        ],
        [
            'user_id' => $event->user->id,
            'ticker' => 'CASH',
            'description' => 'Cash Deposits / Withdrawals USD',
            'type' => Enums::Cash,
            'currency' => CurrencyEnum::USD,
        ]));
    }
}
