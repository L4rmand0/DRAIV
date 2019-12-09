<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $profile = auth()->user()->User_profile;
        if($profile == "Administrator"){
            return view('admin.dashboard');
        }else{
            return view('prohibited');
        }
    }

    public function validateAdmin(){
        
    }
}
