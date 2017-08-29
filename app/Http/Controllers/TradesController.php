<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditTradeRequest;
use App\Trade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trade = Trade::get();
        return response()->json($trade);
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
     * @param  EditTradeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditTradeRequest $request)
    {
        $trade = new Trade($request->all());
        Trade::save($trade);
        return response()->json(["succes" => true]);
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
        $trade = Trade::findOrFail($id)->first();
        return response()->json($trade);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditTradeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditTradeRequest $request, $id)
    {
        $trade = Trade::findOrFail($id);
        $trade->update($request->all());
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
