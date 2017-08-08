<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    public function boot(){
         \Validator::extend('anyname', function($attribute,$value,$parameters){
             if(preg_match('/^[\pL\s\-]+$/u',$value)) {
                return true;
             }else{
                 return false;
             }

         });
    }

    public function register()
    {

    }
}
