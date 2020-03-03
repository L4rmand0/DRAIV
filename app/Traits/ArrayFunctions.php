<?php
namespace App\Traits;

trait ArrayFunctions {
    public function toArrayColumn($array = [], $index = null){
        $new_array = [];
        if($index !== null){
            foreach ($array as $key => $value) {
                $new_array[$key] = $value[$index];
            }
        }
        return $new_array;
    }
    
}