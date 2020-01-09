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

        $("#select_cc_driver").on('change', function() {
            alert("Cambia")
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
                    var chart_education = new Chart(ele_chart_education, {
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
                    var chart_civil_state = new Chart(ele_chart_civil_state, {
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
                    var chart_category = new Chart(ele_chart_category, {
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
                    var chart_licence_state = new Chart(ele_chart_licence_state, {
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
                    var chart_type_v = new Chart(ele_chart_type_v, {
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
                    var chart_owner_v = new Chart(ele_chart_owner_v, {
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
                    var chart_owner_v = new Chart(ele_chart_line_v, {
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
                    var chart_owner_v = new Chart(ele_chart_brand_v, {
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
                    var chart_model_v = new Chart(ele_chart_model_v, {
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


    // The rest of the code goes here!
}));