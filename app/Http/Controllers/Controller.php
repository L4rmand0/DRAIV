<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function addDeleteButtonDatatable($data){
        foreach ($data as $key => $value) {
            $data[$key]->delete_row = "";
        }
        return $data;
    }

    public function generateOptionsEnumDt($data){
        foreach ($data as $key => $value) {
            $options[]=['value'=>$value,'display'=>$value];
        }
        return $options;
    }
}
