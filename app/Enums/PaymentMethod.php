<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case CASH = 'tunai';
    case CARD = 'kartu';
    case QRIS = 'qris';
    case E_WALLET = 'dompet_digital';

    public function label(): string
    {
        return match($this) {
            self::CASH => 'Tunai',
            self::CARD => 'Debit / Kredit',
            self::QRIS => 'QRIS',
            self::E_WALLET => 'E-Wallet (GoPay/OVO)',
        };
    }
}
