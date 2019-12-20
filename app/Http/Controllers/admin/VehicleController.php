<?php

namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Imports\VehiclesImport;
use App\Vehicle;
use Maatwebsite\Excel\Facades\Excel;
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
                'plate_id' => ['required','max:255','unique:vehicle'],
                'type_v' => 'required|max:255',
                'owner_v' => 'required|max:255',
                'soat_expi_date' => 'required|max:255',
                'capacity' => 'required|max:255',
                'driver_information_dni_id' => ['required','max:255','unique:vehicle']
            ],
            [
                'plate_id.required' => "La placa no puede ser vacía",
                'type_v.required' => "Se debe elegir el tipo de vehiculo",
                'owner_v.required' => "Se debe elegir una opción",
                'soat_expi_date.required' => "Se debe seleccionar una fecha",
                'capacity.required' => "Se debe seleccionar la capacidad",
                'wser_information_dni_id.unique' => "Este conductor ya tiene un vehículo.",
                'plate_id.unique' => "Esta placa ya está registrada."
            ]
        );
        $errors = $validator->errors()->getMessages();
        if (!empty($errors)) {
            return response()->json(['errors' => $errors]);
        } else {
            $vehicle = Vehicle::create([
                'driver_information_dni_id' => $data_input['driver_information_dni_id'],
                'plate_id' => $data_input['plate_id'],
                'type_v' =>  $data_input['type_v'],
                'owner_v' =>  $data_input['owner_v'] != "" ? $data_input['owner_v'] : 0 ,
                'taxi_type' => $data_input['taxi_type'] != "" ? $data_input['taxi_type'] : "NA",
                'taxi_Number_of_drivers' => $data_input['taxi_Number_of_drivers'] != "" ? $data_input['taxi_Number_of_drivers'] : 1,
                'soat_expi_date' => $data_input['soat_expi_date'],
                'capacity' => $data_input['capacity'],
                'service' => $data_input['service'] != "" ? $data_input['service'] :"Otros",
                'cylindrical_cc' => $data_input['cylindrical_cc'] != "" ? $data_input['cylindrical_cc'] :1,
                'v_class' => $data_input['v_class'] != "" ? $data_input['v_class'] : "",
                'model' => $data_input['model'] != "" ? $data_input['model'] : "",
                'line' => $data_input['line'] != "" ? $data_input['line'] : "",
                'brand' => $data_input['brand'] != "" ? $data_input['brand'] : "",
                'color' => $data_input['color'] != "" ? $data_input['color'] : "",
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
        $response = Vehicle::where('plate_id', $data_updated['plate_id'])->update([$field => $value, 'operation' => 'U', 'date_operation' => $now]);
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
        $delete = Vehicle::where('plate_id', $data_delete['plate_id'])->update(['operation' => 'D']);
        if ($delete) {
            return response()->json(['response' => 'Usuario eliminado', 'error' => '']);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el usuario']);
        }
    }

    public function vehicleList()
    {
        $company_id = Auth::user()->Company_id;
        $vehicle = DB::table('vehicle')
            ->join('driver_information', 'driver_information.DNI_id', '=', 'vehicle.User_information_dni_id')
            ->where('driver_information.company_id', '=', $company_id)
            ->where('vehicle.operation', '!=', 'D')
            ->select(DB::raw(
               'vehicle.plate_id, 
                vehicle.type_V, 
                IF(vehicle.owner_V=1,"Sí","No") as owner_v, 
                vehicle.taxi_type, 
                vehicle.taxi_Number_of_drivers, 
                vehicle.soat_expi_date, 
                vehicle.capacity, 
                vehicle.service,
                vehicle.cylindrical_cc,
                vehicle.v_class,
                vehicle.model,
                vehicle.line,
                vehicle.brand,
                vehicle.color,
                vehicle.technomechanical_date,
                driver_information.first_name,
                driver_information.s_last_name'
            ))->get();
        $vehicle = $this->addDeleteButtonDatatable($vehicle);
        return datatables()->of($vehicle)->make(true);
    }

    public function import(Request $request)
    {
        $data_insert = $request->all();
        $data_insert['id'] = auth()->id();
        $file = $request->file('file');
        $result = Excel::import(new VehiclesImport(), $file);
        return response()->json(['response' => 'ok']);
    }


}
