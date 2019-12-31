<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $profile = auth()->user()->user_profile;
        if ($profile == "administrator") {
            $company_id = auth()->user()->company_id;
            $company = CompanyController::getCompanyByid($company_id);
            $total_drivers = DriverInformationController::getNumberDriversByCompany($company_id);
            $total_vehicles = DriverVehicleController::getTotalVehiclesByCompany($company_id);
            return view('admin.dashboard', [
                'company_name' => ucwords(strtolower($company->company)),
                'total_drivers' => $total_drivers,
                'total_vehicles' => $total_vehicles
            ]);
        } else {
            return view('prohibited');
        }
    }

    public function validateAdmin()
    {
    }
}
