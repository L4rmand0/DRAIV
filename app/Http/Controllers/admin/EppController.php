<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Epp;
use App\Company;
use App\Vehicle;
use App\SkillMtM;
use App\Rules\NotToday;
use App\DocVerification;
use Illuminate\Http\Request;
use App\MotorcycleTechnology;
use App\DocVerificationDriver;
use App\DocVerificationVehicle;
use App\Traits\ArrayFunctions;
use App\Http\Controllers\Controller;
use App\MotorcycleMechanicalConditions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EppController extends Controller
{
    use ArrayFunctions;


    public function __construct()
    {
        $this->middleware(['auth']);
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
        $company_active = Auth::user()->company_active;
        $company_name = Company::where('company_id', $company_active)->first()->name_company;
        $name_evaluator = Auth::user()->name;
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
            return response()->json(['response' => 'error_swal', 'errors' => ['message' => 'Este conductor ha sido elminado.']]);
        }
        $uv_id = !empty($user_vehicle) ? $user_vehicle->id : "";
        $validator = Validator::make(
            $data_input,
            [
                'start_date' => [new NotToday(['user_vehicle_id', $user_vehicle->id], 'epp')],
            ]
        );
        $errors = $validator->errors()->getMessages();
        if (!empty($errors)) {
            return response()->json(['response' => 'error_swal', 'errors' => ['message' => 'Este conductor ya registró una evalución hoy, solo se permite una por día.']]);
        }
        // echo '<pre>';
        // print_r($errors);
        // echo 'finaliza';
        // die;
        $epp = Epp::create([
            'name_evaluator' => $name_evaluator,
            'empresa' => $company_name,
            'casco' => $data_input['casco'],
            'airbag' => $data_input['airbag'],
            'rodilleras' => $data_input['rodilleras'],
            'coderas' => $data_input['coderas'],
            'hombreras' => $data_input['hombreras'],
            'espalda' => $data_input['espalda'],
            'botas' => $data_input['botas'],
            'guantes' => $data_input['guantes'],
            'user_vehicle_id' => $user_vehicle->id,
            'user_id' => auth()->id(),
        ]);
        if ($epp->epp_id > 0) {
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
        $response = Epp::where('epp_id', $data_updated['epp_id'])->update([
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
        $data_delete = $request->all();
        // echo '<pre>';
        // print_r($data_delete);
        // die;
        $delete = Epp::where('epp_id', $data_delete['epp_id'])->update(['operation' => 'D']);
        if ($delete) {
            return response()->json(['response' => 'El registro ha sido eliminado.', 'error' => '']);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el registro']);
        }
    }

    public function dataTable(Request $request)
    {
        // echo '<pre> hola';
        // print_r($request->all());
        // die;
        $company_id = Auth::user()->company_active;
        $personal_element_protection = DB::table('epp as e')
            ->select(DB::raw(
                'e.epp_id, 
                e.name_evaluator, 
                e.empresa,
                e.casco,
                e.airbag,
                e.rodilleras,
                e.coderas,
                e.hombreras,
                e.espalda,
                e.botas,
                e.guantes,
                e.epp_results,
                e.risk,
                di.first_name,
                di.f_last_name,
                di.dni_id,
                v.plate_id'
            ))
            ->join('user_vehicle as uv', 'uv.id', '=', 'e.user_vehicle_id')
            ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
            ->join('vehicle as v', 'v.plate_id', '=', 'uv.vehicle_plate_id')
            ->where('di.company_id', '=', $company_id)
            ->where('e.operation', '!=', 'D')
            ->orderBy('e.start_date', 'desc')
            ->get();

        $personal_element_protection = $this->dataQuery($personal_element_protection)->make([
            'casco' => Epp::VALUE_CASCO,
            'airbag' => Epp::VALUE_AIRBAG,
            'rodilleras' => Epp::VALUE_RODILLERAS,
            'coderas' => Epp::VALUE_CODERAS,
            'hombreras' => Epp::VALUE_HOMBRERAS,
            'espalda' => Epp::VALUE_ESPALDA,
            'botas' => Epp::VALUE_BOTAS,
            'guantes' => Epp::VALUE_GUANTES,
        ]);
        $personal_element_protection = $this->addDeleteButtonDatatable($personal_element_protection);
        return datatables()->of($personal_element_protection)->make(true);
    }

    protected function validateInformation(Request $request)
    {
        $data_input = $request->get('epp');
        // echo '<pre>';
        // print_r($data_input);
        // print_r($all);
        // die;
        foreach ($data_input as $key => $value) {
            $validator = Validator::make(
                $value,
                [
                    'casco' => ['required', 'max:10'],
                    'airbag' => 'required|max:10',
                    'rodilleras' => 'required|max:10',
                    'coderas' => 'required|max:10',
                    'hombreras' => 'required|max:10',
                    'espalda' => 'required|max:10',
                    'botas' => 'required|max:10',
                    'guantes' => 'required|max:10',
                ],
                [
                    'casco.required' => "La evaluación de llantas es obligatorio",
                    'airbag.required' => "La evaluación de la manigueta guaya es obligatorio",
                    'rodilleras.required' => "La evaluación de tipo de frenado es obligatorio",
                    'coderas.required' => "El tipo del kit es obligatorio",
                    'hombreras.required' => "La evaluación de dirección/suspensión es obligatoria",
                    'espalda.required' => "La evaluación de la fuga de aceite es obligatoria",
                    'botas.required' => "La evaluación de chasis,espejos, guardabarros, etc, es obligatoria",
                    'guantes.required' => "La evaluación de la bocina es obligatoria",
                ]
            );
            $errors[$key] = $validator->errors()->getMessages();
        }
        $errors_new = self::personalizeErrorsTypeVehicle($errors);

        if (!empty($errors_new)) {
            return response()->json(['errors' => $errors_new]);
        } else {
            return response()->json(['response' => '', 'errors' => []]);
            // $this->storeAllEvaluationsDriverVehicle($all_data_input);
        }
    }

    public function storeAllEvaluationsDriverVehicle(Request $request)
    {
        $data_input = $request->all();
        // echo '<pre> guardar todos';
        // print_r($data_input);
        // die;
        $now_date = date("Y-m-d");
        $dni_id = $data_input['driver_select_evaluation'];
        $skillmtm = $data_input['skillmtm'];
        $data_doc_verification_driver = $data_input['doc_verification_driver'];

        $motorcycle_technology = $data_input['motorcycle_technology'];
        $doc_verification_vehicle = $data_input['doc_verification_vehicle'];
        $motorcycle_mechanical_conditions = !empty($data_input['motorcycle_mechanical_conditions']) ? $data_input['motorcycle_mechanical_conditions'] : false;
        $epp = !empty($data_input['epp']) ? $data_input['epp'] : false;
        //Insertar información en la tabla de verificación documental de conductores
        $doc_verification_driver = DocVerificationDriver::create([
            'valid_licence' => $data_doc_verification_driver['valid_licence'],
            'category' => $data_doc_verification_driver['category'],
            'runt_state' => $data_doc_verification_driver['runt_state'],
            'accident_rate' => $data_doc_verification_driver['accident_rate'],
            'penality_record' => $data_doc_verification_driver['penality_record'],
            'code_penality_1' => $data_doc_verification_driver['code_penality_1'],
            'date_penality_1' => $data_doc_verification_driver['date_penality_1'],
            'code_penality_2' => $data_doc_verification_driver['code_penality_2'],
            'date_penality_2' => $data_doc_verification_driver['date_penality_2'],
            'code_penality_3' => $data_doc_verification_driver['code_penality_3'],
            'date_penality_3' => $data_doc_verification_driver['date_penality_3'],
            'code_penality_4' => $data_doc_verification_driver['code_penality_4'],
            'date_penality_4' => $data_doc_verification_driver['date_penality_4'],
            'code_penality_5' => $data_doc_verification_driver['code_penality_5'],
            'date_penality_5' => $data_doc_verification_driver['date_penality_5'],
            'driver_information_dni_id' => $dni_id,
        ]);

        $driver_vehicles = DriverVehicleController::getUserVehicleIdTypeVehicle($dni_id);
        $driver_vehicles_arr = DriverVehicleController::getArraygetVehiclesByDniId($dni_id);
        // print_r($driver_vehicles_arr);
        // echo 'foreach';

        foreach ($driver_vehicles_arr as $key_dva => $value_dva) {
            $mt_data = !empty($motorcycle_technology[$value_dva->plate_id]) ? $motorcycle_technology[$value_dva->plate_id] : false;
            $doc_v_vehicle_data = $doc_verification_vehicle[$value_dva->plate_id];
            $mt_mechanical_cond_data = !empty($motorcycle_mechanical_conditions[$value_dva->plate_id]) ? $motorcycle_mechanical_conditions[$value_dva->plate_id] : false;
            $epp_data = !empty($epp[$value_dva->plate_id]) ? $epp[$value_dva->plate_id] : false;
            // Inserta la información de la evaluación de la tecnología de la moto
            DocVerificationVehicle::create([
                'date_evaluation' => $now_date,
                'soat' => $doc_v_vehicle_data['soat'],
                'technom_review' => $doc_v_vehicle_data['technom_review'],
                'expi_date' => $doc_v_vehicle_data['expi_date'],
                'user_id' => auth()->id(),
                'user_vehicle_id' => $value_dva->id,
            ]);
            if ($mt_data) {
                MotorcycleTechnology::create([
                    'date_evaluation' => $now_date,
                    'brake_type' => $mt_data['brake_type'],
                    'assistence_brake' => $mt_data['assistence_brake'],
                    'automatic_lights' => $mt_data['automatic_lights'],
                    'user_id' => auth()->id(),
                    'user_vehicle_id' => $value_dva->id,
                ]);
            }
            if ($mt_data) {
                MotorcycleMechanicalConditions::create([
                    'date_evaluation' => $now_date,
                    'tires' => $mt_mechanical_cond_data['tires'],
                    'manigueta_guaya' => $mt_mechanical_cond_data['manigueta_guaya'],
                    'braking_system' => $mt_mechanical_cond_data['braking_system'],
                    'kit' => $mt_mechanical_cond_data['kit'],
                    'stee_susp' => $mt_mechanical_cond_data['stee_susp'],
                    'oil_leak' => $mt_mechanical_cond_data['oil_leak'],
                    'other_components' => $mt_mechanical_cond_data['other_components'],
                    'horn' => $mt_mechanical_cond_data['horn'],
                    'lights' => $mt_mechanical_cond_data['lights'],
                    'user_id' => auth()->id(),
                    'user_vehicle_id' => $value_dva->id,
                ]);
            }
            if ($epp_data) {
                Epp::create([
                    'date_evaluation' => $now_date,
                    'casco' => $epp_data['casco'],
                    'airbag' => $epp_data['airbag'],
                    'rodilleras' => $epp_data['rodilleras'],
                    'coderas' => $epp_data['coderas'],
                    'hombreras' => $epp_data['hombreras'],
                    'espalda' => $epp_data['espalda'],
                    'botas' => $epp_data['botas'],
                    'guantes' => $epp_data['guantes'],
                    'user_id' => auth()->id(),
                    'user_vehicle_id' => $value_dva->id,
                ]);
            }
            // print_r($value_dva);
            // print_r($motorcycle_technology[$value_dva->plate_id]);
        }
        // Inserta la evaluación de habilidades según si es moto o carro (skills_m_t_m)
        if (!empty($driver_vehicles['motos'])) {
            $data_skill_motos = $skillmtm['Motos'];
            foreach ($driver_vehicles['motos'] as $key_motos_uvid => $value_motos_uvid) {
                SkillMtM::create([
                    'date_evaluation' => $now_date,
                    'slalom' => $data_skill_motos['slalom'],
                    'projection' => $data_skill_motos['projection'],
                    'braking' => $data_skill_motos['braking'],
                    'evasion' => $data_skill_motos['evasion'],
                    'user_vehicle_id' => $value_motos_uvid,
                    'user_id' => auth()->id()
                ]);
            }
        }
        if (!empty($driver_vehicles['autos'])) {
            $data_skill_autos = $skillmtm['Autos'];
            foreach ($driver_vehicles['autos'] as $key_autos_uvid => $value_autos_uvid) {
                SkillMtM::create([
                    'date_evaluation' => $now_date,
                    'slalom' => $data_skill_autos['slalom'],
                    'projection' => $data_skill_autos['projection'],
                    'braking' => $data_skill_autos['braking'],
                    'evasion' => $data_skill_autos['evasion'],
                    'user_vehicle_id' => $value_autos_uvid,
                    'user_id' => auth()->id()
                ]);
            }
        }
        return response()->json(['response' => 'El registro de evaluaciones ha sido insertado correctamente', 'errors' => []]);
    }
}
