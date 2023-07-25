<?php

namespace App\console\job;

use App\model\Currency;
use App\service\CurrencyService;

/**
 * CurrencyFetchJob
 */
class CurrencyFetchJob
{
    /**
     * @var CurrencyService
     */
    private $currencyService;

    public function __construct()
    {
        $this->currencyService = new CurrencyService();
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $rates = $this->currencyService->fetchRates();

        foreach ($rates as $code => $data) {
            $currency = Currency::updateOrCreate(['code' => $code]);
            $currency->rate = $data['rate'];
            $currency->nominal = $data['nominal'];
            $currency->save();
        }
    }
}
