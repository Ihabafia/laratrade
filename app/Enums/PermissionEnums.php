<?php

namespace App\Enums;

enum PermissionEnums: string
{
    case ManageUsers = 'manage_users';
    case ManagePortfolios = 'manage_portfolios';
    case ManagePortfolio = 'manage_portfolio';
    case ManageStocks = 'manage_stocks';

    public function label(): string
    {
        return match($this) {
            self::ManageUsers => 'Manage Users',
            self::ManagePortfolios => 'Manage Portfolios',
            self::ManagePortfolio => 'Manage Portfolio',
            self::ManageStocks => 'Manage Stocks',
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
