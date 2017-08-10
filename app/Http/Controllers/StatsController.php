<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /* $dailySales = DB::table('bills_details')->join('bills' , 'bills_details.bill_id' , '=' , 'bills.id')
           ->join('products' , 'bills_details.products_id' , '=' , 'products.id')
           ->join('categories' , 'products.category_id' , '=' , 'categories.id')
           ->select('categories.name as category_name' ,
               'products.codebar' , 'products.name as product_name' ,
               'products.selling_price' , 'bills_details.qty' , 'bills_details.discount' ,
               DB::raw('bills_details.qty * (products.selling_price - bills_details.discount ) as total'))
          // ->whereRaw('bills.created_at between ' . $startdate . ' and ' . $endDate . ' and bills.type = F')
           ->groupBy('bills_details.id')->get();

       $creditsGiven = DB::table('bills_details')->join('bills' , 'bills_details.bill_id' , '=' , 'bills.id')
           ->join('products' , 'bills_details.products_id' , '=' , 'products.id')
           ->join('categories' , 'products.category_id' , '=' , 'categories.id')
           ->select('categories.name as category_name' ,
               'products.codebar' , 'products.name as product_name' ,
               'products.selling_price' , 'bills_details.qty' , 'bills_details.discount' ,
               DB::raw('bills_details.qty * (products.selling_price - bills_details.discount ) as total'))
           // ->whereRaw('bills.created_at between ' . $startdate . ' and ' . $endDate . ' and bills.type = CR')
           ->groupBy('bills_details.id')->get();

       $totSales = 0;
       foreach($dailySales as $i){
           $totSales += $i->total;
       }
        $totcredit = 0;
        foreach($creditsGiven as $i){
            $totcredit += $i->total;
        }
        $total = $totSales - $totcredit;
        $totals = ['totSales' => $totSales, 'totCredits' => $totcredit, 'Total' => $total];
        $DailyReport = ['Sales' => $dailySales, 'Credits' => $creditsGiven , 'Totals' => $totals];
        return response()->json($DailyReport);*/ #Rapport detailler journalier

       /* $inventaireNeuf = DB::table('products')
            ->join('categories', 'products.category_id' , '=' , 'categories.id')
            ->selectRaw('SUM(products.qty * products.selling_price) as neuf_vendant , SUM(products.qty * products.original_cost) as neuf_coutant, categories.name as category_name')
            ->whereRaw('products.used = 0')
            ->groupBy('products.category_id')->get();
        $inventaireUsager = DB::table('products')
            ->join('categories', 'products.category_id' , '=' , 'categories.id')
            ->selectRaw('SUM(products.qty * products.selling_price) as neuf_vendant , SUM(products.qty * products.original_cost) as neuf_coutant, categories.name as category_name')
            ->whereRaw('products.used = 1')
            ->groupBy('products.category_id')->get();
        $inventaireTotal = DB::table('products')
            ->join('categories', 'products.category_id' , '=' , 'categories.id')
            ->selectRaw('SUM(products.qty * products.selling_price) as neuf_vendant , SUM(products.qty * products.original_cost) as neuf_coutant, categories.name as category_name')
            ->groupBy('products.category_id')->get();

        $inventaire = ['Neuf' => $inventaireNeuf, 'Usager' => $inventaireUsager, 'Total' => $inventaireTotal];
        return response()->json($inventaire);*/ #Stats valeur inventaire

        return response()->json();
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
