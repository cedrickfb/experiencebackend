<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditSettingsRequest;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = DB::table('settings')->get();
        return response()->json($setting);
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
     * @param  EditSettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditSettingsRequest $request)
    {

       // dd($request->all());
        $setting = new Setting($request->all());
        if($setting['active'] == 1){
            Setting::where('active' , '=' , '1')->update(['active' => 0]);
        }
        $setting->save();
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
        $setting = Setting::findOrFail($id)->first();
        return response()->json($setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditSettingsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditSettingsRequest $request, $id)
    {
        DB::table('settings')->where('active', '=' , 1)->update(['active' => 0]);
        $setting = Setting::findOrFail($id);
      // dd($setting->active);
        //dd($request->all());

        $setting->update($request->all());
       // dd($setting);
        return response()->json(["success" => true]);
    }

    public function get_current() {
        $active = DB::table('settings')->where('active', 1)->first();
        $emp = DB::table('employees')->whereRaw('remember_token IS NOT NULL ')->get();


        $active->empName = $emp[0]->firstname ;
        $active->empId = $emp[0]->id;

        return response()->json([$active]);
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
