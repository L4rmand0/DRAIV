<?php
namespace App\Traits;

trait ArrayFunctions {
    public function toArrayColumn($array = [], $index = null, $except = []){
        $new_array = [];
        if($index !== null){
            foreach ($array as $key => $value) {
                if(!$this->in_array_contains($key,$except)){
                    $new_array[$key] = $value[$index];
                }else{
                    $new_array[$key] = $value;
                }
            }
        }
        return $new_array;
    }

    public function in_array_contains($needle, $array){
        $flag = false;
        foreach ($array as $key => $value) {
            // echo "needle: $needle => find: $value ||";
            if(strpos($needle,$value)!== false){
                $flag = true;
                return $flag;
            }
        }
        return $flag;
    }
    
}

