<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'tel_prefix',
        'telephone',
        'address',
        'city',
        'province',
        'country',
        'postal_code',
        'comments',
        'password',
        'credits'
    ];


}
