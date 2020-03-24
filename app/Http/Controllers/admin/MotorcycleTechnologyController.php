<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Rules\NotToday;
use Illuminate\Http\Request;
use App\MotorcycleTechnology;
use App\Traits\ArrayFunctions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class MotorcycleTechnologyController extends Controller
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
            return response()->json(['response' => 'error_swal','errors'=>['message' => 'Este conductor ha sido eliminado.']]);
        }
        $uv_id = !empty($user_vehicle) ? $user_vehicle->id : "";
        $validator = Validator::make(
            $data_input,
            [
                'start_date' => [new NotToday(['user_vehicle_id', $user_vehicle->id], 'motorcycle_technology')],
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
        $motorcycle_technology = MotorcycleTechnology::create([
            'brake_type' => $data_input['brake_type'],
            'assistence_brake' => $data_input['assistence_brake'],
            'automatic_lights' => $data_input['automatic_lights'],
            'user_vehicle_id' => $user_vehicle->id,
            'user_id' => auth()->id(),
        ]);
        if ($motorcycle_technology->m_t_id > 0) {
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
        $response = MotorcycleTechnology::where('m_t_id', $data_updated['m_t_id'])->update([
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
        $delete = MotorcycleTechnology::where('m_t_id', $data_delete['m_t_id'])->update(['operation' => 'D']);
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
        $motorcycle_technology = DB::table('motorcycle_technology as mt')
            ->select(DB::raw(
                'mt.m_t_id, 
                mt.brake_type, 
                mt.assistence_brake,
                mt.automatic_lights,
                di.first_name,
                di.f_last_name,
                di.dni_id,
                v.plate_id'
            ))
            ->join('user_vehicle as uv', 'uv.id', '=', 'mt.user_vehicle_id')
            ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
            ->join('vehicle as v', 'v.plate_id', '=', 'uv.vehicle_plate_id')
            ->where('di.company_id', '=', $company_id)
            ->where('mt.operation', '!=', 'D')
            ->orderBy('mt.start_date', 'desc')
            ->get();

        $motorcycle_technology = $this->dataQuery($motorcycle_technology)->make([
            'brake_type'=>MotorcycleTechnology::VALUE_TYPE_BRAKE,
            'assistence_brake'=>MotorcycleTechnology::VALUE_ASSISTENCE_BRAKE,
            'automatic_lights'=>MotorcycleTechnology::VALUE_AUTOMATIC_LIGHTS,
        ]);    
        $motorcycle_technology = $this->addDeleteButtonDatatable($motorcycle_technology);
        return datatables()->of($motorcycle_technology)->make(true);
    }

    protected function validateInformation(Request $request)
    {
        $all = $request->all();
        $data_input = $request->get('motorcycle_technology');
        // echo '<pre>';
        // print_r($data_input);
        // print_r($all);
        // die;

        foreach ($data_input as $key => $value) {
            $validator = Validator::make(
                $value,
                [
                    'brake_type' => ['required', 'max:10'],
                    'assistence_brake' => 'required|max:10',
                    'automatic_lights' => 'required|max:10',
                    // 'operation' => [new IsNotDelete(['plate_id', $plate_id], 'vehicle')],
                ],
                [
                    'brake_type.required' => "El tipo de frenado de disco es obligatorio",
                    'assistence_brake.required' => "El tipo de asistencia de frenos es obligatoria",
                    'automatic_lights.required' => "El tipo de luces es obligatoria",
                ]
            );
            $errors[$key] = $validator->errors()->getMessages();
        }
        $errors_new = self::personalizeErrorsTypeVehicle($errors);
        // print_r($errors_new);
        // die;
       
        if (!empty($errors_new)) {
            return response()->json(['errors' => $errors_new]);
        } else {
            return response()->json(['response' => '', 'errors' => []]);
        }
    }
}
