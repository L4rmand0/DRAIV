<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverVehicleController extends Controller
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

    public function listDriverVehicle(Request $request){
        $driver_vehicle = DB::table('user_vehicle')
            ->where('vehicle.operation', '!=', 'D')
            ->join('driver_information', 'driver_information.dni_id', '=', 'user_vehicle.driver_information_dni_id')
            ->select(DB::raw(
               'user_vehicle.vehicle_plate_id, 
               user_vehicle.driver_information_dni_id, 
               driver_information.first_name, 
               driver_information.f_last_name'
            ))->get();
            // $driver_vehicle = $this->addDeleteButtonDatatable($driver_vehicle);
        return datatables()->of($driver_vehicle)->make(true);
    }

//     SELECT 
// user_vehicle.vehicle_plate_id, 
// user_vehicle.driver_information_dni_id, 
// driver_information.first_name, 
// driver_information.f_last_name FROM sam.user_vehicle
// INNER	JOIN	sam.driver_information ON driver_information.dni_id = user_vehicle.driver_information_dni_id;

}
