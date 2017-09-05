<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $fillable = [
        'employees_id',
        'customers_id',
        'description',
        'amount',
        'qty',
    ];
}
