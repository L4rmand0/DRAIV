<?php

namespace App\VendorDraiv;

use function PHPSTORM_META\type;

class ListDatatableUser
{

    private $data_query;

    public function query($data_query)
    {
        $this->data_query = $data_query;
        return $this;
    }

    public function make($type = null, $column_value = null, $column_display = null)
    {
        // echo ' hola <pre> ';
        // print_r($this->data_query);
        // die;
        if ($type == "sql" && $column_value != null) {
            // echo '<pre> entra';
            // die;
            foreach ($this->data_query as $key => $value) {
                $options[] = [
                    'value' => $value[$column_value],
                    'display' => $value[$column_display],
                ];
            }
        } else if($type == "array" && $column_value == null && $column_display == null){
            foreach ($this->data_query as $key => $value) {
                $options[] = [
                    'value' => $value,
                    'display' => $value,
                ];
            }
        } else if($column_value == null && $column_display == null && $type == "array_assoc"){
            foreach ($this->data_query as $key => $value) {
                $options[] = [
                    'value' => $key,
                    'display' => $value,
                ];
            }
        }
        return $options;
    }
}
