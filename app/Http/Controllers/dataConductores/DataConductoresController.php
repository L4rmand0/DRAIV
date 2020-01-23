<?php

namespace App\Http\Controllers\dataConductores;

use App\DrivingLicence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserInformation;
use App\Vehicle;
use Illuminate\Support\Facades\Validator;

class DataConductoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.driver');
    }

    public function index(Request $request)
    {
        return view('data-conductores.create');
    }

    public function store($data)
    {
        $data_user_information = $data['userInformation'];
        $data_driving_licence = $data['drivingLicence'];
        $data_vehicle = $data['vehicle'];

        $user_information = UserInformation::create([
            'DNI_id' => $data_user_information['DNI_id'],
            'First_name' => $data_user_information['First_name'],
            'Second_name' =>  $data_user_information['Second_name'] != "" ? $data_user_information['Second_name'] : "",
            'F_last_name' => $data_user_information['F_last_name'],
            'S_last_name' => $data_user_information['S_last_name'],
            'E_mail_address' => $data_user_information['E_mail_address'],
            'Gender' => $data_user_information['Gender'],
            'Education' => $data_user_information['Education'],
            'Country_born' => $data_user_information['Country_born'],
            'Civil_state' => $data_user_information['Civil_state'],
            'address' => $data_user_information['address'],
            'phone' => $data_user_information['phone'],
            'Db_user_id' => $data_user_information['Db_user_id']
        ]);

        $user_dni_id = $user_information->DNI_id;
        if($user_dni_id < 0){
            $errors['user_info']="No se pudo insertar la información de usuario";
        }

        $driving_licence = DrivingLicence::create([
            'User_information_DNI_id' => $user_dni_id,
            'Licence_num' => $data_driving_licence['Licence_num'],
            'Country_expedition' =>  $data_driving_licence['Country_expedition'],
            'Category' => $data_driving_licence['Category'],
            'State' => $data_driving_licence['State'],
            'Expedition_day' => $data_driving_licence['Expedition_day'],
            'Expi_date' => $data_driving_licence['Expi_date']
        ]);

        $driving_licence_id = $driving_licence->Licence_id;
        if($driving_licence_id < 0){
            $errors['driving_licence']="No se pudo insertar la información de licencia";
        }

        $vehicle = Vehicle::create([
            'User_information_DNI_id' => $user_dni_id,
            'Plate_id' => $data_vehicle['Plate_id'],
            'Type_V' =>  $data_vehicle['Type_V'],
            'Owner_V' =>  $data_vehicle['Owner_V'] != "" ? $data_vehicle['Owner_V'] : 0 ,
            'Taxi_type' => $data_vehicle['Taxi_type'] != "" ? $data_vehicle['Taxi_type'] : "NA",
            'taxi_Number_of_drivers' => $data_vehicle['taxi_Number_of_drivers'] != "" ? $data_vehicle['taxi_Number_of_drivers'] : 1,
            'Soat_expi_date' => $data_vehicle['Soat_expi_date'],
            'Capacity' => $data_vehicle['Capacity'],
            'Service' => $data_vehicle['Service'] != "" ? $data_vehicle['Service'] :"Otros",
            'Cylindrical_cc' => $data_vehicle['Cylindrical_cc'] != "" ? $data_vehicle['Cylindrical_cc'] :1,
            'V_class' => $data_vehicle['V_class'] != "" ? $data_vehicle['V_class'] : "",
            'Model' => $data_vehicle['Model'] != "" ? $data_vehicle['Model'] : "",
            'Line' => $data_vehicle['Line'] != "" ? $data_vehicle['Line'] : "",
            'Brand' => $data_vehicle['Brand'] != "" ? $data_vehicle['Brand'] : "",
            'technomechanical_date' => $data_vehicle['technomechanical_date'] != "" ? $data_vehicle['technomechanical_date'] : "0000-00-00",
        ]);

        $vehicle_id = $vehicle->row_id;
        
        if($vehicle_id < 0){
            $errors['vehicle']="No se pudo insertar la información del vehículo";
        }

       if (!empty($errors)){
            return response()->json(['errors' => $errors]);
       }else{
            return response()->json(['success' => 'Información insertada correctamente']);
       }
    }

    public function checkUserInformation(Request $request)
    { 

    }
}
