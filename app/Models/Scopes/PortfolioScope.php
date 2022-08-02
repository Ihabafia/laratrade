<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PortfolioScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('account_id', session('portfolio')['id']);
    }
}

