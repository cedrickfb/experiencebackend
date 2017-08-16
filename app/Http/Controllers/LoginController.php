<?php

namespace App\Http\Controllers;

use App\Employee;
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $rep['state'] = false;
            $rep['message'] = "Un utilisateur est deja connecter";
        }else{
            $emp = Employee::whereRaw('password = ' . $id)->first();
            if($emp == null){
                $rep['state'] = false;
                $rep['message'] = "Mauvais mot de passe, veuillez reessayer.";
            }else{
                $token = session()->get('_token');
                $emp->remember_token = $token;
                $emp->save();
                $rep['state'] = true;
                $rep['message'] = "Connexion reussis";
            }
        }
        return response()->json($rep);
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
