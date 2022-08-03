<?php

namespace App\Actions;

use App\Enums\AssetTypeEnum;
use App\Enums\Enums;
use App\Models\Portfolio;
use App\Models\Asset;
use Illuminate\Support\Collection;

class ConvertCurrency
{
    protected Portfolio $portfolio;
    protected Asset $asset;

    public function __construct(public array $data, public string $action)
    {
        $this->portfolio = Portfolio::find($this->data['portfolio_id']);
    }

    public function converted(): Collection
    {
        $converted = $this->convert();
        $cadAsset = $this->portfolio->cash()->where('currency', 'CAD')->first();
        $usdAsset = $this->portfolio->cash()->where('currency', 'USD')->first();

        $result['CAD'] = [
            'user_id' => auth()->id(),
            'asset_id' => $cadAsset->id,
            'ticker' => 'CASH',
            'currency' => 'CAD',
            'quantity' => 1,
            'price' => $converted['price_cad'],
            'action' => $this->data['action'],
            'date' => $all['date'] ?? now(),
        ];

        $result['USD'] = [
            'user_id' => auth()->id(),
            'asset_id' => $usdAsset->id,
            'ticker' => 'CASH',
            'currency' => 'USD',
            'quantity' => 1,
            'price' => $converted['price_usd'],
            'action' => $this->data['action'],
            'date' => $all['date'] ?? now(),
        ];

        return collect($result);
    }

    private function convert(): array
    {
        return [
            'price_cad' => $this->action === 'CAD2USD' ? -$this->data['amount'] : $this->data['amount'] * $this->data['rate'],
            'price_usd' => $this->action === 'CAD2USD' ? $this->data['amount'] * $this->data['rate'] : -$this->data['amount'],
        ];
    }
}

