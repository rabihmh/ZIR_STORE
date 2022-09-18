<?php

namespace App\Helpers;

use NumberFormatter;

class Currency
{
    public static function format($amount, $currency = null)
    {
        $formatter = new NumberFormatter(config('app.local'), NumberFormatter::CURRENCY);
        if ($currency === null) {
            return $formatter->formatCurrency($amount, config('app.currency', 'USD'));
        }
        return $formatter->formatCurrency($amount, $currency);
    }
}
