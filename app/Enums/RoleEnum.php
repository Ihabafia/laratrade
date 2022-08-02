<?php

namespace App\Enums;

enum RoleEnum: string
{
    case Admin = 'Admin';
    case User = 'User';

    public function label(): string
    {
        return match($this) {
            self::Admin => 'Admin',
            self::User => 'User',
        };
    }

    public function color(): string
    {
        return match($this) {
            RoleEnum::Admin => 'info',
            RoleEnum::User => 'success',
            default => '',
        };
    }

    public function bg()
    {
        return match($this) {
            self::Webmaster => 'bg-body-dark',
            default => 'bg-body-light',
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
