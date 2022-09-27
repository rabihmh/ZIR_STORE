<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    private $apiKey;
    protected $baseUrl = "https://free.currconv.com/api/v7";

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function convert(string $from, string $to, float $amount = 1): float
    {
        //$url = "https://api.apilayer.com/exchangerates_data/convert?to={$to}&from={$from}&amount={$amount}";
        $q = "{$from}_{$to}";
        $response = Http::baseUrl($this->baseUrl)->get('/convert', [
            'q' => $q,
            'compact' => 'y',
            'apiKey' => $this->apiKey,
        ]);
        $result = $response->json();
        //dd($result);
        return $result[$q]['val'] * $amount;
    }
}
