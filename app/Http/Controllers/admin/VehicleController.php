<?php

namespace App\Http\Controllers\admin;

use App\DriverVehicle;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Imports\VehiclesImport;
use App\Vehicle;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enum_type_v = $this->generateOptionsEnumDt(Vehicle::enum_type_v);
        $list_type_v = Vehicle::enum_type_v;
        $enum_service = $this->generateOptionsEnumDt(Vehicle::enum_service);
        $list_service = Vehicle::enum_service;
        $enum_taxi_type = $this->generateOptionsEnumDt(Vehicle::enum_taxi_type);
        $list_taxi_type = Vehicle::enum_taxi_type;
        // print_r($enum_type_v);
        // die;
        return view('admin.vehicle.index', [
            'enum_type_v' => $enum_type_v,
            'enum_service' => $enum_service,
            'enum_taxi_type' => $enum_taxi_type,
            'list_type_v' => $list_type_v,
            'list_service' => $list_service,
            'list_taxi_type' => $list_taxi_type
        ]);
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
        $data_input_drivers = $request->get('driver_vehicle');
        $data_input = $request->get('vehicle');
        $plate_id = $data_input['plate_id'];
        // print_r($data_input_drivers);
        // print_r($data_input);
        // die;
        if (!$data_input['type_v'] == "Taxis") {
            unset($data_input_drivers);
            unset($data_input['taxi_type']);
            unset($data_input['number_of_drivers']);
        }
        $duplicate_drivers = DriverVehicleController::checkDuplicateDriversPlateId($data_input_drivers, $plate_id);
        // echo '<pre>';
        // print_r($duplicate_drivers);
        // die;
        if (!empty($duplicate_drivers)) {
            return response()->json(['errors' => ['response' => 'Conductores Duplicados'], 'duplicates' => $duplicate_drivers]);
        }
        $validator = Validator::make(
            $data_input,
            [
                'plate_id' => ['required', 'max:15', 'unique:vehicle'],
                'type_v' => 'required|max:255',
                'owner_v' => 'required|max:255',
                'soat_expi_date' => 'required|max:255',
                'capacity' => 'required|max:11',
            ],
            [
                'plate_id.required' => "La placa no puede ser vacía",
                'type_v.required' => "Se debe elegir el tipo de vehiculo",
                'owner_v.required' => "Se debe elegir una opción",
                'soat_expi_date.required' => "Se debe seleccionar una fecha",
                'capacity.required' => "Se debe seleccionar la capacidad",
                'plate_id.unique' => "Esta placa ya está en uso. Para actualizarla hágalo en la tabla."
            ]
        );

        $errors = $validator->errors()->getMessages();

        //Revisa que ya se haya insertado un vehículo con esa placa y lo actualiza
        foreach ($errors as $key => $value) {
            if (strpos($value[0], "uso") !== FALSE) {
                $plate_id = $data_input[$key];

                $check_vehicle = DB::table('vehicle')
                    ->orderBy('vehicle.date_operation', 'desc')
                    ->where('vehicle.operation', '=', 'D')
                    ->where('vehicle.plate_id', '=', $plate_id)
                    ->select(DB::raw(
                        'vehicle.plate_id, 
                     vehicle.operation,
                     vehicle.technomechanical_date'
                    ))->first();
                if (empty($check_vehicle)) {
                    return response()->json(['response' => 'vehicle exists', 'errors' => $errors]);
                }
                $now = date("Y-m-d H:i:s");
                $response = Vehicle::where($key, $plate_id)->update([
                    'plate_id' => $data_input['plate_id'],
                    'type_v' =>  $data_input['type_v'],
                    'owner_v' =>  $data_input['owner_v'] != "" ? $data_input['owner_v'] : 0,
                    'taxi_type' => !empty($data_input['taxi_type']) ? $data_input['taxi_type'] : "NA",
                    'number_of_drivers' => !empty($data_input['number_of_drivers']) ? $data_input['number_of_drivers'] : 1,
                    'soat_expi_date' => $data_input['soat_expi_date'],
                    'capacity' => $data_input['capacity'],
                    'service' => $data_input['service'] != "" ? $data_input['service'] : "Otros",
                    'cylindrical_cc' => $data_input['cylindrical_cc'] != "" ? $data_input['cylindrical_cc'] : 1,
                    'v_class' => $data_input['v_class'] != "" ? $data_input['v_class'] : "",
                    'model' => $data_input['model'] != "" ? $data_input['model'] : "",
                    'line' => $data_input['line'] != "" ? $data_input['line'] : "",
                    'brand' => $data_input['brand'] != "" ? $data_input['brand'] : "",
                    'color' => $data_input['color'] != "" ? $data_input['color'] : "",
                    'technomechanical_date' => $data_input['technomechanical_date'] != "" ? $data_input['technomechanical_date'] : null,
                    'operation' => 'U',
                    'date_operation' => $now,
                    'user_id' => auth()->id()
                ]);
                if ($response) {
                    $list_drivers = DriverVehicleController::listDriverByPlateId($plate_id);
                    if(empty($list_drivers)){
                        $response_transaction = DriverVehicleController::insertOrUpdateDriverNoList($data_input_drivers, $plate_id);
                    }else{
                        $response_transaction = DriverVehicleController::insertOrUpdateDrivers($data_input_drivers, $list_drivers, $plate_id);
                    }
                    return response()->json(['response' => 'Información actualizada', 'errors' => []]);
                } else {
                    return response()->json(['errors' => ['response' => 'No se pudo actualizar la información']]);
                }
            }
        }

        //Si no hay errores en el formulario y el vehículo no está en la tabla vehicle, lo inserta
        if (!empty($errors)) {
            return response()->json(['errors' => $errors]);
        } else {
            $vehicle = Vehicle::create([
                'plate_id' => $data_input['plate_id'],
                'type_v' =>  $data_input['type_v'],
                'owner_v' =>  $data_input['owner_v'] != "" ? $data_input['owner_v'] : 0,
                'taxi_type' => $data_input['taxi_type'] != "" ? $data_input['taxi_type'] : "NA",
                'number_of_drivers' => $data_input['number_of_drivers'] != "" ? $data_input['number_of_drivers'] : 1,
                'soat_expi_date' => $data_input['soat_expi_date'],
                'capacity' => $data_input['capacity'],
                'service' => $data_input['service'] != "" ? $data_input['service'] : "Otros",
                'cylindrical_cc' => $data_input['cylindrical_cc'] != "" ? $data_input['cylindrical_cc'] : 1,
                'v_class' => $data_input['v_class'] != "" ? $data_input['v_class'] : "",
                'model' => $data_input['model'] != "" ? $data_input['model'] : "",
                'line' => $data_input['line'] != "" ? $data_input['line'] : "",
                'brand' => $data_input['brand'] != "" ? $data_input['brand'] : "",
                'color' => $data_input['color'] != "" ? $data_input['color'] : "",
                'technomechanical_date' => $data_input['technomechanical_date'] != "" ? $data_input['technomechanical_date'] : null,
                'user_id' => auth()->id()
            ]);
            //Inserta todos los conductores elegidos y con la placa enviada en la tabla user_vehicle
            if ($vehicle->plate_id != "" && !empty($data_input_drivers)) {
                $list_drivers = DriverVehicleController::listDriverByPlateId($plate_id);
                if(empty($list_drivers)){
                    $response_transaction = DriverVehicleController::insertOrUpdateDriverNoList($data_input_drivers, $plate_id);
                }else{
                    $response_transaction = DriverVehicleController::insertOrUpdateDrivers($data_input_drivers, $list_drivers, $plate_id);
                }
                return response()->json([
                    'success' => 'Información registrada.',
                    'errors' => $errors
                ]);
            }
        }
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
        $now = date("Y-m-d H:i:s");
        $data_updated = $request->all();
        $field = $data_updated['fieldch'];
        $value = $data_updated['valuech'];
        // print_r($request->all());
        if ($field == "owner_v") {
            $value = $value == "Sí" ? 'Y' : 'N';
        }
        $response = Vehicle::where('plate_id', $data_updated['plate_id'])->update([
            $field => $value,
            'operation' => 'U',
            'date_operation' => $now,
            'user_id' => auth()->id()
        ]);
        if ($response > 0) {
            return response()->json(['response' => 'Información actualizada', 'error' => []]);
        } else {
            return response()->json(['error' => ['response' => 'No se pudo actualizar la información']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data_delete = $request->all();
        $now = date("Y-m-d H:i:s");
        $plate_id = $data_delete['plate_id'];
        // echo '<pre>';
        // print_r($plate_id);
        // die;
        
        $delete = Vehicle::where('plate_id', $plate_id)->update([
            'operation' => 'D', 
            'user_id' => auth()->id(),
            'number_of_drivers' => 0,
            'date_operation' => $now
            ]);
        if ($delete) {
            $response = DriverVehicle::where('vehicle_plate_id', $plate_id)->update([
                'operation' => 'D',
                'date_operation' => $now,
                'user_id' => auth()->id()
            ]);
            return response()->json(['response' => 'Usuario eliminado', 'error' => '']);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el usuario']);
        }
    }

    public function vehicleList()
    {
        $vehicle = DB::table('vehicle')
            ->orderBy('vehicle.date_operation', 'desc')
            ->where('vehicle.operation', '!=', 'D')
            ->select(DB::raw(
                'vehicle.plate_id, 
                vehicle.type_v, 
                IF(vehicle.owner_v="Y","Sí","No") as owner_v, 
                vehicle.taxi_type, 
                vehicle.number_of_drivers, 
                vehicle.soat_expi_date, 
                vehicle.capacity, 
                vehicle.service,
                vehicle.cylindrical_cc,
                vehicle.v_class,
                vehicle.model,
                vehicle.line,
                vehicle.brand,
                vehicle.color,
                vehicle.technomechanical_date'
            ))->get();
        $vehicle = $this->addDeleteButtonDatatable($vehicle);
        return datatables()->of($vehicle)->make(true);
    }

    public function import(Request $request)
    {
        $data_insert = $request->all();
        $data_insert['id'] = auth()->id();
        $file = $request->file('file');
        $result = Excel::import(new VehiclesImport(), $file);
        return response()->json(['response' => 'ok']);
    }

    public function checkVehicleByPlateId(Request $request)
    {
        $plate_id = $request->get('plate_id');
        $check_vehicle = DB::table('vehicle')
            ->orderBy('vehicle.date_operation', 'desc')
            ->where('vehicle.plate_id', '=', $plate_id)
            ->select(DB::raw(
                'vehicle.plate_id, 
                 vehicle.operation,
                 vehicle.technomechanical_date'
            ))->first();
            // print_r($check_vehicle);
            // die;
        if (empty($check_vehicle)) {
            return response()->json(['response' => 'ok', 'errors' => []]);
        }else if($check_vehicle->operation == "U" || $check_vehicle->operation == "A"){
            return response()->json(['response' => 'error', 'errors' => ['plate_id'=>['Esta placa ya tiene un vehículo. Para actualizarla debe hacerlo en la tabla.']]]);
        }else{
            return response()->json(['response' => 'ok', 'errors' => []]);
        }
    }
}
