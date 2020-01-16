<?php

namespace App\Http\Controllers;

class ChartJS
{
    private $data;

    public function __construct()
    {

    }

    public function makeChart($data_query, $percentage = null)
    {
        if (!empty($data_query)) {
            $column_name = $this->getLabelQuery($data_query[0]);
            if ($percentage != null) {
                $get_data = $this->transformPercentage($data_query);
                $data_query = $get_data['data_query'];
                $maximo = $get_data['maximo'] + 1;
                foreach ($data_query as $key => $value) {
                    $labels[] = $value[$column_name];
                    $data_data[] = $value['total'];
                }
                $num_register = count($data_data);
                $arr_colors = $this->fillColorsBarChartVerifiedsDrivers($num_register);
            } else {
                foreach ($data_query as $key => $value) {
                    $labels[] = $value->$column_name;
                    $data_data[] = $value->total;
                }
                $maximo = max($data_data) + 1;
                $num_register = count($data_data);
                $arr_colors = $this->fillColorsBarChart($num_register);
            }

        } else {
            $arr_colors['backgroundColor'] = ['rgba(255, 99, 132, 0.2)'];
            $arr_colors['borderColor'] = ['rgba(255, 99, 132, 0.2)'];
            $data_data[] = ['0'];
            $labels[] = ['No data'];
            $maximo = 1;
        }
        // echo ' máximo '.$maximo;
        // die;

        if ($percentage != null) {
            $options = $this->createOptionsPercentage($maximo);
        } else {
            $options = $this->createOptions($maximo);
        }
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

    public function transformPercentage($data_query)
    {
        $sum = 0;
        $maximo = 0;
        foreach ($data_query as $key => $value) {
            $sum += $value->total;
            if ($maximo < $value->total) {
                $maximo = $value->total;
            }
            // echo '<pre>';
            // print_r($data_query);
            $data_query[$key] = (array) $value;
        }
        // print_r($data_query);
        // die;
        foreach ($data_query as $key => $value) {
            // echo ' || value: '.$value['total'].' sum: '.$sum.'  || ';
            $data_query[$key]['total'] = number_format(floatval(($value['total'] * 100) / $sum), 2);
        }
        return ['data_query' => $data_query, 'maximo' => $maximo];
    }

    public function getLabelQuery($element)
    {
        $element = (array) $element;
        // print_r($element);
        foreach ($element as $key => $value) {
            if ($key != "total") {
                return $key;
            }
        }
    }

    public function fillColorsBarChart($number)
    {
        $colors = [
            // 'rgba(29, 46, 61)',
            'rgba(87, 189, 215)',
            'rgba(104, 129, 139)',
            'rgba(189, 212, 223)',
            'rgba(207, 217, 227)',
            // 'rgba(63, 86, 105)',
            // 'rgba(63, 86, 105)',
            // 'rgba(209, 48, 144)',
            // 'rgba(234, 19, 25)',
            // 'rgba(241, 95, 72)',
            // 'rgba(255, 99, 132, 0.2)',
            // 'rgba(69, 153, 63, 0.2)',
            // 'rgba(240, 108, 33, 0.2)',
            // 'rgba(54, 162, 235, 0.2)',
            // 'rgba(255, 206, 86, 0.2)',
            // 'rgba(75, 192, 192, 0.2)',
            // 'rgba(153, 102, 255, 0.2)',
            // 'rgba(255, 159, 64, 0.2)',
        ];

        $borders_colors = [
            // 'rgba(29, 46, 61)',
            'rgba(87, 189, 215)',
            'rgba(104, 129, 139)',
            'rgba(189, 212, 223)',
            'rgba(207, 217, 227)',
            // 'rgba(63, 86, 105)',
            // 'rgba(63, 86, 105)',
            // 'rgba(209, 48, 144)',
            // 'rgba(234, 19, 25)',
            // 'rgba(241, 95, 72)',
            // 'rgba(255, 99, 132, 1)',
            // 'rgba(69, 153, 63, 1)',
            // 'rgba(240, 108, 33, 1)',
            // 'rgba(54, 162, 235, 1)',
            // 'rgba(255, 206, 86, 1)',
            // 'rgba(75, 192, 192, 1)',
            // 'rgba(153, 102, 255, 1)',
            // 'rgba(255, 159, 64, 1)',
        ];

        $borders = [];
        $bg_colors = [];
        $cursor_colors = 0;
        for ($i = 0; $i < $number; $i++) {
            if ($cursor_colors == 4) {
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

    public function fillColorsBarChartVerifiedsDrivers($number)
    {
        $colors = [
            'rgba(87, 213, 100)',
            'rgba(213, 87, 87)',
        ];

        $borders_colors = [
            'rgba(87, 213, 100)',
            'rgba(213, 87, 87)',
        ];
        $borders = [];
        $bg_colors = [];
        $cursor_colors = 0;
        for ($i = 0; $i < $number; $i++) {
            if ($cursor_colors == 2) {
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

    public function createOptions($maximo)
    {
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

    public function createOptionsPercentage($maximo)
    {
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
                    'formatter' => 'function(value, context) {
                        return context.dataIndex +"%";
                    }',
                ],
            ],
        ];
    }
}

// formatter: function(value, context) {
//     return context.dataIndex +'%';
// }
