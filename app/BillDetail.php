<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = 'bills_details';
    public function bill(){
        return $this->belongsTo('App\Bill');
    }

    public $timestamps = false;
    public $fillable = [
        'qty',
        'discount',
        'bill_id',
        'products_id',
        'bonidollar',
    ];
}
