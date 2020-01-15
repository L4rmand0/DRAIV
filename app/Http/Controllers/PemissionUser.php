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
        // echo '<pre>';
        // print_r($data);
        // die;
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

        $lenght_groups = count($groups_organized);
        $cont = 0;
        foreach ($groups_organized as $key => $value) {
            $new_gr_or[$cont] = $value;
            $new_gr_or[$cont]['key'] = $key;
            $cont++;
        }
        //ordenar de menor a mayor
        for ($i = 0; $i < $lenght_groups; $i++) {
            for ($j = $i; $j < $lenght_groups; $j++) {
                // echo $new_gr_or[$i]['key'].' => '.$new_gr_or[$j]['key'].' || ';
                if ($new_gr_or[$i]['key'] > $new_gr_or[$j]['key']) {
                    $item_actual = $new_gr_or[$i];
                    $item_comparativo = $new_gr_or[$j];
                    $new_gr_or[$i] = $item_comparativo;
                    $new_gr_or[$j] = $item_actual;
                }
            }
        }
        // print_r($new_gr_or);
        // die;
        // $this->orderGroups($groups_organized);
        // echo '<pre>';
        //ordenar el array

        // for ($i = 1; $i <= $lenght_groups; $i++) {
        //     $new_groups[] = $groups_organized[$i];
        // }
        // echo '<pre>  xxx ';
        // print_r($new_groups);
        // die;
        return $new_gr_or;
    }

    public function orderGroups($groups)
    {

    }

    public function orderArrayKeys($array)
    {
        foreach ($array as $key_main => $value_main) {
            foreach ($array as $key => $value) {
                if ($key_main < $key) {

                }
            }
        }
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
