<?php

namespace App\Providers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function boot(){
         \Validator::extend('anyname', function($attribute,$value,$parameters){
             if(preg_match('/^[\pL\s\-]+$/u',$value)) {
                return true;
             }else{
                 return false;
             }

         });
        \Validator::extend('uniqueExcludeMe', function($attribute,$value,$parameters){
            if(DB::table($parameters[0])->whereRaw($attribute . ' = ' . $value . ' and id != ' . $parameters[1])->exists()) {
                return false;
            }else{
                return true;
            }

        });
        \Validator::extend('zipCode', function($attribute,$value,$parameters){
            if(preg_match('@[ABCEGHJKLMNPRSTVXY][0-9][ABCEGHJKLMNPRSTVWXYZ][0-9][ABCEGHJKLMNPRSTVWXYZ][0-9]@',$value)) {
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
