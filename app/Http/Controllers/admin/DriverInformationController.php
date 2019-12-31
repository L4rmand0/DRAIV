<?php

namespace App\Http\Controllers\admin;


// use Excel;

use DB;
use App\DriverInformation;
use App\DriverVehicle;
use App\DrivingLicence;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersInformationImport;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\dataConductores\UserInformationController;
use App\Imagenes;
use App\Vehicle;

class DriverInformationController extends Controller
{

    private $excel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->excel = $excel;
        // $this->middleware('guest');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_admin3 = Admin3Controller::listAdmin3();
        $enum_education = $this->generateOptionsEnumDt(DriverInformation::enum_education);
        $list_education = DriverInformation::enum_education;
        $enum_civil_state = $this->generateOptionsEnumDt(DriverInformation::enum_civil_state);
        $list_civil_state = DriverInformation::enum_civil_state;
        $enum_country_born = $this->generateOptionsEnumDt(DriverInformation::enum_country_born);
        $list_country_born = DriverInformation::enum_country_born;
        // echo '<pre>'; 
        // print_r($enum_education);
        // die;
        return view(
            'admin.information-user.index',
            [
                'enum_education' => $enum_education,
                'enum_civil_state' => $enum_civil_state,
                'enum_country_born' => $enum_country_born,
                'list_education' => $list_education,
                'list_civil_state' => $list_civil_state,
                'list_country_born' => $list_country_born,
                'list_admin3' => $list_admin3
            ]
        );
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
        $data_input = $request->all()['driverInformation'];
        // print_r($data_input);
        // die;
        $validator = Validator::make(
            $data_input,
            [
                'first_name' => 'required|max:70',
                'f_last_name' => 'required|max:20',
                's_last_name' => 'max:20',
                'e_mail_address' => ['required', 'max:35', 'unique:driver_information'],
                'dni_id' => ['required', 'max:10', 'unique:driver_information'],
                'gender' => 'required',
                'education' => 'required',
                'country_born' => 'required',
                'city_born' => 'required|max:20',
                'city_residence_place' => 'required|max:20',
                'department' => 'required|max:20',
                'civil_state' => 'required',
                'address' => 'required|max:50',
                'phone' => 'required|max:30'
            ],
            [
                'dni_id.unique' => "Esta cédula ya está en uso.",
                'e_mail_address.unique' => "Este email ya está en uso."
            ]
        );

        $errors = $validator->errors()->getMessages();
        // print_r($errors);
        // die;
        foreach ($errors as $key => $value) {
            if (strpos($value[0], "uso") !== FALSE) {
                $now = date("Y-m-d H:i:s");
                $response = DriverInformation::where($key, $data_input[$key])->update([
                    'first_name' => $data_input['first_name'],
                    'second_name' =>  $data_input['second_name'] != "" ? $data_input['second_name'] : "NA",
                    'f_last_name' => $data_input['f_last_name'],
                    's_last_name' => $data_input['s_last_name'] != "" ? $data_input['s_last_name'] : "NA",
                    'gender' => $data_input['gender'] == "Masculino",
                    'education' => $data_input['education'],
                    'country_born' => $data_input['country_born'],
                    'city_born' => $data_input['city_born'],
                    'city_residence_place' => $data_input['city_residence_place'],
                    'department' => $data_input['department'],
                    'civil_state' => $data_input['civil_state'],
                    'score' => $data_input['score'] != "" ? number_format($data_input['score'], 2) : null,
                    'address' => $data_input['address'],
                    'phone' => $data_input['phone'],
                    'db_user_id' => $data_input['db_user_id'],
                    'company_id' => $data_input['company_id'],
                    'operation' => 'U',
                    'date_operation' => $now
                ]);
                if ($response) {
                    return response()->json(['response' => 'Información actualizada', 'errors' => []]);
                } else {
                    return response()->json(['errors' => ['response' => 'No se pudo actualizar la información']]);
                }
            }
        }
        if (!empty($errors)) {
            return response()->json(['errors' => $errors]);
        } else {
            $user_information = DriverInformation::create([
                'dni_id' => $data_input['dni_id'],
                'first_name' => $data_input['first_name'],
                'second_name' =>  $data_input['second_name'] != "" ? $data_input['second_name'] : "NA",
                'f_last_name' => $data_input['f_last_name'],
                's_last_name' => $data_input['s_last_name'] != "" ? $data_input['s_last_name'] : "NA",
                'e_mail_address' => $data_input['e_mail_address'],
                'gender' => $data_input['gender'] == "Masculino",
                'education' => $data_input['education'],
                'country_born' => $data_input['country_born'],
                'city_born' => $data_input['city_born'],
                'city_residence_place' => $data_input['city_residence_place'],
                'department' => $data_input['department'],
                'civil_state' => $data_input['civil_state'],
                'score' => $data_input['score'] != "" ? number_format($data_input['score'], 2) : null,
                'address' => $data_input['address'],
                'phone' => $data_input['phone'],
                'db_user_id' => $data_input['db_user_id'],
                'company_id' => $data_input['company_id']
            ]);
            if ($user_information->dni_id > 0) {
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
        if ($field == "score" && ($value > 5 || $value < 0)) {
            return response()->json(['error' => ['response' => 'El score no puede mayor a 5 ni menor a 0. Ejemplo: 5.00']]);
        }
        $response = DriverInformation::where('dni_id', $data_updated['dni_id'])->update([
            $field => $value,
            'operation' => 'U',
            'date_operation' => $now,
            'user_id' => auth()->id()
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
            'date_operation' => $now
        ]);
        if ($delete <= 0) {
            $errors++;
        }
        $delete = DrivingLicence::where('driver_information_dni_id', $dni_id)->update([
            'operation' => 'D',
            'user_id' => auth()->id(),
            'date_operation' => $now
        ]);

        $delete = Imagenes::where('driver_information_dni_id', $dni_id)->update([
            'operation' => 'D',
            'user_id' => auth()->id(),
            'date_operation' => $now
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
                'date_operation' => $now
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
                'date_operation' => $now
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
        $company_id = Auth::user()->company_id;
        $drive_information = DB::table('driver_information')
            ->orderBy('driver_information.date_operation', 'desc')
            ->join('users', 'driver_information.Db_user_id', '=', 'users.id')
            ->join('company', 'company.Company_id', '=', 'driver_information.company_id')
            ->join('admin2', 'admin2.adm2_id', '=', 'driver_information.department')
            ->join('admin3', 'admin3.adm3_id', '=', 'driver_information.city_born')
            ->where('driver_information.company_id', '=', $company_id)
            ->where('driver_information.operation', '!=', 'D')
            ->select(DB::raw(
                'driver_information.dni_id,
            driver_information.first_name,
            driver_information.second_name,
            driver_information.f_last_name,
            driver_information.s_last_name,
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
            ))->get();
        $drive_information = $this->addDeleteButtonDatatable($drive_information);
        return datatables()->of($drive_information)->make(true);
    }

    public static function getListDrivers()
    {
        $company_id = Auth::user()->company_id;
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
        $company_id = Auth::user()->company_id;
        $admin2 = DB::table('driver_information')
            ->orderBy('driver_information.date_operation', 'desc')
            ->select(
                'driver_information.dni_id'
            )->where('driver_information.company_id', '=', $company_id)
            ->where('driver_information.operation', '!=', 'D')
            ->get()->toArray();
        return response()->json($this->createSelect2($admin2));
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
        $company_id = Auth::user()->company_id;
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
        foreach ($name_driver as $value) {
            $name_id = $value->first_name . " " . $value->second_name . " " . $value->f_last_name . " " . $value->s_last_name;
        }
        return response()->json(['name' => $name_id]);
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
        $drivers = DB::table('driver_information')
            ->orderBy('driver_information.date_operation', 'desc')
            ->where('driver_information.company_id', '=', $company_id)
            ->select(DB::raw(
                'driver_information.dni_id'
            ))->get()->toArray();
        return count($drivers);
    }


    public static function getEducationGradeByCompany($company_id)
    {
        return DB::table('driver_information')
            ->select(DB::raw(
                'driver_information.education,COUNT(*) AS total'
            ))
            ->where('driver_information.company_id', '=', $company_id)
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
            ->groupBy('civil_state')
            ->get()->toArray();
    }

    public static function getGenderByCompany($company_id)
    {
        return DB::table('driver_information')
            ->select(DB::raw(
                'driver_information.gender,COUNT(*) AS total'
            ))
            ->where('driver_information.company_id', '=', $company_id)
            ->groupBy('gender')
            ->get()->toArray();
    }

    public static function getAverageScoreByCompany($company_id)
    {
        return DB::table('driver_information')
            ->select(DB::raw(
                'avg(driver_information.score) as average'
            ))
            ->where('driver_information.company_id', '=', $company_id)
            ->first();
    }

    public function makeBarChart(Request $request)
    {
        $company_id = $request->get('company_id');
        $education = $this->getEducationGradeByCompany($company_id);
        foreach ($education as $key => $value) {
            $labels[] = $value->education;
            $data_data[] = $value->total;
        }
        $num_register = count($data_data);
        $arr_colors = $this->fillColorsBarChart($num_register);
        $maximo = max($data_data)+1;
        $datasets['label'] = "Frecuencia";
        $datasets['data'] = $data_data;
        $datasets['backgroundColor'] = $arr_colors['backgroundColor'];
        $datasets['borderColor'] = $arr_colors['borderColor'];
        $datasets['borderWidth'] = 1;
        $data['datasets'][] = $datasets;
        $data['labels'] = $labels;
        return response()->json(['data' => $data, 'errors' => [],'max'=>$maximo]);
    }

    public function makeBarChartCivilState(Request $request)
    {
        $company_id = $request->get('company_id');
        $civil_state = $this->getCivilStateByCompany($company_id);
        foreach ($civil_state as $key => $value) {
            $labels[] = $value->civil_state;
            $data_data[] = $value->total;
        }
        $num_register = count($data_data);
        $arr_colors = $this->fillColorsBarChart($num_register);
        $maximo = max($data_data)+1;
        $datasets['label'] = "Frecuencia";
        $datasets['data'] = $data_data;
        $datasets['backgroundColor'] = $arr_colors['backgroundColor'];
        $datasets['borderColor'] = $arr_colors['borderColor'];
        $datasets['borderWidth'] = 1;
        $data['datasets'][] = $datasets;
        $data['labels'] = $labels;
        return response()->json(['data' => $data, 'errors' => [],'max'=>$maximo]);
    }
}
