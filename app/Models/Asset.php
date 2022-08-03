<?php

namespace App\Models;

use App\Enums\AssetTypeEnum;
use App\Enums\CurrencyEnum;
use App\Enums\Enums;
use App\Models\Scopes\UserScope;
use App\Traits\AuditTrailable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MyCLabs\Enum\Enum;
use Spatie\Activitylog\Traits\LogsActivity;

class Asset extends Model
{
    use HasFactory, LogsActivity, AuditTrailable;

    protected $casts = [
        'type' => Enums::class,
        'currency' => CurrencyEnum::class,
    ];

    protected static function booted()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }

    /*public function getRouteKeyName(): string
    {
        return 'ticker';
    }*/

    public function setTickerAttribute($value)
    {
        $this->attributes['ticker'] = strtoupper($value);
    }

    public static function selectArray()
    {
        return self::orderBy('ticker')
            ->get()
            ->pluck('ticker', 'id');
    }

    public function scopeWithOutCash($builder)
    {
        return $builder->where('ticker', '!=', 'CASH');
    }

    public static function selectArrayWithOutCash()
    {
        return self::where('ticker', '!=', 'CASH')
            ->orderBy('ticker')
            ->get()
            ->pluck('ticker', 'id');
    }
}
