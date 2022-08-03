<?php

namespace App\Listeners;

use App\Events\TransactionsProcessed;
use App\Models\Transaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdatePortfolios
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
     * @param  \App\Events\TransactionsProcessed  $event
     * @return void
     */
    public function handle(TransactionsProcessed $event)
    {
        foreach ($event->transactions as $transaction) {
            $newBalance = Transaction::where([
                'portfolio_id' => $transaction->portfolio_id,
                'currency' => $transaction->currency,
                'ticker' => 'CASH',
            ])->get()->sum(function($transaction) {
                return $transaction->price * $transaction->quantity;
            });

            $portfolio = $transaction->portfolio;
            $portfolio->{$transaction->currency} = $newBalance ?? 0.00;
            $portfolio->save();
        }
    }
}
