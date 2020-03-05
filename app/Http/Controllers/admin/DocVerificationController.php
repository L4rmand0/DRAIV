<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Rules\NotToday;
use App\DocVerification;
use App\DriverInformation;
use Illuminate\Http\Request;
use App\Traits\TListDataTable;
use App\Http\Controllers\ChartJS;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DocVerificationController extends Controller
{
    use TListDataTable;
    private $chart_js;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->chart_js = new ChartJS();
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
        $now = date("Y-m-d");
        $data_input = $request->all();
        $data_input['start_date'] = $now;
        // echo '<pre>';
        // print_r($data_input);
        // die;
        // Trae el id de la tabla user_vehicle para insertarlo después
        $user_vehicle = DB::table('user_vehicle as uv')
            ->select(DB::raw(
                'uv.id'
            ))
            ->where('uv.driver_information_dni_id', '=', $data_input['user_vehicle_id'])
            ->where('uv.operation', '!=', 'D')
            ->first();
        if (empty($user_vehicle)) {
            return response()->json(['response' => 'error_swal','errors'=>['message' => 'Este conductor ha sido elminado.']]);
        }
        $uv_id = !empty($user_vehicle) ? $user_vehicle->id : "";
        $validator = Validator::make(
            $data_input,
            [
                'start_date' => [new NotToday(['user_vehicle_id', $user_vehicle->id], 'doc_verification')],
            ]
        );
        $errors = $validator->errors()->getMessages();
        if(!empty($errors)){
            return response()->json(['response' => 'error_swal','errors'=>['message' => 'Este conductor ya registró una evalución hoy, solo se permite una por día.']]);
        }
        // echo '<pre>';
        // print_r($errors);
        // echo 'finaliza';
        // die;
        $doc_verification = DocVerification::create([
            'valid_licence' => $data_input['valid_licence'],
            'category' => $data_input['category'],
            'soat_available' => $data_input['soat_available'],
            'technom_review' => $data_input['technom_review'],
            'technom_expi_date' => $data_input['technom_expi_date'],
            'run_state' => $data_input['run_state'],
            'accident_rate' => $data_input['accident_rate'],
            'penality_record' => $data_input['penality_record'],
            'code_penality_1' => $data_input['code_penality_1'] != "" ? $data_input['code_penality_1'] : "",
            'date_penality_1' => $data_input['date_penality_1'] != "" ? $data_input['code_penality_1'] : "",
            'code_penality_2' => $data_input['code_penality_2'] != "" ? $data_input['code_penality_2'] : "",
            'date_penality_2' => $data_input['date_penality_2'] != "" ? $data_input['date_penality_2'] : "",
            'code_penality_3' => $data_input['code_penality_3'] != "" ? $data_input['code_penality_3'] : "",
            'date_penality_4' => $data_input['date_penality_3'] != "" ? $data_input['date_penality_3'] : "",
            'code_penality_4' => $data_input['code_penality_4'] != "" ? $data_input['code_penality_4'] : "",
            'date_penality_4' => $data_input['date_penality_4'] != "" ? $data_input['date_penality_4'] : "",
            'code_penality_5' => $data_input['code_penality_5'] != "" ? $data_input['code_penality_5'] : "",
            'date_penality_5' => $data_input['date_penality_5'] != "" ? $data_input['date_penality_5'] : "",
            'start_date' => $data_input['start_date'],
            'validated_data' => 0,
            'user_vehicle_id' => $user_vehicle->id,
            'user_id' => auth()->id(),
        ]);
        if ($doc_verification->doc_id > 0) {
            return response()->json(['response' => 'error_swal', 'message' => 'Ocurrió un error en el proceso']);
        } else {
            return response()->json(['response' => 'Información insertada correctamente', 'errors' => []]);
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

    public function MakeCategoryList()
    {
        $profile_list = DB::table('profile_ as p')
            ->orderBy('p.date_operation', 'asc')
            ->select('p.profile_id', 'p.user_profile')
            ->where('p.operation', '!=', 'D')
            ->get()->toArray();
        return $this->ListDT()->query(self::sanitazeArr($profile_list))->make('sql','profile_id','user_profile');
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
        $dni_id = $request->get('dni_id');
        $validated_data = $request->get('validated_data');
        $update = DriverInformation::where('dni_id', $dni_id)->update([
            'validated_data' => $validated_data,
            'operation' => 'U',
            'user_id' => auth()->id(),
            'date_operation' => $now,
        ]);
        return response()->json(['response' => 'Registro actualizado', 'errors' => [], 'updates' => $update]);
    }

    public function updateDocVerification(Request $request){
        $now = date("Y-m-d H:i:s");
        $data_updated = $request->all();
        $field = $data_updated['fieldch'];
        $value = $data_updated['valuech'];
        $response = DocVerification::where('doc_id', $data_updated['doc_id'])->update([
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
        // echo '<pre>';
        // print_r($request->all());
        $data_delete = $request->all();
        // die;
        $delete = DocVerification::where('doc_id', $data_delete['doc_id'])->update(['Operation' => 'D']);
        if ($delete) {
            return response()->json(['response' => 'Usuario eliminado', 'error' => '']);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el usuario']);
        }
    }

    public function listVerifiedDrivers(Request $request)
    {
        $company_id = auth()->user()->company_active;
        $list_verifieds = DB::table('user_vehicle as uv')
            ->select(DB::raw(
                'di.first_name,
                     di.f_last_name,
                     di.dni_id,
                     v.plate_id,
                     dl.licence_num,
                     di.validated_data'
            ))
            ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
            ->join('vehicle as v', 'v.plate_id', '=', 'uv.vehicle_plate_id')
            ->join('driving_licence as dl', 'dl.driver_information_dni_id', '=', 'di.dni_id')
            ->where('di.company_id', '=', $company_id)
            ->where('uv.operation', '!=', 'D')
            ->get()->toArray();
        // echo '<pre>';
        // print_r($list_verifieds);
        // die;
        $list_verifieds = $this->addDeleteButtonDatatable($list_verifieds);
        return datatables()->of($list_verifieds)->make(true);
    }

    public static function getNumberValidatedDrivers($company_id)
    {
        $drivers_verifieds = DB::table('driver_information as di')
            ->select(DB::raw(
                'di.validated_data, 
                count(di.dni_id) as total'
            ))
            ->join('user_vehicle as uv', 'di.dni_id', '=', 'uv.driver_information_dni_id')
            ->join('vehicle as v', 'v.plate_id', '=', 'uv.vehicle_plate_id')
            ->join('driving_licence as dl', 'dl.driver_information_dni_id', '=', 'di.dni_id')
            ->where('di.company_id', '=', $company_id)
            ->where('di.operation', '!=', 'D')
            ->groupBy('validated_data')
            ->get()->toArray();
            // echo '<pre>';
            // print_r($drivers_verifieds);
            // die;
        foreach ($drivers_verifieds as $key => $value) {
            if ($value->validated_data == 1) {
                $drivers_verifieds[$key]->validated_data = "Verificado";
            } else {
                $drivers_verifieds[$key]->validated_data = "Sin Verificar";
            }
        }
        return $drivers_verifieds;
    }

    public static function getNumberValidatedDriversADriver($company_id, $dni_id)
    {
        $drivers_verifieds = DB::table('driver_information as di')
            ->select(DB::raw(
                'di.validated_data, 
                count(di.dni_id) as total'
            ))
            ->where('di.company_id', '=', $company_id)
            ->where('di.dni_id', '=', $dni_id)
            ->where('di.operation', '!=', 'D')
            ->groupBy('validated_data')
            ->get()->toArray();
        foreach ($drivers_verifieds as $key => $value) {
            if ($value->validated_data == 1) {
                $drivers_verifieds[$key]->validated_data = "Verificado";
            } else {
                $drivers_verifieds[$key]->validated_data = "Sin Verificar";
            }
        }
        return $drivers_verifieds;
    }

    public function makeDonutChartDriversVerified(Request $request)
    {
        $company_id = $request->get('company_id');
        if (!empty($request->get('dni_id'))) {
            $dni_id = $request->get('dni_id');
            $verify_drivers = $this->getNumberValidatedDriversADriver($company_id, $dni_id);
        } else {
            $verify_drivers = $this->getNumberValidatedDrivers($company_id);
        }
        return $this->chart_js->makeChart($verify_drivers, true);
    }

    public function dataTable(Request $request)
    {
        $company_id = Auth::user()->company_active;
        $skill_m_t_m = DB::table('doc_verification as dv')
            ->select(DB::raw(
                'dv.doc_id,
                 dv.valid_licence,
                 dv.category,
                 dv.soat_available,
                 dv.technom_review,
                 dv.technom_expi_date,
                 dv.run_state,
                 dv.accident_rate,
                 dv.penality_record,
                 dv.date_penality_1,
                 dv.date_penality_2,
                 dv.date_penality_3,
                 dv.date_penality_4,
                 dv.date_penality_5,
                 dv.code_penality_1,
                 dv.code_penality_2,
                 dv.code_penality_3,
                 dv.code_penality_4,
                 dv.code_penality_5,
                 dv.validated_data,
                 di.first_name,
                 di.f_last_name,
                 di.dni_id,
                 v.plate_id'
            ))
            ->join('user_vehicle as uv', 'uv.id', '=', 'dv.user_vehicle_id')
            ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
            ->join('vehicle as v', 'v.plate_id', '=', 'uv.vehicle_plate_id')
            ->where('di.company_id', '=', $company_id)
            ->where('dv.operation', '!=', 'D')
            ->orderBy('dv.start_date', 'desc')
            ->get();
        $drive_information = $this->addDeleteButtonDatatable($skill_m_t_m);
        return datatables()->of($drive_information)->make(true);
    }

    public function validateInformation(Request $request){
        $data_input = $request->get('doc_verification');
        $user_vehicle_id = $request->get('doc_verification');
        $validator = Validator::make(
            $data_input,
            [
                'start_date' => [new NotToday(['user_vehicle_id', $user_vehicle_id], 'doc_verification')],
            ]
        );
        $errors = $validator->errors()->getMessages();
        if (!empty($errors)) {
            return response()->json(['errors' => $errors]);
        }else{
            return response()->json(['response'=>'','errors' => []]);
        }
    }
}
