<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Revisar si se puede quitar
    // public function findFieldUpdated($data)
    // {
    //     // print_r($data);
    //     // die;
    //     $value_changed = $data['valuech'];
    //     unset($data['valuech']);
    //     $field = '';
    //     foreach ($data as $key => $value) {
    //         if ($value == $value_changed) {
    //             $field = $key;
    //         }
    //     }
    //     return trim($field);
    // }

    public function addDeleteButtonDatatable($data){
        foreach ($data as $key => $value) {
            $data[$key]->delete_row = "";
        }
        return $data;
    }
}
