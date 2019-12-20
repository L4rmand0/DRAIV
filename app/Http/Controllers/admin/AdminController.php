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
        $profile = auth()->user()->user_profile;
        if($profile == "administrator"){
            return view('admin.dashboard');
        }else{
            return view('prohibited');
        }
    }

    public function validateAdmin(){
        
    }
}
