<?php

namespace App\ValueObject;

enum Role: string
{
    case SUPER_ADMIN = 'super-admin';
    case ADMIN = 'admin';
    case MANAGER = 'manager';

    public function level(): int
    {
        return match ($this) {
            self::SUPER_ADMIN => 999,
            self::MANAGER => 1,
            self::ADMIN => 2,
        };
    }
}
