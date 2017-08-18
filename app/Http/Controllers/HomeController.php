<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::whereRaw('created_at = "' .Carbon::today()->toDateString() . '"' )->count();
        $sales = Bill::whereRaw('created_at = "' .Carbon::today()->toDateString() . '"' )->count();
        $cash = DB::table('bills')->select(DB::raw('sum(total - taxable) AS montant'))->whereRaw('created_at = "' .Carbon::today()->toDateString() . '"')->get();
        $tre = (array)$cash[0];
        $cashmade = array_pop($tre);
        if($cashmade == null){
            $cashmade = 0;
        }
        $test = ['newCustomers' => $customer, 'NumberTransaction' => $sales, 'CashMade' => $cashmade];
        return response()->json($test);
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
