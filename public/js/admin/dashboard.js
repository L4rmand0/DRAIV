// IIFE - Immediately Invoked Function Expression
(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {
        var ele_chart_education = $("#education_chart");

        $.ajax({
            type: 'POST',
            url: $("#function_barchart_education").val(),
            data: {
                'company_id': $("#dashboard_company_id").val(),
                "_token": $('#token').val()
            },
            success: function (data) {
                if (data.error == "") {
                } else {

                       
                }
            }
        });

        var chart_education = new Chart(ele_chart_education, {
            type: 'horizontalBar',
            data:
            {
                labels: ['Ninguno', 'primaria', 'secundaria', 'pregrado', 'postgrado', 'Sin información'],
                datasets: [{
                    label: 'Frecuencia',
                    data: [12, 19, 3, 5, 3, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        

    });


    // The rest of the code goes here!
}));

