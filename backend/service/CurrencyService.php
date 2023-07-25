<?php

namespace App\service;

use SimpleXMLElement;

/**
 * CurrencyService
 */
class CurrencyService
{
    /**
     * @return array[]
     * @throws \Exception
     */
    public function fetchRates()
    {
        $xml = new SimpleXMLElement(file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp'));

        $rates = ['RUB' => ['rate' => 1, 'nominal' => 1]]; // Add RUB to the rates array with a rate of 1
        foreach ($xml->Valute as $valute) {
            $code = (string)$valute->CharCode;
            $nominal = (int)$valute->Nominal;
            $rate = (float)str_replace(',', '.', $valute->Value) / $nominal;

            $rates[$code] = ['rate' => $rate, 'nominal' => $nominal];
        }

        return $rates;
    }
}