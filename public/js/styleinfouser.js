(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    // Listen for the jQuery ready event on the document
    $(function () {
        var error_founds = 0;
        $(".next").click(function () {
            let element_button = $(this);
            var $url_action = element_button.data('validate');
            let data_error = element_button.data("error");
            let $form_data = $("#msform").serialize();

            current_fs = element_button.parent();
            next_fs = element_button.parent().next();

            $.ajax({
                type: 'POST',
                url: $url_action,
                data: $form_data,
            }).done(function (response) {
                if (!current_fs.hasErrorsForms(current_fs, response)) {
                    //Add Class Active
                    // $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
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