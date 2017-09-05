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
        $customer = Customer::whereRaw('created_at between "' . Carbon::yesterday()->toDateString() . '" and  "' . Carbon::tomorrow()->toDateString() . '"' )->count();
        $sales = Bill::whereRaw('created_at between "'. Carbon::yesterday()->toDateString() . '" and  "' . Carbon::tomorrow()->toDateString() . '"'  )->count();
        $cash = DB::table('bills')->select(DB::raw('sum(total) AS montant'))->whereRaw('created_at between "' . Carbon::yesterday()->toDateString() . '" and  "' . Carbon::tomorrow()->toDateString() . '"' )->get();
        $tre = (array)$cash[0];
        $value_inv = DB::table('products')->selectRaw('SUM(selling_price * qty) as value_inv')->get();
        $val = $value_inv[0]->value_inv;
        $cashmade = array_pop($tre);
        if($cashmade == null){
            $cashmade = 0;
        }
        $test = ['value_inv' => $val, 'NumberTransaction' => $sales, 'CashMade' => $cashmade];
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
