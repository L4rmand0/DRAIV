<?php

namespace App\Http\Controllers\admin;

use App\DriverInformation;
use DB;
use App\Vehicle;
use App\DriverVehicle;
use Illuminate\Http\Request;
use App\Imports\VehiclesImport;
use App\Http\Controllers\ChartJS;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\admin\DriverVehicleController;
use App\Rules\IsNotDelete;
use App\Traits\ArrayFunctions;

use function Aws\flatmap;

class VehicleController extends Controller
{
    use ArrayFunctions;
    private $chart_js;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->excel = $excel;
        // $this->middleware('guest');
        $this->middleware('auth');
        $this->chart_js = new ChartJS();
    }

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
        $company_id = auth()->user()->company_active;
        // Información para ser insertada en la tabla user_vehicle
        $data_input_drivers = $request->get('driver_vehicle');
        // Información para ser insertada en la tabla vehicle
        $data_input = $request->get('vehicle');
        $data_input['operation'] = 'A';
        $plate_id = $data_input['plate_id'];
        // echo '<pre>';
        // print_r($data_input_drivers);
        // print_r($data_input);
        // die;
        //Revisa si el vehículo es un taxi
        if (!$data_input['type_v'] == "Taxis") {
            unset($data_input_drivers);
            unset($data_input['taxi_type']);
            unset($data_input['number_of_drivers']);
        }
        // Revisa que las cédulas de conductores a ingresar todavía no están ingresadas de lo contrario bota un error
        // $duplicate_drivers = DriverVehicleController::checkDuplicateDriversPlateId($data_input_drivers, $plate_id);
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
                'operation' => [new IsNotDelete(['plate_id', $plate_id], 'vehicle')],
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
        // foreach ($errors as $key => $value) {
        //     if (strpos($value[0], "uso") !== false) {
        //         $plate_id = $data_input[$key];
        //         // Revisa que la placa esté en Delete o en operation = D
        //         $check_vehicle = DB::table('vehicle')
        //             ->orderBy('vehicle.start_date', 'desc')
        //             ->where('vehicle.operation', '=', 'D')
        //             ->where('vehicle.plate_id', '=', $plate_id)
        //             ->select(DB::raw(
        //                 'vehicle.plate_id,
        //              vehicle.operation,
        //              vehicle.technomechanical_date'
        //             ))->first();
        //         // Si la placa existe y no está en D retorna una error de que ya existe    
        //         if (empty($check_vehicle)) {
        //             return response()->json(['response' => 'vehicle exists', 'errors' => $errors]);
        //         }

        //         $now = date("Y-m-d H:i:s");
        //         //Actualiza el vehículo con los nuevos datos para revivir el vehículo
        //         $response = Vehicle::where($key, $plate_id)->update([
        //             'plate_id' => $data_input['plate_id'],
        //             'type_v' => $data_input['type_v'],
        //             'owner_v' => $data_input['owner_v'] != "" ? $data_input['owner_v'] : 0,
        //             'taxi_type' => !empty($data_input['taxi_type']) ? $data_input['taxi_type'] : "NA",
        //             'number_of_drivers' => !empty($data_input['number_of_drivers']) ? $data_input['number_of_drivers'] : 1,
        //             'soat_expi_date' => $data_input['soat_expi_date'],
        //             'capacity' => $data_input['capacity'],
        //             'service' => $data_input['service'] != "" ? $data_input['service'] : "Otros",
        //             'cylindrical_cc' => $data_input['cylindrical_cc'] != "" ? $data_input['cylindrical_cc'] : 1,
        //             'model' => $data_input['model'] != "" ? $data_input['model'] : "",
        //             'line' => $data_input['line'] != "" ? $data_input['line'] : "",
        //             'brand' => $data_input['brand'] != "" ? $data_input['brand'] : "",
        //             'color' => $data_input['color'] != "" ? $data_input['color'] : "",
        //             'technomechanical_date' => $data_input['technomechanical_date'] != "" ? $data_input['technomechanical_date'] : null,
        //             'operation' => 'U',
        //             'date_operation' => $now,
        //             'user_id' => auth()->id(),
        //             'company_id' => $company_id,
        //         ]);
        //         if ($response) {
        //             $list_drivers = DriverVehicleController::listDriverByPlateId($plate_id);
        //             if (empty($list_drivers)) {
        //                 $response_transaction = DriverVehicleController::insertOrUpdateDriverNoList($data_input_drivers, $plate_id);
        //             } else {
        //                 $response_transaction = DriverVehicleController::insertOrUpdateDrivers($data_input_drivers, $list_drivers, $plate_id);
        //             }
        //             return response()->json(['response' => 'Información actualizada', 'errors' => []]);
        //         } else {
        //             return response()->json(['errors' => ['response' => 'No se pudo actualizar la información']]);
        //         }
        //     }
        // }
        // print_r($errors);
        // die;    
        //Si no hay errores en el formulario y el vehículo no está en la tabla vehicle, lo inserta de lo contrario devuelve un error
        if (!empty($errors)) {
            //Revisa los errores de que la placa ya exista y  que el registro esté en D o delete
            if (empty($errors['operation']) && !empty($errors['plate_id'])) {
                //Actualiza el vehículo con los nuevos datos para revivir el vehículo
                if (strpos($errors['plate_id'][0], 'uso') !== false) {
                    $now = date("Y-m-d H:i:s");
                    $vehicle = Vehicle::where('plate_id', $plate_id)->update([
                        'plate_id' => $data_input['plate_id'],
                        'type_v' => $data_input['type_v'],
                        'owner_v' => $data_input['owner_v'] != "" ? $data_input['owner_v'] : 0,
                        'taxi_type' => !empty($data_input['taxi_type']) ? $data_input['taxi_type'] : "NA",
                        'number_of_drivers' => !empty($data_input['number_of_drivers']) ? $data_input['number_of_drivers'] : 1,
                        'soat_expi_date' => $data_input['soat_expi_date'],
                        'capacity' => $data_input['capacity'],
                        'service' => $data_input['service'] != "" ? $data_input['service'] : "Otros",
                        'cylindrical_cc' => $data_input['cylindrical_cc'] != "" ? $data_input['cylindrical_cc'] : 1,
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
                    $this->insertDriversVehicle($plate_id, $data_input_drivers);
                    $this->updateNumsVehiclesOfListDrivers($data_input_drivers);
                    return response()->json(['response' => 'Información actualizada', 'errors' => []]);
                }
                return response()->json(['errors' => $errors]);
            }
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
                'model' => $data_input['model'] != "" ? $data_input['model'] : "",
                'line' => $data_input['line'] != "" ? $data_input['line'] : "",
                'brand' => $data_input['brand'] != "" ? $data_input['brand'] : "",
                'color' => $data_input['color'] != "" ? $data_input['color'] : "",
                'technomechanical_date' => $data_input['technomechanical_date'] != "" ? $data_input['technomechanical_date'] : null,
                'company_id' => $company_id,
                'user_id' => auth()->id(),
            ]);
            //Inserta todos los conductores elegidos y con la placa enviada en la tabla user_vehicle
            $this->insertDriversVehicle($plate_id, $data_input_drivers);
            $this->updateNumsVehiclesOfListDrivers($data_input_drivers);
            return response()->json([
                'success' => 'Información registrada.',
                'errors' => [],
            ]);
        }
    }

    private function insertDriversVehicle($plate_id, $data_input_drivers)
    {
        $now = date("Y-m-d H:i:s");
        $update_driver_vechiculo = DriverVehicle::where('vehicle_plate_id', $plate_id)->update([
            'operation' => 'D',
            'date_operation' => $now,
            'user_id' => auth()->id()
        ]);
        foreach ($data_input_drivers as $key_drivers => $value_dni) {
            $insert_drive_vehicle = DriverVehicle::create([
                'vehicle_plate_id' => $plate_id,
                'driver_information_dni_id' => $value_dni,
                'user_id' => auth()->id()
            ]);
        }
    }

    private function updateNumsVehiclesOfListDrivers($list_drivers)
    {
        $now = date("Y-m-d H:i:s");
        foreach ($list_drivers as $key => $value) {
            DriverInformationController::incresases1NumberOfVehiclesByDriver($value);
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
        echo '<pre>';
        print_r($request->all());
        die;
        $now = date("Y-m-d H:i:s");
        $data_updated = $request->all();
        $field = $data_updated['fieldch'];
        $value = $data_updated['valuech'];
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
        // echo '<pre>';
        // print_r($request->all());
        // die;
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
            //Consulta todos los conductores de ese vehículo en user_vehiculo y que no estén en D
            $vehicles_driver = DB::table('user_vehicle as uv')
                ->select(DB::raw('
                di.dni_id
            '))
                ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
                ->where('uv.vehicle_plate_id', '=', $plate_id)
                ->where('uv.operation', '!=', 'D')
                ->get()->toArray();
            //Eliminina o pone en D el campo operation que pertenezcan a esa placa en user_vehicle
            $response = DriverVehicle::where('vehicle_plate_id', $plate_id)->update([
                'operation' => 'D',
                'date_operation' => $now,
                'user_id' => auth()->id(),
            ]);

            // echo '<pre>';
            // print_r($vehicles_driver);
            // die;
            foreach ($vehicles_driver as $key => $value) {
                DriverInformationController::decresases1NumberOfVehiclesByDriver($value->dni_id);
            }
            return response()->json(['response' => 'Usuario eliminado', 'error' => '']);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el usuario']);
        }
    }

    public function vehicleList()
    {
        $company_id = auth()->user()->company_active;
        $vehicle = DB::table('vehicle')
            ->orderBy('vehicle.start_date', 'desc')
            ->where('vehicle.operation', '!=', 'D')
            ->where('vehicle.company_id', '=', $company_id)
            ->select(DB::raw(
                'vehicle.plate_id,
                vehicle.type_v,
                IF(vehicle.owner_v="Y","Sí","No") as owner_v,
                vehicle.number_of_drivers,
                vehicle.soat_expi_date,
                vehicle.capacity,
                vehicle.service,
                vehicle.cylindrical_cc,
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
        $company_id = Auth::user()->company_active;
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

    public static function getSoatExpiDatesR(Request $request)
    {
        // echo '<pre>';
        // print_r($request->all());
        // die;
        $fecha_actual = date("Y-m-d");
        $date_month = date("Y-m-d", strtotime($fecha_actual . "+ 2 month"));
        $company_id = $request->get('company_id');
        if (!empty($request->get('dni_id'))) {
            $dni_id = $request->get('dni_id');
            $soats_expiration = DB::table('vehicle as v')
                ->select(DB::raw(
                    'count(v.plate_id) as total'
                ))
                ->join('user_vehicle as uv', 'uv.vehicle_plate_id', '=', 'v.plate_id')
                ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
                ->where('v.company_id', '=', $company_id)
                ->where('v.operation', '!=', 'D')
                ->where('di.dni_id', '=', $dni_id)
                ->whereBetween('v.soat_expi_date', [$fecha_actual, $date_month])
                ->first();
        } else {
            $soats_expiration = DB::table('vehicle as v')
                ->select(DB::raw(
                    'count(v.plate_id) as total'
                ))
                ->where('v.company_id', '=', $company_id)
                ->where('v.operation', '!=', 'D')
                ->whereBetween('v.soat_expi_date', [$fecha_actual, $date_month])
                ->first();
        }
        // print_r($soats_expiration);
        // die;
        return response()->json(['response' => $soats_expiration->total, 'errors' => []]);
    }

    public static function getSoatsExpirated($company_id)
    {
        $company_id = Auth::user()->company_active;
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

    public static function getSoatsExpiratedR(Request $request)
    {
        $fecha_actual = date("Y-m-d");
        $company_id = $request->get('company_id');
        if (!empty($request->get('dni_id'))) {
            $dni_id = $request->get('dni_id');
            $soats_expirated = DB::table('vehicle as v')
                ->select(DB::raw(
                    'count(v.plate_id) as total'
                ))
                ->join('user_vehicle as uv', 'uv.vehicle_plate_id', '=', 'v.plate_id')
                ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
                ->where('v.company_id', '=', $company_id)
                ->where('v.operation', '!=', 'D')
                ->where('di.dni_id', '=', $dni_id)
                ->where('v.soat_expi_date', '<=', $fecha_actual)
                ->first();
        } else {
            $soats_expirated = DB::table('vehicle as v')
                ->select(DB::raw(
                    'count(v.plate_id) as total'
                ))
                ->where('v.company_id', '=', $company_id)
                ->where('v.operation', '!=', 'D')
                ->where('v.soat_expi_date', '<=', $fecha_actual)
                ->first();
        }
        return response()->json(['response' => $soats_expirated->total, 'errors' => []]);
    }

    public static function getExpiTecnomecanicalDates($company_id)
    {
        $company_id = Auth::user()->company_active;
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

    public static function getExpiTechnomecanicalDatesR(Request $request)
    {
        $fecha_actual = date("Y-m-d");
        $date_month = date("Y-m-d", strtotime($fecha_actual . "+ 2 month"));
        $company_id = $request->get('company_id');
        if (!empty($request->get('dni_id'))) {
            $dni_id = $request->get('dni_id');
            $tecnomecanical_expiration = DB::table('vehicle as v')
                ->select(DB::raw(
                    'count(v.plate_id) as total'
                ))
                ->join('user_vehicle as uv', 'uv.vehicle_plate_id', '=', 'v.plate_id')
                ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
                ->where('v.company_id', '=', $company_id)
                ->where('v.operation', '!=', 'D')
                ->where('di.dni_id', '=', $dni_id)
                ->whereBetween('v.technomechanical_date', [$fecha_actual, $date_month])
                ->first();
        } else {
            $tecnomecanical_expiration = DB::table('vehicle as v')
                ->select(DB::raw(
                    'count(v.plate_id) as total'
                ))
                ->where('v.company_id', '=', $company_id)
                ->where('v.operation', '!=', 'D')
                ->whereBetween('v.technomechanical_date', [$fecha_actual, $date_month])
                ->first();
        }
        return response()->json(['response' => $tecnomecanical_expiration->total, 'errors' => []]);
    }

    public static function getExpiTecnomecanicalExpirated($company_id)
    {
        $company_id = Auth::user()->company_active;
        $fecha_actual = date("Y-m-d");
        $tecnomecanical_expiration = DB::table('vehicle as v')
            ->select(DB::raw(
                'count(v.plate_id) as total'
            ))
            ->where('v.company_id', '=', $company_id)
            ->where('v.operation', '!=', 'D')
            ->where('v.technomechanical_date', '>', $fecha_actual)
            // ->toSql();
            ->first();
        // echo '<pre>';
        // print_r($tecnomecanical_expiration->total);
        // die;    
        return $tecnomecanical_expiration->total;
    }

    public static function getExpiTecnomecanicalExpiratedR(Request $request)
    {
        $fecha_actual = date("Y-m-d");
        $company_id = $request->get('company_id');
        if (!empty($request->get('dni_id'))) {
            $dni_id = $request->get('dni_id');
            $tecnomecanical_expirated = DB::table('vehicle as v')
                ->select(DB::raw(
                    'count(v.plate_id) as total'
                ))
                ->join('user_vehicle as uv', 'uv.vehicle_plate_id', '=', 'v.plate_id')
                ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
                ->where('v.company_id', '=', $company_id)
                ->where('v.operation', '!=', 'D')
                ->where('di.dni_id', '=', $dni_id)
                ->where('v.technomechanical_date', '<=', $fecha_actual)
                ->first();
        } else {
            $tecnomecanical_expirated = DB::table('vehicle as v')
                ->select(DB::raw(
                    'count(v.plate_id) as total'
                ))
                ->where('v.company_id', '=', $company_id)
                ->where('v.operation', '!=', 'D')
                ->where('v.technomechanical_date', '<=', $fecha_actual)
                ->first();
        }
        return response()->json(['response' => $tecnomecanical_expirated->total, 'errors' => []]);
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

    public static function getTypesByCompanyADriver($company_id, $dni_id)
    {
        return DB::table('vehicle as v')
            ->select(DB::raw(
                'count(plate_id) as total,
                 type_v'
            ))
            ->join('user_vehicle as uv', 'uv.vehicle_plate_id', '=', 'v.plate_id')
            ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
            ->where('v.company_id', '=', $company_id)
            ->where('v.operation', '!=', 'D')
            ->where('di.dni_id', '=', $dni_id)
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

    public static function getOwnersVByCompanyADriver($company_id, $dni_id)
    {
        return DB::table('vehicle as v')
            ->select(DB::raw(
                'count(plate_id) as total,
                IF(owner_v="Y", "Sí", "No") as owner_v'
            ))
            ->join('user_vehicle as uv', 'uv.vehicle_plate_id', '=', 'v.plate_id')
            ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
            ->where('v.company_id', '=', $company_id)
            ->where('v.operation', '!=', 'D')
            ->where('di.dni_id', '=', $dni_id)
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

    public static function getLineVByCompanyADriver($company_id, $dni_id)
    {
        return DB::table('vehicle as v')
            ->select(DB::raw(
                'count(plate_id) as total,
             line'
            ))
            ->join('user_vehicle as uv', 'uv.vehicle_plate_id', '=', 'v.plate_id')
            ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
            ->where('v.company_id', '=', $company_id)
            ->where('v.operation', '!=', 'D')
            ->where('di.dni_id', '=', $dni_id)
            ->groupBy('v.line')
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

    public static function getBrandByCompanyADriver($company_id, $dni_id)
    {
        return DB::table('vehicle as v')
            ->select(DB::raw(
                'count(plate_id) as total,
                 brand'
            ))
            ->join('user_vehicle as uv', 'uv.vehicle_plate_id', '=', 'v.plate_id')
            ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
            ->where('v.company_id', '=', $company_id)
            ->where('v.operation', '!=', 'D')
            ->where('di.dni_id', '=', $dni_id)
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

    public static function getModelByCompanyADriver($company_id, $dni_id)
    {
        return DB::table('vehicle as v')
            ->select(DB::raw(
                'count(plate_id) as total,
             model'
            ))
            ->join('user_vehicle as uv', 'uv.vehicle_plate_id', '=', 'v.plate_id')
            ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
            ->where('v.company_id', '=', $company_id)
            ->where('v.operation', '!=', 'D')
            ->where('di.dni_id', '=', $dni_id)
            ->groupBy('v.model')
            // ->toSql();
            ->get()->toArray();
    }

    public function makeBarChartTypeV(Request $request)
    {
        $company_id = $request->get('company_id');
        if (!empty($request->get('dni_id'))) {
            $dni_id = $request->get('dni_id');
            $type_v = $this->getTypesByCompanyADriver($company_id, $dni_id);
        } else {
            $type_v = $this->getTypesByCompany($company_id);
        }
        return $this->chart_js->makeChart($type_v);
        // foreach ($type_v as $key => $value) {
        //     $labels[] = $value->type_v;
        //     $data_data[] = $value->total;
        // }
        // $num_register = count($data_data);
        // $arr_colors = $this->fillColorsBarChart($num_register);
        // $maximo = max($data_data) + 1;
        // $datasets['label'] = "Frecuencia Tipos Vehículo";
        // $datasets['data'] = $data_data;
        // $datasets['backgroundColor'] = $arr_colors['backgroundColor'];
        // $datasets['borderColor'] = $arr_colors['borderColor'];
        // $datasets['borderWidth'] = 1;
        // $data['datasets'][] = $datasets;
        // $data['labels'] = $labels;
        // return response()->json(['data' => $data, 'errors' => [], 'max' => $maximo]);
    }

    public function makePieChartLineV(Request $request)
    {
        $company_id = $request->get('company_id');
        if (!empty($request->get('dni_id'))) {
            $dni_id = $request->get('dni_id');
            $lines = $this->getLineVByCompanyADriver($company_id, $dni_id);
        } else {
            $lines = $this->getLineVByCompany($company_id);
        }
        return $this->chart_js->makeChart($lines);
        // echo '<pre>';
        // print_r($lines);
        // die;
        // foreach ($lines as $key => $value) {
        //     $labels[] = $value->line;
        //     $data_data[] = $value->total;
        // }
        // $num_register = count($data_data);
        // $arr_colors = $this->fillColorsBarChart($num_register);
        // $maximo = max($data_data) + 1;
        // $datasets['label'] = "Frecuencia Tipos Vehículo";
        // $datasets['data'] = $data_data;
        // $datasets['backgroundColor'] = $arr_colors['backgroundColor'];
        // $datasets['borderColor'] = $arr_colors['borderColor'];
        // $datasets['borderWidth'] = 1;
        // $data['datasets'][] = $datasets;
        // $data['labels'] = $labels;
        // return response()->json(['data' => $data, 'errors' => [], 'max' => $maximo]);
    }

    public function addVehicleDriver(Request $request)
    {
        $now = date("Y-m-d H:i:s");
        $data_request = $request->all();
        $driver_information_dni_id = $data_request['driver_information_dni_id'];
        $vehicle_plate_id = $data_request['vehicle_plate_id'];
        // echo '<pre>';
        // print_r($data_request);
        //Revisan los vehículos de ese conductor
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
            //Le asigna a ese vehículo ese nuevo conductor
            self::updateDriversByVehicle($vehicle_plate_id, $driver_information_dni_id);
            DriverInformationController::incresases1NumberOfVehiclesByDriver($driver_information_dni_id);
            return response()->json(['response' => 'El conductor ha sido asignado al vehículo.', 'errors' => []]);
        } else {
            // print_r($check_vehicles);
            if ($check_vehicles->operation == "D") {
                // echo ' tiene D';
                // die;
                self::updateDriversByVehicle($vehicle_plate_id, $driver_information_dni_id);
                DriverInformationController::incresases1NumberOfVehiclesByDriver($driver_information_dni_id);
                return response()->json(['response' => 'El conductor ha sido asignado al vehículo.', 'errors' => []]);
            } else {
                // echo '<pre>';
                // print_r($check_vehicles);
                if ($this->ifExistDriverVehicle($vehicle_plate_id, $driver_information_dni_id)) {
                    return response()->json(['response' => 'Conductor Ya asociado', 'errors' => ['driver_information_dni_id' => ['Este conductor ya tiene asociado este vehículo.']]]);
                } else {
                    self::updateDriversByVehicle($vehicle_plate_id, $driver_information_dni_id);
                    DriverInformationController::incresases1NumberOfVehiclesByDriver($driver_information_dni_id);
                    return response()->json(['response' => 'El conductor ha sido asignado al vehículo.', 'errors' => []]);
                }
            }
        }
    }

    public function makePolarChartModelV(Request $request)
    {
        $company_id = $request->get('company_id');
        if (!empty($request->get('dni_id'))) {
            $dni_id = $request->get('dni_id');
            $models = $this->getModelByCompanyADriver($company_id, $dni_id);
        } else {
            $models = $this->getModelByCompany($company_id);
        }
        return $this->chart_js->makeChart($models);

        // foreach ($models as $key => $value) {
        //     $labels[] = $value->model;
        //     $data_data[] = $value->total;
        // }
        // $num_register = count($data_data);
        // $arr_colors = $this->fillColorsBarChart($num_register);
        // $maximo = max($data_data) + 1;
        // $datasets['label'] = "Frecuencia Tipos Vehículo";
        // $datasets['data'] = $data_data;
        // $datasets['backgroundColor'] = $arr_colors['backgroundColor'];
        // $datasets['borderColor'] = $arr_colors['borderColor'];
        // $datasets['borderWidth'] = 1;
        // $data['datasets'][] = $datasets;
        // $data['labels'] = $labels;
        // return response()->json(['data' => $data, 'errors' => [], 'max' => $maximo]);
    }

    private function ifExistDriverVehicle($plate_id, $driver)
    {
        $exist = false;
        $check_drivers = DB::table('user_vehicle')
            ->where('user_vehicle.vehicle_plate_id', '=', $plate_id)
            ->select(DB::raw(
                'user_vehicle.vehicle_plate_id,
                user_vehicle.driver_information_dni_id,
                user_vehicle.operation'
            ))->get()->toArray();
        // echo '<pre>';
        // print_r($check_drivers);
        // echo $driver;
        // die;
        foreach ($check_drivers as $key => $value) {
            if ($value->driver_information_dni_id == $driver) {
                $exist = true;
            }
        }
        return $exist;
    }

    public static function updateDriversByVehicle($vehicle_plate_id, $driver_information_dni_id)
    {
        $now = date("Y-m-d H:i:s");
        //Inserta en la tabla relación user_vehicle
        DriverVehicle::create([
            'user_id' => auth()->id(),
            'vehicle_plate_id' => $vehicle_plate_id,
            'driver_information_dni_id' => $driver_information_dni_id,
        ]);
        //Consulta cuántos conductores tienen ese vehículo
        $check_vehicles_dni_id = DB::table('user_vehicle')
            ->where('user_vehicle.vehicle_plate_id', '=', $vehicle_plate_id)
            ->where('user_vehicle.operation', '!=', 'D')
            ->select(DB::raw(
                'user_vehicle.vehicle_plate_id,
                     user_vehicle.driver_information_dni_id,
                     user_vehicle.operation'
            ))->get();
        //cuenta la cantidad de vehículos
        $num_vehicles = count($check_vehicles_dni_id);
        //Actualiza la cantidad de conductores en la tabla vehicle
        $response = Vehicle::where('plate_id', $vehicle_plate_id)->update([
            'number_of_drivers' => $num_vehicles,
            'operation' => 'U',
            'date_operation' => $now,
            'user_id' => auth()->id(),
        ]);
    }

    public function makePolarChartBrandV(Request $request)
    {
        $company_id = $request->get('company_id');
        if (!empty($request->get('dni_id'))) {
            $dni_id = $request->get('dni_id');
            $brands = $this->getBrandByCompanyADriver($company_id, $dni_id);
        } else {
            $brands = $this->getBrandByCompany($company_id);
        }
        return $this->chart_js->makeChart($brands);
        // foreach ($brands as $key => $value) {
        //     $labels[] = $value->brand;
        //     $data_data[] = $value->total;
        // }
        // $num_register = count($data_data);
        // $arr_colors = $this->fillColorsBarChart($num_register);
        // $maximo = max($data_data) + 1;
        // $datasets['label'] = "Frecuencia Tipos Vehículo";
        // $datasets['data'] = $data_data;
        // $datasets['backgroundColor'] = $arr_colors['backgroundColor'];
        // $datasets['borderColor'] = $arr_colors['borderColor'];
        // $datasets['borderWidth'] = 1;
        // $data['datasets'][] = $datasets;
        // $data['labels'] = $labels;
        // return response()->json(['data' => $data, 'errors' => [], 'max' => $maximo]);
    }

    public function makePieChartOwnerV(Request $request)
    {
        $company_id = $request->get('company_id');
        if (!empty($request->get('dni_id'))) {
            $dni_id = $request->get('dni_id');
            $owner_v = $this->getOwnersVByCompanyADriver($company_id, $dni_id);
        } else {
            $owner_v = $this->getOwnersVByCompany($company_id);
        }
        return $this->chart_js->makeChart($owner_v);
        // foreach ($owner_v as $key => $value) {
        //     $labels[] = $value->owner_v;
        //     $data_data[] = $value->total;
        // }
        // $num_register = count($data_data);
        // $arr_colors = $this->fillColorsBarChart($num_register);
        // $maximo = max($data_data) + 1;
        // $datasets['label'] = "Frecuencia Tipos Vehículo";
        // $datasets['data'] = $data_data;
        // $datasets['backgroundColor'] = $arr_colors['backgroundColor'];
        // $datasets['borderColor'] = $arr_colors['borderColor'];
        // $datasets['borderWidth'] = 1;
        // $data['datasets'][] = $datasets;
        // $data['labels'] = $labels;
        // return response()->json(['data' => $data, 'errors' => [], 'max' => $maximo]);
    }

    public function checkVehicleByPlateId(Request $request)
    {
        $company_id_active = Auth::user()->company_active;
        $plate_id = $request->get('plate_id');
        $check_vehicle = DB::table('vehicle')
            ->orderBy('vehicle.start_date', 'desc')
            ->where('vehicle.plate_id', '=', $plate_id)
            ->select(DB::raw(
                'vehicle.plate_id,
                 vehicle.operation,
                 vehicle.technomechanical_date,
                 vehicle.company_id'
            ))->first();
        // echo '<pre> '.$company_id_active.' ';
        // print_r($check_vehicle);
        // var_dump($check_vehicle->company_id == $company_id_active);
        // die;
        if (empty($check_vehicle)) {
            return response()->json(['response' => 'ok', 'errors' => []]);
        } else if (($check_vehicle->operation == "U" || $check_vehicle->operation == "A") && $check_vehicle->company_id == $company_id_active) {
            return response()->json(['response' => 'error', 'errors' => ['plate_id' => ['Esta placa ya existe. Para actualizarla debe hacerlo en la tabla.']]]);
        } else if (($check_vehicle->operation == "U" || $check_vehicle->operation == "A") && $check_vehicle->company_id != $company_id_active) {
            return response()->json(['response' => 'error', 'errors' => ['plate_id' => ['Esta placa se encuentra reigstrada en otra empresa.']]]);
        } else {
            return response()->json(['response' => 'ok', 'errors' => []]);
        }
    }

    protected function validateInformation(Request $request)
    {
        $all = $request->all();
        $data_input = $request->get('vehicle');
        $index = $request->get('index');
        echo '<pre>';
        print_r($all);
        die;
        $data_input = $this->toArrayColumn($data_input, $index, ['soat_expi_date', 'technomechanical_date']);
        // echo '<pre> index:';
        // print($index);
        // print_r($data_input);
        // die;
        $plate_id = !empty($data_input['plate_id']) ? $data_input['plate_id'] : "";
        $validator = Validator::make(
            $data_input,
            [
                'plate_id' => ['required', 'max:15', 'unique:vehicle'],
                'type_v' => 'required|max:255',
                'owner_v' => 'required|max:255',
                'soat_expi_date' . ($index + 1) => 'required|max:255',
                'capacity' => 'required|max:11',
                'operation' => [new IsNotDelete(['plate_id', $plate_id], 'vehicle')],
            ],
            [
                'plate_id.required' => "La placa no puede ser vacía",
                'type_v.required' => "Se debe elegir el tipo de vehiculo",
                'owner_v.required' => "Se debe elegir una opción",
                'soat_expi_date' . ($index + 1) . '.required' => "Se debe seleccionar una fecha",
                'capacity.required' => "Se debe seleccionar la capacidad",
                'plate_id.unique' => "Esta placa ya está en uso. Para actualizarla hágalo en la tabla.",
            ]
        );
        $errors = $validator->errors()->getMessages();
        if (!empty($errors)) {
            return response()->json(['errors' => $errors]);
        } else {
            return response()->json(['response' => '', 'errors' => []]);
        }
    }

    public function registerSecondaryInformation(Request $request)
    {
        $company_id = auth()->user()->company_active;
        // echo '<pre>';
        // die;
        $vechicles = $request->get('vehicle');
        $data_clean_vehicles = $this->cleanArray($vechicles);
        // print_r($data_clean_vehicles);
        // $v = $this->toArrayByNumber($request->get('vehicle'));
        // die;
        $driver_information = $request->get('driverInformation');
        $dni_id = $driver_information['dni_id'];
        $insert_v = "";
        $insert_uv = "";
        foreach ($data_clean_vehicles as $key_v => $value_v) {
            $insert_v = Vehicle::create([
                'plate_id' => $value_v['plate_id'],
                'type_v' => $value_v['type_v'],
                'owner_v' => $value_v['owner_v'] != "" ? $value_v['owner_v'] : 0,
                'taxi_type' => $value_v['taxi_type'] != "" ? $value_v['taxi_type'] : "NA",
                'number_of_drivers' => $value_v['number_of_drivers'] != "" ? $value_v['number_of_drivers'] : 1,
                'soat_expi_date' => $value_v['soat_expi_date'],
                'capacity' => $value_v['capacity'],
                'service' => $value_v['service'] != "" ? $value_v['service'] : "Otros",
                'cylindrical_cc' => $value_v['cylindrical_cc'] != "" ? $value_v['cylindrical_cc'] : 1,
                'model' => $value_v['model'] != "" ? $value_v['model'] : "",
                'line' => $value_v['line'] != "" ? $value_v['line'] : "",
                'brand' => $value_v['brand'] != "" ? $value_v['brand'] : "",
                'color' => $value_v['color'] != "" ? $value_v['color'] : "",
                'technomechanical_date' => $value_v['technomechanical_date'] != "" ? $value_v['technomechanical_date'] : null,
                'company_id' => $company_id,
                'user_id' => auth()->id(),
            ]);
            // echo ' di '.$dni_id;
            // echo ' placa: '.$insert_v->plate_id;
            // die;
            $insert_uv = DriverVehicle::create([
                'vehicle_plate_id' => $insert_v->plate_id,
                'driver_information_dni_id' => $dni_id,
                'user_id' => auth()->id()
            ]);
        }
        if ($insert_v->plate_id  != "" && $insert_uv->vehicle_plate_id != "") {
            return response()->json(['response' => 'Se ha registrado la información de la fase 2-3', 'errors' => []]);
        } else {
            return response()->json(['errors' => ['response' => 'No se pudo actualizar la información']]);
        }
    }

    private function cleanArray($array_vehicle)
    {
        $str_soat_expi_date = 'soat_expi_date';
        $lenght_soat = strlen($str_soat_expi_date);
        $str_technomechanical_date = 'technomechanical_date';
        $lenght_tech = strlen($str_technomechanical_date);
        $new = [];
        foreach ($array_vehicle as $key_vehicle => $value_vehicle) {
            if (strpos($key_vehicle, $str_soat_expi_date) !== false) {
                $explit = str_split($key_vehicle, $lenght_soat);
                $new[($explit[1]) - 1][$str_soat_expi_date] = $value_vehicle;
            } else if (strpos($key_vehicle, $str_technomechanical_date) !== false) {
                $explit = str_split($key_vehicle, $lenght_tech);
                $new[($explit[1]) - 1][$str_technomechanical_date] = $value_vehicle;
            } else {
                foreach ($value_vehicle as $key_child => $value_child) {
                    $new[$key_child][$key_vehicle] = $value_child;
                }
            }
        }
        return $new;
    }

    public static function listArray()
    {
        $company_id = auth()->user()->company_active;
        return DB::table('vehicle')
            ->orderBy('vehicle.start_date', 'desc')
            ->where('vehicle.operation', '!=', 'D')
            ->where('vehicle.company_id', '=', $company_id)
            ->select(DB::raw(
                'vehicle.plate_id,
                vehicle.type_v'
            ))->get()->toArray();
        // echo '<pre>';
        // print_r($vehicle);
        // die;
    }
}
