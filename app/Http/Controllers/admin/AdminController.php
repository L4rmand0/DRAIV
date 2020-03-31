<?php

namespace App\Http\Controllers\admin;

use App\Admin1;
use DB;
use auth;
use App\User;
use App\Module;
use App\Company;
use App\Profile;
use App\Vehicle;
use App\Imagenes;
use App\SkillMtM;
use App\DrivingLicence;
use App\DocVerification;
use App\DriverInformation;
use App\Epp;
use Illuminate\Http\Request;
use App\Traits\TListDataTable;
use App\Http\Controllers\Controller;
use App\ImagenesVehiculo;
use App\MotorcycleMechanicalConditions;
use App\MotorcycleTechnology;

class AdminController extends Controller
{
    use TListDataTable;
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

    public function index(Request $request, $module = null, $aditional = null)
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
                case 'motorcycle_technology':
                    $data_motorcycle_technology = $this->showIndexMotorcycleTecnology($company_name);
                    $data_motorcycle_technology = $this->checkMultipleAdmin($auth_user, $child_companies, $data_motorcycle_technology);
                    return view('admin.motorcycle-technology.index', $data_motorcycle_technology);
                    break;
                case 'mt_mechanical_condition':
                    $data_motorcycle_technology = $this->showIndexMtMechanicalCondition($company_name);
                    $data_motorcycle_technology = $this->checkMultipleAdmin($auth_user, $child_companies, $data_motorcycle_technology);
                    return view('admin.mt-mechanical-condition.index', $data_motorcycle_technology);
                    break;
                case 'personal_ele_protection':
                    $data_motorcycle_technology = $this->showIndexPersonalElementProtection($company_name);
                    $data_motorcycle_technology = $this->checkMultipleAdmin($auth_user, $child_companies, $data_motorcycle_technology);
                    return view('admin.personal-ele-protection.index', $data_motorcycle_technology);
                    break;
                case 'register_driver':
                    $data_register_driver = $this->showRegisterDriver($company_name);
                    $data_register_driver = $this->checkMultipleAdmin($auth_user, $child_companies, $data_register_driver);
                    return view('admin.register-information.register', $data_register_driver);
                    break;
                case 'edit_driver':
                    $data_motorcycle_technology = $this->showEditDriver($company_name);
                    $data_motorcycle_technology = $this->checkMultipleAdmin($auth_user, $child_companies, $data_motorcycle_technology);
                    return view('admin.register-information.edit', $data_motorcycle_technology);
                    break;
                case 'register_evaluation':
                    $data_register_driver = $this->showRegisterEvaluationDriver($company_name);
                    $data_register_driver = $this->checkMultipleAdmin($auth_user, $child_companies, $data_register_driver);
                    $data_register_driver['driver_dni_id'] = false;
                    if($aditional != null){
                        $data_register_driver['driver_dni_id'] = $aditional;
                    }
                    return view('admin.register-information.register-evaluation', $data_register_driver);
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
    
    private function showRegisterDriver($company_name)
    {
        //Información de Conductores
        $list_admin3 = Admin3Controller::listAdmin3();
        $enum_education = $this->generateOptionsEnumDt(DriverInformation::enum_education);
        $list_education = DriverInformation::enum_education;
        $enum_civil_state = $this->generateOptionsEnumDt(DriverInformation::enum_civil_state);
        $list_civil_state = DriverInformation::enum_civil_state;
        $enum_country_born = $this->generateOptionsEnumDt(DriverInformation::enum_country_born);
        $list_country_born = DriverInformation::enum_country_born;
        $list_admin1 = Admin1::all()->toArray();
        //Información de Licencia
        $enum_category = $this->generateOptionsEnumDt(DrivingLicence::enum_category);
        $list_category = DrivingLicence::enum_category;
        $enum_country_expedition = $this->generateOptionsEnumDt(DrivingLicence::enum_country_expedition);
        $list_country_expedition = DrivingLicence::enum_country_expedition;
        $enum_state = $this->generateOptionsEnumDt(DrivingLicence::enum_state);
        $list_state = DrivingLicence::enum_state;
        //Imágenes
        $drivers = DriverInformationController::getListDrivers();
        $type_images = Imagenes::enum_assoc_tipo_doc;
        $last_element_type_images = $this->getLastElementArrayAssoc($type_images);
        //Imágenes Vehículos
        $type_images_vehicle = ImagenesVehiculo::enum_assoc_tipo_doc;
        $cols = 3;
        $arr_types_images['general'] = array_chunk(ImagenesVehiculo::ARR_ASSOC_TIPO_DOC_GENERAL, $cols);
        $arr_types_images['taxis'] = array_chunk(ImagenesVehiculo::ARR_ASSOC_TIPO_DOC_TAXI, $cols);
        $arr_type_images_vehicle = $arr_types_images;
        $last_element_type_images_v = $this->getLastElementArrayAssoc($type_images_vehicle);
        //Vehículos
        $enum_type_v = $this->generateOptionsEnumDt(Vehicle::enum_type_v);
        $list_type_v = Vehicle::enum_type_v;
        $enum_service = $this->generateOptionsEnumDt(Vehicle::enum_service);
        $list_service = Vehicle::enum_service;
        $enum_taxi_type = $this->generateOptionsEnumDt(Vehicle::enum_taxi_type);
        $list_taxi_type = Vehicle::enum_taxi_type;
        $select_all_vehicles = VehicleController::listArray();

        return [
            'enum_education' => $enum_education,
            'enum_civil_state' => $enum_civil_state,
            'enum_country_born' => $enum_country_born,
            'list_education' => $list_education,
            'list_civil_state' => $list_civil_state,
            'list_country_born' => $list_country_born,
            'list_admin3' => $list_admin3,
            'list_admin1' => $list_admin1,
            'enum_category' => $enum_category,
            'enum_country_expedition' => $enum_country_expedition,
            'enum_state' => $enum_state,
            'list_country_expedition' => $list_country_expedition,
            'list_category' => $list_category,
            'list_state' => $list_state,
            'list_drivers' => $drivers,
            'type_images' => $type_images,
            'last_element_type_images' => $last_element_type_images,
            //variable de Imágenes de vehículos
            'type_images_vehicle' => $type_images_vehicle,
            'last_element_type_images_v' => $last_element_type_images_v,
            'enum_type_v' => $enum_type_v,
            'enum_service' => $enum_service,
            'enum_taxi_type' => $enum_taxi_type,
            'list_type_v' => $list_type_v,
            'list_service' => $list_service,
            'list_taxi_type' => $list_taxi_type,
            'select_all_vehicles' => $select_all_vehicles,
            'arr_type_images_vehicle' => $arr_type_images_vehicle,
            // variables de verificación manual
            'category_list'=>DocVerification::CATEGORY,
            'runstate_list'=>DocVerification::RUNSTATE,
            'values_slalom' => SkillMtM::VALUE_SLALOM,
            'values_projection' => SkillMtM::VALUE_PROJECTION,
            'values_braking' => SkillMtM::VALUE_BRAKING,
            'values_evasion' => SkillMtM::VALUE_EVASION,
            'values_mobility' => SkillMtM::VALUE_MOBILITY,
            'company_name' => ucwords(strtolower($company_name)),
            'permissions' => $this->permissions,
        ];
    }

    private function showRegisterEvaluationDriver($company_name)
    {
        //Evaluación de Conductores
        return [
            'category_list'=>DocVerification::CATEGORY,
            'runstate_list'=>DocVerification::RUNSTATE,
            'values_slalom' => SkillMtM::VALUE_SLALOM,
            'values_projection' => SkillMtM::VALUE_PROJECTION,
            'values_braking' => SkillMtM::VALUE_BRAKING,
            'values_evasion' => SkillMtM::VALUE_EVASION,
            'values_mobility' => SkillMtM::VALUE_MOBILITY,
            'driver_information_list'=> DriverInformationController::driveInformationListbyCompany(),
            // Motorcycle Technology Evaluation
            'values_type_brake' => MotorcycleTechnology::VALUE_TYPE_BRAKE,
            'values_assistence_brake' => MotorcycleTechnology::VALUE_ASSISTENCE_BRAKE,
            'values_automatic_lights' => MotorcycleTechnology::VALUE_AUTOMATIC_LIGHTS,
            'company_name' => ucwords(strtolower($company_name)),
            'permissions' => $this->permissions,
            // Motorcycle Mechanical Conditions
            'values_tires' => MotorcycleMechanicalConditions::VALUE_TIRES,
            'values_manigueta_guaya' => MotorcycleMechanicalConditions::VALUE_MANIGUETA_GUAYA,
            'values_braking_system' => MotorcycleMechanicalConditions::VALUE_BRAKING_SYSTEM,
            'values_kit' => MotorcycleMechanicalConditions::VALUE_KIT,
            'values_stee_susp' => MotorcycleMechanicalConditions::VALUE_STEE_SUSP,
            'values_oil_leak' => MotorcycleMechanicalConditions::VALUE_OIL_LEAK,
            'values_other_components' => MotorcycleMechanicalConditions::VALUE_OTHER_COMPONENTS,
            'values_horn' => MotorcycleMechanicalConditions::VALUE_HORN,
            'values_lights' => MotorcycleMechanicalConditions::VALUE_LIGHTS,
            // Personsal Elements Protection
            'values_casco' => Epp::VALUE_CASCO,
            'values_airbag' => Epp::VALUE_AIRBAG,
            'values_rodilleras' => Epp::VALUE_RODILLERAS,
            'values_coderas' => Epp::VALUE_CODERAS,
            'values_hombreras' => Epp::VALUE_HOMBRERAS,
            'values_espalda' => Epp::VALUE_ESPALDA,
            'values_botas' => Epp::VALUE_BOTAS,
            'values_guantes' => Epp::VALUE_GUANTES
        ];
    }

    private function showEditDriver($company_name)
    {
        return [
            'options_civil_state'=>DriverInformation::enum_civil_state,
            'options_education'=>DriverInformation::enum_education,
            // Doc_verification
            'category_list'=>DocVerification::CATEGORY,
            'runstate_list'=>DocVerification::RUNSTATE,
            'values_slalom' => SkillMtM::VALUE_SLALOM,
            'values_projection' => SkillMtM::VALUE_PROJECTION,
            'values_braking' => SkillMtM::VALUE_BRAKING,
            'values_evasion' => SkillMtM::VALUE_EVASION,
            'values_mobility' => SkillMtM::VALUE_MOBILITY,
            'company_name' => ucwords(strtolower($company_name)),
            'permissions' => $this->permissions,
        ];
    }

    private function showIndexMotorcycleTecnology($company_name)
    {
        return [
            'company_name' => ucwords(strtolower($company_name)),
            'permissions' => $this->permissions,
            'values_type_brake' => MotorcycleTechnology::VALUE_TYPE_BRAKE,
            'values_assistence_brake' => MotorcycleTechnology::VALUE_ASSISTENCE_BRAKE,
            'values_automatic_lights' => MotorcycleTechnology::VALUE_AUTOMATIC_LIGHTS,
            'assistence_type_brake_list'=> json_encode($this->ListDT()->query(MotorcycleTechnology::VALUE_TYPE_BRAKE)->make("array_assoc")),
            'assistence_brake_list'=> json_encode($this->ListDT()->query(MotorcycleTechnology::VALUE_ASSISTENCE_BRAKE)->make("array_assoc")),
            'automatic_lights_list'=> json_encode($this->ListDT()->query(MotorcycleTechnology::VALUE_AUTOMATIC_LIGHTS)->make("array_assoc")),
        ];
    }

    private function showIndexPersonalElementProtection($company_name)
    {
        return [
            'company_name' => ucwords(strtolower($company_name)),
            'permissions' => $this->permissions,
            'values_casco' => Epp::VALUE_CASCO,
            'values_airbag' => Epp::VALUE_AIRBAG,
            'values_rodilleras' => Epp::VALUE_RODILLERAS,
            'values_coderas' => Epp::VALUE_CODERAS,
            'values_hombreras' => Epp::VALUE_HOMBRERAS,
            'values_espalda' => Epp::VALUE_ESPALDA,
            'values_botas' => Epp::VALUE_BOTAS,
            'values_guantes' => Epp::VALUE_GUANTES,
            'casco_list'=> json_encode($this->ListDT()->query(Epp::VALUE_CASCO)->make("array_assoc")),
            'airbag_list'=> json_encode($this->ListDT()->query(Epp::VALUE_AIRBAG)->make("array_assoc")),
            'rodilleras_list'=> json_encode($this->ListDT()->query(Epp::VALUE_RODILLERAS)->make("array_assoc")),
            'coderas_list'=> json_encode($this->ListDT()->query(Epp::VALUE_CODERAS)->make("array_assoc")),
            'hombreras_list'=> json_encode($this->ListDT()->query(Epp::VALUE_HOMBRERAS)->make("array_assoc")),
            'espalda_list'=> json_encode($this->ListDT()->query(Epp::VALUE_ESPALDA)->make("array_assoc")),
            'botas_list'=> json_encode($this->ListDT()->query(Epp::VALUE_BOTAS)->make("array_assoc")),
            'guantes_list'=> json_encode($this->ListDT()->query(Epp::VALUE_GUANTES)->make("array_assoc")),
        ];

    }

    private function showIndexMtMechanicalCondition($company_name)
    {
        return [
            'company_name' => ucwords(strtolower($company_name)),
            'permissions' => $this->permissions,
            'values_tires' => MotorcycleMechanicalConditions::VALUE_TIRES,
            'values_manigueta_guaya' => MotorcycleMechanicalConditions::VALUE_MANIGUETA_GUAYA,
            'values_braking_system' => MotorcycleMechanicalConditions::VALUE_BRAKING_SYSTEM,
            'values_kit' => MotorcycleMechanicalConditions::VALUE_KIT,
            'values_stee_susp' => MotorcycleMechanicalConditions::VALUE_STEE_SUSP,
            'values_oil_leak' => MotorcycleMechanicalConditions::VALUE_OIL_LEAK,
            'values_other_components' => MotorcycleMechanicalConditions::VALUE_OTHER_COMPONENTS,
            'values_horn' => MotorcycleMechanicalConditions::VALUE_HORN,
            'values_lights' => MotorcycleMechanicalConditions::VALUE_LIGHTS,
            'tires_list'=> json_encode($this->ListDT()->query(MotorcycleMechanicalConditions::VALUE_TIRES)->make("array_assoc")),
            'automatic_lights_list'=> json_encode($this->ListDT()->query(MotorcycleMechanicalConditions::VALUE_MANIGUETA_GUAYA)->make("array_assoc")),
            'braking_system_list'=> json_encode($this->ListDT()->query(MotorcycleMechanicalConditions::VALUE_BRAKING_SYSTEM)->make("array_assoc")),
            'kit_list'=> json_encode($this->ListDT()->query(MotorcycleMechanicalConditions::VALUE_KIT)->make("array_assoc")),
            'stee_susp_list'=> json_encode($this->ListDT()->query(MotorcycleMechanicalConditions::VALUE_STEE_SUSP)->make("array_assoc")),
            'oil_leak_list'=> json_encode($this->ListDT()->query(MotorcycleMechanicalConditions::VALUE_OIL_LEAK)->make("array_assoc")),
            'other_components_list'=> json_encode($this->ListDT()->query(MotorcycleMechanicalConditions::VALUE_OTHER_COMPONENTS)->make("array_assoc")),
            'horn_list'=> json_encode($this->ListDT()->query(MotorcycleMechanicalConditions::VALUE_HORN)->make("array_assoc")),
            'lights_list'=> json_encode($this->ListDT()->query(MotorcycleMechanicalConditions::VALUE_LIGHTS)->make("array_assoc")),
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
            'slalom_t_list'=> json_encode($this->ListDT()->query(SkillMtM::VALUE_SLALOM)->make("array_assoc")),
            'projection_t_list'=> json_encode($this->ListDT()->query(SkillMtM::VALUE_PROJECTION)->make("array_assoc")),
            'braking_t_list'=> json_encode($this->ListDT()->query(SkillMtM::VALUE_BRAKING)->make("array_assoc")),
            'evasion_t_list'=> json_encode($this->ListDT()->query(SkillMtM::VALUE_EVASION)->make("array_assoc")),
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
            'category_t_list'=> json_encode($this->ListDT()->query(DocVerification::CATEGORY)->make('array')),
            'runstate_t_list'=> json_encode($this->ListDT()->query(DocVerification::RUNSTATE)->make('array')),
            'soat_available_t_list'=> json_encode($this->ListDT()->query(DocVerification::SOAT_AVAILABLE)->make('array')),
            'technom_review_t_list'=> json_encode($this->ListDT()->query(DocVerification::TECHNOM_REVIEW)->make('array')),
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
