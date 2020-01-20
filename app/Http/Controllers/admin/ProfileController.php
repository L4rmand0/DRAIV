<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Profile;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function update(Request $request, $id)
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

    public function profilesSelect2(Request $request){
        $profiles = DB::table('profile_ as p')
            ->orderBy('p.date_operation', 'desc')
            ->select('p.profile_id','p.user_profile')
            ->where('p.operation', '!=', 'D')
            // ->toSql();
            ->get()
            ->toArray();
    
        // echo '<pre>';
        // print_r($profiles);
        // die;
        return response()->json($this->createProfileSelect2($profiles));
    }

    public function createProfileSelect2($query_data)
    {
        $data[0]['id'] = "";
        $data[0]['text'] = "Seleccionar";
        foreach ($query_data as $key => $value) {
            $data[$key + 1]['id'] = $value->profile_id;
            $data[$key + 1]['text'] = $value->user_profile;
        }
        return $data;
    }

    public function getArrPermissionByProfile($profile_id){
        Profile::where('','')->first();
    }
}
