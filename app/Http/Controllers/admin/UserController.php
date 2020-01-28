<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Profile;
use App\Traits\TListDataTable;
use App\User;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use TListDataTable;

    private $permission_controller;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->permission_controller = new PermissionController();
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
        $id = Auth::user()->id;
        $data_updated = $request->all();
        // echo '<pre>';
        // print_r($data_updated);
        // die;
        //datos de la actualización
        $now = date("Y-m-d H:i:s");
        $field = $data_updated['fieldch'];
        $value = $data_updated['valuech'];

        $permission_profile = Profile::where('profile_id', $value)->get()->toArray()[0]['permission'];
        $permission_modules_arr = json_decode($permission_profile, true)['modules'];
        // echo '<pre>';
        // print_r($permission_modules_arr);

        if (empty($permission_modules_arr)) {
            return response()->json(['errors' => ['modules empty', 'Este perfil no tiene permisos asociados. Por favor comuníquese con el soporte.']]);
        }
        $response = User::where('id', $data_updated['id'])->update([$field => $value, 'operation' => 'U', 'date_operation' => $now]);
        $user_permission = $this->permission_controller->getArrUserPermissions($data_updated['id']);
        // print_r($user_permission);
        // die;
        if (empty($user_permission)) {
            foreach ($permission_modules_arr as $key => $value) {
                Permission::create([
                    'module_module_id' => $value,
                    'user_id' => $id,
                    'users_id' => $data_updated['id'],
                ]);
            }
        } else {
            // print_r($user_permission);
            $response = Permission::where('users_id', $data_updated['id'])
                ->update(['operation' => 'D', 'date_operation' => $now, 'user_id' => $id]);
            foreach ($permission_modules_arr as $key => $value) {
                $coincidencia = 0;
                // echo ' <pre> || '.$value.' ';
                foreach ($user_permission as $key_p_user => $value_p_user) {
                    // echo ' -- val_profile '.$value.' val_user '.$value_p_user->module_id.' -- ';
                    if ($value == $value_p_user->module_id) {
                        $coincidencia++;
                    }
                }
                // if($coincidencia>0){
                //     echo ' coincide || ';
                // }else{
                //     echo ' no coincide || ';
                // }
                if ($coincidencia > 0) {
                    $response = Permission::where('module_module_id', $value)
                        ->where('users_id', $data_updated['id'])
                        ->update(['operation' => 'U', 'date_operation' => $now, 'user_id' => $id]);
                } else {
                    $response = Permission::create([
                        'module_module_id' => $value,
                        'user_id' => $id,
                        'users_id' => $data_updated['id'],
                    ]);
                }
            }
        }
        if ($response) {
            return response()->json(['response' => 'Usuario actualizado', 'errors' => []]);
        } else {
            return response()->json(['errors' => ['response' => 'No se pudo actualizar el usuario']]);
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
        $company_id = Auth::user()->company_active;
        // echo $company_id;
        // die;
        $users = DB::table('users as u')
            ->select(DB::raw(
                'u.id, u.name, u.email, u.company_id, u.profile_id, p.user_profile'
            ))
            ->join('profile_ as p', 'p.profile_id', '=', 'u.profile_id')
            ->where('u.company_id', '=', $company_id)
            ->where('u.operation', '!=', 'D')
            ->orderBy('u.start_date', 'desc')
            ->get();
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
        $modules = json_decode($profiles->permission, true)['modules'];
        foreach ($modules as $value_modulo) {
            Permission::create([
                'users_id' => $user_id,
                'module_module_id' => $value_modulo,
                'user_id' => Auth::user()->id,
            ]);
        }
    }

    public function MakeProfileList()
    {
        $profile_list = DB::table('profile_ as p')
            ->orderBy('p.date_operation', 'asc')
            ->select('p.profile_id', 'p.user_profile')
            ->where('p.operation', '!=', 'D')
            ->get()->toArray();
        return $this->ListDT()->query(self::sanitazeArr($profile_list))->make('profile_id', 'user_profile');
    }

    public function updateCompanyActive(Request $request)
    {
        $company_id = $request->get('company_id');
        $id = Auth::user()->id;
        $user = User::where('id', $id)->update(['company_active' => $company_id]);
        return response()->json(['response' => 'Información actualizada', 'errors' => []]);
    }
}
