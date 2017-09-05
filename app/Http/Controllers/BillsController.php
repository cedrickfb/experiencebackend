<?php

namespace App\Http\Controllers;

use App\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billDetail = DB::table('bills')
            ->join('customers' , 'customers.id' , '=' , 'bills.customers_id')
            ->join('employees' , 'employees.id' , '=' , 'bills.employees_id')
            ->join('settings' , 'settings.id' , '=' , 'bills.company_id')
            ->selectRaw('bills.* ,  CONCAT_WS(\' \',customers.firstname,customers.lastname) as CustName ,
            CONCAT_WS(\' \',employees.firstname,employees.lastname) as EmpName')
            ->whereRaw('settings.active = 1')
            ->get();
      /* $billDetail = DB::table('bills')
           ->join('employees' , 'bills.employees_id' , '=' , 'employees.id')
           ->selectRaw('bills.*')
           ->get();*/
        return response()->json($billDetail);
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
        //dd($request->all());
        $bill = new Bill($request->all());
        $bill->save();

        return response()->json($bill['id']);
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
        $bill = Bill::findOrFail($id);
        return response()->json($bill);
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
