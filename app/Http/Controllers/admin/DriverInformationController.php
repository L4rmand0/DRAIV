<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\UserInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class DriverInformationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.information-user.index');
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
        $data_input = $request->all();
        // print_r($data_input);
        // die;
        $validator = Validator::make(
            $data_input,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:5', 'confirmed'],
                'checkdata' => ['accepted'],
                'Company_id' => ['required'],
                'User_profile' => ['required']
            ],
            [
                'checkdata.accepted' => "Debe aceptar los términos y condiciones.",
            ]
        );

        $errors = $validator->errors()->getMessages();
        if (!empty($errors)) {
            return response()->json(['errors' => $errors]);
        } else {
            $user = User::create([
                'name' => $data_input['name'],
                'email' => $data_input['email'],
                'password' => Hash::make($data_input['password']),
                'Company_id' => $data_input['Company_id'],
                'User_profile' => $data_input['User_profile']
            ]);
            if ($user->id > 0) {
                return response()->json([
                    'success' => 'Usuario registrado.',
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
        $data_updated = $request->all();
        // print_r($data_updated);
        // die;
        $field = $data_updated['fieldch'];
        $value = $data_updated['valuech'];
        $response = UserInformation::where('DNI_id', $data_updated['DNI_id'])->update([$field => $value]);
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
    public function destroy($id)
    {
        //
    }

    public function driveInformationList()
    {
        $company_id = Auth::user()->Company_id;
        $drive_information = DB::table('User_information')
            ->join('users', 'User_information.Db_user_id', '=', 'users.id')
            ->join('company', 'company.Company_id', '=', 'User_information.Company_id')
            ->where('User_information.Company_id', '=', $company_id)
            ->select(
                'User_information.DNI_id',
                'User_information.First_name',
                'User_information.Second_name',
                'User_information.F_last_name',
                'User_information.S_last_name',
                'User_information.Gender',
                'User_information.Education',
                'User_information.E_mail_address',
                'User_information.address',
                'User_information.Country_born',
                'User_information.City_born',
                'User_information.City_Residence_place',
                'User_information.Department',
                'User_information.phone',
                'User_information.Civil_state',
                'User_information.Score',
                'User_information.Db_user_id',
                'User_information.Company_id',
                'users.name as user',
                'company.Name_company as company'
            )
            ->get();
        // echo '<pre>';
        // print_r($drive_information);
        // die;
        return datatables()->of($drive_information)->make(true);
    }

    //     SELECT 
    // User_information.DNI_id,
    // User_information.First_name,
    // User_information.Second_name,
    // User_information.F_last_name,
    // User_information.S_last_name,
    // User_information.Gender,
    // User_information.Education,
    // User_information.E_mail_address,
    // User_information.address,
    // User_information.Country_born,
    // User_information.City_born,
    // User_information.City_Residence_place,
    // User_information.Department,
    // User_information.phone,
    // User_information.Civil_state,
    // User_information.Score,
    // users.name AS user, 
    // company.Name_company AS company
    // FROM sam.users
    // INNER JOIN sam.User_information ON User_information.Db_user_id = users.id
    // INNER JOIN sam.company ON company.Company_id = User_information.Company_id
    // WHERE User_information.DNI_id = 1069731531;

}
