<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Http\Requests\EditCertificateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CertificatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cert = DB::table('certificates')
            ->join('customers' , 'certificates.customers_id' , '=' , 'customers.id')
            ->join('employees' , 'employees.id' , '=' , 'certificates.employees_id')
            ->selectRaw('certificates.* , CONCAT_WS(\' \',customers.firstname,customers.lastname) as CustName ,
            CONCAT_WS(\' \',employees.firstname,employees.lastname) as EmpName')
            ->get();
        return response()->json($cert);
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
     * @param  EditCertificateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditCertificateRequest $request)
    {
        $certificate = new Certificate($request->all());
       $certificate->save();
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
        $cert = Certificate::findOrFail($id);
        return response()->json($cert);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditCertificateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCertificateRequest $request, $id)
    {
        $cert = Certificate::findOrFail($id);
        $cert->update($request->all());
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
