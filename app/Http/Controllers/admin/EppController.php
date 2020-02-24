<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EppController extends Controller
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
    public function update(Request $request)
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

    public function dataTable(Request $request){
        // echo '<pre> hola';
        // print_r($request->all());
        // die;
        $company_id = Auth::user()->company_active;
        $motorcycle_technology = DB::table('epp as e')
            ->select(DB::raw(
                'e.epp_id, 
                e.name_evaluator, 
                e.empresa,
                e.casco,
                e.airbag,
                e.rodilleras,
                e.coderas,
                e.hombreras,
                e.espalda,
                e.botas,
                e.guantes,
                e.epp_results,
                e.risk,
                di.first_name,
                di.f_last_name,
                di.dni_id,
                v.plate_id'
            ))
            ->join('user_vehicle as uv', 'uv.id', '=', 'e.user_vehicle_id')
            ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
            ->join('vehicle as v', 'v.plate_id', '=', 'uv.vehicle_plate_id')
            ->where('di.company_id', '=', $company_id)
            ->where('e.operation', '!=', 'D')
            ->orderBy('e.start_date', 'desc')
            ->get();

        // $skill_m_t_m = $this->dataQuery($skill_m_t_m)->make([
        //     'slalom'=>SkilleM::VALUE_SLALOM,
        //     'projection'=>SkilleM::VALUE_PROJECTION,
        //     'braking'=>SkilleM::VALUE_BRAKING,
        //     'evasion'=>SkilleM::VALUE_EVASION,
        // ]);    
        $motorcycle_technology = $this->addDeleteButtonDatatable($motorcycle_technology);
        return datatables()->of($motorcycle_technology)->make(true);
    }

}
