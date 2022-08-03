<?php

namespace App\Enums;

enum Enums: string
{
    case Buy = 'Buy';
    case Sell = 'Sell';
    case Dividend = 'Dividend';
    case Deposit = 'Deposit';
    case Withdraw = 'Withdraw';
    case CAD2USD = 'CAD2USD';
    case USD2CAD = 'USD2CAD';
    case Cash = 'Cash';
    case Stock = 'Stock';
    case Crypto = 'Crypto';

    public function label(): string
    {
        return match($this) {
            self::Buy => 'Buy',
            self::Sell => 'Sell',
            self::Dividend => 'Dividend',
            self::Deposit => 'Deposit',
            self::Withdraw => 'Withdraw',
            self::CAD2USD => 'Convert CAD to USD',
            self::USD2CAD => 'Convert USD to CAD',
            self::Stock => 'Stock',
            self::Crypto => 'Crypto',
            self::Cash => 'Cash',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Buy, self::Stock => 'success',
            self::Sell => 'danger',
            self::Dividend, self::Cash => 'info',
            self::Deposit, self::Withdraw, self::CAD2USD, self::USD2CAD, self::Crypto => 'primary',
            default => '',
        };
    }

    public function lightColor(): string
    {
        return match($this) {
            self::Buy, self::Stock => 'light-success',
            self::Sell => 'light-danger',
            self::Dividend, self::Cash => 'light-info',
            self::Deposit, self::Withdraw, self::CAD2USD, self::USD2CAD, self::Crypto => 'light-primary',
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
