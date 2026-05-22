<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case CASHIER = 'kasir';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrator',
            self::CASHIER => 'Kasir',
        };
    }
}
