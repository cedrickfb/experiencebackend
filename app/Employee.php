<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $fillable = [
        'firstname',
        'lastname',
        'password',
        'hire_date',
        'leaving_date',
        'remember_token'
    ];
    public $timestamps = false;
}
