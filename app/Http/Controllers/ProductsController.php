<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProductRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       /* $cat = Input::get('cat');
        if(!isset($cat)){
            $products = Product::with('category')->get();

        }else{
            $products = Product::with('category')->whereRaw('category_id = ' . $cat)->get();
        }*/
        /*$products = DB::table('products')
        ->join('categories as c1' , 'products.category_id' , '=' , 'c1.id')
        ->join('categories as c2' , 'c1.parent_id' , '=' , 'c2.id')
        ->selectRaw('products.* , c1.id, c1.name as catName, c2.name as parentName')
        ->get();*/
    $products = DB::table('products')
        ->join('categories as c1' , 'products.category_id' , '=' , 'c1.id')
        ->join('categories as c2' , 'c1.parent_id' , '=' , 'c2.id')
        ->selectRaw('products.* , c1.id, c1.name as catName, c2.name as parentName')
        ->get();
    $id = [];
    foreach ($products as $product){
        array_push($id, $product->id);
    }
        $productsNoCat = DB::table('products')->whereRaw('products.id NOT IN (\'' . implode($id , '\' , \'') . '\')')
            ->join('categories' , 'products.category_id' , '=' , 'categories.id')
            ->selectRaw('products.* , categories.name as catName')
            ->get();

        //dd(compact('products','productsNoCat'));
        return response()->json(compact('products','productsNoCat'));

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
     * @param  EditProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditProductRequest $request)
    {
        $product = new Product($request->all());
        $product->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Product::with('category')->whereRaw('codebar = \'' . $id . '\'')->exists()){
            $product = Product::with('category')->whereRaw('codebar = \'' . $id . '\'')->first();
            return response()->json($product);
        }else{
            return response()->json(false);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json($product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  EditProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
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
