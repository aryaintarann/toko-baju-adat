<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Shipped = 'shipped';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Processing => 'Diproses',
            self::Shipped => 'Dikirim',
            self::Completed => 'Selesai',
            self::Cancelled => 'Batal',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'bg-yellow-100 text-yellow-700',
            self::Processing => 'bg-blue-100 text-blue-700',
            self::Shipped => 'bg-purple-100 text-purple-700',
            self::Completed => 'bg-green-100 text-green-700',
            self::Cancelled => 'bg-red-100 text-red-700',
        };
    }
}
