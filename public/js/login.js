// IIFE - Immediately Invoked Function Expression


(function(runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function($, window, document) {

    // Listen for the jQuery ready event on the document
    $(function() {

        $("#register_form").submit(function(event) {
            let $form = $(this);
            event.preventDefault();
            let data_form = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $form.attr("action"),
                data: data_form,
                success: function(data) {
                    $(".error-strong").text("");
                    if (Object.keys(data.errors).length > 0) {
                        let arr_errores = data.errors;
                        console.log(arr_errores);
                        $.each(arr_errores, function(index, value) {
                            let selector = "#" + index + "-error";
                            let selector_strong = "#" + index + "-error-strong";
                            $(selector).show();
                            $(selector_strong).text(value[0]);
                        });
                    } else {
                        $("#form_user_admin input[type=text]").val("");
                        $("#form_user_admin input[type=password]").val("");
                        $("#form_user_admin select").val("");
                        $("#form_user_admin input[type=email]").val("");
                        $("#defaultChecked2").prop('checked', false);
                        $('#form_create_user').modal('hide');
                        swal.fire(
                            'Proceso Completado!',
                            data.success,
                            'success'
                        )
                    }
                }
            });

        })

        $("#btn_free_plan").on('click', function() {
            // Manejo del color de los botones
            $(this).css("background", '#fff');
            $("#btn_medium_plan").css("background", "#EDE6DD");
            $("#btn_all_plan").css("background", "#EDE6DD");
            // Manejo de la clase active
            $("#btn_medium_plan").removeClass("active");
            $("#btn_all_plan").removeClass("active");
            $(this).addClass("active");
            // Manejo de mostrar y ocultar los cards
            $("#medium_plan").hide();
            $("#all_plan").hide();
            $("#free_plan").show();
        });
        $("#btn_medium_plan").on('click', function() {
            // Manejo del color de los botones
            $(this).css("background", '#fff');
            $("#btn_free_plan").css("background", "#EDE6DD");
            $("#btn_all_plan").css("background", "#EDE6DD");
            // Manejo de la clase active
            $("#btn_free_plan").removeClass("active");
            $("#btn_all_plan").removeClass("active");
            $(this).addClass("active");
            // Manejo de mostrar y ocultar los cards
            $("#free_plan").hide();
            $("#all_plan").hide();
            $("#medium_plan").show();
            $("#medium_plan").attr("hidden", false);
        });
        $("#btn_all_plan").on('click', function() {
            // Manejo del color de los botones
            $(this).css("background", '#fff');
            $("#btn_free_plan").css("background", "#EDE6DD");
            $("#btn_medium_plan").css("background", "#EDE6DD");
            // Manejo de la clase active
            $("#btn_free_plan").removeClass("active");
            $("#btn_medium_plan").removeClass("active");
            $(this).addClass("active");
            // Manejo de mostrar y ocultar los cards
            $("#medium_plan").hide();
            $("#free_plan").hide();
            $("#all_plan").show();
            $("#all_plan").attr("hidden", false);
        });

        $("#btn_call_login").on('click', function() {
            $("#login_card").show();
            $("#register_card").hide();
        });

        $("#btn_call_register").on('click', function() {
            $("#login_card").hide();
            $("#register_card").show();
            $("#register_card").attr("hidden", false);
        });

    });
    // The rest of the code goes here!
}));