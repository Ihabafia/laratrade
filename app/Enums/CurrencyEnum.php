<?php

namespace App\Enums;

enum CurrencyEnum: string
{
    case CAD = 'CAD';
    case USD = 'USD';

    public function label(): string
    {
        return match($this) {
            self::CAD => 'Canadian Dollars (CAD)',
            self::USD => 'US Dollars (USD)',
        };
    }

    public function symbol(): string
    {
        return match($this) {
            self::CAD => 'CA$',
            self::USD => '$',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::CAD => 'primary',
            self::USD => 'info',
            default => '',
        };
    }

    public function lightColor(): string
    {
        return match($this) {
            self::CAD, self::USD => 'light-primary',
            default => '',
        };
    }

    public static function toArray(): array
    {
        foreach (self::cases() as $enum) {
            $result[$enum->value] = $enum->label();
        }

        return $result;
    }
}
