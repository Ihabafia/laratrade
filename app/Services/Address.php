<?php

namespace App\Services;

use Str;

class Address
{
    public string|null $number;
    public string|null $address1;
    public string|null $address2;
    public string|null $full_address1;
    public string|null $city;
    public string|null $province;
    public string|null $postal_code;
    public string|null $country;

    public function __construct($number = null, $address1 = null, $full_address1 = null, $address2 = null, $city = null, $province = null, $postal_code = null, $country = null)
    {
        $this->number = $number;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->full_address1 = $full_address1;
        $this->city = $city;
        $this->province = $province;
        $this->postal_code = $postal_code;
        $this->country = $country ?? 'Canada';

        $this->trim();
    }

    public function fullAddress($lb = "\n"): string
    {
        $address = $this->getAddress1().$lb;
        if($this->address2) {
            $address .= $this->address2.$lb;
        }
        $address .= $this->city.', '.$this->province.' '.$this->getPostalCode().$lb;
        $address .= $this->country();

        return $address;
    }

    public function oneLineAddress(): string
    {
        $address = $this->getAddress1();
        if($this->address2) {
            $address .= $this->address2.' ';
        }
        $address .= $this->city.', '.$this->province.' '.$this->getPostalCode();

        return $address;
    }

    public function twoLineAddress(): string
    {
        $address[] = $this->getAddress1();
        if($this->address2) {
            $address .= $this->address2.' ';
        }
        $address[] = $this->city.', '.$this->province.' '.$this->getPostalCode();

        return $address;
    }

    public function number(): ?string
    {
        return $this->number;
    }

    public function getAddress1(): ?string
    {
        return ($this->number ? $this->number . ' ' . $this->address1 : $this->address1) . ' - ';
    }

    public function getPostalCode(): ?string
    {
        return substr($this->postal_code, 0, 3).' '.substr($this->postal_code, 3, 3);
    }

    public function setPostalCode(): ?string
    {
        return Str::of($this->postal_code)
            ->replace(' ', '')
            ->title();
    }

    public function country(): ?string
    {
        return ucfirst($this->country);
    }

    public function toArray()
    {
        return [
            'number' => $this->number,
            'address1' => $this->getAddress1(),
            'address2' => $this->address2,
            'full_address1' => $this->full_address1,
            'city' => $this->city,
            'province' => $this->province,
            'postal_code' => $this->postal_code,
            'country' => $this->country,
        ];
    }

    public function province()
    {
        return [
            'AB' => 'Alberta',
            'BC' => 'British Columbia',
            'MB' => 'Manitoba',
            'NB' => 'New Brunswick',
            'NL' => 'Newfoundland and Labrador',
            'NS' => 'Nova Scotia',
            'ON' => 'Ontario',
            'PE' => 'Prince Edward Island',
            'QC' => 'Quebec',
            'SK' => 'Saskatchewan',
            'NT' => 'Northwest Territories',
            'NU' => 'Nunavut',
            'YT' => 'Yukon',
        ][$this->province];
    }

    private function trim()
    {
        foreach ($this as $key => $variable) {
            $this->{$key} = trim($variable);
        }
    }
}
