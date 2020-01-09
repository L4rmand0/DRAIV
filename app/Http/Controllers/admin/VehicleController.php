<?php

namespace App\Http\Controllers\admin;

use App\DriverVehicle;
use App\Http\Controllers\Controller;
use App\Imports\VehiclesImport;
use App\Vehicle;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user_id = auth()->user()->id;
        // $permissions = $this->getPermissions($user_id);
        // $enum_type_v = $this->generateOptionsEnumDt(Vehicle::enum_type_v);
        // $list_type_v = Vehicle::enum_type_v;
        // $enum_service = $this->generateOptionsEnumDt(Vehicle::enum_service);
        // $list_service = Vehicle::enum_service;
        // $enum_taxi_type = $this->generateOptionsEnumDt(Vehicle::enum_taxi_type);
        // $list_taxi_type = Vehicle::enum_taxi_type;
        // $company_id = auth()->user()->company_id;
        // $company = CompanyController::getCompanyByid($company_id);
        // // print_r($enum_type_v);
        // // die;
        // return view('admin.vehicle.index', [
        //     'enum_type_v' => $enum_type_v,
        //     'enum_service' => $enum_service,
        //     'enum_taxi_type' => $enum_taxi_type,
        //     'list_type_v' => $list_type_v,
        //     'list_service' => $list_service,
        //     'list_taxi_type' => $list_taxi_type,
        //     'company_name' => ucwords(strtolower($company->company)),
        //     'permissions' => $permissions,
        // ]);
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
        $company_id = auth()->user()->company_id;
        // echo $company_id;
        // die;
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
        // if (!empty($duplicate_drivers)) {
        //     return response()->json(['errors' => ['response' => 'Conductores Duplicados'], 'duplicates' => $duplicate_drivers]);
        // }
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
                'plate_id.unique' => "Esta placa ya está en uso. Para actualizarla hágalo en la tabla.",
            ]
        );

        $errors = $validator->errors()->getMessages();
        // print_r($errors);
        // die;

        //Revisa que ya se haya insertado un vehículo con esa placa y lo actualiza
        foreach ($errors as $key => $value) {
            if (strpos($value[0], "uso") !== false) {
                $plate_id = $data_input[$key];

                $check_vehicle = DB::table('vehicle')
                    ->orderBy('vehicle.start_date', 'desc')
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
                    'type_v' => $data_input['type_v'],
                    'owner_v' => $data_input['owner_v'] != "" ? $data_input['owner_v'] : 0,
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
                    'user_id' => auth()->id(),
                    'company_id' => $company_id,
                ]);
                if ($response) {
                    $list_drivers = DriverVehicleController::listDriverByPlateId($plate_id);
                    if (empty($list_drivers)) {
                        $response_transaction = DriverVehicleController::insertOrUpdateDriverNoList($data_input_drivers, $plate_id);
                    } else {
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

            // echo 'else '.$company_id;
            // die;
            $vehicle = Vehicle::create([
                'plate_id' => $data_input['plate_id'],
                'type_v' => $data_input['type_v'],
                'owner_v' => $data_input['owner_v'] != "" ? $data_input['owner_v'] : 0,
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
                'company_id' => $company_id,
                'user_id' => auth()->id(),
            ]);
            //Inserta todos los conductores elegidos y con la placa enviada en la tabla user_vehicle
            if ($vehicle->plate_id != "" && !empty($data_input_drivers)) {
                $list_drivers = DriverVehicleController::listDriverByPlateId($plate_id);
                if (empty($list_drivers)) {
                    $response_transaction = DriverVehicleController::insertOrUpdateDriverNoList($data_input_drivers, $plate_id);
                } else {
                    $response_transaction = DriverVehicleController::insertOrUpdateDrivers($data_input_drivers, $list_drivers, $plate_id);
                }
                return response()->json([
                    'success' => 'Información registrada.',
                    'errors' => $errors,
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
            'user_id' => auth()->id(),
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
            'date_operation' => $now,
        ]);
        if ($delete) {
            $response = DriverVehicle::where('vehicle_plate_id', $plate_id)->update([
                'operation' => 'D',
                'date_operation' => $now,
                'user_id' => auth()->id(),
            ]);
            return response()->json(['response' => 'Usuario eliminado', 'error' => '']);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el usuario']);
        }
    }

    public function vehicleList()
    {
        $vehicle = DB::table('vehicle')
            ->orderBy('vehicle.start_date', 'desc')
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

    public static function getSoatExpiDates($company_id)
    {
        $fecha_actual = date("Y-m-d");
        $date_month = date("Y-m-d", strtotime($fecha_actual . "+ 2 month"));
        $soats_expiration = DB::table('vehicle as v')
            ->select(DB::raw(
                'count(v.plate_id) as total'
            ))
            ->where('v.company_id', '=', $company_id)
            ->where('v.operation', '!=', 'D')
            ->whereBetween('v.soat_expi_date', [$fecha_actual, $date_month])
        // ->toSql();
        // print_r($soats_expiration);
        // die;
            ->first();
        return $soats_expiration->total;
    }

    public static function getSoatsExpirated($company_id)
    {
        $fecha_actual = date("Y-m-d");
        $soats_expiration = DB::table('vehicle as v')
            ->select(DB::raw(
                'count(v.plate_id) as total'
            ))
            ->where('v.company_id', '=', $company_id)
            ->where('v.operation', '!=', 'D')
            ->where('v.soat_expi_date', '<=', $fecha_actual)
        // ->toSql();
        // print_r($soats_expiration);
        // die;
            ->first();
        return $soats_expiration->total;
    }

    public static function getExpiTecnomecanicalDates($company_id)
    {
        $fecha_actual = date("Y-m-d");
        $date_month = date("Y-m-d", strtotime($fecha_actual . "+ 2 month"));
        $tecnomecanical_expiration = DB::table('vehicle as v')
            ->select(DB::raw(
                'count(v.plate_id) as total'
            ))
            ->where('v.company_id', '=', $company_id)
            ->where('v.operation', '!=', 'D')
            ->whereBetween('v.technomechanical_date', [$fecha_actual, $date_month])
        // ->toSql();
        // print_r($tecnomecanical_expiration);
        // die;
            ->first();
        return $tecnomecanical_expiration->total;
    }

    public static function getExpiTecnomecanicalExpirated($company_id)
    {
        $fecha_actual = date("Y-m-d");
        $tecnomecanical_expiration = DB::table('vehicle as v')
            ->select(DB::raw(
                'count(v.plate_id) as total'
            ))
            ->where('v.company_id', '=', $company_id)
            ->where('v.operation', '!=', 'D')
            ->where('v.technomechanical_date', '<=', $fecha_actual)
        // ->toSql();
        // print_r($tecnomecanical_expiration);
        // die;
            ->first();
        return $tecnomecanical_expiration->total;
    }

    public static function getTypesByCompany($company_id)
    {
        return DB::table('vehicle as v')
            ->select(DB::raw(
                'count(plate_id) as total,
                 type_v'
            ))
            ->where('v.company_id', '=', $company_id)
            ->where('v.operation', '!=', 'D')
            ->groupBy('v.type_v')
        // ->toSql();
            ->get()->toArray();
    }

    public static function getOwnersVByCompany($company_id)
    {
        return DB::table('vehicle as v')
            ->select(DB::raw(
                'count(plate_id) as total,
                IF(owner_v="Y", "Sí", "No") as owner_v'
            ))
            ->where('v.company_id', '=', $company_id)
            ->where('v.operation', '!=', 'D')
            ->groupBy('v.owner_v')
        // ->toSql();
            ->get()->toArray();
    }

    public static function getLineVByCompany($company_id)
    {
        return DB::table('vehicle as v')
            ->select(DB::raw(
                'count(plate_id) as total,
             line'
            ))
            ->where('v.company_id', '=', $company_id)
            ->where('v.operation', '!=', 'D')
            ->groupBy('v.line')
        // ->toSql();
            ->get()->toArray();
    }

    public static function getBrandByCompany($company_id)
    {
        return DB::table('vehicle as v')
            ->select(DB::raw(
                'count(plate_id) as total,
                 brand'
            ))
            ->where('v.company_id', '=', $company_id)
            ->where('v.operation', '!=', 'D')
            ->groupBy('v.brand')
        // ->toSql();
            ->get()->toArray();
    }

    public static function getModelByCompany($company_id)
    {
        return DB::table('vehicle as v')
            ->select(DB::raw(
                'count(plate_id) as total,
             model'
            ))
            ->where('v.company_id', '=', $company_id)
            ->where('v.operation', '!=', 'D')
            ->groupBy('v.model')
        // ->toSql();
            ->get()->toArray();
    }

    public function makeBarChartTypeV(Request $request)
    {
        $company_id = $request->get('company_id');
        $education = $this->getTypesByCompany($company_id);
        foreach ($education as $key => $value) {
            $labels[] = $value->type_v;
            $data_data[] = $value->total;
        }
        $num_register = count($data_data);
        $arr_colors = $this->fillColorsBarChart($num_register);
        $maximo = max($data_data) + 1;
        $datasets['label'] = "Frecuencia Tipos Vehículo";
        $datasets['data'] = $data_data;
        $datasets['backgroundColor'] = $arr_colors['backgroundColor'];
        $datasets['borderColor'] = $arr_colors['borderColor'];
        $datasets['borderWidth'] = 1;
        $data['datasets'][] = $datasets;
        $data['labels'] = $labels;
        return response()->json(['data' => $data, 'errors' => [], 'max' => $maximo]);
    }

    public function makePieChartLineV(Request $request)
    {
        $company_id = $request->get('company_id');
        $lines = $this->getLineVByCompany($company_id);
        // echo '<pre>';
        // print_r($lines);
        // die;
        foreach ($lines as $key => $value) {
            $labels[] = $value->line;
            $data_data[] = $value->total;
        }
        $num_register = count($data_data);
        $arr_colors = $this->fillColorsBarChart($num_register);
        $maximo = max($data_data) + 1;
        $datasets['label'] = "Frecuencia Tipos Vehículo";
        $datasets['data'] = $data_data;
        $datasets['backgroundColor'] = $arr_colors['backgroundColor'];
        $datasets['borderColor'] = $arr_colors['borderColor'];
        $datasets['borderWidth'] = 1;
        $data['datasets'][] = $datasets;
        $data['labels'] = $labels;
        return response()->json(['data' => $data, 'errors' => [], 'max' => $maximo]);
    }

    public function addVehicleDriver(Request $request)
    {
        $now = date("Y-m-d H:i:s");
        $data_request = $request->all();
        $driver_information_dni_id = $data_request['driver_information_dni_id'];
        $vehicle_plate_id = $data_request['vehicle_plate_id'];
        // echo '<pre>';
        // print_r($data_request);

        $check_vehicles = DB::table('user_vehicle')
            ->where('user_vehicle.driver_information_dni_id', '=', $driver_information_dni_id)
            ->select(DB::raw(
                'user_vehicle.vehicle_plate_id,
                user_vehicle.driver_information_dni_id,
                user_vehicle.operation'
            ))->first();
        // print_r($check_vehicles);
        // die;
        if (empty($check_vehicles)) {
            DriverVehicle::create([
                'user_id' => auth()->id(),
                'vehicle_plate_id' => $vehicle_plate_id,
                'driver_information_dni_id' => $driver_information_dni_id,
            ]);
            $check_vehicles_dni_id = DB::table('user_vehicle')
                ->where('user_vehicle.vehicle_plate_id', '=', $vehicle_plate_id)
                ->where('user_vehicle.operation', '!=', 'D')
                ->select(DB::raw(
                    'user_vehicle.vehicle_plate_id,
                         user_vehicle.driver_information_dni_id,
                         user_vehicle.operation'
                ))->get();
            $num_vehicles = count($check_vehicles_dni_id);
            $response = Vehicle::where('plate_id', $vehicle_plate_id)->update([
                'number_of_drivers' => $num_vehicles,
                'operation' => 'U',
                'date_operation' => $now,
                'user_id' => auth()->id(),
            ]);
            return response()->json(['response' => 'El conductor ha sido asignado al vehículo.', 'errors' => []]);
        } else {
            // print_r($check_vehicles);
            if ($check_vehicles->operation == "D") {
                // echo ' tiene D';
                // die;
                $response = DriverVehicle::where('driver_information_dni_id', $driver_information_dni_id)->update([
                    'vehicle_plate_id' => $vehicle_plate_id,
                    'operation' => 'U',
                    'date_operation' => $now,
                    'user_id' => auth()->id(),
                ]);
                $check_vehicles_dni_id = DB::table('user_vehicle')
                    ->where('user_vehicle.vehicle_plate_id', '=', $vehicle_plate_id)
                    ->where('user_vehicle.operation', '!=', 'D')
                    ->select(DB::raw(
                        'user_vehicle.vehicle_plate_id,
                         user_vehicle.driver_information_dni_id,
                         user_vehicle.operation'
                    ))->get();
                $num_vehicles = count($check_vehicles_dni_id);
                $response = Vehicle::where('plate_id', $vehicle_plate_id)->update([
                    'number_of_drivers' => $num_vehicles,
                    'operation' => 'U',
                    'date_operation' => $now,
                    'user_id' => auth()->id(),
                ]);
                return response()->json(['response' => 'El conductor ha sido asignado al vehículo.', 'errors' => []]);
            } else {
                return response()->json(['response' => 'Conductor Ya asociado', 'errors' => ['driver_information_dni_id' => ['Este conductor ya tiene asociado un vehículo.']]]);
            }
        }
    }

    public function makePieChartModelV(Request $request)
    {
        $company_id = $request->get('company_id');
        $models = $this->getModelByCompany($company_id);
        foreach ($models as $key => $value) {
            $labels[] = $value->model;
            $data_data[] = $value->total;
        }
        $num_register = count($data_data);
        $arr_colors = $this->fillColorsBarChart($num_register);
        $maximo = max($data_data) + 1;
        $datasets['label'] = "Frecuencia Tipos Vehículo";
        $datasets['data'] = $data_data;
        $datasets['backgroundColor'] = $arr_colors['backgroundColor'];
        $datasets['borderColor'] = $arr_colors['borderColor'];
        $datasets['borderWidth'] = 1;
        $data['datasets'][] = $datasets;
        $data['labels'] = $labels;
        return response()->json(['data' => $data, 'errors' => [], 'max' => $maximo]);
    }

    public function makePolarChartBrandV(Request $request)
    {
        $company_id = $request->get('company_id');
        $brands = $this->getBrandByCompany($company_id);
        foreach ($brands as $key => $value) {
            $labels[] = $value->brand;
            $data_data[] = $value->total;
        }
        $num_register = count($data_data);
        $arr_colors = $this->fillColorsBarChart($num_register);
        $maximo = max($data_data) + 1;
        $datasets['label'] = "Frecuencia Tipos Vehículo";
        $datasets['data'] = $data_data;
        $datasets['backgroundColor'] = $arr_colors['backgroundColor'];
        $datasets['borderColor'] = $arr_colors['borderColor'];
        $datasets['borderWidth'] = 1;
        $data['datasets'][] = $datasets;
        $data['labels'] = $labels;
        return response()->json(['data' => $data, 'errors' => [], 'max' => $maximo]);
    }

    public function makePieChartOwnerV(Request $request)
    {
        $company_id = $request->get('company_id');
        $education = $this->getOwnersVByCompany($company_id);
        foreach ($education as $key => $value) {
            $labels[] = $value->owner_v;
            $data_data[] = $value->total;
        }
        $num_register = count($data_data);
        $arr_colors = $this->fillColorsBarChart($num_register);
        $maximo = max($data_data) + 1;
        $datasets['label'] = "Frecuencia Tipos Vehículo";
        $datasets['data'] = $data_data;
        $datasets['backgroundColor'] = $arr_colors['backgroundColor'];
        $datasets['borderColor'] = $arr_colors['borderColor'];
        $datasets['borderWidth'] = 1;
        $data['datasets'][] = $datasets;
        $data['labels'] = $labels;
        return response()->json(['data' => $data, 'errors' => [], 'max' => $maximo]);
    }

    public function checkVehicleByPlateId(Request $request)
    {
        $plate_id = $request->get('plate_id');
        $check_vehicle = DB::table('vehicle')
            ->orderBy('vehicle.start_date', 'desc')
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
        } else if ($check_vehicle->operation == "U" || $check_vehicle->operation == "A") {
            return response()->json(['response' => 'error', 'errors' => ['plate_id' => ['Esta placa ya tiene un vehículo. Para actualizarla debe hacerlo en la tabla.']]]);
        } else {
            return response()->json(['response' => 'ok', 'errors' => []]);
        }
    }
}
