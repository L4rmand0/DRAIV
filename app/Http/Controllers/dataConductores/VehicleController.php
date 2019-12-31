<?php

namespace App\Http\Controllers\dataConductores;

use App\Http\Controllers\Controller;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
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

    public function validateVehicle(Request $request)
    {

        $data_conductores_controller = new DataConductoresController();

        $data_input = $request->get('vehicle');
        $rules = [
            'Plate_id' => 'required|max:255',
            'Type_V' => 'required|max:255',
            'Owner_V' => 'required|max:255',
            'Soat_expi_date' => 'required|max:255',
            'Capacity' => 'required|max:255'
        ];

        $cont = 1;
        $messages = [
            'Plate_id.required' => $cont++ . " La placa no puede ser vacía",
            'Type_V.required' => $cont++ . " Se debe elegir el tipo de vehiculo",
            'Owner_V.required' => $cont++ . " Se debe elegir una opción",
            'Soat_expi_date.required' => $cont++ . " Se debe seleccionar una fecha",
            'Capacity.required' => $cont++ . " Se debe seleccionar la capacidad"
        ];

        $validator = Validator::make($data_input, $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as  $value) {
                $response_errors[$value[0]] = substr($value, 2);
            }
            return response()->json(['error' => $response_errors]);
        }

        $response_insert = $data_conductores_controller->store($request->all());

        return response()->json(['success' => 'validación correcta']);
    }

    public static function getTotalNumberVehiclesByCompny($company_id){
        
    }
}
