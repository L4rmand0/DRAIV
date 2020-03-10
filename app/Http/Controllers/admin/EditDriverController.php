<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class EditDriverController extends Controller
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

    public function getInformationDriver(Request $request){
        // echo '<pre>';
        // print_r($request->all());
        $company_id = Auth::user()->company_active;
        $param = $request->get('search_param');
        $value = $request->get('value_param');
        if($param == "plate_id"){

        }else{
            $driver_information = DB::table('driver_information')
            ->orderBy('driver_information.start_date', 'desc')
            ->join('users', 'driver_information.db_user_id', '=', 'users.id')
            ->join('company', 'company.Company_id', '=', 'driver_information.company_id')
            ->join('admin2', 'admin2.adm2_id', '=', 'driver_information.department')
            ->join('admin3', 'admin3.adm3_id', '=', 'driver_information.city_residence_place')
            ->where('driver_information.company_id', '=', $company_id)
            ->where('driver_information.'.$param, '=', $value)
            ->select(DB::raw(
                'driver_information.dni_id,
            driver_information.first_name,
            driver_information.second_name,
            driver_information.f_last_name,
            driver_information.s_last_name,
            driver_information.number_of_vehicles,
            IF(driver_information.gender=0,"Masculino","Femenino") as gender,
            driver_information.education,
            driver_information.e_mail_address,
            driver_information.address,
            driver_information.country_born,
            admin3.name AS city_residence_place,
            admin2.name AS department,
            driver_information.phone,
            driver_information.civil_state,
            driver_information.score,
            driver_information.db_user_id,
            driver_information.company_id,
            users.name as user,
            company.Name_company as company'
            ))
            ->first();
            // echo '<pre>';
            // print_r($driver_information);
            // die;
            if(!empty($driver_information)){
                return response()->json(['response' => 'data found', 'errors' => [],'data'=>$driver_information]);
            }else{
                return response()->json(['response' => 'no data', 'errors' => [],'message'=>'No se encontró información de conductores por ese valor de búsqueda.']);
            }
        }

        echo '<pre>';
        print_r($request->all());
        die;
    }
}
