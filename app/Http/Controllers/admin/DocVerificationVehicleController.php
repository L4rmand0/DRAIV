<?php

namespace App\Http\Controllers\admin;

use DB;
use Illuminate\Http\Request;
use App\Traits\ArrayFunctions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DocVerificationVehicleController extends Controller
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

    protected function validateInformation(Request $request)
    {
        // $data_input = $request->all();
        $data_input = $request->get('doc_verification_vehicle');
        echo '<pre>';
        // print_r($data_input);
        // die;

        foreach ($data_input as $key => $value) {
            $validator = Validator::make(
                $value,
                [
                    'soat' => ['required', 'max:10'],
                    'technom_review' => 'required|max:10',
                    'expi_date' => 'required|max:10',
                    // 'operation' => [new IsNotDelete(['plate_id', $plate_id], 'vehicle')],
                ],
                [
                    'soat.required' => "La revisión de soat es obligatoria",
                    'technom_review.required' => "La revisión de tecnomecánica es obligatoria",
                    'expi_date.required' => "La fecha de vencimiento es obligatoria",
                ]
            );
            $errors[$key] = $validator->errors()->getMessages();
        }
        $errors_new = self::personalizeErrorsTypeVehicle($errors);
        print_r($errors_new);
        die;
       
        if (!empty($errors)) {
            return response()->json(['errors' => $errors]);
        } else {
            return response()->json(['response' => '', 'errors' => []]);
        }
    }
}
