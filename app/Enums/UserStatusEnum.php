<?php

namespace App\Enums;

enum UserStatusEnum: string
{
    case Active = 'Active';
    case Inactive = 'Inactive';
    case Blocked = 'Blocked';

    public function label(): string
    {
        return match($this) {
            self::Active => 'Active',
            self::Inactive => 'Inactive',
            self::Blocked => 'Blocked',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Active => 'success',
            self::Inactive => 'warning',
            self::Blocked => 'dark',
            default => '',
        };
    }

    public function lightColor(): string
    {
        return match($this) {
            self::Active => 'light-success',
            self::Inactive => 'light-warning',
            self::Blocked => 'dark',
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
