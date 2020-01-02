<?php

namespace App\Http\Controllers\admin;

use DB;
use App\DriverVehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vehicle;

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
    public function destroy(Request $request)
    {
        // echo '<pre>';
        // print_r($request->all());
        // die;
        $data_delete = $request->all();
        $plate_id = $data_delete['vehicle_plate_id'];
        $vehicle = DB::table('user_vehicle')
            ->where('user_vehicle.operation', '!=', 'D')
            ->where('user_vehicle.vehicle_plate_id', '=', $plate_id)
            ->select(DB::raw(
                'user_vehicle.id'
            ))->get()->toArray();

        $new_numbers = count($vehicle) - 1;
        $delete = DriverVehicle::where('id', $data_delete['id'])->update(['operation' => 'D', 'user_id' => auth()->id()]);
        $update_vehicles = Vehicle::where('plate_id', $plate_id)->update([
            'operation' => 'U',
            'user_id' => auth()->id(),
            'number_of_drivers' => $new_numbers
        ]);
        if ($delete) {
            return response()->json(['response' => 'Usuario eliminado', 'error' => '']);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el usuario']);
        }
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
            ->orderBy('user_vehicle.start_date', 'desc')
            ->where('user_vehicle.operation', '!=', 'D')
            ->where('user_vehicle.vehicle_plate_id', '=', $plate_id)
            ->join('driver_information', 'driver_information.dni_id', '=', 'user_vehicle.driver_information_dni_id')
            ->join('vehicle', 'vehicle.plate_id', '=', 'user_vehicle.vehicle_plate_id')
            ->select(DB::raw(
                'user_vehicle.id, 
               user_vehicle.vehicle_plate_id, 
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

    public static function insertOrUpdateDriverNoList($data_input_drivers, $plate_id)
    {
        $now = date("Y-m-d H:i:s");
        foreach ($data_input_drivers as $key_in => $value_in) {
            $driver_searched = DB::table('user_vehicle')
                ->where('user_vehicle.driver_information_dni_id', '=', $value_in)
                ->select(DB::raw(
                    'user_vehicle.id, 
                             user_vehicle.vehicle_plate_id, 
                             user_vehicle.driver_information_dni_id, 
                             user_vehicle.operation'
                ))->first();
            if (empty($driver_searched)) {
                $insert_drive_vehicle = DriverVehicle::create([
                    'vehicle_plate_id' => $plate_id,
                    'driver_information_dni_id' => $value_in,
                    'user_id' => auth()->id()
                ]);
            } else {
                $update_drive_vechiculo = DriverVehicle::where('id', $driver_searched->id)->update([
                    'operation' => 'U',
                    'date_operation' => $now,
                    'vehicle_plate_id' => $plate_id,
                    'user_id' => auth()->id()
                ]);
            }
        }
    }

    public static function insertOrUpdateDrivers($data_input_drivers, $list_drivers, $plate_id)
    {
        // echo '<pre>';
        // print_r($list_drivers);
        // print_r($data_input_drivers);
        // die;
        $now = date("Y-m-d H:i:s");
        foreach ($data_input_drivers as $key_in => $value_in) {
            $driver_searched = DB::table('user_vehicle')
                ->where('user_vehicle.driver_information_dni_id', '=', $value_in)
                ->select(DB::raw(
                    'user_vehicle.id, 
                             user_vehicle.vehicle_plate_id, 
                             user_vehicle.driver_information_dni_id, 
                             user_vehicle.operation'
                ))->first();
            foreach ($list_drivers as $key_l => $value_l) {
                $coincidencia = 0;
                if ($value_in == $value_l->driver_information_dni_id) {
                    $coincidencia++;
                }
                if ($coincidencia == 0) {
                    if (empty($driver_searched)) {
                        $insert_drive_vehicle = DriverVehicle::create([
                            'vehicle_plate_id' => $plate_id,
                            'driver_information_dni_id' => $value_in,
                            'user_id' => auth()->id()
                        ]);
                    } else {
                        $update_drive_vechiculo = DriverVehicle::where('id', $driver_searched->id)->update([
                            'operation' => 'U',
                            'date_operation' => $now,
                            'vehicle_plate_id' => $plate_id,
                            'user_id' => auth()->id()
                        ]);
                    }
                } else {
                    $update_drive_vechiculo = DriverVehicle::where('id', $driver_searched->id)->update([
                        'operation' => 'U',
                        'date_operation' => $now,
                        'user_id' => auth()->id()
                    ]);
                }
            }
        }
        // Los conductores que no se encuentren dentro de la nueva lista de conductores los pone en 'D'
        foreach ($list_drivers as $key_l => $value_l) {
            $coincidencia = 0;
            foreach ($data_input_drivers as $key_in => $value_in) {
                if ($value_in == $value_l->driver_information_dni_id) {
                    $coincidencia++;
                }
            }
            if ($coincidencia == 0) {
                $update_drive_vechiculo = DriverVehicle::where('id', $value_l->id)->update([
                    'operation' => 'D',
                    'date_operation' => $now,
                    'user_id' => auth()->id()
                ]);
            }
        }
    }

    public static function checkDuplicateDriversPlateId($list_drivers, $plate_id)
    {
        $drivers = [];
        foreach ($list_drivers as $value) {
            $driver_vehicle = DB::table('user_vehicle')
                ->where('user_vehicle.driver_information_dni_id', '=', $value)
                ->select(DB::raw(
                    'user_vehicle.vehicle_plate_id, 
                     user_vehicle.driver_information_dni_id, 
                     user_vehicle.operation'
                ))->first();
            if (!empty($driver_vehicle)) {
                if (($driver_vehicle->operation == "U" || $driver_vehicle->operation == "A") && $driver_vehicle->vehicle_plate_id != $plate_id) {
                    $drivers[] = $driver_vehicle;
                }
            }
        }
        if (!empty($drivers)) {
            return $drivers;
        } else {
            return FALSE;
        }
    }

    public static function checkDuplicateDriversPlateId3($list_drivers, $plate_id)
    {
        foreach ($list_drivers as $value) {
            $driver_vehicle = DB::table('user_vehicle')
                ->where('user_vehicle.driver_information_dni_id', '=', $value)
                ->where('user_vehicle.vehicle_plate_id', '!=', $plate_id)
                ->select(DB::raw(
                    'user_vehicle.vehicle_plate_id, 
                     user_vehicle.driver_information_dni_id'
                ))->first();
            if (!empty($driver_vehicle)) {
                $drivers[] = $driver_vehicle;
            }
        }
        if (!empty($drivers)) {
            return $drivers;
        } else {
            return FALSE;
        }
    }


    public static function getTotalVehiclesByCompany($company_id)
    {
        $vechicles = DB::table('driver_information')
            ->select(DB::raw('count(DISTINCT user_vehicle.vehicle_plate_id) as total_vehicles')
            )->join('user_vehicle', 'user_vehicle.driver_information_dni_id', '=', 'driver_information.dni_id')
            ->join('vehicle', 'user_vehicle.vehicle_plate_id', '=', 'vehicle.plate_id')
            ->where('driver_information.company_id', '=', $company_id)
            ->where('vehicle.operation', '!=', 'D')
            ->first();
        if(!empty($vechicles)){
            return $vechicles->total_vehicles; 
        }else{
            return 0; 
        }   
    }
}
