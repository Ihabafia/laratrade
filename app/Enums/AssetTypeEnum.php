<?php

namespace App\Enums;

enum AssetTypeEnum: string
{
    case Stock = 'Stock';
    case Crypto = 'Crypto';
    //case Cash = 'Cash';

    public function label(): string
    {
        return match($this) {
            self::Stock => 'Stock',
            self::Crypto => 'Crypto',
            //self::Cash => 'Cash',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Stock => 'success',
            self::Crypto => 'primary',
            //self::Cash => 'info',
            default => '',
        };
    }

    public function lightColor(): string
    {
        return match($this) {
            self::Stock => 'light-success',
            self::Crypto => 'light-primary',
            //self::Cash => 'light-info',
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
