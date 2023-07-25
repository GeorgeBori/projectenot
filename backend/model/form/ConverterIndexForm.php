<?php

namespace App\model\form;

use App\model\BaseModel;
use App\model\Currency;

/**
 * SiteLoginForm
 *
 * @property numeric $amount
 * @property string $from
 * @property string $to
 */
class ConverterIndexForm extends BaseModel
{
    protected $fillable = ['amount', 'from', 'to'];

    protected $rules = [
        'amount' => 'required|numeric',
        'from' => 'required|string',
        'to' => 'required|string',
    ];

    /**
     * @return false|float|int
     */
    public function convert()
    {
        $fromCurrency = Currency::where('code', $this->from)->first();

        $toCurrency = Currency::where('code', $this->to)->first();

        if (!$fromCurrency || !$toCurrency) {
            $this->errors[] = 'Error: Currency not found.';
            return false;
        }

        return $this->amount * (($toCurrency->rate / $toCurrency->nominal) / ($fromCurrency->rate / $fromCurrency->nominal));
    }
}
