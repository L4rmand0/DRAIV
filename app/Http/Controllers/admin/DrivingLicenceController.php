<?php

namespace App\Http\Controllers\admin;

use App\DrivingLicence;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
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
