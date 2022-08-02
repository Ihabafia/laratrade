<?php

namespace App\Models;

use App\Enums\AssetTypeEnum;
use App\Enums\CurrencyEnum;
use App\Models\Scopes\UserScope;
use App\Traits\AuditTrailable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Asset extends Model
{
    use HasFactory, LogsActivity, AuditTrailable;

    protected $casts = [
        'type' => AssetTypeEnum::class,
        'currency' => CurrencyEnum::class,
    ];

    protected static function booted()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);

        /*static::creating(function ($asset) {
            $asset->user_id = auth()->id();
        });*/
    }

    public static function selectArray()
    {
        return self::orderBy('ticker')
            ->get()
            ->pluck('ticker', 'id');
    }
}
