<?php

namespace App\Http\Requests;

use App\Enums\TransactionEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreTransactionRequest extends FormRequest
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
            'ticker_id' => ['required'],
            'action' => [new Enum(TransactionEnum::class)],
            'quantity' => ['numeric', 'gt:0'],
            'price' => ['required', 'numeric', 'gt:0'],
            'date' => ['nullable', 'date'],
        ];
    }
}
