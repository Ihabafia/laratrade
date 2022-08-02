<?php

namespace App\Actions;

use App\Enums\AssetTypeEnum;
use App\Models\Account;
use App\Models\Asset;
use Illuminate\Support\Collection;

class ConvertCurrency
{
    protected Account $account;
    protected Asset $asset;

    public function __construct(public array $data, public string $action)
    {
        $this->account = Account::find($this->data['account_id']);
    }

    public function converted(): Collection
    {
        $converted = $this->convert();

        $asset = Asset::where(['ticker' => AssetTypeEnum::Cash, 'currency' => 'CAD'])->first();
        $result['CAD'] = [
            'account_id' => $this->account->id,
            'asset_id' => $asset->id,
            'quantity' => 1,
            'price' => $converted['price_cad'],
            'action' => $this->data['action'],
            'date' => $all['date'] ?? now(),
        ];

        $asset = Asset::where(['ticker' => AssetTypeEnum::Cash, 'currency' => 'USD'])->first();
        $result['USD'] = [
            'account_id' => $this->account->id,
            'asset_id' => $asset->id,
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

