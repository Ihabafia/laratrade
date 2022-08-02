<?php

namespace App\Http\Requests;

use App\Enums\AssetTypeEnum;
use App\Enums\CurrencyEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreAssetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'asset.ticker' => ['required', 'string', 'max:10'],
            'asset.description' => ['required', 'string', 'max:255'],
            'asset.type' => ['required', new Enum(AssetTypeEnum::class)],
            'asset.currency' => ['required', new Enum(CurrencyEnum::class)],
        ];
    }
}
