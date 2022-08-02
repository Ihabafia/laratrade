<?php

namespace App\Enums;

enum TransactionTypeEnum: string
{
    case Buy = 'Buy';
    case Sell = 'Sell';
    case Dividend = 'Dividend';
    case Deposit = 'Deposit';
    case Withdraw = 'Withdraw';
    case CAD2USD = 'CAD2USD';
    case USD2CAD = 'USD2CAD';

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
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Buy => 'success',
            self::Sell => 'danger',
            self::Dividend => 'info',
            self::Deposit, self::Withdraw, self::CAD2USD, self::USD2CAD => 'primary',
            default => '',
        };
    }

    public function lightColor(): string
    {
        return match($this) {
            self::Buy => 'light-success',
            self::Sell => 'light-danger',
            self::Dividend => 'light-info',
            self::Deposit, self::Withdraw, self::CAD2USD, self::USD2CAD => 'light-primary',
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
