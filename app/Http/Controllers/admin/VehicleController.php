<?php

namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Vehicle;
use Illuminate\Support\Facades\Validator;
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
        $data_input = $request->get('vehicle');
        // print_r($data_input);
        // die;
        $validator = Validator::make(
            $data_input,
            [
                'Plate_id' => ['required','max:255','unique:Vehicle'],
                'Type_V' => 'required|max:255',
                'Owner_V' => 'required|max:255',
                'Soat_expi_date' => 'required|max:255',
                'Capacity' => 'required|max:255',
                'User_information_DNI_id' => ['required','max:255','unique:Vehicle']
            ],
            [
                'Plate_id.required' => "La placa no puede ser vacía",
                'Type_V.required' => "Se debe elegir el tipo de vehiculo",
                'Owner_V.required' => "Se debe elegir una opción",
                'Soat_expi_date.required' => "Se debe seleccionar una fecha",
                'Capacity.required' => "Se debe seleccionar la capacidad",
                'User_information_DNI_id.unique' => "Este conductor ya tiene un vehículo.",
                'Plate_id.unique' => "Esta placa ya está registrada."
            ]
        );
        $errors = $validator->errors()->getMessages();
        if (!empty($errors)) {
            return response()->json(['errors' => $errors]);
        } else {
            $vehicle = Vehicle::create([
                'User_information_DNI_id' => $data_input['User_information_DNI_id'],
                'Plate_id' => $data_input['Plate_id'],
                'Type_V' =>  $data_input['Type_V'],
                'Owner_V' =>  $data_input['Owner_V'] != "" ? $data_input['Owner_V'] : 0 ,
                'Taxi_type' => $data_input['Taxi_type'] != "" ? $data_input['Taxi_type'] : "NA",
                'taxi_Number_of_drivers' => $data_input['taxi_Number_of_drivers'] != "" ? $data_input['taxi_Number_of_drivers'] : 1,
                'Soat_expi_date' => $data_input['Soat_expi_date'],
                'Capacity' => $data_input['Capacity'],
                'Service' => $data_input['Service'] != "" ? $data_input['Service'] :"Otros",
                'Cylindrical_cc' => $data_input['Cylindrical_cc'] != "" ? $data_input['Cylindrical_cc'] :1,
                'V_class' => $data_input['V_class'] != "" ? $data_input['V_class'] : "",
                'Model' => $data_input['Model'] != "" ? $data_input['Model'] : "",
                'Line' => $data_input['Line'] != "" ? $data_input['Line'] : "",
                'Brand' => $data_input['Brand'] != "" ? $data_input['Brand'] : "",
                'Color' => $data_input['Color'] != "" ? $data_input['Color'] : "",
                'technomechanical_date' => $data_input['technomechanical_date'] != "" ? $data_input['technomechanical_date'] : "0000-00-00",
            ]);
            if ($vehicle->Plate_id != "") {
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
        $response = Vehicle::where('Plate_id', $data_updated['Plate_id'])->update([$field => $value, 'Operation' => 'U', 'Date_operation' => $now]);
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
