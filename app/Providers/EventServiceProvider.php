<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            \App\Listeners\CreateADefaultPortfolio::class,
            \App\Listeners\SendActivationNotificationListener::class,
        ],
        Login::class => [
            \App\Listeners\SetDefaultPortfolioInSession::class,
        ],
        \App\Events\TransactionProcessed::class => [
            \App\Listeners\UpdatePortfolio::class,
        ],
        \App\Events\TransactionsProcessed::class => [
            \App\Listeners\UpdatePortfolios::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
