<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Epp;
use App\Company;
use App\DocVerification;
use App\DocVerificationDriver;
use App\Rules\NotToday;
use Illuminate\Http\Request;
use App\MotorcycleTechnology;
use App\Traits\ArrayFunctions;
use App\Http\Controllers\Controller;
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
        $all_data_input = $request->all();
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
            $this->storeAllEvaluationsDriverVehicle($all_data_input);
            return response()->json(['response' => '', 'errors' => []]);
        }
    }

    public function storeAllEvaluationsDriverVehicle($data_input){
        $doc_verification_driver = DocVerificationDriver::create([
            
        ]);
        echo '<pre> guardar todos';
        print_r($data_input);
        die;
    }
}
