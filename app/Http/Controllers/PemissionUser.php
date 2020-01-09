<?php
namespace App\Traits;

use App\Module;
use DB;

trait PermissionUser
{
    public function getPermissions($user_id)
    {
        $permissions = DB::table('permissions')
            ->where('permissions.users_id', '=', $user_id)
            ->where('permissions.operation', '!=', 'D')
            ->orderBy('module.parent_id', 'asc')
        // ->orderBy('module.route', 'asc')
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
        // print_r($permissions);
        // die;
        return $this->organizePermissionArray($permissions);
    }

    public function organizePermissionArray($data)
    {
        foreach ($data as $key => $value) {
            if ($value->parent_id == 0 && $value->type == "Group") {
                $groups[$value->route]["name"] = $value->name;
                $groups[$value->route]["id"] = $value->module_id;
                $groups[$value->route]["image"] = $value->imagen;
                $groups[$value->route]["module_type"] = $value->module_type;
                unset($data[$key]);
            }
        }
        // print_r($groups);
        // die;
        foreach ($groups as $key_group => $value_group) {
            $groups[$key_group]['childs'] = [];
            $groups_organized[$key_group]['childs'] = [];
            foreach ($data as $key_childs => $value_childs) {
                if ($value_childs->parent_id == $value_group['id']) {
                    // print_r($value_childs);
                    // die;
                    $groups[$key_group]['childs'][$value_childs->route] = $value_childs;
                }
            }
            $length_childs = count($groups[$key_group]['childs']);
            for ($i = 1; $i <= $length_childs; $i++) {
                $groups_organized[$key_group]['childs'][] = $groups[$key_group]['childs'][$i]; 
            }
            $groups_organized[$key_group]['name'] = $groups[$key_group]['name'];
            $groups_organized[$key_group]['id'] = $groups[$key_group]['id'];
            $groups_organized[$key_group]['image'] = $groups[$key_group]['image'];
            $groups_organized[$key_group]['module_type'] = $groups[$key_group]['module_type'];
        }
        // echo '<pre>';
        // print_r($groups_organized);
        // die;
        //ordenar el array
        $lenght_groups = count($groups_organized);

        for ($i = 1; $i <= $lenght_groups; $i++) {
            $new_groups[] = $groups_organized[$i];
        }
        // echo '<pre>  xxx ';
        // print_r($new_groups);
        // die;
        return $new_groups;
    }

    public function checkModulePermission($module, $user_id)
    {
        $module_id = !empty(Module::MODULES[$module]) ? Module::MODULES[$module] : false;
        if ($module_id == false) {
            return false;
        }
        $permissions = DB::table('permissions')
            ->select(DB::raw(
                'permissions.users_id,
             permissions.module_module_id,
             permissions.principal,
             module.module_type'
            ))
            ->join('module', 'module.module_id', '=', 'permissions.module_module_id')
            ->where('permissions.users_id', '=', $user_id)
            ->where('permissions.operation', '!=', 'D')
            ->get()->toArray();
        $principal = "";
        $permiso = false;
        foreach ($permissions as $key_permission => $value_permission) {
            if ($value_permission->principal == 1) {
                $principal = $value_permission->module_type;
            }
            if ($value_permission->module_module_id == $module_id) {
                $permiso = true;
            }
        }
        // var_dump($permiso);
        // echo $principal . ' <pre> permisos ';
        // print_r($permissions);
        // die;
        if ($permiso) {
            return $module;
        } else if ($principal != "") {
            return $principal;
        } else {
            return false;
        }
    }
}
