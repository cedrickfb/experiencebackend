<?php

namespace App\Http\Middleware;

use App\Employee;
use Closure;
use Illuminate\Support\Facades\Session;

class LoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $loginurl = "login";
       if($request->session()->has('userlogged')) {
           $employee = $request->session()->get('userlogged');
           dd($employee);
           if (Employee::find($employee[0])) {
               $empl = Employee::find($employee[0]);
               $token = session()->get('_token');
               if ($empl->remember_token != null) {
                   if ($empl->remember_token == $token) {
                       return $next($request);
                   } else {
                       $empl->remember_token = null;
                       $empl->save();
                       //return redirect("login");
                       return $next($request);
                   }
               } else {
                   $empl->remember_token = $token;
                   $empl->save();
                   #p-t un message flash pour dire que le dude est connecter
                   return $next($request);
               }
               /*dd($employee);
               dd($request->session('attributes')->get('_previous')['url']);
                return $next($request->attributes()->get('_previous'));*/
           } else {
               //dd("asdf");
               return redirect($request->session('attributes')->get('_previous')['url']);
           }
           dd($request->session()->has('userlogged'));
           dd($request->session());
           return $next($request);
       }else {
           return redirect($loginurl);
           return $next($request);
       }
         //$request->session()->push('nouveau cookie numero 1');
        return $next($request);
    }
}
