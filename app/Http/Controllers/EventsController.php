<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\EditEventRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::limit(20)->get();
        return response()->json($event);
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
     * @param EditEventRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditEventRequest $request)
    {
        $event = new Event($request->all());
        DB::table('events')->save($event);
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
        $event =  Event::findOrFail($id)->first();
        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditEventRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditEventRequest $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->update($request->all());
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
