<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\EditCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { //asadf
       // $cust = DB::table('customers')->selectRaw('id , firstname, lastname ,telephone ,tel_prefix, CONCAT( \'(\', tel_prefix, \') \',INSERT(telephone, 4, 0, \'-\')) as tel')->limit(10)->get();
        $customer = DB::table('customers')->selectRaw(' id, CONCAT_WS(\' \',firstname,lastname) as name , CONCAT( \'(\', tel_prefix, \') \',INSERT(telephone, 4, 0, \'-\')) as tel,FORMAT(credits, 2) as credits ')->orderBy('id')->get();
        //$customers = Customer::get();
       return response()->json($customer);
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
     * @param EditCustomerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditCustomerRequest $request)
    {
       $customer = new Customer($request->all());
       $customer->save();
       return response()->json(["success" => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditCustomerRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return response()->json(["success" => true]);
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
