// IIFE - Immediately Invoked Function Expression
(function(runcode) {
    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function($, window, document) {
    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function() {
        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $("#msform input[type=text], #msform input[type=email], #msform input[type=password], #msform input[type=number]").on("keypress", function() {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });

        $("#msform input[type=checkbox]").on("change", function() {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });

        $("#msform").submit(function(event) {
            $target = $(this);
            let datasend = $target.serialize();
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: $target.attr("action"),
                data: datasend,
            }).done(function(response) {
                if (Object.keys(response.errors).length > 0) {
                    swal.fire(
                        'Error!',
                        response.error.response,
                        'error'
                    )
                } else {
                    location.href = $("#login_route").val()
                }
            });
        });

        $(".next").click(function() {
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();
            let data_form = $("#msform").serialize();
            if (current_fs.attr("id") == "account_fieldset") {
                $.ajax({
                    type: 'GET',
                    url: $("#register_validator").val(),
                    data: data_form,
                }).done(function(response) {
                    if (!current_fs.hasErrorsForms(current_fs, response)) {
                        //Add Class Active
                        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                        //show the next fieldset
                        next_fs.show();
                        //hide the current fieldset with style
                        current_fs.animate({ opacity: 0 }, {
                            step: function(now) {
                                // for making fielset appear animation
                                opacity = 1 - now;

                                current_fs.css({
                                    'display': 'none',
                                    'position': 'relative'
                                });
                                next_fs.css({ 'opacity': opacity });
                            },
                            duration: 500
                        });
                        setProgressBar(++current);
                    }
                });
            }
        });

        $(".previous").click(function() {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({ opacity: 0 }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({ 'opacity': opacity });
                },
                duration: 500
            });
            setProgressBar(--current);
        });

        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
        }

        $(".submit").click(function() {
            return false;
        })
    });


    // The rest of the code goes here!
}));