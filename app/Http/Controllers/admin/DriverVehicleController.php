<?php

namespace App\Http\Controllers\admin;

use DB;
use App\DriverVehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public static function listDriverByPlateId($plate_id)
    {
        return DB::table('user_vehicle')
            ->where('user_vehicle.vehicle_plate_id', '=', $plate_id)
            ->select(DB::raw(
                'user_vehicle.id, 
                user_vehicle.vehicle_plate_id, 
                user_vehicle.driver_information_dni_id,
                user_vehicle.operation'
            ))->get()->toArray();
    }

    public function listDriverVehicle(Request $request)
    {
        $plate_id = $request->get('plate_id');
        // print_r($request->all());
        // die;
        $driver_vehicle = DB::table('user_vehicle')
            ->where('user_vehicle.operation', '!=', 'D')
            ->where('user_vehicle.vehicle_plate_id', '=', $plate_id)
            ->join('driver_information', 'driver_information.dni_id', '=', 'user_vehicle.driver_information_dni_id')
            ->join('vehicle', 'vehicle.plate_id', '=', 'user_vehicle.vehicle_plate_id')
            ->select(DB::raw(
                'user_vehicle.vehicle_plate_id, 
               user_vehicle.driver_information_dni_id, 
               driver_information.first_name, 
               driver_information.f_last_name,
               vehicle.type_v'
            ))->get();
        // print_r($driver_vehicle);
        // die;
        $driver_vehicle = $this->addDeleteButtonDatatable($driver_vehicle);
        return datatables()->of($driver_vehicle)->make(true);
    }

    public static function insertDrivers($driver_list, $plate_id)
    {
        foreach ($driver_list as $key => $value) {
            $drive_vehicle = DriverVehicle::create([
                'vehicle_plate_id' => $plate_id,
                'driver_information_dni_id' => $value,
                'user_id' => auth()->id()
            ]);
        }
    }

    public static function insertOrUpdateDrivers($data_input_drivers, $list_drivers, $plate_id)
    {
        $now = date("Y-m-d H:i:s");
        foreach ($data_input_drivers as $key_driver_input => $value_driver_input) {
            $coincidencia = 0;
            foreach ($list_drivers as $reg_drv_vehicle) {
                if ($reg_drv_vehicle->driver_information_dni_id == $value_driver_input && $reg_drv_vehicle->operation == "D") {
                    $update_drive_vechiculo = DriverVehicle::where('id', $reg_drv_vehicle->id)->update([
                        'operation' => 'U',
                        'date_operation' => $now,
                        'user_id' => auth()->id()
                    ]);
                    $coincidencia++;
                } else if ($reg_drv_vehicle->driver_information_dni_id == $value_driver_input) {
                    $coincidencia++;
                }
            }
            if ($coincidencia == 0) {
                $insert_drive_vehicle = DriverVehicle::create([
                    'vehicle_plate_id' => $plate_id,
                    'driver_information_dni_id' => $value_driver_input,
                    'user_id' => auth()->id()
                ]);
            }
        }
    }

    public static function checkDuplicateDriversPlateId($list_drivers)
    {
        foreach ($list_drivers as $key => $value) {
            $driver_vehicle = DB::table('user_vehicle')
                ->where('user_vehicle.driver_information_dni_id', '=', $value)
                ->select(DB::raw(
                    'user_vehicle.vehicle_plate_id, 
                   user_vehicle.driver_information_dni_id, 
                   driver_information.first_name, 
                   driver_information.f_last_name,
                   vehicle.type_v'
                ))->get();
            if (!empty($driver_vehicle)) {
                $drivers[]=$driver_vehicle;
            }
        }
        if(!empty($drivers)){
            return $drivers;
        }else{
            return FALSE;
        }
    }
}
