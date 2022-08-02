<?php

namespace App\Providers;


use App\Actions\Users\CreateUser;
use App\Interfaces\Actions\Users\CreatesUser;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CreatesUser::class => CreateUser::class,
    ];
}
