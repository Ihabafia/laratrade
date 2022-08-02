<?php

namespace App\Casts;

use App\Services\Address;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class AddressCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): Address
    {
        $attr = json_decode("{}");

        if(isset($attributes[$key])) {
            $attr = json_decode($attributes[$key]);
        }

        return new Address(
            number:$attr->number ?? null,
            address1:$attr->address1 ?? null,
            full_address1: $attr->full_address1 ?? null,
            address2:$attr->address2 ?? null,
            city: $attr->city ?? null,
            province: $attr->province ?? null,
            postal_code: $attr->postal_code ?? null,
            country: $attr->country ?? null,
        );
    }

    public function set($model, string $key, $value, array $attributes): array
    {
        return [
            $key => json_encode([
                'number' => $value->number,
                'address1' => $value->address1,
                'address2' => $value->address2,
                'full_address1' => $value->full_address1,
                'city' => $value->city,
                'province' => $value->province,
                'postal_code' => $value->setPostalCode(),
                'country' => ucfirst($value->country),
            ])
        ];
    }
}
