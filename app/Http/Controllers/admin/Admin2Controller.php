<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Admin2Controller extends Controller
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

    public function getAdmin2toSelect2(Request $request)
    {
        $admin2 = DB::table('admin2')
            ->select(
                'admin2.adm2_id',
                'admin2.name'
            )
            ->get()->toArray();
        return response()->json($this->createSelect2($admin2));
    }

    public function createSelect2($query_data)
    {
        foreach ($query_data as $key => $value) {
            $data[$key]['id'] = $value->adm2_id;
            $data[$key]['text'] = $value->name;
        }
        return $data;
    }
}
