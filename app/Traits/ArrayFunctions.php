<?php

namespace App\Traits;

trait ArrayFunctions
{
    public function toArrayColumn($array = [], $index = null, $except = [])
    {
        $new_array = [];
        if ($index !== null) {
            foreach ($array as $key => $value) {
                if (!$this->in_array_contains($key, $except)) {
                    $new_array[$key] = $value[$index];
                } else {
                    $new_array[$key] = $value;
                }
            }
        }else if ($index == null) {
            foreach ($array as $key => $value) {
                if ($this->in_array_contains($key, $except)) {
                    $new_array[$key] = $value;
                    unset($array[$key]);
                } 
            }
            $new_array = array_merge($new_array, $array);
        }
        return $new_array;
    }

    public function in_array_contains($needle, $array)
    {
        $flag = false;
        foreach ($array as $key => $value) {
            // echo "needle: $needle => find: $value ||";
            if (strpos($needle, $value) !== false) {
                $flag = true;
                return $flag;
            }
        }
        return $flag;
    }

    protected static function personalizeErrorsTypeVehicle($error)
    {
        $new_arr_errors = [];
        foreach ($error as $key_err => $value_err) {
            foreach ($value_err as $key_err_t => $value_err_t) {
                $new_arr_errors[$key_err . $key_err_t] = $value_err_t;
            }
        }
        return $new_arr_errors;
    }

    protected static function invertRowColumnArray($array){
        // echo ' invert ';
        // print_r($array);
        $new_array = [];
        foreach ($array as $key_arr => $value_arr) {
            foreach ($value_arr as $key_item => $value_item) {
                $new_array[$key_item][$key_arr] = $value_item;
            }
        }
        return $new_array;
    }
}
