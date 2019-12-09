(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    // Listen for the jQuery ready event on the document
    $(function () {
        let arr_inputs_errors = {
            'info_user': {
                '1': 'small_f_name',
                '2': 'small_f_lastname',
                '3': 'small_s_lastname',
                '4': 'small_email',
                '5': 'small_dni_id',
                '6': 'small_gender',
                '7': 'small_education',
                '8': 'small_country',
                '9': 'small_civil_state',
                '10': 'small_address',
                '11': 'small_phone'
            },
            'driving_licence': {
                '1': 'small_licence_num',
                '2': 'small_country_expedition',
                '3': 'small_category',
                '4': 'small_state',
                '5': 'small_expidition_day',
                '6': 'small_expi_date',
            },
            'vehicle': {
                '1': 'small_plate_id',
                '2': 'small_type_v',
                '3': 'small_owner_v',
                '4': 'small_soat_expi_date',
                '5': 'small_capacity',
                '6': 'small_Expi_date',
            }
        };
        var error_founds = 0;
        $(".next").click(function () {
            debugger
            let element_button = $(this);
            let url_action = element_button.data("url");
            let data_error = element_button.data("error");
            let form_data = $("#msform").serialize();
            $.post(url_action, form_data, function (result) {
                $(".small_forms").hide();
                if (!$.isEmptyObject(result.error)) {
                    let arr_errores = result.error;
                    $.each(arr_errores, function (index, value) {
                        // console.log("En el índice "+index+" value: "+value);
                        let selector = "#" + arr_inputs_errors[data_error][index];
                        $(selector).show();
                        $(selector).text(value);
                        error_founds = error_founds + 1;
                    });
                } else {
                    current_fs = element_button.parent();
                    next_fs = element_button.parent().next();

                    //Add Class Active
                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                    //show the next fieldset
                    next_fs.show();
                    //hide the current fieldset with style
                    current_fs.animate({ opacity: 0 }, {
                        step: function (now) {
                            // for making fielset appear animation
                            opacity = 1 - now;

                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            next_fs.css({ 'opacity': opacity });
                        },
                        duration: 600
                    });
                }
            });
            // }
        });

        $(".previous").click(function () {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({ opacity: 0 }, {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({ 'opacity': opacity });
                },
                duration: 600
            });
        });

        $('.radio-group .radio').click(function () {
            $(this).parent().find('.radio').removeClass('selected');
            $(this).addClass('selected');
        });

        $(".submit").click(function () {
            return false;
        });


    });

    // The rest of the code goes here!
}));