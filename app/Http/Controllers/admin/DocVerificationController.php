<?php

namespace App\Http\Controllers\admin;

use App\DriverInformation;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class DocVerificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
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
    public function update(Request $request)
    {
        $now = date("Y-m-d H:i:s");
        $dni_id = $request->get('dni_id');
        $validated_data = $request->get('validated_data');
        $update = DriverInformation::where('dni_id', $dni_id)->update([
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
    public function destroy($id)
    {
        //
    }

    public function listVerifiedDrivers(Request $request)
    {
        $company_id = auth()->user()->company_id;
        $list_verifieds = DB::table('user_vehicle as uv')
            ->select(DB::raw(
                'di.first_name,
                     di.f_last_name,
                     di.dni_id,
                     v.plate_id,
                     dl.licence_num,
                     di.validated_data'
            ))
            ->join('driver_information as di', 'di.dni_id', '=', 'uv.driver_information_dni_id')
            ->join('vehicle as v', 'v.plate_id', '=', 'uv.vehicle_plate_id')
            ->join('driving_licence as dl', 'dl.driver_information_dni_id', '=', 'di.dni_id')
            ->where('di.company_id', '=', $company_id)
            ->where('uv.operation', '!=', 'D')
            ->get()->toArray();
        // echo '<pre>';
        // print_r($list_verifieds);
        // die;
        $list_verifieds = $this->addDeleteButtonDatatable($list_verifieds);
        return datatables()->of($list_verifieds)->make(true);
    }
}
