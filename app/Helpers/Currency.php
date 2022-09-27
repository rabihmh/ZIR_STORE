<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use NumberFormatter;

class Currency
{
    public static function format($amount, $currency = null)
    {
        $formatter = new NumberFormatter(config('app.local'), NumberFormatter::CURRENCY);
        $baseCurrency = config('app.currency', 'USD');
        if ($currency === null) {
            //return $formatter->formatCurrency($amount, config('app.currency', 'USD'));
            $currency = Session::get('currency_code', $baseCurrency);//iza mush mawjud bl session jibli yeah mn config
        }
        if ($currency != $baseCurrency) {
            $rate = Cache::get('currency_rates' . $currency, 1);
            $amount = $amount * $rate;
        }
        return $formatter->formatCurrency($amount, $currency);
    }
}
