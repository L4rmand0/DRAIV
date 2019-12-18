<?php

namespace App\Http\Controllers\dataConductores;

use App\DrivingLicence;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DrivingLicenceController extends Controller
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
    public function create(Request $request)
    {
        echo ' <pre> Método create';
        print_r($request->all());
        return view('data-conductores.driving-licence.create');
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

    public function validateDrivingLicence(Request $request)
    {
        $data_input = $request->get('drivingLicence');
        $rules = [
            'Licence_num' => 'required|max:255',
            'Country_expedition' => 'required|max:255',
            'Category' => 'required|max:255',
            'State' => 'required|max:255',
            'Expedition_day' => 'required|max:255',
            'Expi_date' => 'required|max:255'
        ];

        $messages = [
            'Licence_num.required' => " El campo número de licencia no puede ser vacío",
            'Country_expedition.required' => "Se debe elegir un país de expedición",
            'Category.required' => "Se debe elegir una categoría",
            'State.required' => "Se debe elegir un estado",
            'Expedition_day.required' => "Se debe elegir una fecha de expedición",
            'Expi_date.required' => "Se debe elegir una fecha de vencimiento",
        ];

        $validator = Validator::make($data_input, $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as  $value) {
                $response_errors[$value[0]] = substr($value, 2);
            }
            return response()->json(['error' => $response_errors]);
        }
        
        return response()->json(['success' => 'validación correcta']);
    }

}
