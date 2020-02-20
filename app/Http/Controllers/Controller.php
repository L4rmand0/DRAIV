<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\PermissionUser;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, PermissionUser;

    protected $data_query;
    protected $arr_columns;

    public function addDeleteButtonDatatable($data)
    {
        foreach ($data as $key => $value) {
            $data[$key]->delete_row = "";
        }
        return $data;
    }

    public function generateOptionsEnumDt($data)
    {
        $options[] = ['value' => "", 'display' => "Seleccionar"];
        foreach ($data as $key => $value) {
            $options[] = ['value' => $value, 'display' => $value];
        }
        return $options;
    }

    public function fillColorsBarChart($number)
    {
        $colors = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(69, 153, 63, 0.2)',
            'rgba(240, 108, 33, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)',
        ];

        $borders_colors = [
            'rgba(255, 99, 132, 1)',
            'rgba(69, 153, 63, 1)',
            'rgba(240, 108, 33, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
        ];

        $borders = [];
        $bg_colors = [];
        $cursor_colors = 0;
        for ($i = 0; $i < $number; $i++) {
            if ($cursor_colors == 5) {
                $cursor_colors = 0;
                $bg_colors[] = $colors[$cursor_colors];
                $borders[] = $borders_colors[$cursor_colors];
            } else {
                $bg_colors[] = $colors[$cursor_colors];
                $borders[] = $borders_colors[$cursor_colors];
            }
            $cursor_colors++;
        }
        return ['backgroundColor' => $bg_colors, 'borderColor' => $borders];
    }

    public static function sanitazeArr($array_objects){
        foreach ($array_objects as $key => $value) {
            $array_objects[$key] = (array) $value;
        }
        return $array_objects;
    }

    protected function dataQuery($data_query){
        $this->data_query = $data_query;
        return $this;
    }

    protected function make($arr_columns){
        $this->arr_columns = $arr_columns;
        foreach ($this->data_query as $key_data => $value_data) {
            foreach ($value_data as $key_c_data => $value_c_data) {
                //Si la columna que viene dentro de los datos está dentro de $arr_columns
                //Modifica los datos de la query inicial con los valores de las constantes del array
                if(self::cin_array($key_c_data, $arr_columns)){
                    $this->data_query[$key_data]->$key_c_data = $arr_columns[$key_c_data][$value_c_data]; 
                }
            }
        }
        return $this->data_query;
    }

    protected static function cin_array($element,$array){
        $exist = false;
        foreach ($array as $key => $value) {
            if($key == $element){
                $exist = true;
            }
        }
        return $exist;
    }
}
