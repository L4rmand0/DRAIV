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
                // Revisa si el input o el select están visibles
                checkInputOrSelectDrivers();
                $(".doc_v_date_penality").datepicker({ dateFormat: 'yy-mm-dd' });
                $("#driver_select_evaluation").on('change', function () {
                    $select = $(this);
                    dni_id = $select.val();
                    $.post($("#function-list-driver-vehicles").val(), { 'dni_id': dni_id }).done(function (response) {
                        console.log(response);
                        if (Object.keys(response.errors).length > 0) {

                        } else {
                            generateCardSkills(response);
                            generateCardDocvVehicle(response);
                            generateCardMotorTechnology(response);
                            generateCardMotoMehcanicalConditions(response);
                            generateCardElementPersonalProtection(response);
                            // ----- Limpia los estilos de error en los formularios -----
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
        $("#msform #fs_skills input[type=text], #msform  #fs_skills input[type=email], #msform #fs_skills input[type=password], #msform #fs_skills input[type=number], #msform #fs_skills input[type=tel]").on("keypress", function () {
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
    }

    function generateCardDocvVehicle(response) {
        let cards = "";
        $.each(response.data, function (k, v) {
            let plate_id = v["plate_id"];
            let card_auto = $("#example_card_doc_v_vehicle").html();
            card_auto = card_auto.replace(/&amp;PLACA/g, String(plate_id));
            cards += card_auto;
        })
        $("#accordion_doc_verification_vehicle").html(cards);
        if ($(".doc_v_v_expi_date").hasClass("hasDatepicker")) {
            // $(".date_vehicle").datepicker( "destroy" );
            $(".doc_v_v_expi_date").removeClass("hasDatepicker");
            $(".doc_v_v_expi_date").datepicker({ dateFormat: 'yy-mm-dd' });
        } else {
            $(".doc_v_v_expi_date").datepicker({ dateFormat: 'yy-mm-dd' });
        }
        $("#msform #fs_doc_v_vehicle input[type=text], #msform  #fs_doc_v_vehicle input[type=email], #msform #fs_doc_v_vehicle input[type=password], #msform #fs_doc_v_vehicle input[type=number], #msform #fs_doc_v_vehicle input[type=tel]").on("keypress", function () {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });
        $("#msform #fs_doc_v_vehicle input[type=text], #msform #fs_doc_v_vehicle input[type=email], #msform #fs_doc_v_vehicle input[type=password], #msform #fs_doc_v_vehicle input[type=number], #msform #fs_doc_v_vehicle input[type=tel], #msform #fs_doc_v_vehicle input[type=date]").on("change", function () {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });
        $("#msform #fs_doc_v_vehicle input[type=checkbox], #msform #fs_doc_v_vehicle select").on("change", function () {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });
    }

    function generateCardMotorTechnology(response) {
        let cards = "";
        $.each(response.data, function (k, v) {
            let plate_id = v["plate_id"];
            let card_auto = $("#example_card_motorcycle_technology").html();
            card_auto = card_auto.replace(/&amp;PLACA/g, String(plate_id));
            cards += card_auto;
        })
        $("#accordion_motorcycle_technology_vehicle").html(cards);
        $("#msform #fs_motor_technology input[type=text], #msform  #fs_motor_technology input[type=email], #msform #fs_motor_technology input[type=password], #msform #fs_motor_technology input[type=number], #msform #fs_motor_technology input[type=tel]").on("keypress", function () {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });
        $("#msform #fs_motor_technology input[type=text], #msform #fs_motor_technology input[type=email], #msform #fs_motor_technology input[type=password], #msform #fs_motor_technology input[type=number], #msform #fs_motor_technology input[type=tel], #msform #fs_motor_technology input[type=date]").on("change", function () {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });
        $("#msform #fs_motor_technology input[type=checkbox], #msform #fs_motor_technology select").on("change", function () {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });
    }

    function generateCardMotoMehcanicalConditions(response) {
        let cards = "";
        $.each(response.data, function (k, v) {
            let plate_id = v["plate_id"];
            let card_auto = $("#example_card_moto_mechanical_conditions").html();
            card_auto = card_auto.replace(/&amp;PLACA/g, String(plate_id));
            cards += card_auto;
        })
        $("#accordion_moto_mechanical_conditions").html(cards);
        $("#msform #fs_moto_mechanicals_conditions input[type=text], #msform  #fs_moto_mechanicals_conditions input[type=email], #msform #fs_moto_mechanicals_conditions input[type=password], #msform #fs_moto_mechanicals_conditions input[type=number], #msform #fs_moto_mechanicals_conditions input[type=tel]").on("keypress", function () {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });
        $("#msform #fs_moto_mechanicals_conditions input[type=text], #msform #fs_moto_mechanicals_conditions input[type=email], #msform #fs_moto_mechanicals_conditions input[type=password], #msform #fs_moto_mechanicals_conditions input[type=number], #msform #fs_moto_mechanicals_conditions input[type=tel], #msform #fs_moto_mechanicals_conditions input[type=date]").on("change", function () {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });
        $("#msform #fs_moto_mechanicals_conditions input[type=checkbox], #msform #fs_moto_mechanicals_conditions select").on("change", function () {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });
    }

    function generateCardElementPersonalProtection(response) {
        let cards = "";
        $.each(response.data, function (k, v) {
            let plate_id = v["plate_id"];
            let card_auto = $("#example_card_epp").html();
            card_auto = card_auto.replace(/&amp;PLACA/g, String(plate_id));
            cards += card_auto;
        })
        $("#accordion_epp").html(cards);
        $("#msform #fs_epp input[type=text], #msform  #fs_epp input[type=email], #msform #fs_epp input[type=password], #msform #fs_epp input[type=number], #msform #fs_epp input[type=tel]").on("keypress", function () {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });
        $("#msform #fs_epp input[type=text], #msform #fs_epp input[type=email], #msform #fs_epp input[type=password], #msform #fs_epp input[type=number], #msform #fs_epp input[type=tel], #msform #fs_epp input[type=date]").on("change", function () {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });
        $("#msform #fs_epp input[type=checkbox], #msform #fs_epp select").on("change", function () {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });
    }

    function checkInputOrSelectDrivers() {
        $input = $(".item_input_evaluation");
        dni_id = $input.val();
        if ($input.is(":visible")) {
            $.post($("#function-list-driver-vehicles").val(), { 'dni_id': dni_id,"_token": $('#token').val() }).done(function (response) {
                console.log(response);
                if (Object.keys(response.errors).length > 0) {

                } else {
                    generateCardSkills(response);
                    generateCardDocvVehicle(response);
                    generateCardMotorTechnology(response);
                    generateCardMotoMehcanicalConditions(response);
                    generateCardElementPersonalProtection(response);
                    // ----- Limpia los estilos de error en los formularios -----

                    // ------- Termina limpiar el formulario -------
                }
            });
        }
    }
    // The rest of the code goes here!
}));