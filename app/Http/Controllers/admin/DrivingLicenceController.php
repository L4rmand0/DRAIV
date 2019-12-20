<?php

namespace App\Http\Controllers\admin;

use App\DrivingLicence;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Imports\DrivingLicenceImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DrivingLicenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.driving-licence.index');
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
        $data_input = $request->get('drivingLicence');
        $validator = Validator::make(
            $data_input,
            [
                'licence_num' => 'required|max:255',
                'country_expedition' => 'required|max:255',
                'category' => 'required|max:255',
                'state' => 'required|max:255',
                'expedition_day' => 'required|max:255',
                'expi_date' => 'required|max:255',
                'driver_information_dni_id' => ['required','max:255','unique:driving_licence']
            ],
            [
                'driver_information_dni_id.unique' => "Este conductor ya tiene una licencia."
            ]
        );
        $errors = $validator->errors()->getMessages();
        if (!empty($errors)) {
            return response()->json(['errors' => $errors]);
        } else {
            $driving_licence = DrivingLicence::create([
                'driver_information_dni_id' => $data_input['driver_information_dni_id'],
                'licence_num' => $data_input['licence_num'],
                'country_expedition' =>  $data_input['country_expedition'],
                'category' => $data_input['category'],
                'state' => $data_input['state'],
                'expedition_day' => $data_input['expedition_day'],
                'expi_date' => $data_input['expi_date']
            ]);
            if ($driving_licence->licence_num != "") {
                return response()->json([
                    'success' => 'Información registrada.',
                    'errors' => $errors
                ]);
            }
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
        $response = DrivingLicence::where('licence_id', $data_updated['licence_id'])->update([$field => $value, 'operation' => 'U', 'date_operation' => $now]);
        if ($response) {
            return response()->json(['response' => 'Información actualizada']);
        } else {
            return response()->json(['error' => 'No se pudo actualizar la información']);
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
        $delete = DrivingLicence::where('licence_id', $data_delete['licence_id'])->update(['operation' => 'D']);
        if ($delete) {
            return response()->json(['response' => 'Usuario eliminado', 'error' => '']);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el usuario']);
        }
    }

    public function drivingLicenceList()
    {
        $company_id = Auth::user()->company_id;
        $driving_licence = DB::table('driving_licence')
            ->join('driver_information', 'driver_information.dni_id', '=', 'driving_licence.driver_information_dni_id')
            ->where('driver_information.company_id', '=', $company_id)
            ->where('driving_licence.operation', '!=', 'D')
            ->select(DB::raw(
               'driving_licence.licence_id,
                driving_licence.licence_num,
                driving_licence.country_expedition,
                driving_licence.category,
                driving_licence.state,
                driving_licence.expedition_day,
                driving_licence.expi_date,
                driving_licence.driver_information_dni_id,
                driver_information.first_name,
                driver_information.f_last_name'
            ))->get();
        $driving_licence = $this->addDeleteButtonDatatable($driving_licence);
        return datatables()->of($driving_licence)->make(true);
    }

    public function import(Request $request)
    {
        $data_insert = $request->all();
        $data_insert['id'] = auth()->id();
        $file = $request->file('file');
        $result = Excel::import(new DrivingLicenceImport(), $file);
        return response()->json(['response' => 'ok']);
    }

}
