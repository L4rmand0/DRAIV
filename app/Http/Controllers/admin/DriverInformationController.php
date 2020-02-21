<?php

namespace App\Http\Controllers\admin;

// use Excel;

use App\DriverInformation;
use App\DriverVehicle;
use App\DrivingLicence;
use App\Http\Controllers\ChartJS;
use App\Http\Controllers\Controller;
// use Maatwebsite\Excel\Excel;
use App\Imagenes;
use App\Imports\UsersInformationImport;
use App\Vehicle;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class DriverInformationController extends Controller
{
    private $excel;
    private $chart_js;
    private $user_controller;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->chart_js = new ChartJS();
        $this->user_controller = new UserController();
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
        // $list_admin3 = Admin3Controller::listAdmin3();
        // $enum_education = $this->generateOptionsEnumDt(DriverInformation::enum_education);
        // $list_education = DriverInformation::enum_education;
        // $enum_civil_state = $this->generateOptionsEnumDt(DriverInformation::enum_civil_state);
        // $list_civil_state = DriverInformation::enum_civil_state;
        // $enum_country_born = $this->generateOptionsEnumDt(DriverInformation::enum_country_born);
        // $list_country_born = DriverInformation::enum_country_born;
        // $company_id = auth()->user()->company_id;
        // $company = CompanyController::getCompanyByid($company_id);
        // // echo '<pre>';
        // // print_r($enum_education);
        // // die;
        // return view(
        //     'admin.information-user.index',
        //     [
        //         'enum_education' => $enum_education,
        //         'enum_civil_state' => $enum_civil_state,
        //         'enum_country_born' => $enum_country_born,
        //         'list_education' => $list_education,
        //         'list_civil_state' => $list_civil_state,
        //         'list_country_born' => $list_country_born,
        //         'list_admin3' => $list_admin3,
        //         'company_name' => ucwords(strtolower($company->company)),
        //         'permissions' => $permissions,
        //     ]
        // );
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
        $company_id_active = Auth::user()->company_active;
        // echo '<pre>';
        $data_input = $request->all()['driverInformation'];
        // print_r($data_input);
        // die;
        $validator = Validator::make(
            $data_input,
            [
                'first_name' => 'required|max:70',
                'f_last_name' => 'required|max:20',
                's_last_name' => 'max:20',
                'dni_id' => ['required', 'max:10', 'unique:driver_information'],
                'gender' => 'required',
                'education' => 'required',
                'country_born' => 'required',
                // 'city_born' => 'required|max:20',
                'city_residence_place' => 'required|max:20',
                'department' => 'required|max:20',
                'civil_state' => 'required',
                'address' => 'required|max:50',
                'phone' => 'required|max:30',
            ],
            [
                'dni_id.unique' => "Esta cédula ya está en uso.",
            ]
        );
        // echo ' store ';
        $errors = $validator->errors()->getMessages();
        $check_driver = DB::table('driver_information as d')
            ->where('d.dni_id', '=', $data_input['dni_id'])
            ->select(DB::raw(
                'd.dni_id,
                 d.company_id,
                 d.operation'
            ))->first();
        //  echo '<pre>';
        //  print_r($check_driver);
        //  die;   
        if(!empty($check_driver)){
            if($check_driver->operation == 'D'){
                foreach ($errors as $key => $value) {
                    if (strpos($value[0], "uso") !== false) {
                        $now = date("Y-m-d H:i:s");
                        $response = DriverInformation::where($key, $data_input[$key])->update([
                            'first_name' => $data_input['first_name'],
                            'second_name' => $data_input['second_name'] != "" ? $data_input['second_name'] : "NA",
                            'f_last_name' => $data_input['f_last_name'],
                            's_last_name' => $data_input['s_last_name'] != "" ? $data_input['s_last_name'] : "NA",
                            'gender' => $data_input['gender'],
                            'education' => $data_input['education'],
                            'country_born' => $data_input['country_born'],
                            // 'city_born' => $data_input['city_born'],
                            'city_residence_place' => $data_input['city_residence_place'],
                            'department' => $data_input['department'],
                            'civil_state' => $data_input['civil_state'],
                            'score' => $data_input['score'] != "" ? number_format($data_input['score'], 2) : null,
                            'address' => $data_input['address'],
                            'phone' => $data_input['phone'],
                            'db_user_id' => $data_input['db_user_id'],
                            'company_id' => $data_input['company_id'],
                            'operation' => 'U',
                            'date_operation' => $now,
                        ]);
                        if ($response) {
                            return response()->json(['response' => 'Información actualizada', 'errors' => []]);
                        } else {
                            return response()->json(['errors' => ['response' => 'No se pudo actualizar la información']]);
                        }
                    }
                }
             }else{
                 if($check_driver->company_id != auth()->user()->company_id){
                    return response()->json(['errors' => ['dni_id' => ['Este conductor se encuentra activo en otra empresa.']]]);
                 }
             }
        }
         
        if (!empty($errors)) {
            return response()->json(['errors' => $errors]);
        } else {
            $user_information = DriverInformation::create([
                'dni_id' => $data_input['dni_id'],
                'first_name' => $data_input['first_name'],
                'second_name' => $data_input['second_name'] != "" ? $data_input['second_name'] : "NA",
                'f_last_name' => $data_input['f_last_name'],
                's_last_name' => $data_input['s_last_name'] != "" ? $data_input['s_last_name'] : "NA",
                'e_mail_address' => $data_input['e_mail_address'],
                'gender' => $data_input['gender'],
                'education' => $data_input['education'],
                'country_born' => $data_input['country_born'],
                // 'city_born' => $data_input['city_born'],
                'city_residence_place' => $data_input['city_residence_place'],
                'department' => $data_input['department'],
                'civil_state' => $data_input['civil_state'],
                'score' => $data_input['score'] != "" ? number_format($data_input['score'], 2) : null,
                'address' => $data_input['address'],
                'phone' => $data_input['phone'],
                'db_user_id' => $data_input['db_user_id'],
                'company_id' => $data_input['company_id'],
            ]);
            if ($user_information->dni_id > 0) {
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

    /**$.ajax({
    type: 'GET',
    url: $('#department').data('url'),
    data: { 'type': 'select_admin2' },
    success: function (data) {
    $('#department').select2({
    data: data
    });
    }
    });
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
        if ($field == "gender") {
            $value = $value == "Masculino" ? 0 : 1;
        }
        // var_dump(is_numeric($value));
        // die;
        if(!is_numeric($value) && $field == "score"){
            return response()->json(['error' => ['response' => 'Formato incorrecto, el número no puede llevar comas ni texto. Ejemplo Correcto: 4.00']]);
        }
        if ($field == "score" && ($value > 5 || $value < 0)) {
            return response()->json(['error' => ['response' => 'El score no puede ser mayor a 5 ni menor a 0. Ejemplo: 5.00']]);
        }
        $response = DriverInformation::where('dni_id', $data_updated['dni_id'])->update([
            $field => $value,
            'operation' => 'U',
            'date_operation' => $now,
            'user_id' => auth()->id(),
        ]);
        if ($response) {
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
        $now = date("Y-m-d H:i:s");
        $data_delete = $request->all();
        $delete = 0;
        $errors = 0;
        $dni_id = $data_delete['dni_id'];
        // echo '<pre>';
        // print_r($check_vehicle_driver);
        $delete = DriverInformation::where('dni_id', $dni_id)->update([
            'operation' => 'D',
            'user_id' => auth()->id(),
            'date_operation' => $now,
        ]);
        if ($delete <= 0) {
            $errors++;
        }
        $delete = DrivingLicence::where('driver_information_dni_id', $dni_id)->update([
            'operation' => 'D',
            'user_id' => auth()->id(),
            'date_operation' => $now,
        ]);

        $delete = Imagenes::where('driver_information_dni_id', $dni_id)->update([
            'operation' => 'D',
            'user_id' => auth()->id(),
            'date_operation' => $now,
        ]);

        $check_vehicle_driver = DB::table('user_vehicle')
            ->where('user_vehicle.driver_information_dni_id', '=', $dni_id)
            ->where('user_vehicle.operation', '!=', 'D')
            ->select(DB::raw(
                'user_vehicle.driver_information_dni_id,
                user_vehicle.vehicle_plate_id'
            ))->first();
        if (!empty($check_vehicle_driver)) {
            $delete = DriverVehicle::where('driver_information_dni_id', $dni_id)->update([
                'operation' => 'D',
                'user_id' => auth()->id(),
                'date_operation' => $now,
            ]);
            $plate_id_driver = $check_vehicle_driver->vehicle_plate_id;
            $vehicle = DB::table('vehicle')
                ->where('vehicle.plate_id', '=', $plate_id_driver)
                ->select(DB::raw(
                    'vehicle.plate_id,
                    vehicle.number_of_drivers'
                ))->first();
            $number_of_drivers = $vehicle->number_of_drivers - 1;
            // print_r($number_of_drivers);
            // die;
            $delete = Vehicle::where('plate_id', $plate_id_driver)->update([
                'operation' => 'U',
                'number_of_drivers' => $number_of_drivers,
                'user_id' => auth()->id(),
                'date_operation' => $now,
            ]);
            if ($delete <= 0) {
                $errors++;
            }
        }

        if ($errors == 0) {
            return response()->json(['response' => 'Usuario eliminado', 'error' => '']);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el usuario']);
        }
    }

    public function driveInformationList()
    {
        $company_id = Auth::user()->company_active;
        $drive_information = DB::table('driver_information')
            ->orderBy('driver_information.start_date', 'desc')
            ->join('users', 'driver_information.db_user_id', '=', 'users.id')
            ->join('company', 'company.Company_id', '=', 'driver_information.company_id')
            ->join('admin2', 'admin2.adm2_id', '=', 'driver_information.department')
            ->join('admin3', 'admin3.adm3_id', '=', 'driver_information.city_residence_place')
            ->where('driver_information.company_id', '=', $company_id)
            ->where('driver_information.operation', '!=', 'D')
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
            // ->toSql();
            ->get();
        // echo '<pre>';
        // print_r($drive_information);
        // die;    
        $drive_information = $this->addDeleteButtonDatatable($drive_information);
        return datatables()->of($drive_information)->make(true);
    }

    public static function getListDrivers()
    {
        $company_id = Auth::user()->company_active;
        return DB::table('driver_information')
            ->select(
                'driver_information.dni_id'
            )->where('driver_information.company_id', '=', $company_id)
            ->where('driver_information.operation', '!=', 'D')
            ->orderBy('driver_information.date_operation', 'desc')
            ->get()->toArray();
    }

    public function getDriveInformationtoSelect2(Request $request)
    {
        if(!empty($request->get('dashboard'))){
            $company_id = $request->get('company_id');
            $this->user_controller->updateCompanyActive($request);
        }else{
            $company_id = Auth::user()->company_active;
        }
        $admin2 = DB::table('driver_information')
            ->orderBy('driver_information.date_operation', 'desc')
            ->select(
                'driver_information.dni_id'
            )->where('driver_information.company_id', '=', $company_id)
            ->where('driver_information.operation', '!=', 'D')
            ->get()->toArray();
        return response()->json($this->createSelect2($admin2));
    }

    public function getMotorCyclistDriveInformationtoSelect2(Request $request)
    {
        $company_id = Auth::user()->company_active;
        $motor_cyclist = DB::table('user_vehicle as uv')
            ->select(
            'di.dni_id'
            )
            ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
            ->join('vehicle as v', 'v.plate_id', '=', 'uv.vehicle_plate_id')
            ->where('di.company_id', '=', $company_id)
            ->where('uv.operation', '!=', 'D')
            ->where('v.type_v', '=', 'Motos')
            ->orderBy('uv.start_date', 'desc')
            ->get()
            ->toArray();
        return response()->json($this->createSelect2($motor_cyclist));
    }

    public function createSelect2($query_data)
    {
        $data[0]['id'] = "";
        $data[0]['text'] = "Seleccionar";
        foreach ($query_data as $key => $value) {
            $data[$key + 1]['id'] = $value->dni_id;
            $data[$key + 1]['text'] = $value->dni_id;
        }
        return $data;
    }

    public function getNameDriver(Request $request)
    {
        $company_id = Auth::user()->company_active;
        $dni_id = $request->all()['user_info_id'];
        $name_driver = DB::table('driver_information')
            ->select(
                'driver_information.dni_id',
                'driver_information.first_name',
                'driver_information.second_name',
                'driver_information.f_last_name',
                'driver_information.s_last_name'
            )->where('driver_information.dni_id', '=', $dni_id)
            ->where('driver_information.company_id', '=', $company_id)
            ->get()->toArray();
        $check_vehicles = DB::table('user_vehicle')
            ->where('user_vehicle.driver_information_dni_id', '=', $dni_id)
            ->where('user_vehicle.operation', '!=', 'D')
            ->select(DB::raw(
                'user_vehicle.vehicle_plate_id,
                user_vehicle.driver_information_dni_id,
                user_vehicle.operation'
            ))->first();

        foreach ($name_driver as $value) {
            $name_id = $value->first_name . " " . $value->second_name . " " . $value->f_last_name . " " . $value->s_last_name;
        }
        if (!empty($check_vehicles)) {
            return response()->json(['name' => $name_id, 'errors' => ['driver_information_dni_id' => ['Este conductor ya tiene asociado un vehículo.']]]);
        } else {
            return response()->json(['name' => $name_id, 'errors' => []]);
        }
    }

    public function import(Request $request)
    {
        $data_insert = $request->all();
        $data_insert['id'] = auth()->id();
        $file = $request->file('file');
        $result = Excel::import(new UsersInformationImport($data_insert), $file);
        return response()->json(['response' => 'ok']);
    }

    public static function getNumberDriversByCompany($company_id)
    {
        $company_id = Auth::user()->company_active;
        $drivers = DB::table('driver_information')
            ->orderBy('driver_information.date_operation', 'desc')
            ->where('driver_information.company_id', '=', $company_id)
            ->where('driver_information.operation', '!=', 'D')
            ->select(DB::raw(
                'driver_information.dni_id'
            ))->get()->toArray();
        return count($drivers);
    }

    public static function incresases1NumberOfVehiclesByDriver($dni_id){
        $now = date("Y-m-d H:i:s");
        $drivers = DB::table('driver_information as di')
                ->select(DB::raw('
                    di.number_of_vehicles
                '))
                ->where('di.dni_id','=',$dni_id)->first();
                // print_r($drivers);
                // die;
                $old_number = (int) $drivers->number_of_vehicles;
                // var_dump($old_number);
                // die;
                $update = DriverInformation::where('dni_id', $dni_id)->update([
                    'number_of_vehicles' => ($old_number+1),
                    'operation' => 'A',
                    'date_operation' => $now,
                    'user_id' => auth()->id(),
                ]);
    }

    public static function decresases1NumberOfVehiclesByDriver($dni_id){
        $now = date("Y-m-d H:i:s");
        $drivers = DB::table('driver_information as di')
                ->select(DB::raw('
                    di.number_of_vehicles
                '))
                ->where('di.dni_id','=',$dni_id)->first();
                // print_r($drivers);
                // die;
                $old_number = (int) $drivers->number_of_vehicles;
                // var_dump($old_number);
                // die;
                $update = DriverInformation::where('dni_id', $dni_id)->update([
                    'number_of_vehicles' => ($old_number-1),
                    'operation' => 'A',
                    'date_operation' => $now,
                    'user_id' => auth()->id(),
                ]);
    } 

    public static function getNumberDriversByCompanyR(Request $request)
    {
        // echo '<pre>';
        // print_r($request->all());
        // die;
        $company_id = $request->get('company_id');
        if (!empty($request->get('dni_id'))) {
            $dni_id = $request->get('dni_id');
            $drivers = DB::table('driver_information')
                ->orderBy('driver_information.date_operation', 'desc')
                ->where('driver_information.dni_id', '=', $dni_id)
                ->where('driver_information.company_id', '=', $company_id)
                ->where('driver_information.operation', '!=', 'D')
                ->select(DB::raw(
                    'driver_information.dni_id'
                ))->get()->toArray();
        } else {
            $drivers = DB::table('driver_information')
                ->orderBy('driver_information.date_operation', 'desc')
                ->where('driver_information.company_id', '=', $company_id)
                ->where('driver_information.operation', '!=', 'D')
                ->select(DB::raw(
                    'driver_information.dni_id'
                ))->get()->toArray();
        }

        return response()->json(['response' => count($drivers), 'errors' => []]);
    }

    public static function getEducationGradeByCompany($company_id)
    {
        return DB::table('driver_information')
            ->select(DB::raw(
                'driver_information.education,COUNT(*) AS total'
            ))
            ->where('driver_information.company_id', '=', $company_id)
            ->where('driver_information.operation', '!=', 'D')
            ->groupBy('education')
            ->get()->toArray();
    }

    public static function getEducationGradeByCompanyADriver($company_id, $dni_id)
    {
        return DB::table('driver_information')
            ->select(DB::raw(
                'driver_information.education,COUNT(*) AS total'
            ))
            ->where('driver_information.company_id', '=', $company_id)
            ->where('driver_information.dni_id', '=', $dni_id)
            ->where('driver_information.operation', '!=', 'D')
            ->groupBy('education')
            ->get()->toArray();
    }

    public static function getCivilStateByCompany($company_id)
    {
        return DB::table('driver_information')
            ->select(DB::raw(
                'driver_information.civil_state,COUNT(*) AS total'
            ))
            ->where('driver_information.company_id', '=', $company_id)
            ->where('driver_information.operation', '!=', 'D')
            ->groupBy('civil_state')
            ->get()->toArray();
    }

    public static function getCivilStateByCompanyADriver($company_id, $dni_id)
    {
        return DB::table('driver_information')
            ->select(DB::raw(
                'driver_information.civil_state,COUNT(*) AS total'
            ))
            ->where('driver_information.company_id', '=', $company_id)
            ->where('driver_information.operation', '!=', 'D')
            ->where('driver_information.dni_id', '=', $dni_id)
            ->groupBy('civil_state')
            ->get()->toArray();
    }

    public static function getGenderByCompany($company_id)
    {
        $company_id = Auth::user()->company_active;
        return DB::table('driver_information')
            ->select(DB::raw(
                'driver_information.gender,COUNT(*) AS total'
            ))
            ->where('driver_information.company_id', '=', $company_id)
            ->where('driver_information.operation', '!=', 'D')
            ->groupBy('gender')
            ->get()->toArray();
    }

    public static function getGenderByCompanyR(Request $request)
    {
        $company_id = $request->get('company_id');
        if (!empty($request->get('dni_id'))) {
            $dni_id = $request->get('dni_id');
            $gender = DB::table('driver_information')
                ->select(DB::raw(
                    'driver_information.gender,COUNT(*) AS total'
                ))
                ->where('driver_information.dni_id', '=', $dni_id)
                ->where('driver_information.company_id', '=', $company_id)
                ->where('driver_information.operation', '!=', 'D')
                ->groupBy('gender')
                ->get()->toArray();
        } else {
            $gender = DB::table('driver_information')
                ->select(DB::raw(
                    'driver_information.gender,COUNT(*) AS total'
                ))
                ->where('driver_information.company_id', '=', $company_id)
                ->where('driver_information.operation', '!=', 'D')
                ->groupBy('gender')
                ->get()->toArray();
        }
        $man = 0;
        $woman = 0;
        foreach ($gender as $key => $value) {
            if ($value->gender == 0) {
                $man = $value->total;
            } else if ($value->gender == 1) {
                $woman = $value->total;
            }
        }
        return response()->json(['response' => ['man' => $man, 'woman' => $woman], 'errors' => []]);
    }

    public static function getAverageScoreByCompany($company_id)
    {
        $company_id = Auth::user()->company_active;
        return DB::table('driver_information')
            ->select(DB::raw(
                'avg(driver_information.score) as average'
            ))
            ->where('driver_information.company_id', '=', $company_id)
            ->where('driver_information.operation', '!=', 'D')
            ->first();
    }

    public static function getAverageScoreByCompanyR(Request $request)
    {
        $company_id = $request->get('company_id');
        if (!empty($request->get('dni_id'))) {
            $dni_id = $request->get('dni_id');
            $average = DB::table('driver_information')
                ->select(DB::raw(
                    'avg(driver_information.score) as average'
                ))
                ->where('driver_information.dni_id', '=', $dni_id)
                ->where('driver_information.company_id', '=', $company_id)
                ->where('driver_information.operation', '!=', 'D')
                ->first();
        } else {
            $average = DB::table('driver_information')
                ->select(DB::raw(
                    'avg(driver_information.score) as average'
                ))
                ->where('driver_information.company_id', '=', $company_id)
                ->where('driver_information.operation', '!=', 'D')
                ->first();
        }
        // echo '<pre>';
        // print_r($average);
        // die;
        return response()->json(['response' => number_format($average->average, 3), 'errors' => []]);
    }

    public function makeBarChart(Request $request)
    {
        $company_id = $request->get('company_id');
        if (!empty($request->get('dni_id'))) {
            $dni_id = $request->get('dni_id');
            $education = $this->getEducationGradeByCompanyADriver($company_id, $dni_id);
        } else {
            $education = $this->getEducationGradeByCompany($company_id);
        }
        return $this->chart_js->makeChart($education);
    }

    public function makeBarChartCivilState(Request $request)
    {
        $company_id = $request->get('company_id');
        if (!empty($request->get('dni_id'))) {
            $dni_id = $request->get('dni_id');
            $civil_state = $this->getCivilStateByCompanyADriver($company_id, $dni_id);
        } else {
            $civil_state = $this->getCivilStateByCompany($company_id);
        }
        return $this->chart_js->makeChart($civil_state);
    }
}
