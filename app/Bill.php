<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'type',
        'tps',
        'tvq',
        'total',
        'taxable',
        'non_taxable',
        'bonidollars',
        'consigne',
        'customers_id',
        'employees_id',
        'company_id',
        ];
}
