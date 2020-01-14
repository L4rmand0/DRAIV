<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\User;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user_id = auth()->user()->id;
        // $company_id = auth()->user()->company_id;
        // $company = CompanyController::getCompanyByid($company_id);
        // $permissions = $this->getPermissions($user_id);
        // return view('admin.users.index',[
        //     'company_name' => ucwords(strtolower($company->company)),
        //     'permissions' => $permissions,
        // ]);
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
        //
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
        $response = User::where('id', $data_updated['id'])->update([$field => $value, 'Operation' => 'U', 'Date_operation' => $now]);
        if ($response) {
            return response()->json(['response' => 'Usuario actualizado']);
        } else {
            return response()->json(['error' => 'No se pudo actualizar el usuario']);
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
        $delete = User::where('id', $data_delete['id'])->update(['Operation' => 'D']);
        if ($delete) {
            return response()->json(['response' => 'Usuario eliminado', 'error' => '']);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el usuario']);
        }
    }

    public function usersList()
    {
        $company_id = Auth::user()->company_id;
        $users = DB::table('users')->orderBy('users.start_date', 'desc')->where('company_id', '=', $company_id)->where('operation', '!=', 'D')->get();
        $users = $this->addDeleteButtonDatatable($users);
        return datatables()->of($users)->make(true);
    }

    public function storeUserAdmin(Request $request)
    {

        $data_input = $request->all();
        $profile_id = $data_input['profile_id'];
        
        // echo '<pre>';
        // print_r($data_input);
        // die;
        $validator = Validator::make(
            $data_input,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:5', 'confirmed'],
                'company_id' => ['required'],
                'profile_id' => ['required'],
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
                'company_id' => $data_input['company_id'],
                'profile_id' => $data_input['profile_id'],
            ]);
            if ($user->id > 0) {
                $this->putPermissionsProfile($profile_id, $user->id);
                return response()->json([
                    'success' => 'Usuario registrado.',
                    'errors' => $errors,
                ]);
            }
        }
    }

    public function putPermissionsProfile($profile_id, $user_id)
    {
        $profiles = DB::table('profile_ as p')
            ->orderBy('p.date_operation', 'desc')
            ->select('p.profile_id', 'p.user_profile', 'permission')
            ->where('p.operation', '!=', 'D')
            ->where('p.profile_id', '=', $profile_id)
            ->first();
        $modules = json_decode($profiles->permission,TRUE)['modules'];
        foreach ($modules as $value_modulo) {
            Permission::create([
                'users_id' => $user_id,
                'module_module_id' => $value_modulo,
                'user_id' => Auth::user()->id,
            ]);
        }
    }
}
