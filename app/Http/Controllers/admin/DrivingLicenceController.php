<?php

namespace App\Http\Controllers\admin;

use App\DrivingLicence;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
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
                'Licence_num' => 'required|max:255',
                'Country_expedition' => 'required|max:255',
                'Category' => 'required|max:255',
                'State' => 'required|max:255',
                'Expedition_day' => 'required|max:255',
                'Expi_date' => 'required|max:255',
                'User_information_DNI_id' => ['required','max:255','unique:Driving_licence']
            ],
            [
                'User_information_DNI_id.unique' => "Este conductor ya tiene una licencia."
            ]
        );
        $errors = $validator->errors()->getMessages();
        if (!empty($errors)) {
            return response()->json(['errors' => $errors]);
        } else {
            $driving_licence = DrivingLicence::create([
                'User_information_DNI_id' => $data_input['User_information_DNI_id'],
                'Licence_num' => $data_input['Licence_num'],
                'Country_expedition' =>  $data_input['Country_expedition'],
                'Category' => $data_input['Category'],
                'State' => $data_input['State'],
                'Expedition_day' => $data_input['Expedition_day'],
                'Expi_date' => $data_input['Expi_date']
            ]);
            if ($driving_licence->Licence_num > 0) {
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
        $response = DrivingLicence::where('Licence_id', $data_updated['Licence_id'])->update([$field => $value, 'Operation' => 'U', 'Date_operation' => $now]);
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
        $delete = DrivingLicence::where('Licence_id', $data_delete['Licence_id'])->update(['Operation' => 'D']);
        if ($delete) {
            return response()->json(['response' => 'Usuario eliminado', 'error' => '']);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el usuario']);
        }
    }

    public function drivingLicenceList()
    {
        $company_id = Auth::user()->Company_id;
        $driving_licence = DB::table('Driving_licence')
            ->join('User_information', 'User_information.DNI_id', '=', 'Driving_licence.User_information_DNI_id')
            ->where('User_information.Company_id', '=', $company_id)
            ->where('Driving_licence.Operation', '!=', 'D')
            ->select(DB::raw(
                'Driving_licence.Licence_id,
                Driving_licence.Licence_num,
                Driving_licence.Country_expedition,
                Driving_licence.Category,
                Driving_licence.State,
                Driving_licence.Expedition_day,
                Driving_licence.Expi_date,
                Driving_licence.User_information_DNI_id,
                User_information.First_name,
                User_information.F_last_name'
            ))->get();
        $driving_licence = $this->addDeleteButtonDatatable($driving_licence);
        return datatables()->of($driving_licence)->make(true);
    }

    //     SELECT 
    // Driving_licence.Licence_num, 
    // Driving_licence.Country_expedition, 
    // Driving_licence.Category, 
    // Driving_licence.State, 
    // Driving_licence.Expedition_day, 
    // Driving_licence.Expi_date,
    // User_information.First_name,
    // User_information.F_last_name
    // FROM sam.Driving_licence 
    // INNER JOIN User_information on User_information.DNI_id = Driving_licence.User_information_DNI_id 
    // WHERE User_information.Company_id = '9013380301';


}
