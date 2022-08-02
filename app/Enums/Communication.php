<?php

namespace App\Enums;

enum Communication: string
{
    case Email = 'Email';
    case AdminEmail = 'AdminEmail';
    case SMS = 'SMS';
    case AdminSMS = 'AdminSMS';

    public function label(): string
    {
        return match($this) {
            self::Email => 'Email',
            self::AdminEmail => 'Admin Email',
            self::SMS => 'SMS',
            self::AdminSMS => 'Admin SMS',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Email => 'success',
            self::AdminEmail, self::AdminSMS => 'warning',
            self::SMS => 'info',
        };
    }

    public function route(): string
    {
        return match($this) {
            self::Email => 'email',
            self::AdminEmail => 'admin-email',
            self::SMS => 'sms',
            self::AdminSMS => 'admin-sms',
        };
    }

    public static function toArray(): array
    {
        foreach (self::cases() as $enum) {
            $result[$enum->value] = $enum->label();
        }

        return $result;
    }

    public static function toArrayValues(): array
    {
        foreach (self::cases() as $enum) {
            $result[$enum->name] = $enum->value;
        }

        return $result;
    }
}
