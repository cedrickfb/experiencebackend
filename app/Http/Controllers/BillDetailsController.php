<?php

namespace App\Http\Controllers;

use App\BillDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $billDetail = DB::table('bills_details')->get();
        $billDetail = BillDetail::get();
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
        $bill = new BillDetail($request->all());
        $bill->save();
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
        /*$bill = DB::table('bills_details')->whereRaw('bill_id = ' . $id)
            ->join('products' , 'bills_details.products_id' , '=' , 'products.id')
        ->selectRaw('bills_details.id, bills_details.qty , bills_details.bill_id , bills_details.bonidollar
         , products.name as ProductName ')
        ->get();*/
        $bill = DB::table('bills_details')->whereRaw('bill_id = ' . $id)
            ->join('products' , 'bills_details.products_id' , '=' , 'products.id')
            ->selectRaw('bills_details.*,bills_details.qty as qty_facture , bills_details.bonidollar as product_boni, products.*')
            ->get();
        return response()->json($bill);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bill = BillDetail::findOrFail($id);
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
