<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'company_name',
        'no_tps',
        'no_tvq',
        'address',
        'city',
        'province',
        'country',
        'postal_code',
        'telephone',
        'telephone',
        'fax',
        'email',
        'active',
        'bonidollar',
        'tps',
        'tvq',
        'show_name'
    ];
}
