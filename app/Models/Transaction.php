<?php

namespace App\Models;

use App\Casts\CurrencyCast;
use App\Enums\TransactionEnum;
use App\Enums\TransactionTypeEnum;
use App\Models\Scopes\PortfolioScope;
use App\Models\Scopes\UserScope;
use App\Traits\AuditTrailable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class Transaction extends Model
{
    use HasFactory, LogsActivity, AuditTrailable;

    protected $casts = [
        'action' => TransactionTypeEnum::class,
        'date' => 'datetime',
        'price' => CurrencyCast::class,
        'quantity' => 'float',
    ];

    protected static function booted()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
        static::addGlobalScope(new PortfolioScope);

        static::creating(function ($asset) {
            $asset->user_id = auth()->id();
        });
    }

    public function getTickerDescriptionAttribute()
    {
        return $this->asset->ticker . ' - ' . $this->asset->description;
    }

    public function getAmountAttribute()
    {
        return $this->quantity * $this->price;
    }

    public function getQtyAttribute()
    {
        if(in_array($this->action, [
            TransactionTypeEnum::Buy,
            TransactionTypeEnum::Sell,
        ])) {
            return $this->quantity;
        }
    }

    public function getThePriceAttribute()
    {
        if(in_array($this->action, [
            TransactionTypeEnum::Buy,
            TransactionTypeEnum::Sell,
        ])) {
            return $this->price;
        }
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

}
