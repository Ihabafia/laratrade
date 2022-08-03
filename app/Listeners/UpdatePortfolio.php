<?php

namespace App\Listeners;

use App\Events\TransactionProcessed;
use App\Models\Portfolio;
use App\Models\Transaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdatePortfolio
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
     * @param  \App\Events\TransactionProcessed  $event
     * @return void
     */
    public function handle(TransactionProcessed $event)
    {
        $newBalance = Transaction::where([
            'portfolio_id' => $event->transaction->portfolio_id,
            'currency' => $event->transaction->currency,
            'ticker' => 'CASH',
        ])->get()->sum(function($transaction) {
            return $transaction->price * $transaction->quantity;
        });

        $portfolio = $event->transaction->portfolio;
        $portfolio->{$event->transaction->currency} = $newBalance;
        $portfolio->save();
    }
}
