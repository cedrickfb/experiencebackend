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
        return response()->json($DailyReport);*/ #Rapport detailler journalier sur excel

        $inventaireNeuf = DB::table('products')
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

        //$inventaire = ['Neuf' => $inventaireNeuf, 'Usager' => $inventaireUsager, 'Total' => $inventaireTotal];
        return response()->json($inventaireNeuf); #Stats valeur inventaire
        /*
        $clientid = 1; #remplacer par un parametre nullable
        $venteClient = DB::table('bills')
            ->join('customers' ,'bills.customers_id' , '=' , 'customers.id')
            ->join('bills_details' , 'bills.id' ,'=' , 'bills_details.bill_id')
            ->join('products' , 'bills_details.products_id' ,'=' , 'products.id')
            ->join('categories' , 'products.category_id' ,'=' , 'categories.id')
            ->selectRaw(' CONCAT_WS(\' \',customers.firstname,customers.lastname) as custName , bills.created_at as DateAchat, bills.id as numFacture, bills_details.products_id as numProduct ,
             categories.name as catName, products.name as prodName , bills_details.qty as Qty , SUM(products.selling_price - bills_details.discount) as montant , 
             SUM(bills_details.qty *(products.selling_price - bills_details.discount)) as Total ')
            ->groupBy('bills_details.id')
            ->whereRaw('customers.id = ' . $clientid . ' and bills.type = F')
            ->get();

        $creditClient = DB::table('bills')
            ->join('customers' ,'bills.customers_id' , '=' , 'customers.id')
            ->join('bills_details' , 'bills.id' ,'=' , 'bills_details.bill_id')
            ->join('products' , 'bills_details.products_id' ,'=' , 'products.id')
            ->join('categories' , 'products.category_id' ,'=' , 'categories.id')
            ->selectRaw(' CONCAT_WS(\' \',customers.firstname,customers.lastname) as custName , bills.created_at as DateAchat, bills.id as numFacture, bills_details.products_id as numProduct ,
             categories.name as catName, products.name as prodName , bills_details.qty as Qty , SUM(products.selling_price - bills_details.discount) as montant , 
             SUM(bills_details.qty *(products.selling_price - bills_details.discount)) as Total ')
            ->groupBy('bills_details.id')
            ->whereRaw('customers.id = ' . $clientid . ' and bills.type = CR')
            ->get();

        return response()->json($venteClient);
          */ #Rapport achat d'un client

       /* $dailyReportVentes = DB::table('bills')
            ->selectRaw('taxable , tps, tvq, total, non_taxable , SUM(total + non_taxable) as grand_total')
            ->whereRaw('type = F and created_at between  ' . $datedebut . ' and ' . $datefin)
            ->groupBy('id')->get();

        $dailyReportCredits = DB::table('bills')
            ->selectRaw('taxable , tps, tvq, total, non_taxable , SUM(total + non_taxable) as grand_total')
            ->whereRaw('type = CR and created_at between  ' . $datedebut . ' and ' . $datefin)
            ->groupBy('id')->get();

        $dailyreports = ['Ventes' => $dailyReportVentes, 'Credits' => $dailyReportCredits ];
        return response()->json($dailyreports);*/ #Rapport sur les ventes journaliers pas sur excel
        /*
        $customerId = 1; #remplacer par un parametre nullable
        $CreditClient = DB::table('customers')
            ->join('trades' , 'customers.id' , '=' , 'trades.customers_id')
            ->selectRaw('CONCAT_WS(\' \',customers.firstname,customers.lastname) as custName , trades.id,
             trades.description, trades.amount, trades.created_at, customers.credits')
            ->whereRaw('customers.id = ' . $customerId)
            ->groupBy('trades.id')
            ->get();
            */ #Rapport sur les credits d'un client (p-t rajouter l'employer qui as approuver)


        //return response()->json();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ #Stats achat/credits par client
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
