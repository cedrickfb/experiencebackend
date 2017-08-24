<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'amount',
        'used_amount',
        'customers_id',
        'employees_id'
    ];
}
