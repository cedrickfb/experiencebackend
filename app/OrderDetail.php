<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'name',
        'description',
        'qty',
        'received',
    ];
}
