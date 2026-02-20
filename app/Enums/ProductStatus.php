<?php

namespace App\Enums;

enum ProductStatus: int
{
    case Inactive = 0;
    case Active = 1;

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Aktif',
            self::Inactive => 'Nonaktif',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Active => 'bg-green-100 text-green-700',
            self::Inactive => 'bg-gray-100 text-gray-500',
        };
    }
}
