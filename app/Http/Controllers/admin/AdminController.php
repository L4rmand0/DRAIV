<?php

namespace App\Http\Controllers\admin;

use App\DriverInformation;
use App\DrivingLicence;
use App\Http\Controllers\Controller;
use App\Imagenes;
use App\Vehicle;
use auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $permissions;
    private $image_controller;

    public function __construct()
    {
        $this->middleware('auth');
        $this->image_controller = new ImageController();
    }

    public function index(Request $request, $module = null)
    {
        $user_id = auth()->user()->id;
        $profile = auth()->user()->user_profile;
        $profile_id = auth()->user()->profile_id;
        $company_id = auth()->user()->company_id;
        $company_name = CompanyController::getCompanyByid($company_id)->company;
        $this->permissions = $this->getPermissions($user_id);
        if ($profile_id != 1) {
            switch ($module) {
                case 'users':
                    return view('admin.users.index', [
                        'company_name' => ucwords(strtolower($company_name)),
                        'permissions' => $this->permissions,
                    ]);
                    break;
                case 'driver_information':
                    $data_driver_information = $this->showIndexDriverInformation($company_name);
                    return view('admin.information-user.index', $data_driver_information);
                    break;
                case 'driving_licence':
                    $data_driving_licence = $this->showIndexDrivingLicence($company_name);
                    return view('admin.driving-licence.index', $data_driving_licence);
                    break;
                case 'vehicle':
                    $data_vehicle = $this->showIndexVehicle($company_name);
                    return view('admin.vehicle.index', $data_vehicle);
                    break;
                case 'driver_images':
                    $data_images = $this->showIndexDriverImages($company_name);
                    return view('admin.images', $data_images);
                    break;
                default:
                    $data_dashboard = $this->showIndexDashboard($company_id);
                    return view('admin.dashboard', $data_dashboard);
                    break;
            }
        } else {
            return view('prohibited');
        }
    }

    private function showIndexDashboard($company_id)
    {
        $company = CompanyController::getCompanyByid($company_id);
        $total_drivers = DriverInformationController::getNumberDriversByCompany($company_id);
        $total_vehicles = DriverVehicleController::getTotalVehiclesByCompany($company_id);
        $total_gender = DriverInformationController::getGenderByCompany($company_id);
        $average_score = DriverInformationController::getAverageScoreByCompany($company_id);
        $licences_expiration = DrivingLicenceController::getLicenceExpiDates($company_id);
        $licences_expirated = DrivingLicenceController::getLicencesExpirated($company_id);
        $soats_expiration = VehicleController::getSoatExpiDates($company_id);
        $soats_expirated = VehicleController::getSoatsExpirated($company_id);
        $technomecanical_expiration = VehicleController::getExpiTecnomecanicalDates($company_id);
        $technomecanical_expirated = VehicleController::getExpiTecnomecanicalExpirated($company_id);
        // $incomplete_document_drivers = $this->image_controller->checkIncompleteDocumentDrivers($company_id);
        // echo $soats_expiration;
        // die;
        $man = 0;
        $woman = 0;
        foreach ($total_gender as $key => $value) {
            if ($value->gender == 0) {
                $man = $value->total;
            } else if ($value->gender == 1) {
                $woman = $value->total;
            }
        }
        return [
            'company_name' => ucwords(strtolower($company->company)),
            'total_drivers' => $total_drivers,
            'total_vehicles' => $total_vehicles,
            'total_man' => $man,
            'total_woman' => $woman,
            'score_average' => number_format($average_score->average, 3),
            'licences_expiration' => $licences_expiration,
            'licences_expirated' => $licences_expirated,
            'soats_expiration' => $soats_expiration,
            'soats_expirated' => $soats_expirated,
            'technomecanical_expiration' => $technomecanical_expiration,
            'technomecanical_expirated' => $technomecanical_expirated,
            'permissions' => $this->permissions,
        ];
    }

    private function showIndexDriverInformation($company_name)
    {
        $list_admin3 = Admin3Controller::listAdmin3();
        $enum_education = $this->generateOptionsEnumDt(DriverInformation::enum_education);
        $list_education = DriverInformation::enum_education;
        $enum_civil_state = $this->generateOptionsEnumDt(DriverInformation::enum_civil_state);
        $list_civil_state = DriverInformation::enum_civil_state;
        $enum_country_born = $this->generateOptionsEnumDt(DriverInformation::enum_country_born);
        $list_country_born = DriverInformation::enum_country_born;

        return [
            'enum_education' => $enum_education,
            'enum_civil_state' => $enum_civil_state,
            'enum_country_born' => $enum_country_born,
            'list_education' => $list_education,
            'list_civil_state' => $list_civil_state,
            'list_country_born' => $list_country_born,
            'list_admin3' => $list_admin3,
            'company_name' => ucwords(strtolower($company_name)),
            'permissions' => $this->permissions,
        ];
    }

    private function showIndexDrivingLicence($company_name)
    {
        $enum_category = $this->generateOptionsEnumDt(DrivingLicence::enum_category);
        $list_category = DrivingLicence::enum_category;
        $enum_country_expedition = $this->generateOptionsEnumDt(DrivingLicence::enum_country_expedition);
        $list_country_expedition = DrivingLicence::enum_country_expedition;
        $enum_state = $this->generateOptionsEnumDt(DrivingLicence::enum_state);
        $list_state = DrivingLicence::enum_state;

        return [
            'enum_category' => $enum_category,
            'enum_country_expedition' => $enum_country_expedition,
            'enum_state' => $enum_state,
            'list_country_expedition' => $list_country_expedition,
            'list_category' => $list_category,
            'list_state' => $list_state,
            'company_name' => ucwords(strtolower($company_name)),
            'permissions' => $this->permissions,
        ];
    }

    private function showIndexDriverImages($company_name)
    {
        $drivers = DriverInformationController::getListDrivers();
        $type_images = Imagenes::enum_assoc_tipo_doc;
        return [
            'list_drivers' => $drivers,
            'type_images' => $type_images,
            'company_name' => ucwords(strtolower($company_name)),
            'permissions' => $this->permissions,
        ];
    }

    private function showIndexVehicle($company_name)
    {
        $enum_type_v = $this->generateOptionsEnumDt(Vehicle::enum_type_v);
        $list_type_v = Vehicle::enum_type_v;
        $enum_service = $this->generateOptionsEnumDt(Vehicle::enum_service);
        $list_service = Vehicle::enum_service;
        $enum_taxi_type = $this->generateOptionsEnumDt(Vehicle::enum_taxi_type);
        $list_taxi_type = Vehicle::enum_taxi_type;
        $company_id = auth()->user()->company_id;
        return [
            'enum_type_v' => $enum_type_v,
            'enum_service' => $enum_service,
            'enum_taxi_type' => $enum_taxi_type,
            'list_type_v' => $list_type_v,
            'list_service' => $list_service,
            'list_taxi_type' => $list_taxi_type,
            'company_name' => ucwords(strtolower($company_name)),
            'permissions' => $this->permissions,
        ];
    }
}
