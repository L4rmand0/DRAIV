(function (runcode) {
    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {
    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {
        (function (runcode) {
            // The global jQuery object is passed as a parameter
            runcode(window.jQuery, window, document);

        }(function ($, window, document) {
            // The $ is now locally scoped 
            // Listen for the jQuery ready event on the document
            $(function () {
                $("#driver_select_evaluation").on('change', function () {
                    $select = $(this);
                    dni_id = $select.val();
                    $.post($("#function-list-driver-vehicles").val(), { 'dni_id': dni_id }).done(function (response) {
                        console.log(response);
                        if (Object.keys(response.errors).length > 0) {

                        } else {
                            generateCardSkills(response);
                            generateCardDocvVehicle(response);
                            // ----- Limpia los estilos de error en los formularios -----
                            $("#msform #fs_skills input[type=text], #msform  #fs_skillsinput[type=email], #msform #fs_skills input[type=password], #msform #fs_skills input[type=number], #msform #fs_skills input[type=tel]").on("keypress", function () {
                                let $target = $(this);
                                $(this).cleanErrorElementForm($target);
                            });
                            $("#msform #fs_skills input[type=text], #msform #fs_skills input[type=email], #msform #fs_skills input[type=password], #msform #fs_skills input[type=number], #msform #fs_skills input[type=tel], #msform #fs_skills input[type=date]").on("change", function () {
                                let $target = $(this);
                                $(this).cleanErrorElementForm($target);
                            });
                            $("#msform #fs_skills input[type=checkbox], #msform #fs_skills select").on("change", function () {
                                let $target = $(this);
                                $(this).cleanErrorElementForm($target);
                            });
                            // ------- Termina limpiar el formulario -------
                        }
                    });
                });
            });
            // The rest of the code goes here!
        }));
    });

    function generateCardSkills(response) {
        let cards = "";
        if (response.has_autos) {
            let card_auto = $("#example_card_skill").html();
            card_auto = card_auto.replace(/&amp;TYPE_VEHICLE/g, "Autos");
            cards = card_auto;
            $("#has_autos").val("true")
        }
        if (response.has_motos) {
            let card_moto = $("#example_card_skill").html();
            card_moto = card_moto.replace(/&amp;TYPE_VEHICLE/g, "Motos");
            cards += card_moto;
            $("#has_motos").val("true")
        }
        $("#accordion_skills").html(cards);
    }

    function generateCardDocvVehicle(response){
        let cards = "";
        $.each(response.data,function(k,v){
            let plate_id = v["plate_id"];
            let card_auto = $("#example_card_doc_v_vehicle").html();
            card_auto = card_auto.replace(/&amp;PLACA/g, String(plate_id));
            cards+=card_auto;
        })
        $("#accordion_doc_verification_vehicle").html(cards);
    }
    // The rest of the code goes here!
}));