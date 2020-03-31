<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Rules\NotToday;
use Illuminate\Http\Request;
use App\Traits\ArrayFunctions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\MotorcycleMechanicalConditions;
use Illuminate\Support\Facades\Validator;

class MotorcycleMechanicalConditionsController extends Controller
{
    use ArrayFunctions;
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
                'start_date' => [new NotToday(['user_vehicle_id', $user_vehicle->id], 'skill_m_t_m')],
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
        $mt_mechanical_conditions = MotorcycleMechanicalConditions::create([
            'tires' => $data_input['tires'],
            'manigueta_guaya' => $data_input['manigueta_guaya'],
            'braking_system' => $data_input['braking_system'],
            'kit' => $data_input['kit'],
            'stee_susp' => $data_input['stee_susp'],
            'oil_leak' => $data_input['oil_leak'],
            'other_components' => $data_input['other_components'],
            'horn' => $data_input['horn'],
            'lights' => $data_input['lights'],
            'user_vehicle_id' => $user_vehicle->id,
            'user_id' => auth()->id(),
        ]);
        if ($mt_mechanical_conditions->evaluation_id > 0) {
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
        $response = MotorcycleMechanicalConditions::where('evaluation_id', $data_updated['evaluation_id'])->update([
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
        $delete = MotorcycleMechanicalConditions::where('evaluation_id', $data_delete['evaluation_id'])->update(['operation' => 'D']);
        if ($delete) {
            return response()->json(['response' => 'El registro ha sido eliminado.', 'error' => '']);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el registro']);
        }
    }

    public function dataTable(Request $request){
        // echo '<pre> hola';
        // print_r($request->all());
        // die;
        $company_id = Auth::user()->company_active;
        $mt_mechanical_conditions = DB::table('motorcycle_mechanical_conditions as mmc')
            ->select(DB::raw(
                'mmc.evaluation_id,
                mmc.name_evaluator, 
                mmc.tires, 
                mmc.manigueta_guaya,
                mmc.braking_system,
                mmc.kit,
                mmc.stee_susp,
                mmc.oil_leak,
                mmc.other_components,
                mmc.horn,
                mmc.lights,
                di.first_name,
                di.f_last_name,
                di.dni_id,
                v.plate_id'
            ))
            ->join('user_vehicle as uv', 'uv.id', '=', 'mmc.user_vehicle_id')
            ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
            ->join('vehicle as v', 'v.plate_id', '=', 'uv.vehicle_plate_id')
            ->where('di.company_id', '=', $company_id)
            ->where('mmc.operation', '!=', 'D')
            ->orderBy('mmc.start_date', 'desc')
            ->get();

        $mt_mechanical_conditions = $this->dataQuery($mt_mechanical_conditions)->make([
            'tires'=>MotorcycleMechanicalConditions::VALUE_TIRES,
            'manigueta_guaya'=>MotorcycleMechanicalConditions::VALUE_MANIGUETA_GUAYA,
            'braking_system'=>MotorcycleMechanicalConditions::VALUE_BRAKING_SYSTEM,
            'kit'=>MotorcycleMechanicalConditions::VALUE_KIT,
            'stee_susp'=>MotorcycleMechanicalConditions::VALUE_STEE_SUSP,
            'oil_leak'=>MotorcycleMechanicalConditions::VALUE_OIL_LEAK,
            'other_components'=>MotorcycleMechanicalConditions::VALUE_OTHER_COMPONENTS,
            'horn'=>MotorcycleMechanicalConditions::VALUE_HORN,
            'lights'=>MotorcycleMechanicalConditions::VALUE_LIGHTS,
        ]);    
        $mt_mechanical_conditions = $this->addDeleteButtonDatatable($mt_mechanical_conditions);
        return datatables()->of($mt_mechanical_conditions)->make(true);
    }

    protected function validateInformation(Request $request)
    {
        $all = $request->all();
        $data_input = $request->get('motorcycle_mechanical_conditions');
        // echo '<pre>';
        // print_r($data_input);
        // print_r($all);
        // die;

        foreach ($data_input as $key => $value) {
            $validator = Validator::make(
                $value,
                [
                    'tires' => ['required', 'max:10'],
                    'manigueta_guaya' => 'required|max:10',
                    'braking_system' => 'required|max:10',
                    'kit' => 'required|max:10',
                    'stee_susp' => 'required|max:10',
                    'oil_leak' => 'required|max:10',
                    'other_components' => 'required|max:10',
                    'horn' => 'required|max:10',
                    'lights' => 'required|max:10',
                ],
                [
                    'tires.required' => "La evaluación de llantas es obligatorio",
                    'manigueta_guaya.required' => "La evaluación de la manigueta guaya es obligatorio",
                    'braking_system.required' => "La evaluación de tipo de frenado es obligatorio",
                    'kit.required' => "El tipo del kit es obligatorio",
                    'stee_susp.required' => "La evaluación de dirección/suspensión es obligatoria",
                    'oil_leak.required' => "La evaluación de la fuga de aceite es obligatoria",
                    'other_components.required' => "La evaluación de chasis,espejos, guardabarros, etc, es obligatoria",
                    'horn.required' => "La evaluación de la bocina es obligatoria",
                    'lights.required' => "El evaluación de luces es obligatoria",
                ]
            );
            $errors[$key] = $validator->errors()->getMessages();
        }
        $errors_new = self::personalizeErrorsTypeVehicle($errors);
       
        if (!empty($errors_new)) {
            return response()->json(['errors' => $errors_new]);
        } else {
            return response()->json(['response' => '', 'errors' => []]);
        }
    }

    public function getDatabyDriver($dni_id){
        $company_id = Auth::user()->company_active;
        $mt_mechanical_conditions = DB::table('motorcycle_mechanical_conditions as mmc')
            ->select(DB::raw(
                'mmc.evaluation_id,
                mmc.name_evaluator, 
                mmc.tires, 
                mmc.manigueta_guaya,
                mmc.braking_system,
                mmc.kit,
                mmc.stee_susp,
                mmc.oil_leak,
                mmc.other_components,
                mmc.horn,
                mmc.lights,
                di.first_name,
                di.f_last_name,
                di.dni_id,
                v.plate_id'
            ))
            ->join('user_vehicle as uv', 'uv.id', '=', 'mmc.user_vehicle_id')
            ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
            ->join('vehicle as v', 'v.plate_id', '=', 'uv.vehicle_plate_id')
            ->where('di.dni_id', '=', $dni_id)
            ->where('di.company_id', '=', $company_id)
            ->where('mmc.operation', '!=', 'D')
            ->orderBy('mmc.start_date', 'desc')
            ->get();
        // echo '<pre> ';
        // print_r($mt_mechanical_conditions);
        // die;

        $mt_mechanical_conditions = $this->dataQuery($mt_mechanical_conditions)->make([
            'tires'=>MotorcycleMechanicalConditions::VALUE_TIRES,
            'manigueta_guaya'=>MotorcycleMechanicalConditions::VALUE_MANIGUETA_GUAYA,
            'braking_system'=>MotorcycleMechanicalConditions::VALUE_BRAKING_SYSTEM,
            'kit'=>MotorcycleMechanicalConditions::VALUE_KIT,
            'stee_susp'=>MotorcycleMechanicalConditions::VALUE_STEE_SUSP,
            'oil_leak'=>MotorcycleMechanicalConditions::VALUE_OIL_LEAK,
            'other_components'=>MotorcycleMechanicalConditions::VALUE_OTHER_COMPONENTS,
            'horn'=>MotorcycleMechanicalConditions::VALUE_HORN,
            'lights'=>MotorcycleMechanicalConditions::VALUE_LIGHTS,
        ]); 
        return $mt_mechanical_conditions;
    }
}
