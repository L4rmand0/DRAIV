<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Company;
use App\Profile;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'checkdata' => ['accepted'],
            'company_id' => ['required','unique:company'],
            'company_name' => ['required'],
        ],[
            'name.required' => "El campo nombre es obligatorio",
            'email.required' => "El correo electrónico es obligatorio",
            'password.confirmed' => "Las contraseñas no coindicen",
            'password.required' => "La contraseña es obligatoria",
            'checkdata.required' => "Se deben aceptar los términos y condiciones",
            'company_id.required' => "El campo compañía es obligatorio",
            'company_name.required' => "El nombre de la compañía es obligatorio",
            'email.unique' => "Este correo electrónico ya fue registrado",
            'company_id.unique' => "Este nit o documento ya fue registrado",
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'Company_id' => $data['Company_id']
        ]);
    }

    protected function createAccount(array $data)
    {
        Company::create([
            'company_id'=> $data['company_id'],
            'name_company'=> $data['company_name'],
            'user_id'=> auth()->id(),
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'company_id' => $data['company_id'],
            'profile_id' => User::USER_DEFAULT
        ]);

        $permission_profile = Profile::where('profile_id', User::USER_DEFAULT)->get()->toArray()[0]['permission'];
        $permission_modules_arr = json_decode($permission_profile, true)['modules'];
        foreach ($permission_modules_arr as $key => $value) {
            $response = Permission::create([
                'module_module_id' => $value,
                'users_id' => $user->id,
            ]);
        }    
        return response()->json(['response' => 'Usuario creado correctamente', 'errors' => []]);
    }

}
