<?php

namespace App;
use App\Observers\ProductObservers;
use App\Events\ProductQuantityChange;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = [
        'codebar',
        'used',
        'name',
        'original_cost' ,
        'selling_price' ,
        'min_qty' ,
        'max_qty' ,
        'deposit' ,
        'allow_notif',
        'qty' ,
        'category_id' ,
        'bonidollar',
        'tps',
        'tvq',
    ];
    public function category(){
        return $this->belongsTo('App\Category');
    }

   public $events = [
       'updated' =>  ProductQuantityChange::class
    ];


}
