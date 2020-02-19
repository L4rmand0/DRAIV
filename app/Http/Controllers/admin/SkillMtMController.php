<?php

namespace App\Http\Controllers\admin;

use DB;
use App\SkillMtM;
use App\Rules\NotToday;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SkillMtMController extends Controller
{
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
    public function update(Request $request, $id)
    {
        $now = date("Y-m-d H:i:s");
        $reg_id = $request->get('reg_id');
        $validated_data = $request->get('validated_data');
        $update = SkillMtM::where('reg_id', $reg_id)->update([
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
        $drive_information = $this->addDeleteButtonDatatable($skill_m_t_m);
        return datatables()->of($drive_information)->make(true);
    }
}
