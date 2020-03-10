function clickcito() {
    alert("todo nice")
}

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
        var index_fieldset = 0;
        $(".next").click(function () {
            // debugger
            let element_button = $(this);
            var $url_action = element_button.data('validate');
            let data_error = element_button.data("error");
            // let $form_data = $("#msform").serialize();
            let $form_data_arr = $("#msform").serializeArray();
            let index = $("#index_section").val();
            $form_data_arr.push({ name: 'index', value: parseInt(index) });

            current_fs = element_button.parent();
            next_fs = element_button.parent().next();
            if (typeof (next_fs.attr('data-doc')) !== "undefined") {
                $(".select_user_vehicle").html("")
                let dataArray = $("#msform").serializeArray();
                $(".select_user_vehicle").append("<option value=''>Seleccionar ...</option>");
                $(dataArray).each(function (i, field) {
                    if (field.name == "vehicle[plate_id][]") {
                        $(".select_user_vehicle").append("<option value='" + field.value + "'>" + field.value + "</option>");
                    }
                });
            }
            $.ajax({
                type: 'POST',
                url: $url_action,
                data: $form_data_arr,
            }).done(function (response) {
                // debugger
                if (typeof (current_fs.attr('data-vehicle')) !== "undefined") {
                    container_validate = current_fs.find("section:last-child");
                } else {
                    container_validate = current_fs;
                }
                if (!current_fs.hasErrorsForms(container_validate, response)) {
                    // if (true) {
                    //Add Class Active
                    if (typeof current_fs.data('endsection') !== "undefined") {
                        index_fieldset++;
                        $("#progressbar li").eq(index_fieldset).addClass("active");
                    }
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

            if (current_fs.find(".next").is(":hidden")==true){
                current_fs.find(".next").show()
            }
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