<?php

namespace App\Enums;

enum CashEnum: string
{
    case Deposit = 'Deposit';
    case Withdraw = 'Withdraw';
    case CAD2USD = 'CAD2USD';
    case USD2CAD = 'USD2CAD';

    public function label(): string
    {
        return match($this) {
            self::Deposit => 'Deposit',
            self::Withdraw => 'Withdraw',
            self::CAD2USD => 'Convert CAD to USD',
            self::USD2CAD => 'Convert USD to CAD',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Deposit => 'success',
            self::Withdraw => 'warning',
            self::CAD2USD, self::USD2CAD => 'info',
            default => '',
        };
    }

    public function lightColor(): string
    {
        return match($this) {
            self::Buy => 'light-success',
            self::Sell => 'light-warning',
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
