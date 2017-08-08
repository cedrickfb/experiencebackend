<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'text',
        'viewed',
        'created_at',
        'updated_at'
    ];
}
