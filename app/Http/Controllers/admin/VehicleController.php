<?php

namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.vehicle.index');
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
        $delete = Vehicle::where('Plate_id', $data_delete['Plate_id'])->update(['Operation' => 'D']);
        if ($delete) {
            return response()->json(['response' => 'Usuario eliminado', 'error' => '']);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el usuario']);
        }
    }

    public function vehicleList()
    {
        $company_id = Auth::user()->Company_id;
        $vehicle = DB::table('Vehicle')
            ->join('User_information', 'User_information.DNI_id', '=', 'Vehicle.User_information_DNI_id')
            ->where('User_information.Company_id', '=', $company_id)
            ->where('Vehicle.Operation', '!=', 'D')
            ->select(DB::raw(
               'Vehicle.Plate_id, 
                Vehicle.Type_V, 
                IF(Vehicle.Owner_V=1,"Sí","No") as Owner_V, 
                Vehicle.Taxi_type, 
                Vehicle.taxi_Number_of_drivers, 
                Vehicle.Soat_expi_date, 
                Vehicle.Capacity, 
                Vehicle.Service,
                Vehicle.Cylindrical_cc,
                Vehicle.V_class,
                Vehicle.Model,
                Vehicle.Line,
                Vehicle.Brand,
                Vehicle.Color,
                Vehicle.technomechanical_date,
                User_information.First_name,
                User_information.S_last_name'
            ))->get();
        $vehicle = $this->addDeleteButtonDatatable($vehicle);
        return datatables()->of($vehicle)->make(true);
    }

//     SELECT 
// Vehicle.Plate_id, 
// Vehicle.Type_V, 
// Vehicle.Owner_V, 
// Vehicle.Taxi_type, 
// Vehicle.taxi_Number_of_drivers, 
// Vehicle.Soat_expi_date, 
// Vehicle.Capacity, 
// Vehicle.Service,
// Vehicle.Cylindrical_cc,
// Vehicle.V_class,
// Vehicle.Model,
// Vehicle.Line,
// Vehicle.Brand,
// Vehicle.Color,
// Vehicle.technomechanical_date,
// User_information.First_name,
// User_information.S_last_name 
// FROM sam.Vehicle
// INNER JOIN User_information ON User_information.DNI_id = Vehicle.User_information_DNI_id;


}
