<?php

namespace App\Http\Controllers\admin;

use DB;
use App\DriverInformation;
use Illuminate\Http\Request;
use App\Http\Controllers\ChartJS;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DocVerificationController extends Controller
{
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
        $data_input = $request->all();
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
                'city_born' => 'required|max:20',
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

    public static function getNumberValidatedDrivers($company_id){
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
        foreach ($drivers_verifieds as $key => $value) {
            if($value->validated_data == 1){
                $drivers_verifieds[$key]->validated_data = "Verificado";
            }else{
                $drivers_verifieds[$key]->validated_data = "Sin Verificar";
            }
        }
        return $drivers_verifieds;
    }

    public static function getNumberValidatedDriversADriver($company_id, $dni_id){
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
            if($value->validated_data == 1){
                $drivers_verifieds[$key]->validated_data = "Verificado";
            }else{
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

    public function dataTable(Request $request){
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

//     select
// 	di.validated_data, count(di.dni_id) as total
// from
// 	driver_information as di 
// where
// 	di.company_id = 9013380301
// 	and di.operation != 'D'
// GROUP BY validated_data;

}
