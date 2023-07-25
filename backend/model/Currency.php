<?php

namespace App\model;

/**
 * Currency
 * @property string $code
 * @property numeric $rate
 * @property int $nominal
 */
class Currency extends BaseModel
{
    protected $table = 'currency';

    protected $fillable = ['code', 'rate', 'nominal'];

    public $timestamps = false;

    protected $rules = [
        'code' => 'required|string|max:3',
        'rate' => 'required|numeric',
        'nominal' => 'required|integer',
    ];
}
