<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetDefaultPortfolioInSession
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
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $portfolios = $event->user->portfolios;
        session()->put('portfolio', $portfolios->first()->toArray());
        session()->put('portfolios', $portfolios->pluck('id', 'name'));

        $log = activity($event->user->id)
            ->causedBy($event->user)
            ->performedOn($event->user)
            ->event('logged-in')
            ->log(__('custom-messages.audit-action__model__event__', ['model' => 'user', 'event' => 'logged in']));
    }
}
