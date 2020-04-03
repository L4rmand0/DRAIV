<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class EditDriverController extends Controller
{
    private $skill_mtm_controller;
    private $motorcycle_technology_controller;
    private $mt_mechanical_conditions_controller;
    private $epp_controller;

    public function __construct() {
        $this->skill_mtm_controller = new SkillMtMController();
        $this->motorcycle_technology_controller = new MotorcycleTechnologyController();
        $this->mt_mechanical_conditions_controller = new MotorcycleMechanicalConditionsController();
        $this->epp_controller = new EppController();
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
    public function destroy($id)
    {
        //
    }

    public function getInformationDriver(Request $request)
    {
        // echo '<pre>';
        // print_r($request->all());
        // die;
        $company_id = Auth::user()->company_active;
        $param = $request->get('search_param');
        $value = $request->get('value_param');
        if ($param == "plate_id") {
        } else if ($param == "dni_id") {
            //Obtiene la información personal del conductor
            $driver_information = DB::table('driver_information')
                ->orderBy('driver_information.start_date', 'desc')
                ->join('users', 'driver_information.db_user_id', '=', 'users.id')
                ->join('company', 'company.Company_id', '=', 'driver_information.company_id')
                ->join('admin1', 'admin1.adm1_id', '=', 'driver_information.country_born')
                ->join('admin2', 'admin2.adm2_id', '=', 'driver_information.department')
                ->join('admin3', 'admin3.adm3_id', '=', 'driver_information.city_residence_place')
                ->where('driver_information.company_id', '=', $company_id)
                ->where('driver_information.' . $param, '=', $value)
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
            driver_information.country_born as country_id,
            driver_information.born_date,
            admin3.name AS city_residence_place,
            admin2.name AS department,
            admin1.name AS country_born,
            driver_information.phone,
            driver_information.civil_state,
            driver_information.score,
            driver_information.db_user_id,
            driver_information.company_id,
            users.name as user,
            company.Name_company as company'
                ))
                ->first();
            // echo '<pre>';
            // print_r($driver_information);
            // die;
            if (!empty($driver_information)) {
                //Obtiene la información de vehículos que tiene el conductor
                $vehicles = DB::table('user_vehicle as uv')
                    ->select(DB::raw('
                    v.plate_id,
                    v.type_v,
                    IF(v.owner_v="Y","Sí","No") as owner_v,
                    v.taxi_type,
                    v.number_of_drivers,
                    v.soat_expi_date,
                    v.capacity,
                    v.service,
                    v.cylindrical_cc,
                    v.model,
                    v.line,
                    v.brand,
                    v.color,
                    v.technomechanical_date
                '))
                    ->join('vehicle as v', 'v.plate_id', '=', 'uv.vehicle_plate_id')
                    ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
                    ->where('di.company_id', '=', $company_id)
                    ->where('uv.operation', '!=', 'D')
                    ->where('uv.driver_information_dni_id', '=', $driver_information->dni_id)
                    ->get()->toArray();
                //Agrupa la información de los soats vencidos del conductor    
                $soats_vencidos = [];
                foreach ($vehicles as $key_v => $value_v) {
                    $fecha_actual = strtotime(date("Y-m-d"));
                    $fecha_vencimiento = strtotime($value_v->soat_expi_date);
                    if ($fecha_actual > $fecha_vencimiento) {
                        $soats_vencidos[] = $value_v->plate_id;
                    }
                }

                $doc_verification_driver = DB::table('doc_verification_driver as dv')
                    ->select(DB::raw(
                        'dv.valid_licence ,
                    dv.category,
                    dv.runt_state,
                    dv.penality_record,
                    dv.accident_rate,
                    dv.date_penality_1,
                    dv.code_penality_1,
                    dv.date_penality_2,
                    dv.code_penality_2,
                    dv.date_penality_3,
                    dv.code_penality_3,
                    dv.date_penality_4,
                    dv.code_penality_4,
                    dv.date_penality_5,
                    dv.date_penality_5'
                    ))
                    ->join('driver_information as di', 'di.dni_id', '=', 'dv.driver_information_dni_id')
                    ->where('di.company_id', '=', $company_id)
                    ->where('dv.operation', '!=', 'D')
                    ->where('di.' . $param, '=', $value)
                    ->orderBy('dv.start_date', 'desc')
                    ->first();

                $skill_m_t_m = $this->skill_mtm_controller->skillSeparateMotoAutos($driver_information->dni_id);
                $motorcycle_technology = $this->motorcycle_technology_controller->getDatabyDriver($driver_information->dni_id);
                $mt_mechanical_conditions = $this->mt_mechanical_conditions_controller->getDatabyDriver($driver_information->dni_id);
                $epp = $this->epp_controller->getDatabyDriver($driver_information->dni_id);
                // echo '<pre>';
                // print_r($soats_vencidos);
                // print_r($vehicles);
                // die;
            }
            if (!empty($driver_information)) {
                return response()->json([
                    'response' => 'data found',
                    'errors' => [], 'data' => $driver_information,
                    'soats_vencidos' => $soats_vencidos,
                    'vehicles' => $vehicles,
                    'doc_verification_d' => $doc_verification_driver,
                    'skill_m_t_m' => $skill_m_t_m,
                    'motorcycle_technology' => $motorcycle_technology,
                    'mt_mechanical_conditions' => $mt_mechanical_conditions,
                    'epp' => $epp,
                ]);
            } else {
                return response()->json([
                    'response' => 'no data',
                    'errors' => [],
                    'message' => 'No se encontró información de conductores por ese valor de búsqueda.'
                ]);
            }
        }
    }
}
