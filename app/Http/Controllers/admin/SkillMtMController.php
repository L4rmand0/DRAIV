<?php

namespace App\Http\Controllers\admin;

use DB;
use App\SkillMtM;
use App\Rules\NotToday;
use Illuminate\Http\Request;
use App\Traits\ArrayFunctions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SkillMtMController extends Controller
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
        $skill_m_t_m = SkillMtM::create([
            'slalom' => $data_input['slalom'],
            'projection' => $data_input['projection'],
            'braking' => $data_input['braking'],
            'evasion' => $data_input['evasion'],
            'user_vehicle_id' => $user_vehicle->id,
            'user_id' => auth()->id(),
        ]);
        if ($skill_m_t_m->reg_id > 0) {
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
        $response = SkillMtM::where('reg_id', $data_updated['reg_id'])->update([
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
        $delete = SkillMtM::where('reg_id', $data_delete['reg_id'])->update(['operation' => 'D']);
        if ($delete) {
            return response()->json(['response' => 'El registro ha sido eliminado.', 'error' => '']);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el registro']);
        }
    }

    public function dataTable(Request $request){
        $company_id = Auth::user()->company_active;
        $skill_m_t_m = DB::table('skill_m_t_m as smtm')
            ->select(DB::raw(
                'smtm.reg_id, 
                smtm.date_evaluation,
                smtm.slalom,
                smtm.projection,
                smtm.braking,
                smtm.evasion,
                smtm.mobility,
                smtm.result,
                di.first_name,
                di.f_last_name,
                di.dni_id,
                v.plate_id'
            ))
            ->join('user_vehicle as uv', 'uv.id', '=', 'smtm.user_vehicle_id')
            ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
            ->join('vehicle as v', 'v.plate_id', '=', 'uv.vehicle_plate_id')
            ->where('di.company_id', '=', $company_id)
            ->where('smtm.operation', '!=', 'D')
            ->orderBy('smtm.start_date', 'desc')
            ->get();

        $skill_m_t_m = $this->dataQuery($skill_m_t_m)->make([
            'slalom'=>SkillMtM::VALUE_SLALOM,
            'projection'=>SkillMtM::VALUE_PROJECTION,
            'braking'=>SkillMtM::VALUE_BRAKING,
            'evasion'=>SkillMtM::VALUE_EVASION,
        ]);    
        $drive_information = $this->addDeleteButtonDatatable($skill_m_t_m);
        return datatables()->of($drive_information)->make(true);
    }

    protected function validateInformation(Request $request)
    {
        // $data_input = $request->all();
        $data_input = $request->get('skillmtm');
        // echo '<pre>';
        // print_r($data_input);
        // die;
        // echo '<pre> index:';
        // print($index);
        // print_r($data_input);
        // die;
        // if($has_)

        foreach ($data_input as $key => $value) {
            $validator = Validator::make(
                $value,
                [
                    'slalom' => ['required', 'max:10'],
                    'projection' => 'required|max:10',
                    'braking' => 'required|max:10',
                    'evasion' => 'required|max:10',
                    // 'operation' => [new IsNotDelete(['plate_id', $plate_id], 'vehicle')],
                ],
                [
                    'slalom.required' => "La destreza es obligatoria",
                    'projection.required' => "La habilidad de proyección es obligatoria",
                    'braking.required' => "La habilidad de frenado es obligatoria",
                    'evasion.required' => "La habilidad de evasión es obligatoria",
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
