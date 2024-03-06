<?php

namespace App\Helpers;

class Money
{
    public static function format($money, $withSymbol = true): string
    {
        if ($withSymbol) {
            return self::getCurrencySymbol(). ' ' . number_format($money, 2);
        }

        return number_format($money, 2);
    }

    public static function getCurrencySymbol(): string
    {
        return '$';
    }
}
