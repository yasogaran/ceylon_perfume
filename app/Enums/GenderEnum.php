<?php

namespace App\Enums;

enum GenderEnum: string
{
    case MAN = 'man';
    case WOMEN = 'women';
    case UNISEX = 'unisex';

    public static function labels(): array
    {
        return [
            self::MAN->value => 'Male',
            self::WOMEN->value => 'Female',
            self::UNISEX->value => 'Unisex',
        ];
    }
}
