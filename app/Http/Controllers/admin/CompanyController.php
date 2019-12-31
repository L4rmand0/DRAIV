<?php

namespace App\Http\Controllers\admin;

use DB;
use auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function getCompanies(Request $request)
    {
        $nit = $request['nit_company'];

        $companies = DB::table('company')
            ->where('company.company_id', 'like', '%' . $nit . '%')
            ->select(
                'company.company_id AS nit',
                'company.name_company AS company'
            )
            ->get();
        // $queries = DB::getQueryLog();
        return datatables()->of($companies)->make(true);
    }

    public function getCompaniestoSelect2(Request $request)
    {
        $companies = DB::table('company')
            ->select(
                'company.company_id AS nit',
                'company.name_company AS company'
            )
            ->get()->toArray();
        return response()->json($this->createSelect2($companies));
        // $queries = DB::getQueryLog();
    }

    public function createSelect2($query_data)
    {
        $data[0]['id'] = "";
        $data[0]['text'] = "Seleccionar";
        foreach ($query_data as $key => $value) {
            $data[$key+1]['id'] = $value->nit;
            $data[$key+1]['text'] = $value->company;
        }
        return $data;
    }

    public static function getListCompanies(){
        return DB::table('company')
            ->select(
                'company.company_id AS nit',
                'company.name_company AS company'
            )
            ->get()->toArray();
    }
    public static function getCompanyByid($id){
        return DB::table('company')
            ->select(
                'company.company_id AS nit',
                'company.name_company AS company'
            )->where('company.company_id', '=', $id)
            ->first();
    }
}
