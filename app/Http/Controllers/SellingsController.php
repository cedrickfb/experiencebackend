<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Excel;

class SellingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


         \Maatwebsite\Excel\Facades\Excel::load('ventes_detaillees.xls', function($file) {


            $file->sheet('Feuil1' , function($sellingsSheet){
                $start = Input::get('start');
                $end = Input::get('end');
                $sellingsSheet->setCellValue('A1' , 'Date :' . Carbon::today()->toDateString());
                $sellingsSheet->setCellValue('A2', 'Ventes du ' . $start . ' au ' . $end);

              // dd($end,$start);
                $sales = DB::table('bills')
                    ->leftjoin('bills_details' , 'bills.id' , '=' ,'bills_details.bill_id')
                    ->join('products' , 'bills_details.products_id', '=' , 'products.id')
                    ->join('categories as c1' , 'products.category_id' , '=' , 'c1.id')
                    ->selectRaw('c1.name as catName , products.codebar,
                     products.name as prodName, c1.id as catId, c1.parent_id as catParent, products.selling_price, bills_details.discount,
                     bills_details.qty, bills.total')
                    ->whereRaw('bills.type = \'F\' and bills.created_at between \'' . $start . '\' and \'' . $end . '\'' )
                    ->get();

                $categories = DB::table('bills')
                    ->leftjoin('bills_details' , 'bills.id' , '=' ,'bills_details.bill_id')
                    ->join('products' , 'bills_details.products_id', '=' , 'products.id')
                    ->join('categories as c1' , 'products.category_id' , '=' , 'c1.id')
                    ->selectRaw('c1.id,c1.name as catName')
                    ->whereRaw('bills.type = \'F\'')
                    ->distinct()
                    ->get();
                $cpt = 4;
                $tot = 0;
                foreach($categories as $category){

                    if($cpt == 4){
                        $sellingsSheet->appendRow($cpt,array(
                            $category->catName
                        ));
                    }else{
                        $sellingsSheet->prependRow($cpt,array(
                            $category->catName
                        ));
                    }


                    $cpt++;
                    foreach($sales as $sale){
                        if($sale->catId == $category->id){
                            $sellingsSheet->prependRow($cpt,array(
                                '', ' ' . $sale->codebar, $sale->prodName, $sale->selling_price, $sale->qty, $sale->discount, $sale->selling_price * $sale->qty - $sale->discount
                            ));
                            $tot +=$sale->selling_price * $sale->qty - $sale->discount;
                            $cpt++;
                        }

                    }
                }
                $sellingsSheet->appendRow($cpt, array(
                    '','','','','','Total ventes : ', $tot
                ));


            });

     /*       $file->sheet('Feuil2' , function($creditsSheet){
                $creditsSheet->setCellValue('A1' , 'Date :' . Carbon::today()->toDateString());

                $credits = DB::table('bills')->whereRaw('type = \'CR\'')->get();
                //dd($credits);
                $creditsSheet->appendRow(1,array(
                    #change values
                ));
            });*/  #Feuil2 pour les credits

        })->export('xls');
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
