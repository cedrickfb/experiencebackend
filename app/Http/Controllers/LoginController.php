<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Setting;
use Closure;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $try = Employee::whereNotNull('remember_token')->first();
        if($try <> null ){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

        $try = Employee::whereNotNull('remember_token')->first();
        //dd($try);
        if($try <> null){
            $rep = false;
            //$rep['message'] = "Un utilisateur est deja connecter";
        }else{
            $emp = Employee::whereRaw('password = \'' . $id . '\'')->first();
            if($emp == null){
                $rep = false;
              //  $rep['message'] = "Mauvais mot de passe, veuillez reessayer.";
            }else{
                $token = session()->get('_token');
                $emp->remember_token = $token;
                $emp->save();
                $rep = true;
                $settings = Setting::whereRaw('active = 1')->get();

               // $rep['message'] = "Connexion reussis";
            }
        }
        return response()->json(compact('rep',$rep,'emp',$emp,'settings',$settings));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
