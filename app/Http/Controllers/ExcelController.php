<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class ExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


       /* $inventaireNeuf = DB::table('products')
            ->join('categories', 'products.category_id' , '=' , 'categories.id')
            ->selectRaw('SUM(products.qty * products.selling_price) as neuf_vendant ,
            SUM(products.qty * products.original_cost) as neuf_coutant, categories.name as category_name')
            ->whereRaw('products.used = 0')
            ->groupBy('products.category_id')->get();
        $inventaireUsager = DB::table('products')
            ->join('categories', 'products.category_id' , '=' , 'categories.id')
            ->selectRaw('SUM(products.qty * products.selling_price) as neuf_vendant ,
             SUM(products.qty * products.original_cost) as neuf_coutant, categories.name as category_name')
            ->whereRaw('products.used = 1')
            ->groupBy('products.category_id')->get();
        $inventaireTotal = DB::table('products')
            ->join('categories', 'products.category_id' , '=' , 'categories.id')
            ->selectRaw('SUM(products.qty * products.selling_price) as neuf_vendant ,
            SUM(products.qty * products.original_cost) as neuf_coutant, categories.name as category_name')
            ->groupBy('products.category_id')->get();

        $inventaire = ['Neuf' => $inventaireNeuf, 'Usager' => $inventaireUsager, 'Total' => $inventaireTotal];*/  #ancienne request
       /*\Maatwebsite\Excel\Facades\Excel::create('asdfas', function($excel){
           $excel->setTitle('Valeur_inventaire_cat');

           $excel->setDescription('Valeur de l\'inventaire par catégories');

           $excel->sheet('Feuil1', function($sheet) {



           });

       })->download('xls');*/

       /*$inventaireNeuf = DB::table('products')
           ->join('categories' , 'products.category_id' , '=' , 'categories.id')
           ->selectRaw('categories.id , categories.name , SUM(products.selling_price) as neuf_vendant , SUM(products.original_cost) as neuf_coutant')
           ->whereRaw('products.used != 1')
           ->groupBy('products.category_id')
           ->get();
        $inventaireUsager = DB::table('products')
            ->join('categories' , 'products.category_id' , '=' , 'categories.id')
            ->selectRaw('categories.id, categories.name , SUM(products.selling_price) as used_vendant , SUM(products.original_cost) as used_coutant')
            ->whereRaw('products.used = 1')
            ->groupBy('products.category_id')
            ->get();
       //dd($inventaireUsager);
        $tableNeuf[] = $inventaireNeuf;
        $tableUsed[] = $inventaireUsager;
        $table = array_merge($tableNeuf,$tableUsed);
        dd($table);
        foreach ($tableNeuf as $item){
           if(in_array($item , $tableUsed)){
            $table = array_merge($tableNeuf,$tableUsed);
            dd($table);
           }else{

           }
        }*/



       $excel =  \Maatwebsite\Excel\Facades\Excel::load('Valeur_inventaire_cat.xls', function($file) {

           $file->sheet('Feuil1' , function($sheet){
              $sheet->setCellValue('A1' , 'Date :' . Carbon::today()->toDateString());
              $cpt = 5;
               $cats = DB::table('categories')->select('id')->get();

               $inventaire = [];
               $totneufcoutant = 0;
               $totneufvendant = 0;
               $totusagercoutant = 0;
               $totusagervendant = 0;
               $tottotcoutant = 0;

               $tottotvendant = 0;
               foreach($cats as $cat){
                   $products = DB::table('products')->whereRaw('category_id = \'' . $cat->id . '\'')
                       ->join('categories', 'products.category_id' , '=' , 'categories.id')
                       ->selectRaw('products.* , categories.name as catName, categories.parent_id as catParent')
                       ->get();
                    foreach ($products as $p){
                        if($p->catParent != 0){

                            $p->catParent = DB::table('categories')->selectRaw('name as catParent')->whereRaw($p->catParent . ' = id')->get();

                        }else{
                            $p->catParent = "Aucune";
                        }
                    }
                   $coutantneuf = 0;
                   $vendantneuf = 0;
                   $coutantused = 0;
                   $vendantused = 0;
                   $totcoutant = 0;
                   $totvendant = 0;
                   $catname = "";


                   foreach($products as $product){

                       if($product->used == 1){
                           $coutantused += $product->original_cost;
                           $vendantused += $product->selling_price;
                           $totcoutant += $product->original_cost;
                           $totvendant += $product->selling_price;
                            $totusagercoutant += $product->original_cost;
                            $totusagervendant += $product->selling_price;
                           $tottotcoutant += $product->original_cost;
                           $tottotvendant += $product->selling_price;
                       }else{
                           $coutantneuf += $product->original_cost;
                           $vendantneuf += $product->selling_price;
                           $totcoutant += $product->original_cost;
                           $totvendant += $product->selling_price;
                           $totneufcoutant += $product->original_cost;
                           $totneufvendant += $product->selling_price;
                           $tottotcoutant += $product->original_cost;
                           $tottotvendant += $product->selling_price;
                       }
                       if($product->catParent == "Aucune"){
                           $str =  $product->catParent  ;
                       }else{
                           $str = $product->catParent[0]->catParent ;

                       }
                       $catname =' (' .  $product->catName . ')';
                   }
                   if($catname == ""){

                   }else{
                       $newprod = ['catName' => $str . $catname , 'coutantUsed' => $coutantused , 'vendantUsed' => $vendantused,
                           'coutantNeuf' => $coutantneuf , 'vendantNeuf' => $vendantneuf ,
                           'totCoutant' => $totcoutant , 'totVendant' => $totvendant];
                       array_push($inventaire, $newprod);
                   }

               }


               $invValue = ['totNeufCoutant' => $totneufcoutant , 'totNeufVendant' => $totneufvendant ,
                   'totUsagerCoutant' => $totusagercoutant , 'totUsagerVendant' => $totusagervendant ,
                   'totTotCoutant' => $tottotcoutant , 'totTotVendant' => $tottotvendant];

               $nbCat = DB::table('categories')->count();
               $sheet->appendRow($cpt,array(
                   $inventaire[0]['catName'] , $inventaire[0]['coutantNeuf'] , $inventaire[0]['vendantNeuf'] ,
                   $inventaire[0]['coutantUsed'] , $inventaire[0]['vendantUsed'] ,
                   $inventaire[0]['totCoutant'] , $inventaire[0]['totVendant']
               ));
               for($x=1 ; $x < count($inventaire) ; $x++){

                   $cpt++;
                   $sheet->prependRow($cpt,array(
                       $inventaire[$x]['catName'] , $inventaire[$x]['coutantNeuf'] , $inventaire[$x]['vendantNeuf'] ,
                    $inventaire[$x]['coutantUsed'] , $inventaire[$x]['vendantUsed'] ,
                    $inventaire[$x]['totCoutant'] , $inventaire[$x]['totVendant']
                   ));

               };
               $cpt++;
               $sheet->appendRow($cpt,array(
                   'Valeur de l\'inventaire' ,$invValue['totNeufCoutant'] , $invValue['totNeufVendant'] , $invValue['totUsagerCoutant']
                   ,$invValue['totUsagerVendant'] ,$invValue['totTotCoutant'], $invValue['totTotVendant']
               ));
               $cpt++;
               $tValue = $invValue['totTotCoutant'] + $invValue['totTotVendant'];
               $sheet->appendRow($cpt, array(
                   'Valeur total de l\'inventaire' , $tValue
               ));


           });

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
