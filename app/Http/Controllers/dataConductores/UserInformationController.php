<?php

namespace App\Http\Controllers\dataConductores;

use App\Http\Controllers\Controller;
use App\UserInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserInformationController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data-conductores.user-information.create');
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

    public function validateUserInformation(Request $request)
    {
        $data_input = $request->get('userInformation');
        $rules = [
            'First_name' => 'required|max:255',
            'F_last_name' => 'required|max:255',
            'S_last_name' => 'required|max:255',
            'E_mail_address' => 'required|max:255',
            'DNI_id' => 'required|max:255',
            'Gender' => 'required|max:255',
            'Education' => 'required|max:255',
            'Country_born' => 'required|max:255',
            'Civil_state' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:255'
        ];

        $cont = 1;
        $messages = [
            'First_name.required' => $cont++." El campo nombre no puede ser vacío",
            'F_last_name.required' => $cont++." El campo apellido no puede ser vacío",
            'S_last_name.required' => $cont++." El campo segundo apellido no puede ser vacío",
            'E_mail_address.required' => $cont++." El campo correo no puede ser vacío",
            'DNI_id.required' => $cont++." El campo cédula no puede ser vacío",
            'Gender.required' => $cont++." El campo género no puede ser vacío",
            'Education.required' => $cont++." El campo eduación no puede ser vacío",
            'Country_born.required' => $cont++." Se debe elegir un país",
            'Civil_state.required' => $cont++." Se debe elegir un estado civil",
            'address.required' => $cont++." El campo dirección no puede ser vacío",
            'phone.required' => $cont++." El campo teléfono no puede ser vacío",
        ];
        

        $validator = Validator::make($data_input, $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as  $value) {
                $response_errors[trim($value[0] . $value[1])] = substr($value, 2);
            }

            return response()->json(['error' => $response_errors]);
        }

        return response()->json(['success' => 'validación correcta']);
    }
}
