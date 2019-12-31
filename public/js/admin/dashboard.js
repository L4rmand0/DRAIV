// IIFE - Immediately Invoked Function Expression
(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {
        var ele_chart_education = $("#education_chart");
        var ele_chart_civil_state = $("#civil_state_chart");
        var ele_chart_category = $("#category_chart");
        var ele_chart_licence_state = $("#driving_licence_state_chart");

        $.ajax({
            type: 'POST',
            url: $("#function_barchart_education").val(),
            data: {
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function (datac) {
                console.log(datac);
                
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    var chart_education = new Chart(ele_chart_education, {
                        type: 'horizontalBar',
                        data: 
                        datac.data,
                        options: {
                            display:true,
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
                                        max:datac.max
                                    }
                                }]
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
            success: function (datac) {
                console.log(datac);
                
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    var chart_civil_state = new Chart(ele_chart_civil_state, {
                        type: 'horizontalBar',
                        data: 
                        datac.data,
                        options: {
                            display:true,
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
                                        max:datac.max
                                    }
                                }]
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
            success: function (datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    var chart_category = new Chart(ele_chart_category, {
                        type: 'horizontalBar',
                        data: 
                        datac.data,
                        options: {
                            display:true,
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
                                        max:datac.max
                                    }
                                }]
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
            success: function (datac) {
                console.log(datac);
                if (Object.keys(datac.errors).length > 0) {

                } else {
                    var chart_licence_state = new Chart(ele_chart_licence_state, {
                        type: 'horizontalBar',
                        data: 
                        datac.data,
                        options: {
                            display:true,
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
                                        max:datac.max
                                    }
                                }]
                            }
                        }
                    });
                }
            }
        });


    });


    // The rest of the code goes here!
}));

