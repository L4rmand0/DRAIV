<?php

namespace App\VendorDraiv;

class ListDatatableUser
{

    private $data_query;

    public function query($data_query)
    {
        $this->data_query = $data_query;
        return $this;
    }

    public function make($column_value, $column_display)
    {
        // echo '<pre>';
        foreach ($this->data_query as $key => $value) {
            $options[] = [
                'value' => $value[$column_value],
                'display' => $value[$column_display],
            ];
            // $options['value'][] = $value[$column_value];
            // $options['display'][] = $value[$column_display];
        }
        // print_r($options);
        // die;
        return $options;
    }

}
