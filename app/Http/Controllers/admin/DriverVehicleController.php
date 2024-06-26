<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Vehicle;
use App\DriverVehicle;
use App\Rules\NotToday;
use App\DriverInformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DriverVehicleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        $now = date("Y-m-d H:i:s");
        // echo '<pre>';
        // print_r($request->all());
        // die;
        $data_delete = $request->all();
        $plate_id = $data_delete['vehicle_plate_id'];
        //Consultar para obtener el número de conductores que tiene ese vehículo
        $vehicle = DB::table('user_vehicle')
            ->where('user_vehicle.operation', '!=', 'D')
            ->where('user_vehicle.vehicle_plate_id', '=', $plate_id)
            ->select(DB::raw(
                'user_vehicle.id'
            ))->get()->toArray();
        //Actualiza en el número de vehículos del conductor en -1  
        DriverInformationController::decresases1NumberOfVehiclesByDriver($data_delete['driver_information_dni_id']);
        // Actualiza el registro activo de ese conductor a operation D
        $delete = DriverVehicle::where('id', $data_delete['id'])->where('operation', '!=', 'D')->update(['operation' => 'D', 'user_id' => auth()->id()]);
        // Actualiza el número de conductores ese vehiculo en uno menos
        $new_numbers = count($vehicle) - 1;
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
        // echo '<pre>';    
        // print_r($driver_vehicle);
        // die;
        $driver_vehicle = $this->addDeleteButtonDatatable($driver_vehicle);
        return [
            'datatable' => datatables()->of($driver_vehicle)->make(true),
            'plate_id' => $plate_id
        ];
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
        //Actualiza todos los conductores de ese vehículo y los pone en Delete
        $update_drive_vechiculo = DriverVehicle::where('vehicle_plate_id', $plate_id)->update([
            'operation' => 'D',
            'date_operation' => $now,
            'user_id' => auth()->id()
        ]);



        foreach ($data_input_drivers as $key_in => $value_in) {
            //Busca cada de los conductores a insertar en la tabla user_vehiculo sin importar la placa
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
                // Revisa que en la lista de conductores a ingresar y los conductores insertados con esa placa ya exista ese dni_id
                if ($value_in == $value_l->driver_information_dni_id) {
                    $coincidencia++;
                }
                //Si existe ese dni_id con esa placa, ahora lo revisa con otras placas
                if ($coincidencia == 0) {
                    if (empty($driver_searched)) {
                        $insert_drive_vehicle = DriverVehicle::create([
                            'vehicle_plate_id' => $plate_id,
                            'driver_information_dni_id' => $value_in,
                            'user_id' => auth()->id()
                        ]);
                    } else {
                        $insert_drive_vehicle = DriverVehicle::create([
                            'vehicle_plate_id' => $plate_id,
                            'driver_information_dni_id' => $value_in,
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
        //Los conductores que no se encuentren dentro de la nueva lista de conductores los pone en 'D'
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
                ->where('user_vehicle.vehicle_plate_id', '!=', $plate_id)
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
        $company_id = Auth::user()->company_active;
        $vechicles = DB::table('vehicle')
            ->select(DB::raw('count(plate_id) as total_vehicles'))
            ->where('vehicle.company_id', '=', $company_id)
            ->where('vehicle.operation', '!=', 'D')
            ->first();
        if (!empty($vechicles)) {
            return $vechicles->total_vehicles;
        } else {
            return 0;
        }
    }

    public static function getTotalVehiclesByCompanyR(Request $request)
    {
        $company_id = $request->get('company_id');
        if (!empty($request->get('dni_id'))) {
            $dni_id = $request->get('dni_id');
            $vechicles = DB::table('vehicle as v')
                ->select(DB::raw('count(v.plate_id) as total_vehicles'))
                ->join('user_vehicle as uv', 'uv.vehicle_plate_id', '=', 'v.plate_id')
                ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
                ->where('di.dni_id', '=', $dni_id)
                ->where('v.company_id', '=', $company_id)
                ->where('v.operation', '!=', 'D')
                ->where('uv.operation', '!=', 'D')
                ->first();
            // ->toSql();
            // echo '<pre>';
            // print_r($vechicles);
            // die;
        } else {
            $vechicles = DB::table('vehicle')
                ->select(DB::raw('count(plate_id) as total_vehicles'))
                ->where('vehicle.company_id', '=', $company_id)
                ->where('vehicle.operation', '!=', 'D')
                ->first();
        }
        // echo '<pre>';
        // print_r($vechicles);
        // die;
        return response()->json(['response' => $vechicles->total_vehicles, 'errors' => []]);
    }

    public static function getVehiclesByDriver(Request $request)
    {
        $has_motos = false;
        $has_autos = false;
        $dni_id = $request->get('dni_id');
        $result = DB::table('user_vehicle as uv')
            ->select(DB::raw(
                'uv.driver_information_dni_id,
                v.type_v,
                v.plate_id'
            ))
            ->join('vehicle as v', 'v.plate_id', '=', 'uv.vehicle_plate_id')
            ->where('uv.driver_information_dni_id', '=', $dni_id)
            ->where('uv.operation', '!=', 'D')
            ->get()->toArray();
        foreach ($result as $key => $value) {
            if (in_array($value->type_v, Vehicle::MOTOS)) {
                $has_motos = true;
            } else if (in_array($value->type_v, Vehicle::AUTOS)) {
                $has_autos = true;
            }
        }
        // echo ' autos: ';
        // var_dump($has_autos); 
        // echo ' motos: ';
        // var_dump($has_motos); 
        // // print_r($result);
        // die;
        return response()->json([
            'data' => $result, 'errors' => [],
            'has_autos' => $has_autos,
            'has_motos' => $has_motos
        ]);
        // print_r($result);
        // die;
    }

    public static function getUserVehicleIdTypeVehicle($dni_id)
    {
        // echo '<pre>';
        // print_r($dni_id);
        // die;
        $arr_vehicles = [];
        $result = DB::table('user_vehicle as uv')
            ->select(DB::raw(
                'uv.id,
                uv.driver_information_dni_id,
                v.type_v,
                v.plate_id'
            ))
            ->join('vehicle as v', 'v.plate_id', '=', 'uv.vehicle_plate_id')
            ->where('uv.driver_information_dni_id', '=', $dni_id)
            ->where('uv.operation', '!=', 'D')
            ->get()->toArray();
        foreach ($result as $key => $value) {
            if (in_array($value->type_v, Vehicle::MOTOS)) {
                $arr_vehicles['motos'][] = $value->id;
            } else if (in_array($value->type_v, Vehicle::AUTOS)) {
                $arr_vehicles['autos'][] = $value->id;
            }
        }
        // echo '<pre>';
        // print_r($arr_vehicles);
        // print_r($result);
        // die;
        return $arr_vehicles;
    }


    public static function getArraygetVehiclesByDniId($dni_id){
        return DB::table('user_vehicle as uv')
            ->select(DB::raw(
                'uv.id,
                uv.driver_information_dni_id,
                v.type_v,
                v.plate_id'
            ))
            ->join('vehicle as v', 'v.plate_id', '=', 'uv.vehicle_plate_id')
            ->where('uv.driver_information_dni_id', '=', $dni_id)
            ->where('uv.operation', '!=', 'D')
            ->get()->toArray();
    }
}
