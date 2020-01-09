<?php
namespace App\Traits;
use DB;

trait PermissionUser
{
    public function getPermissions($user_id){
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
                 module.parent_id,
                 module.name,
                 module.route'
            ))->get();
        return $this->organizePermissionArray($permissions);
    }

    public function organizePermissionArray($data)
    {
        foreach ($data as $key => $value) {
            if ($value->parent_id == 0 && $value->type == "Group") {
                $groups[$value->module_type]["name"] = $value->name;
                $groups[$value->module_type]["id"] = $value->module_id;
                $groups[$value->module_type]["image"] = $value->imagen;
                $groups[$value->module_type]["module_type"] = $value->module_type;
                unset($data[$key]);
            }
        }
        foreach ($groups as $key_group => $value_group) {
            $groups[$key_group]['childs']=[];
            foreach ($data as $key_childs => $value_childs) {
                if($value_childs->parent_id == $value_group['id']){
                    $groups[$key_group]['childs'][] = $value_childs;
                }
            }
        }
        // echo '<pre>';
        // print_r($groups);
        // die;
        return $groups;
        
    }
}