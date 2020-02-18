<?php

namespace App\Http\Controllers\admin;

use App\Company;
use App\DocVerification;
use App\DriverInformation;
use App\DrivingLicence;
use App\Http\Controllers\Controller;
use App\Imagenes;
use App\Module;
use App\Profile;
use App\SkillMtM;
use App\User;
use App\Vehicle;
use auth;
use DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $permissions;
    private $image_controller;
    private $user_controller;
    private $module;
    private $company;
    private $company_active;
    private $company_active_name;

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->image_controller = new ImageController();
        $this->user_controller = new UserController();
    }

    public function index(Request $request, $module = null)
    {
        $auth_user = auth()->user();
        $module = $this->checkModulePermission($module, $auth_user->id);
        $this->module = $module;
        // dd($this->company_id);
        $this->company_active = auth()->user()->company_active;
        // dd($this->company_active);
        $this->company_active_name = Company::where('company_id', $this->company_active)->first()->name_company;
        $this->company = auth()->user()->company;

        $company_name = $this->company->name_company;
        $child_companies = json_decode($auth_user->company->child_company, true);
        $child_companies[] = ['id' => $auth_user->company_id, 'name' => $auth_user->company->name_company];
        // dd($child_companies);
        $this->permissions = $this->getPermissions($auth_user->id);
        // echo '<pre> holi m '.$module.' ';
        // die;

        if ($auth_user->profile_id != 1) {
            switch ($module) {
                case 'users':
                    $profile_list = $this->user_controller->MakeProfileList();
                    $data_users = [
                        'company_name' => ucwords(strtolower($company_name)),
                        'permissions' => $this->permissions,
                        'profile_list' => json_encode($profile_list),
                    ];
                    $data_users = $this->checkMultipleAdmin($auth_user, $child_companies, $data_users);
                    return view('admin.users.index', $data_users);
                    break;
                case 'driver_information':
                    $data_driver_information = $this->showIndexDriverInformation($company_name);
                    $data_driver_information = $this->checkMultipleAdmin($auth_user, $child_companies, $data_driver_information);
                    // echo '<pre>';
                    // print_r($data_driver_information);
                    // die;
                    return view('admin.information-user.index', $data_driver_information);
                    break;
                case 'driving_licence':
                    $data_driving_licence = $this->showIndexDrivingLicence($company_name);
                    $data_driving_licence = $this->checkMultipleAdmin($auth_user, $child_companies, $data_driving_licence);
                    return view('admin.driving-licence.index', $data_driving_licence);
                    break;
                case 'vehicle':
                    $data_vehicle = $this->showIndexVehicle($company_name);
                    $data_vehicle = $this->checkMultipleAdmin($auth_user, $child_companies, $data_vehicle);
                    // dd("Hola vehicle 2");
                    // die;
                    return view('admin.vehicle.index', $data_vehicle);
                    break;
                case 'driver_images':
                    $data_images = $this->showIndexDriverImages($company_name);
                    $data_images = $this->checkMultipleAdmin($auth_user, $child_companies, $data_images);
                    return view('admin.images', $data_images);
                    break;
                case 'dashboard':
                    $data_dashboard = $this->showIndexDashboard($auth_user->company_id);
                    $data_dashboard = $this->checkMultipleAdmin($auth_user, $child_companies, $data_dashboard);
                    return view('admin.dashboard', $data_dashboard);
                    break;
                case 'doc_verification':
                    $data_doc_verification = $this->showIndexDocVerification($company_name);
                    $data_doc_verification = $this->checkMultipleAdmin($auth_user, $child_companies, $data_doc_verification);
                    return view('admin.doc-verification.index', $data_doc_verification);
                    break;
                case 'autoevaluation_company':
                    // echo 'entra';
                    // die;
                    $data_doc_verification = $this->showIndexDocVerification($company_name);
                    $data_doc_verification = $this->checkMultipleAdmin($auth_user, $child_companies, $data_doc_verification);
                    return view('admin.autoevaluation.index', $data_doc_verification);
                    break;
                case 'manual_doc_verification':
                    $data_skill_m_t_m = $this->showIndexMDocVerification($company_name);
                    $data_skill_m_t_m = $this->checkMultipleAdmin($auth_user, $child_companies, $data_skill_m_t_m);
                    return view('admin.manual-doc-verification.index', $data_skill_m_t_m);
                    break;
                case 'skills_m_t_m':
                    $data_skill_m_t_m = $this->showIndexSkillMtM($company_name);
                    $data_skill_m_t_m = $this->checkMultipleAdmin($auth_user, $child_companies, $data_skill_m_t_m);
                    return view('admin.skills.index', $data_skill_m_t_m);
                    break;
                default:
                    return view('404_draiv');
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
        // echo '<pre>';
        // print_r($technomecanical_expirated);
        // die;
        // $drivers_verified = DocVerificationController::getNumberValidatedDrivers($company_id);
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
            'company_id' => $company_id,
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
            'dashboard' => true,
        ];
    }

    private function showIndexDocVerification($company_name)
    {
        return [
            'company_name' => ucwords(strtolower($company_name)),
            'permissions' => $this->permissions,
        ];
    }

    private function showIndexSkillMtM($company_name)
    {
        return [
            'company_name' => ucwords(strtolower($company_name)),
            'permissions' => $this->permissions,
            'values_slalom' => SkillMtM::VALUE_SLALOM,
            'values_projection' => SkillMtM::VALUE_PROJECTION,
            'values_braking' => SkillMtM::VALUE_BRAKING,
            'values_evasion' => SkillMtM::VALUE_EVASION,
            'values_mobility' => SkillMtM::VALUE_MOBILITY,
        ];
    }

    private function showIndexMDocVerification($company_name)
    {
        return [
            'category_list'=>DocVerification::CATEGORY,
            'runstate_list'=>DocVerification::RUNSTATE,
            'company_name' => ucwords(strtolower($company_name)),
            'permissions' => $this->permissions,
            'values_slalom' => SkillMtM::VALUE_SLALOM,
            'values_projection' => SkillMtM::VALUE_PROJECTION,
            'values_braking' => SkillMtM::VALUE_BRAKING,
            'values_evasion' => SkillMtM::VALUE_EVASION,
            'values_mobility' => SkillMtM::VALUE_MOBILITY,
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

    public function viewSumarizeTable(Request $request)
    {
        $company_id = $request->get('company_id');
        $sumarize = DB::table('view_sumarize as vs')
            ->where('vs.company_id', '=', $company_id)
            ->get();
        // echo '<pre>';
        // print_r($sumarize);
        // die;
        return datatables()->of($sumarize)->make(true);
    }

    public function checkMultipleAdmin($auth_user, $child_companies, $data)
    {
        $data['multiple_admin'] = false;
        $data['company_active'] = $this->company_active;
        $data['company_active_name'] = $this->company_active_name;
        $data['company_id'] = $this->company->company_id;
        if ($auth_user->profile_id == Profile::MULTIPLEADMIN ? true : false) {
            $data['child_companies'] = $child_companies;
            $data['multiple_admin'] = true;
        }
        // Revisa si el llamado lo hizo la opción del dashboard
        if (empty($data['dashboard'])) {
            $data['dashboard'] = false;
        }
        return $data;
    }
}
