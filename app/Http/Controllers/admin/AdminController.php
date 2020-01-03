<?php

namespace App\Http\Controllers\admin;

use App\DrivingLicence;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;

class AdminController extends Controller
{
    private $image_controller;
    public function __construct()
    {
        $this->middleware('auth');
        $this->image_controller = new ImageController();
    }

    public function index(Request $request)
    {
        $profile = auth()->user()->user_profile;
        if ($profile == "administrator") {
            
            $company_id = auth()->user()->company_id;
            $company = CompanyController::getCompanyByid($company_id);
            $total_drivers = DriverInformationController::getNumberDriversByCompany($company_id);
            $total_vehicles = DriverVehicleController::getTotalVehiclesByCompany($company_id);
            $total_gender = DriverInformationController::getGenderByCompany($company_id);
            $average_score = DriverInformationController::getAverageScoreByCompany($company_id);
            $licences_expiration = DrivingLicenceController::getLicenceExpiDates($company_id);
            $soats_expiration = VehicleController::getSoatExpiDates($company_id);
            $technomecanical_expiration = VehicleController::getExpiTecnomecanicalDates($company_id);
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
            // echo '<pre>';
            // print_r($total_gender);
            // die;
            return view('admin.dashboard', [
                'company_name' => ucwords(strtolower($company->company)),
                'total_drivers' => $total_drivers,
                'total_vehicles' => $total_vehicles,
                'total_man' => $man,
                'total_woman' => $woman,
                'score_average' => number_format($average_score->average, 3),
                'licences_expiration' => $licences_expiration,
                'soats_expiration' => $soats_expiration,
                'technomecanical_expiration' => $technomecanical_expiration
            ]);
        } else {
            return view('prohibited');
        }
    }

    public function validateAdmin()
    {
    }
}
