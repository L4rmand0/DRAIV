<?php

namespace App\Http\Controllers;

class ChartJS
{
    private $data;

    public function __construct() {
        
    }

    public function makeChart($data_query){
        // echo '<pre> make ';
        // print_r($data_query);
        // die;
        if (!empty($data_query)) {
            $column_name = $this->getLabelQuery($data_query[0]);
            foreach ($data_query as $key => $value) {
                $labels[] = $value->$column_name;
                $data_data[] = $value->total;
            }
            $num_register = count($data_data);
            $arr_colors = $this->fillColorsBarChart($num_register);
            $maximo = max($data_data) + 1;
        } else {
            $arr_colors['backgroundColor'] = ['rgba(255, 99, 132, 0.2)'];
            $arr_colors['borderColor'] = ['rgba(255, 99, 132, 0.2)'];
            $data_data[]=['0'];
            $labels[]=['No data'];
            $maximo = 1;
        }
        // echo ' máximo '.$maximo;
        // die;
        $options = $this->createOptions($maximo);
        $datasets['label'] = "Frecuencia Educación";
        $datasets['data'] = $data_data;
        $datasets['backgroundColor'] = $arr_colors['backgroundColor'];
        $datasets['borderColor'] = $arr_colors['borderColor'];
        $datasets['borderWidth'] = 1;
        $data['datasets'][] = $datasets;
        $data['labels'] = $labels;
        // return response()->json([]);
        return response()->json(['data' => $data, 'options' => $options, 'errors' => [], 'max' => $maximo]);
    }

    public function getLabelQuery($element){
        $element = (array) $element;
        // print_r($element);
        foreach ($element as $key => $value) {
            if($key != "total"){
                return $key;
            }
        }
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

    function createOptions($maximo){
        return [
            'display' => true,
            'scaleStartValue' => 0,
            'scales' => [
                'yAxes' => [[
                    'ticks' => [
                        'beginAtZero' => true,
                    ],
                ]],
                'xAxes' => [[
                    'ticks' => [
                        'min' => 0,
                        'max' => $maximo,
                    ],
                ]],
            ],
            'plugins' => [
                'datalabels' => [
                    'render' => 'label',
                    'font' => [
                        'weight' => 'bold',
                        'size' => 14,
                    ],
                ],
            ],
        ];
    }
}
