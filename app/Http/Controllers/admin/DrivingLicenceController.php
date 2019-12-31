<?php

namespace App\Http\Controllers\admin;

use App\DrivingLicence;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Imports\DrivingLicenceImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DrivingLicenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enum_category = $this->generateOptionsEnumDt(DrivingLicence::enum_category);
        $list_category = DrivingLicence::enum_category;
        $enum_country_expedition = $this->generateOptionsEnumDt(DrivingLicence::enum_country_expedition);
        $list_country_expedition = DrivingLicence::enum_country_expedition;
        $enum_state = $this->generateOptionsEnumDt(DrivingLicence::enum_state);
        $list_state = DrivingLicence::enum_state;
        return view(
            'admin.driving-licence.index',
            [
                'enum_category' => $enum_category,
                'enum_country_expedition' => $enum_country_expedition,
                'enum_state' => $enum_state,
                'list_country_expedition' => $list_country_expedition,
                'list_category' => $list_category,
                'list_state' => $list_state
            ]
        );
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
        $data_input = $request->get('drivingLicence');
        $validator = Validator::make(
            $data_input,
            [
                'licence_num' => 'required|max:255',
                'country_expedition' => 'required|max:255',
                'category' => 'required|max:255',
                'state' => 'required|max:255',
                'expedition_day' => 'required|max:255',
                'expi_date' => 'required|max:255',
                'driver_information_dni_id' => ['required', 'max:255', 'unique:driving_licence']
            ],
            [
                'driver_information_dni_id.unique' => "Este conductor ya tiene una licencia en uso."
            ]
        );
        $errors = $validator->errors()->getMessages();
        // print_r($errors);
        // die;
        foreach ($errors as $key => $value) {
            if (strpos($value[0], "uso") !== FALSE) {
                $now = date("Y-m-d H:i:s");
                $response = DrivingLicence::where($key, $data_input[$key])->update([
                    'driver_information_dni_id' => $data_input['driver_information_dni_id'],
                    'licence_num' => $data_input['licence_num'],
                    'country_expedition' =>  $data_input['country_expedition'],
                    'category' => $data_input['category'],
                    'state' => $data_input['state'],
                    'expedition_day' => $data_input['expedition_day'],
                    'expi_date' => $data_input['expi_date'],
                    'operation' => 'U',
                    'date_operation' => $now,
                    'user_id' => auth()->id()
                ]);
                if ($response) {
                    return response()->json(['response' => 'Información actualizada', 'errors' => []]);
                } else {
                    return response()->json(['errors' => ['response' => 'No se pudo actualizar la información']]);
                }
            }
        }
        if (!empty($errors)) {
            return response()->json(['errors' => $errors]);
        } else {
            $driving_licence = DrivingLicence::create([
                'driver_information_dni_id' => $data_input['driver_information_dni_id'],
                'licence_num' => $data_input['licence_num'],
                'country_expedition' =>  $data_input['country_expedition'],
                'category' => $data_input['category'],
                'state' => $data_input['state'],
                'expedition_day' => $data_input['expedition_day'],
                'expi_date' => $data_input['expi_date'],
                'user_id' => auth()->id()
            ]);
            if ($driving_licence->licence_num != "") {
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
        if ($field == "expi_date") {
            $day_expedition = strtotime($data_updated['expedition_day']);
            $day_expiration = strtotime($value);
            if ($day_expiration <= $day_expedition) {
                return response()->json(['error' => ['response' => 'Las fecha de vencimiento no puede ser mayor a la fecha de expedición.']]);
            }
        }
        $response = DrivingLicence::where('licence_id', $data_updated['licence_id'])->update([
            $field => $value,
            'operation' => 'U',
            'date_operation' => $now,
            'user_id' => auth()->id()
        ]);
        if ($response) {
            return response()->json(['response' => 'Información actualizada', 'error' => []]);
        } else {
            return response()->json(['error' => ['response' => 'No se pudo actualizar la información']]);
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
        $delete = DrivingLicence::where('licence_id', $data_delete['licence_id'])->update(['operation' => 'D']);
        if ($delete) {
            return response()->json(['response' => 'Usuario eliminado', 'error' => '']);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el usuario']);
        }
    }

    public function drivingLicenceList()
    {
        $company_id = Auth::user()->company_id;
        $driving_licence = DB::table('driving_licence')
            ->orderBy('driving_licence.date_operation', 'desc')
            ->join('driver_information', 'driver_information.dni_id', '=', 'driving_licence.driver_information_dni_id')
            ->where('driver_information.company_id', '=', $company_id)
            ->where('driving_licence.operation', '!=', 'D')
            ->select(DB::raw(
                'driving_licence.licence_id,
                driving_licence.licence_num,
                driving_licence.country_expedition,
                driving_licence.category,
                driving_licence.state,
                driving_licence.expedition_day,
                driving_licence.expi_date,
                driving_licence.driver_information_dni_id,
                driver_information.first_name,
                driver_information.f_last_name'
            ))->get();
        $driving_licence = $this->addDeleteButtonDatatable($driving_licence);
        return datatables()->of($driving_licence)->make(true);
    }

    public function import(Request $request)
    {
        $data_insert = $request->all();
        $data_insert['id'] = auth()->id();
        $file = $request->file('file');
        $result = Excel::import(new DrivingLicenceImport(), $file);
        return response()->json(['response' => 'ok']);
    }

    public static function getCategoryByCompany($company_id)
    {
        return DB::table('driving_licence')
            ->select(DB::raw(
                'driving_licence.category,COUNT(*) AS total'
            ))
            ->join('driver_information', 'driver_information.dni_id', '=', 'driving_licence.driver_information_dni_id')
            ->where('driver_information.company_id', '=', $company_id)
            ->groupBy('category')
            ->get()->toArray();
    }

    public function makeBarChartCategory(Request $request)
    {
        $company_id = $request->get('company_id');
        $civil_state = $this->getCategoryByCompany($company_id);
        foreach ($civil_state as $key => $value) {
            $labels[] = $value->category;
            $data_data[] = $value->total;
        }
        $num_register = count($data_data);
        $arr_colors = $this->fillColorsBarChart($num_register);
        $maximo = max($data_data)+1;
        $datasets['label'] = "Frecuencia";
        $datasets['data'] = $data_data;
        $datasets['backgroundColor'] = $arr_colors['backgroundColor'];
        $datasets['borderColor'] = $arr_colors['borderColor'];
        $datasets['borderWidth'] = 1;
        $data['datasets'][] = $datasets;
        $data['labels'] = $labels;
        return response()->json(['data' => $data, 'errors' => [],'max'=>$maximo]);
    }
}
