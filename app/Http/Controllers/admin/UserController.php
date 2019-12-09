<?php

namespace App\Http\Controllers\admin;

use DB;
use App\User;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
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
        $data_updated = $request->all();
        $field = $this->findFieldUpdated($data_updated);
        $response = User::where('id', $data_updated['id'])->update([$field => $data_updated[$field]]);
        if ($response) {
            return response()->json(['response' => 'Usuario actualizado']);
        } else {
            return response()->json(['error' => 'validación correcta']);
        }
    }

    public function findFieldUpdated($data)
    {
        $value_changed = $data['valuech'];
        unset($data['valuech']);
        $field = '';
        foreach ($data as $key => $value) {
            if ($value == $value_changed) {
                $field = $key;
            }
        }
        return trim($field);
    }

    public function updateUser(Request $request)
    {
        //
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

    public function usersList()
    {
        $company_id = Auth::user()->Company_id;
        $users = DB::table('users')->where('Company_id', '=', $company_id)->get();
        return datatables()->of($users)->make(true);
    }

    public function storeUserAdmin(Request $request)
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
}
