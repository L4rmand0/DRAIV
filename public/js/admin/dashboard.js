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
        var ele_chart_drivers_v = $("#drivers_v_chart");

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
        var chart_drivers_v;

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
            $("#card_driver_number").text("cargando ...");
            $("#card_vehicle_number").text("cargando ...");
            $("#man_number").text("...");
            $("#woman_number").text("...");
            $("#calification_average_number").text("cargando ...");
            $("#prox_expi_licences_number").text("cargando ...");
            $("#card_licence_expirated_number").text("cargando ...");
            $("#card_soat_expiration_number").text("cargando ...");
            $("#card_soat_expirated_number").text("cargando ...");
            $("#card_technomecanical_expiration_number").text("cargando ...");
            $("#card_technomecanical_expirated_number").text("cargando ...");

            makeBarChartEducationByDriver().done(function(response) {
                chart_education.data.datasets.forEach((dataset) => {
                    let data_index = dataset.data.length;
                    for (let index = 0; index < data_index; index++) {
                        dataset.data.pop();
                        chart_education.data.labels.pop();
                    }
                });
                chart_education.options.scales = response.options.scales;
                chart_education.data = response.data;
                chart_education.update();
            });

            makeBarChartCivilStateByDriver().done(function(response) {
                chart_civil_state.data.datasets.forEach((dataset) => {
                    let data_index = dataset.data.length;
                    for (let index = 0; index < data_index; index++) {
                        dataset.data.pop();
                        chart_civil_state.data.labels.pop();
                    }
                });
                chart_civil_state.options.scales = response.options.scales;
                chart_civil_state.data = response.data;
                chart_civil_state.update();
            });

            // chart_licence_state.destroy();
            makeBarChartLicenceStateByDriver().done(function(response) {
                chart_licence_state.data.datasets.forEach((dataset) => {
                    let data_index = dataset.data.length;
                    for (let index = 0; index < data_index; index++) {
                        dataset.data.pop();
                        chart_licence_state.data.labels.pop();
                    }
                });
                chart_licence_state.options.scales = response.options.scales;
                chart_licence_state.data = response.data;
                chart_licence_state.update();
            });
            // chart_category.destroy();
            makeBarChartCategoryByDriver().done(function(response) {
                chart_category.data.datasets.forEach((dataset) => {
                    let data_index = dataset.data.length;
                    for (let index = 0; index < data_index; index++) {
                        dataset.data.pop();
                        chart_category.data.labels.pop();
                    }
                });
                chart_category.options.scales = response.options.scales;
                chart_category.data = response.data;
                chart_category.update();
            });
            // chart_type_v.destroy();
            makeBarChartTypeVByDriver().done(function(response) {
                chart_type_v.data.datasets.forEach((dataset) => {
                    let data_index = dataset.data.length;
                    for (let index = 0; index < data_index; index++) {
                        dataset.data.pop();
                        chart_type_v.data.labels.pop();
                    }
                });
                chart_type_v.options.scales = response.options.scales;
                chart_type_v.data = response.data;
                chart_type_v.update();
            });
            // chart_owner_v.destroy();
            makePieChartOwnerVByDriver().done(function(response) {
                chart_owner_v.data.datasets.forEach((dataset) => {
                    let data_index = dataset.data.length;
                    for (let index = 0; index < data_index; index++) {
                        dataset.data.pop();
                        chart_owner_v.data.labels.pop();
                    }
                });
                chart_owner_v.options.scales = response.options.scales;
                chart_owner_v.data = response.data;
                chart_owner_v.update();
            });
            // chart_line_v.destroy();
            makePieChartLineVByDriver().done(function(response) {
                chart_line_v.data.datasets.forEach((dataset) => {
                    let data_index = dataset.data.length;
                    for (let index = 0; index < data_index; index++) {
                        dataset.data.pop();
                        chart_line_v.data.labels.pop();
                    }
                });
                chart_line_v.options.scales = response.options.scales;
                chart_line_v.data = response.data;
                chart_line_v.update();
            });
            // chart_brand_v.destroy();
            makePieChartBrandByDriver().done(function(response) {
                chart_brand_v.data.datasets.forEach((dataset) => {
                    let data_index = dataset.data.length;
                    for (let index = 0; index < data_index; index++) {
                        dataset.data.pop();
                        chart_brand_v.data.labels.pop();
                    }
                });
                chart_brand_v.options.scales = response.options.scales;
                chart_brand_v.data = response.data;
                chart_brand_v.update();
            });
            // chart_model_v.destroy();
            makePieChartModeldByDriver().done(function(response) {
                chart_model_v.data.datasets.forEach((dataset) => {
                    let data_index = dataset.data.length;
                    for (let index = 0; index < data_index; index++) {
                        dataset.data.pop();
                        chart_model_v.data.labels.pop();
                    }
                });
                chart_model_v.options.scales = response.options.scales;
                chart_model_v.data = response.data;
                chart_model_v.update();
            });
            getTotalDrivers();
            getTotalVehicles();
            getTotalGender();
            getCalificationAverage();
            getLicenceExpiration();
            getLicenceExpirated();
            getSoatExpiration();
            getSoatExpirated();
            getTechnomecanicalExpiration();
            getTechnomecanicalExpirated();
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
                        options: datac.options
                    });
                }
            }
        });

        $.ajax({
            type: 'POST',
            url: $("#function_drivers_verify").val(),
            data: {
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    chart_drivers_v = new Chart(ele_chart_drivers_v, {
                        type: 'doughnut',
                        data: datac.data,
                        options:
                        // datac.options
                        {
                            display: true,
                            scaleStartValue: 0,
                            scales: datac.options.scales,
                            plugins: {
                                datalabels: {
                                    render: 'label',
                                    font: {
                                        weight: 'bold',
                                        size: 14,
                                    },
                                    formatter: function(value, context) {
                                        return value + '%';
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
                                    },
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
                                    // render: 'label',
                                    render: 'percentage',
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
        // var new_chart_education;
        return $.ajax({
                // async: false,
                // cache: false,
                context: document.body,
                type: 'POST',
                url: $("#education_chart").data('url-driver'),
                data: {
                    'dni_id': $("#select_cc_driver").val(),
                    'company_id': $("#dashboard_company_id").val(),
                    "_token": $('#token').val()
                },
                success: function(datac) {
                    // console.log(datac);
                    // if (Object.keys(datac.errors).length > 0) {

                    // } else {
                    //     new_chart_education = new Chart(ele_chart_education, {
                    //         type: 'horizontalBar',
                    //         data: datac.data,
                    //         options: {
                    //             display: true,
                    //             scaleStartValue: 0,
                    //             scales: {
                    //                 yAxes: [{
                    //                     ticks: {
                    //                         beginAtZero: true,
                    //                     }
                    //                 }],
                    //                 xAxes: [{
                    //                     ticks: {
                    //                         min: 0,
                    //                         max: datac.max
                    //                     }
                    //                 }]
                    //             },
                    //             plugins: {
                    //                 datalabels: {
                    //                     render: 'label',
                    //                     font: {
                    //                         weight: 'bold',
                    //                         size: 14,
                    //                     }
                    //                 }
                    //             }
                    //         }
                    //     });
                    // }
                }
            })
            // .done(function() {
            //     $(this)
            //         // debugger
            //     alert("done")
            //     return new_chart_education;
            // });;
    }


    function makeBarChartCivilStateByDriver(ele_chart_civil_state, chart_civil_state) {
        return $.ajax({
            // async: false,
            // cache: false,
            type: 'POST',
            url: $("#function_barchart_civil_state").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            // success: function(datac) {
            //     console.log(datac);
            //     if (Object.keys(datac.errors).length > 0) {

            //     } else {
            //         chart_civil_state = new Chart(ele_chart_civil_state, {
            //             type: 'horizontalBar',
            //             data: datac.data,
            //             options: {
            //                 display: true,
            //                 scaleStartValue: 0,
            //                 scales: {
            //                     yAxes: [{
            //                         ticks: {
            //                             beginAtZero: true,
            //                         }
            //                     }],
            //                     xAxes: [{
            //                         ticks: {
            //                             min: 0,
            //                             max: datac.max
            //                         }
            //                     }]
            //                 },
            //                 plugins: {
            //                     datalabels: {
            //                         render: 'label',
            //                         font: {
            //                             weight: 'bold',
            //                             size: 14,
            //                         }
            //                     }
            //                 }
            //             }
            //         });
            //     }
            // }
        });
        // return chart_civil_state;
    }


    function makeBarChartLicenceStateByDriver() {
        return $.ajax({
            // async: false,
            // cache: false,
            type: 'POST',
            url: $("#function_barchart_licence_state").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            // success: function(datac) {
            //     console.log(datac);
            //     if (Object.keys(datac.errors).length > 0) {

            //     } else {
            //         chart_licence_state = new Chart(ele_chart_licence_state, {
            //             type: 'horizontalBar',
            //             data: datac.data,
            //             options: {
            //                 display: true,
            //                 scaleStartValue: 0,
            //                 scales: {
            //                     yAxes: [{
            //                         ticks: {
            //                             beginAtZero: true,
            //                         }
            //                     }],
            //                     xAxes: [{
            //                         ticks: {
            //                             min: 0,
            //                             max: datac.max
            //                         }
            //                     }]
            //                 },
            //                 plugins: {
            //                     datalabels: {
            //                         render: 'label',
            //                         font: {
            //                             weight: 'bold',
            //                             size: 14,
            //                         }
            //                     }
            //                 }
            //             }
            //         });
            //     }
            // }
        });
        // return chart_licence_state;
    }

    function makeBarChartCategoryByDriver() {
        return $.ajax({
            // async: false,
            // cache: false,
            type: 'POST',
            url: $("#function_barchart_category").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            // success: function(datac) {
            //     console.log(datac);
            //     if (Object.keys(datac.errors).length > 0) {

            //     } else {
            //         chart_category = new Chart(ele_chart_category, {
            //             type: 'horizontalBar',
            //             data: datac.data,
            //             options: {
            //                 display: true,
            //                 scaleStartValue: 0,
            //                 scales: {
            //                     yAxes: [{
            //                         ticks: {
            //                             beginAtZero: true,
            //                         }
            //                     }],
            //                     xAxes: [{
            //                         ticks: {
            //                             min: 0,
            //                             max: datac.max
            //                         }
            //                     }]
            //                 },
            //                 plugins: {
            //                     datalabels: {
            //                         render: 'label',
            //                         font: {
            //                             weight: 'bold',
            //                             size: 14,
            //                         }
            //                     }
            //                 }
            //             }
            //         });
            //     }
            // }
        });
        // return chart_category;
    }

    function makeBarChartTypeVByDriver() {
        return $.ajax({
            type: 'POST',
            url: $("#function_barchart_type_v").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
        });
    }

    function makePieChartOwnerVByDriver(ele_chart_owner_v, chart_owner_v) {
        return $.ajax({
            type: 'POST',
            url: $("#function_pie_owner_v").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
        });
    }

    function makePieChartLineVByDriver(ele_chart_line_v, chart_line_v) {
        return $.ajax({
            type: 'POST',
            url: $("#function_pie_line_v").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
        });
    }

    function makePieChartBrandByDriver(ele_chart_brand_v, chart_brand_v) {
        return $.ajax({
            type: 'POST',
            url: $("#function_pie_brand_v").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
        });
    }

    function makePieChartModeldByDriver() {
        return $.ajax({
            type: 'POST',
            url: $("#function_pie_model_v").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
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
            url: $("#function_total_vehicles").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    $("#card_vehicle_number").text(datac.response)
                }
            }
        });
    }

    function getTotalGender() {
        $.ajax({
            type: 'POST',
            url: $("#function_gender").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    $("#man_number").text(datac.response.man);
                    $("#woman_number").text(datac.response.woman);
                }
            }
        });
    }

    function getCalificationAverage() {
        $.ajax({
            type: 'POST',
            url: $("#function_calification_average").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    $("#calification_average_number").text(datac.response);
                }
            }
        });
    }

    function getLicenceExpiration() {
        $.ajax({
            type: 'POST',
            url: $("#function_licence_expiration").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    $("#prox_expi_licences_number").text(datac.response);
                }
            }
        });
    }

    function getLicenceExpirated() {
        $.ajax({
            type: 'POST',
            url: $("#function_licence_expirated").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    $("#card_licence_expirated_number").text(datac.response);
                }
            }
        });
    }

    function getSoatExpiration() {
        $.ajax({
            type: 'POST',
            url: $("#function_soat_expiration").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    $("#card_soat_expiration_number").text(datac.response);
                }
            }
        });
    }

    function getSoatExpirated() {
        $.ajax({
            type: 'POST',
            url: $("#function_soat_expirated").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    $("#card_soat_expirated_number").text(datac.response);
                }
            }
        });
    }

    function getTechnomecanicalExpiration() {
        $.ajax({
            type: 'POST',
            url: $("#function_technomecanical_expiration").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    $("#card_technomecanical_expiration_number").text(datac.response);
                }
            }
        });
    }

    function getTechnomecanicalExpirated() {
        $.ajax({
            type: 'POST',
            url: $("#function_technomecanical_expirated").val(),
            data: {
                'dni_id': $("#select_cc_driver").val(),
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function(datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    $("#card_technomecanical_expirated_number").text(datac.response);
                }
            }
        });
    }

    // The rest of the code goes here!
}));