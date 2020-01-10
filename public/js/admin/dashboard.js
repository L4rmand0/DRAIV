// IIFE - Immediately Invoked Function Expression
(function(runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function($, window, document) {

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function() {

        var ele_chart_education = $("#education_chart");
        var ele_chart_civil_state = $("#civil_state_chart");
        var ele_chart_category = $("#category_chart");
        var ele_chart_licence_state = $("#driving_licence_state_chart");
        var ele_chart_type_v = $("#type_v_chart");
        var ele_chart_owner_v = $("#owner_v_chart");
        var ele_chart_line_v = $("#line_v_chart");
        var ele_chart_brand_v = $("#brand_v_chart");
        var ele_chart_model_v = $("#model_v_chart");

        //Charts
        var chart_education;
        var chart_civil_state;
        var chart_licence_state;
        var chart_category;
        var chart_type_v;
        var chart_owner_v;
        var chart_line_v;
        var chart_brand_v;
        var chart_model_v;

        $.ajax({
            type: 'GET',
            url: $('#select_cc_driver').data('url'),
            data: { 'type': 'select_admin2' },
            success: function(data) {
                $("#select_cc_driver").show();
                $('#select_cc_driver').select2({
                    data: data
                });
            }
        });

        // $("#report_generate").on('click', function() {
        // alert("hola")
        // var labels = ["naruto", "goku", "picolo", "gohan"];
        // var data_up = [20, 30, 50, 60];
        // addData(chart_education, labels, data_up);

        // });

        // function addData(chart, label, data) {
        //     chart.data.labels.push(label);
        //     chart.data.datasets.forEach((dataset) => {
        //         dataset.data.push(data);
        //     });
        //     chart.update();
        // }

        $("#select_cc_driver").on('change', function() {
            chart_education.destroy();
            makeBarChartEducationByDriver(ele_chart_education, chart_education);
            chart_civil_state.destroy();
            makeBarChartCivilStateByDriver(ele_chart_civil_state, chart_civil_state);
            chart_licence_state.destroy();
            makeBarChartLicenceStateByDriver(ele_chart_licence_state, chart_licence_state);
            chart_category.destroy();
            makeBarChartCategoryByDriver(ele_chart_category, chart_category);
            chart_type_v.destroy();
            makeBarChartTypeVByDriver(ele_chart_type_v, chart_type_v);
            chart_owner_v.destroy();
            makePieChartOwnerVByDriver(ele_chart_owner_v, chart_owner_v);
            chart_line_v.destroy();
            makePieChartLineVByDriver(ele_chart_line_v, chart_line_v);
            chart_brand_v.destroy();
            makePieChartBrandByDriver(ele_chart_brand_v, chart_brand_v);
            chart_model_v.destroy();
            makePieChartModeldByDriver(ele_chart_model_v, chart_model_v);
            getTotalDrivers();
        });

        $.ajax({
            type: 'POST',
            url: $("#function_barchart_education").val(),
            data: {
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);

                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_education = new Chart(ele_chart_education, {
                        type: 'horizontalBar',
                        data: datac.data,
                        options: {
                            display: true,
                            scaleStartValue: 0,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        min: 0,
                                        max: datac.max
                                    }
                                }]
                            },
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });

        $.ajax({
            type: 'POST',
            url: $("#function_barchart_civil_state").val(),
            data: {
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);

                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_civil_state = new Chart(ele_chart_civil_state, {
                        type: 'horizontalBar',
                        data: datac.data,
                        options: {
                            display: true,
                            scaleStartValue: 0,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        min: 0,
                                        max: datac.max
                                    }
                                }]
                            },
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });

        $.ajax({
            type: 'POST',
            url: $("#function_barchart_category").val(),
            data: {
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_category = new Chart(ele_chart_category, {
                        type: 'horizontalBar',
                        data: datac.data,
                        options: {
                            display: true,
                            scaleStartValue: 0,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        min: 0,
                                        max: datac.max
                                    }
                                }]
                            },
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });

        $.ajax({
            type: 'POST',
            url: $("#function_barchart_licence_state").val(),
            data: {
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_licence_state = new Chart(ele_chart_licence_state, {
                        type: 'horizontalBar',
                        data: datac.data,
                        options: {
                            display: true,
                            scaleStartValue: 0,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        min: 0,
                                        max: datac.max
                                    }
                                }]
                            },
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });

        $.ajax({
            type: 'POST',
            url: $("#function_barchart_type_v").val(),
            data: {
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_type_v = new Chart(ele_chart_type_v, {
                        type: 'horizontalBar',
                        data: datac.data,
                        options: {
                            display: true,
                            scaleStartValue: 0,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        min: 0,
                                        max: datac.max
                                    }
                                }]
                            },
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });

        $.ajax({
            type: 'POST',
            url: $("#function_pie_owner_v").val(),
            data: {
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_owner_v = new Chart(ele_chart_owner_v, {
                        type: 'pie',
                        data: datac.data,
                        options: {
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }

                            }
                        }
                    });
                }
            }
        });

        $.ajax({
            type: 'POST',
            url: $("#function_pie_line_v").val(),
            data: {
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_line_v = new Chart(ele_chart_line_v, {
                        type: 'pie',
                        data: datac.data,
                        options: {
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }

                            }
                        }
                    });
                }
            }
        });

        $.ajax({
            type: 'POST',
            url: $("#function_pie_brand_v").val(),
            data: {
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_brand_v = new Chart(ele_chart_brand_v, {
                        type: 'polarArea',
                        data: datac.data,
                        options: {
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }

                            }
                        }
                    });
                }
            }
        });

        $.ajax({
            type: 'POST',
            url: $("#function_pie_model_v").val(),
            data: {
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_model_v = new Chart(ele_chart_model_v, {
                        type: 'polarArea',
                        data: datac.data,
                        options: {
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }

                            }
                        }
                    });
                }
            }
        });


    });

    function makeBarChartEducationByDriver(ele_chart_education, chart_education) {
        $.ajax({
            type: 'POST',
            url: $("#education_chart").data('url-driver'),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_education = new Chart(ele_chart_education, {
                        type: 'horizontalBar',
                        data: datac.data,
                        options: {
                            display: true,
                            scaleStartValue: 0,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        min: 0,
                                        max: datac.max
                                    }
                                }]
                            },
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });
    }


    function makeBarChartCivilStateByDriver(ele_chart_civil_state, chart_civil_state) {
        $.ajax({
            type: 'POST',
            url: $("#function_barchart_civil_state").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_civil_state = new Chart(ele_chart_civil_state, {
                        type: 'horizontalBar',
                        data: datac.data,
                        options: {
                            display: true,
                            scaleStartValue: 0,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        min: 0,
                                        max: datac.max
                                    }
                                }]
                            },
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });
    }

    function makeBarChartLicenceStateByDriver(ele_chart_licence_state, chart_licence_state) {
        $.ajax({
            type: 'POST',
            url: $("#function_barchart_licence_state").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_licence_state = new Chart(ele_chart_licence_state, {
                        type: 'horizontalBar',
                        data: datac.data,
                        options: {
                            display: true,
                            scaleStartValue: 0,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        min: 0,
                                        max: datac.max
                                    }
                                }]
                            },
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });
    }

    function makeBarChartLicenceStateByDriver(ele_chart_category, chart_licence_state) {
        $.ajax({
            type: 'POST',
            url: $("#function_barchart_licence_state").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_licence_state = new Chart(ele_chart_licence_state, {
                        type: 'horizontalBar',
                        data: datac.data,
                        options: {
                            display: true,
                            scaleStartValue: 0,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        min: 0,
                                        max: datac.max
                                    }
                                }]
                            },
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });
    }

    function makeBarChartLicenceStateByDriver(ele_chart_licence_state, chart_licence_state) {
        $.ajax({
            type: 'POST',
            url: $("#function_barchart_licence_state").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_licence_state = new Chart(ele_chart_licence_state, {
                        type: 'horizontalBar',
                        data: datac.data,
                        options: {
                            display: true,
                            scaleStartValue: 0,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        min: 0,
                                        max: datac.max
                                    }
                                }]
                            },
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });
    }

    function makeBarChartCategoryByDriver(ele_chart_category, chart_category) {
        $.ajax({
            type: 'POST',
            url: $("#function_barchart_category").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_category = new Chart(ele_chart_category, {
                        type: 'horizontalBar',
                        data: datac.data,
                        options: {
                            display: true,
                            scaleStartValue: 0,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        min: 0,
                                        max: datac.max
                                    }
                                }]
                            },
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });
    }

    function makeBarChartTypeVByDriver(ele_chart_type_v, chart_type_v) {
        $.ajax({
            type: 'POST',
            url: $("#function_barchart_type_v").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_type_v = new Chart(ele_chart_type_v, {
                        type: 'horizontalBar',
                        data: datac.data,
                        options: {
                            display: true,
                            scaleStartValue: 0,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        min: 0,
                                        max: datac.max
                                    }
                                }]
                            },
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });
    }

    function makePieChartOwnerVByDriver(ele_chart_owner_v, chart_owner_v) {
        $.ajax({
            type: 'POST',
            url: $("#function_pie_owner_v").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_owner_v = new Chart(ele_chart_owner_v, {
                        type: 'pie',
                        data: datac.data,
                        options: {
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }

                            }
                        }
                    });
                }
            }
        });
    }

    function makePieChartLineVByDriver(ele_chart_line_v, chart_line_v) {
        $.ajax({
            type: 'POST',
            url: $("#function_pie_line_v").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_line_v = new Chart(ele_chart_line_v, {
                        type: 'pie',
                        data: datac.data,
                        options: {
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }

                            }
                        }
                    });
                }
            }
        });
    }

    function makePieChartBrandByDriver(ele_chart_brand_v, chart_brand_v) {
        $.ajax({
            type: 'POST',
            url: $("#function_pie_brand_v").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_brand_v = new Chart(ele_chart_brand_v, {
                        type: 'polarArea',
                        data: datac.data,
                        options: {
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }

                            }
                        }
                    });
                }
            }
        });
    }

    function makePieChartModeldByDriver(ele_chart_model_v, chart_model_v) {
        $.ajax({
            type: 'POST',
            url: $("#function_pie_model_v").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_model_v = new Chart(ele_chart_model_v, {
                        type: 'polarArea',
                        data: datac.data,
                        options: {
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    }
                                }

                            }
                        }
                    });
                }
            }
        });
    }

    function getTotalDrivers() {
        $.ajax({
            type: 'POST',
            url: $("#function_total_drivers").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    $("#card_driver_number").text(datac.response)
                }
            }
        });
    }

    function getTotalVehicles() {
        $.ajax({
            type: 'POST',
            url: $("#function_total_drivers").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    $("#card_driver_number").text(datac.response)
                }
            }
        });
    }

    // The rest of the code goes here!
}));