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
       // $request->session()->push('nouveau cookie numero 2','cookie 2');
        //dd($request->session());
       // $request->session()->push('nouveau cookie numero 2','cookie 2'); #pour montrer comment sa marche

        /*declarer cette variable lorsque le programme boot
         et recuperer lorsque le front et le back-end se connectent enssemble
         $request->session()->push('test',134513);
         $request->session()->remove('test',0);
         dd($request->session());*/
        $loginurl = "login";

       if($request->session()->has('test')) {
           $employee = $request->session()->get('test');
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
           dd($request->session()->has('test'));
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
