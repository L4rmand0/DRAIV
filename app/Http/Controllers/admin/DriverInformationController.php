<?php

namespace App\Http\Controllers\admin;


// use Excel;
use DB;
use App\UserInformation;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersInformationImport;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\dataConductores\UserInformationController;

class DriverInformationController extends Controller
{

    private $excel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->excel = $excel;
        // $this->middleware('guest');
    }
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
        $data_input = $request->all()['userInformation'];
        // print_r($data_input);
        // die;
        $validator = Validator::make(
            $data_input,
            [
                'First_name' => 'required|max:255',
                'F_last_name' => 'required|max:255',
                'S_last_name' => 'required|max:255',
                'E_mail_address' => ['required', 'max:255', 'unique:User_information'],
                'DNI_id' => ['required', 'max:255', 'unique:User_information'],
                'Gender' => 'required|max:255',
                'Education' => 'required|max:255',
                'Country_born' => 'required|max:255',
                'City_born' => 'required|max:255',
                'Department' => 'required|max:255',
                'Civil_state' => 'required|max:255',
                'address' => 'required|max:255',
                'phone' => 'required|max:255'
            ],
            [
                'DNI_id.unique' => "Esta cédula ya está en uso.",
                'E_mail_address.unique' => "Este email ya está en uso."
            ]
        );

        $errors = $validator->errors()->getMessages();
        if (!empty($errors)) {
            return response()->json(['errors' => $errors]);
        } else {
            $user_information = UserInformation::create([
                'DNI_id' => $data_input['DNI_id'],
                'First_name' => $data_input['First_name'],
                'Second_name' =>  $data_input['Second_name'] != "" ? $data_input['Second_name'] : "",
                'F_last_name' => $data_input['F_last_name'],
                'S_last_name' => $data_input['S_last_name'],
                'E_mail_address' => $data_input['E_mail_address'],
                'Gender' => $data_input['Gender'],
                'Education' => $data_input['Education'],
                'Country_born' => $data_input['Country_born'],
                'City_born' => $data_input['City_born'],
                'Department' => $data_input['Department'],
                'Civil_state' => $data_input['Civil_state'],
                'address' => $data_input['address'],
                'phone' => $data_input['phone'],
                'Db_user_id' => $data_input['Db_user_id'],
                'Company_id' => $data_input['Company_id']
            ]);
            if ($user_information->DNI_id > 0) {
                return response()->json([
                    'success' => 'Información registrada.',
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
    public function destroy(Request $request)
    {
        $data_delete = $request->all();
        $delete = UserInformation::where('DNI_id', $data_delete['DNI_id'])->update(['Operation' => 'D']);
        if ($delete) {
            return response()->json(['response' => 'Usuario eliminado', 'error' => '']);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el usuario']);
        }
    }

    public function driveInformationList()
    {
        $company_id = Auth::user()->Company_id;
        $drive_information = DB::table('User_information')
            ->join('users', 'User_information.Db_user_id', '=', 'users.id')
            ->join('company', 'company.Company_id', '=', 'User_information.Company_id')
            ->join('admin2', 'admin2.adm2_id', '=', 'User_information.Department')
            ->join('admin3', 'admin3.adm3_id', '=', 'User_information.City_born')
            ->where('User_information.Company_id', '=', $company_id)
            ->where('User_information.Operation', '!=', 'D')
            ->select(DB::raw('User_information.DNI_id,
            User_information.First_name,
            User_information.Second_name,
            User_information.F_last_name,
            User_information.S_last_name,
            IF(User_information.Gender=1,"Masculino","Femenino") as Gender,
            User_information.Education,
            User_information.E_mail_address,
            User_information.address,
            User_information.Country_born,
            admin3.name AS City_born,
            User_information.City_Residence_place,
            admin2.name AS Department,
            User_information.phone,
            User_information.Civil_state,
            User_information.Score,
            User_information.Db_user_id,
            User_information.Company_id,
            users.name as user,
            company.Name_company as company'))->get();
        $drive_information = $this->addDeleteButtonDatatable($drive_information);
        return datatables()->of($drive_information)->make(true);
    }

    public function import(Request $request)
    {
        $data_insert = $request->all();
        $data_insert['id'] = auth()->id();
        $file = $request->file('file');
        $result = Excel::import(new UsersInformationImport($data_insert), $file);
        // $result = $this->excel->import(new UsersInformationImport, 'user_information.xlsx');
        return response()->json(['response' => 'ok']);
    }

}
