<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * @property string value
 */
class Category extends Model
{
    protected $fillable = [
        'name',
        'parent_id'
    ];

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function getParentIdAttribute (){
        if(\Request::path() === "api/categories"){
            $parent = Category::select('name')->whereRaw('id = ' .$this->attributes['parent_id'])->get();
            if(sizeof($parent) >0){
                $this->attributes['parent_id'] = $parent[0]->attributes['name'];
                return $this->attributes['parent_id'];
            }else{
                return "Aucune";
            }
        }else{
            return $this->attributes['parent_id'];
        }
    }
}
