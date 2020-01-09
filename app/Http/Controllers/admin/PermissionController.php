<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class PermissionController extends Controller
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

    public function getPermissionByUser($user_id)
    {
        $permissions = DB::table('permissions')
            ->where('permissions.users_id', '=', $user_id)
            ->where('permissions.operation', '!=', 'D')
            ->orderBy('module.parent_id', 'asc')
            ->join('module', 'module.module_id', '=', 'permissions.module_module_id')
            ->select(DB::raw(
                'module.module_id,
               module.module_type,
               module.type,
               module.imagen,
               module.parent_id'
            ))->get();
        return $this->organizePermissionArray($permissions);
    }

    public function organizePermissionArray($data)
    {
        foreach ($data as $key => $value) {
            if ($value->parent_id == 0 && $value->type == "Group") {
                $groups[$value->module_type]["name"] = $value->module_type;
                $groups[$value->module_type]["id"] = $value->module_id;
                unset($data[$key]);
            }
        }
        foreach ($groups as $key_group => $value_group) {
            foreach ($data as $key_childs => $value_childs) {
                if($value_childs->parent_id == $value_group['id']){
                    $groups[$key_group]['childs'][] = $value_childs;
                }
            }
        }
        return $groups;
    }
}
