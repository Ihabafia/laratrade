<?php

namespace App\Models;

use App\Casts\CurrencyCast;
use App\Models\Scopes\UserScope;
use App\Traits\AuditTrailable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;

class Portfolio extends Model
{
    use HasFactory, LogsActivity, AuditTrailable;

    protected $casts = [
        'CAD' => CurrencyCast::class,
        'USD' => CurrencyCast::class,
    ];

    protected static function booted()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }

    /*public function getUSDAttribute()
    {
        return $this->cash['USD'] / 100;
    }

    public function setUSDAttribute($value)
    {
        return $this->attributes['cash']['USD'] = (int) ($value * 100);
    }

    public function getBalanceCADAttribute()
    {
        return $this->cash['CAD'] / 100;
    }

    public function setBalanceCADAttribute($value)
    {
        return $this->attributes['cash']['CAD'] = (int) ($value * 100);
    }*/

    public function getCash()
    {
        ray()->showQueries();
        $transactions = $this->transactions->where(['ticker', 'Cash'])
            ->get()
            ->groupBy(function ($transaction) {
                if($transaction->currency == 'CAD') {
                    return 'CAD';
                }
                if($transaction->type == 'USD') {
                    return 'USD';
                }
            })->sum('amount');
        ray()->stopShowingQueries();
    }

    public static function selectArray()
    {
        return self::orderBy('name')
            ->get()
            ->pluck('name', 'id');
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }

    public function cash(): HasMany
    {
        return $this->hasMany(Asset::class, 'portfolio_id', 'id')
            ->where('ticker', 'CASH');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): hasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
