<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use App\Traits\AuditTrailable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class Account extends Model
{
    use HasFactory, LogsActivity, AuditTrailable;

    protected $casts = [
        'cash' => 'json',
    ];

    protected static function booted()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }

    public function getBalanceUSDAttribute()
    {
        return $this->cash['USD'] / 100;
    }

    public function setBalanceUSDAttribute($value)
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
    }

    public static function selectArray()
    {
        return self::orderBy('name')
            ->get()
            ->pluck('name', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
