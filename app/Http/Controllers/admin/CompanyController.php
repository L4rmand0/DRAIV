<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        // DB::connection()->enableQueryLog();
        $nit = $request['nit_company'];

        // SELECT company.Company_id AS nit, company.Name_company AS company 
        // FROM sam.company 
        // WHERE company.Name_company LIKE '%dra%' OR company.Company_id LIKE '%90%';

        $companies = DB::table('company')
            ->where('company.Company_id', 'like', '%' . $nit . '%')
            ->select(
                'company.Company_id AS nit',
                'company.Name_company AS company'
            )
            ->get();
        // $queries = DB::getQueryLog();
        return datatables()->of($companies)->make(true);
    }

    public function getCompaniestoSelect2(Request $request)
    {
        $companies = DB::table('company')
            ->select(
                'company.Company_id AS nit',
                'company.Name_company AS company'
            )
            ->get()->toArray();
        return response()->json($this->createSelect2($companies));
        // $queries = DB::getQueryLog();
    }

    public function createSelect2($query_data)
    {
        foreach ($query_data as $key => $value) {
            $data['results'][$key]['id'] = $value->nit;
            $data['results'][$key]['text'] = $value->company;
        }
        return $data;
        // print_r($data);
    }
}
