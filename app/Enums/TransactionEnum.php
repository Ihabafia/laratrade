<?php

namespace App\Enums;

enum TransactionEnum: string
{
    case Buy = 'Buy';
    case Sell = 'Sell';
    case Dividend = 'Dividend';

    public function label(): string
    {
        return match($this) {
            self::Buy => 'Buy',
            self::Sell => 'Sell',
            self::Dividend => 'Dividend',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Buy => 'success',
            self::Sell => 'danger',
            self::Dividend => 'info',
            default => '',
        };
    }

    public function lightColor(): string
    {
        return match($this) {
            self::Buy => 'light-success',
            self::Sell => 'light-danger',
            self::Dividend => 'light-info',
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
