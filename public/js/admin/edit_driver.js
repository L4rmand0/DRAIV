// IIFE - Immediately Invoked Function Expression
(function (runcode) {
    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {

    //Titúlos que deben ser llenados con información
    var titles = [
        'dni_id', 'phone'
    ];

    var input_event = false;

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {
        $("#form_search_information").submit(function (event) {
            event.preventDefault();
            $form = $(this);
            //Revisa si el contenedor de información de conductor está oculto
            if ($("#container_card_driver").is(":visible")) {
                $("#container_card_driver").hide();
            }
            if($("#search_param").val()==""){
                swal.fire(
                    'Información requerida!',
                    'Se debe elegir elegir un parámetro de búsqueda.',
                    'warning'
                )
                $("#search_param").focus();
                return
            }
            $.post($("#route-search-information").val(), $form.serialize())
                .done(function (response) {
                    console.log(response);
                    target_element = "nav-driver-information";
                    if (response.response == "no data") {
                        swal.fire(
                            'Información no encontrada!',
                            response.message,
                            'warning'
                        )
                    } else {
                        $("#container_card_driver").attr('hidden', false);
                        $("#container_card_driver").show('hidden', false);
                        fillTitles(response.data, titles);
                        fillInformation(target_element, response.data);
                        fillNameDriver(response.data);
                        fillExpiredSoat(response);
                        generateCardsVehicle(response.vehicles);
                        generateCardsHumanComponent(response.doc_verification_d);
                        $(".field_driver_info_date").datepicker({ dateFormat: 'yy-mm-dd', changeYear: true, yearRange: "-100:+0" });
                        $(".field_driver_info_date").on('click', function () {
                            let $input = $(this);
                            let field = $input.attr("id");
                            let old_val = $input.val();
                            $input.on('change', function () {
                                let new_val = $input.val();
                                if (old_val != new_val) {
                                    inputLookChange($input, field, old_val, new_val);
                                }
                            });
                        });

                        $(".field_driver_info").on('click', function () {
                            let $input = $(this);
                            let old_val = $input.val();
                            $input.attr("readonly", false);
                            $input.off("blur keyup");
                            $input.on('blur keyup', function (e) {
                                let new_val = $input.val();
                                let field = $input.attr("id");
                                if (e.type == "keyup") {
                                    if (e.key == "Enter" && new_val != old_val) {
                                        console.log("event keyup ");
                                        $input.off("blur");
                                        //Se apaga el evento blur
                                        inputLookChange($input, field, old_val, new_val);
                                        $input.attr("readonly", true);
                                    } else if (e.key == "Enter" && new_val != old_val) {
                                        $input.attr("readonly", true);
                                    } else if (e.key == "Escape") {
                                        $input.val(old_val);
                                        $input.attr("readonly", true);
                                    }
                                } else if (e.type == "blur") {
                                    if (new_val != old_val) {
                                        $input.off("keyup");
                                        console.log("event blur ");
                                        inputLookChange($input, field, old_val, new_val);
                                    } else {
                                        $input.attr("readonly", true);
                                    }
                                }
                            });
                        });
                        $(".field_driver_info_select").on('click', function (event) {
                            console.log("event: " + event.type);
                            let $input = $(this);
                            let old_val = $input.val();
                            $col = $input.parent();
                            $select = $col.find('select');
                            //muestra el select con la información y oculta el input
                            $input.hide();
                            $select.attr('hidden', false);
                            //pone en selected el valo en base de datos
                            $select.children().filter(function () {
                                return this.text == old_val;
                            }).prop('selected', true)
                            $select.show();
                            $select.focus();
                            //Desactiva los eventos activados anteriormente
                            $select.off("blur");
                            $select.off("keyup");
                            $select.off("change");
                            $select.on('blur keyup change', function (e) {
                                let new_val = $select[0].selectedOptions[0].label;
                                let field = $input.attr("id");
                                if (e.type == "keyup") {
                                    console.log("event: " + e.type);
                                    if (e.key == "Enter" && new_val != old_val) {
                                        //Se apaga el evento blur
                                        $input.off("blur change");
                                        inputLookChange($input, field, old_val, new_val, $select);
                                        $input.attr("readonly", true);
                                    } else if (e.key == "Enter" && new_val != old_val) {
                                        $input.attr("readonly", true);
                                    } else if (e.key == "Escape") {
                                        $input.val(old_val);
                                        $input.attr("readonly", true);
                                    }
                                } else if (e.type == "change") {
                                    if (new_val != old_val) {
                                        $input.off("blur");
                                        $input.off("keyup");
                                        console.log("event: " + e.type);
                                        inputLookChange($input, field, old_val, new_val, $select);
                                    } else {
                                        console.log("No es diferente");
                                    }
                                } else if (e.type == "blur") {
                                    console.log("event: " + e.type);
                                    if (new_val == old_val) {
                                        $select.hide();
                                        $input.show();
                                        $input.attr("readonly", true);
                                    }
                                }
                            });
                        });
                    }
                });

        });
    });


    function fillInformation(target_element, data) {
        $target = "#" + target_element;
        $.each(data, function (key, value) {
            $("#" + target_element).find("#" + key).val(value);
        })
    }

    function fillTitles(data, titles) {
        $.each(data, function (key, value) {
            if (titles.indexOf(key) != -1) {
                $("#title_" + key).text(value);
            }
        })
    }

    function fillNameDriver(data) {
        let name = data.first_name + " " + data.f_last_name;
        $("#title_name_driver").text(name);
    }

    function fillExpiredSoat(response) {
        if (Object.keys(response.soats_vencidos).length > 0) {
            $("#title_expired_soat").text("Soats vencidos: " + response.soats_vencidos.length);
        } else {
            $("#title_expired_soat").text("Soat al día");
        }
    }

    function generateCardsVehicle(vehicles) {
        let content_example = $("#example_card_vehicles").html();
        let content_cards = "";
        //Genera los cards de cada uno de los vehículos
        $.each(vehicles, function (i, value) {
            let type_v = value.type_v;
            card = String(content_example).replace('id="card_single_vehicle"', 'id="card_single_vehicle' + (i + 1) + '"');
            card = card.replace(/&amp;PLACA/g, String(value['plate_id']));
            card = card.replace(/collapseItem/g, 'collapseItem' + (i + 1));
            // Revisa cuáles inputs debe ocultar según el tipo de vehículo
            content_cards += card;
        });
        $("#accordion_vehicles").html(content_cards);
        //inserta la información en los cards o card del vehículo
        $.each(vehicles, function (i, item_vehicles) {
            card_element = $("#card_single_vehicle" + (i + 1));
            $.each(item_vehicles, function (j, field) {
                card_element.find("." + j).val(field);
                // Revisa si es un taxi u oculta los campos de taxis
                if(field != "Taxis" && j == "type_v"){
                    card_element.find(".col-taxi-type").hide();    
                }
                if (i != 0) {

                }
            })
        });
    }

    function generateCardsHumanComponent(data){
        
    }

    function inputLookChange($input, field, old_val, new_val, $element = 'undefined') {
        let dni_id = $("#title_dni_id").text();
        let new_value = new_val;
        if ($element != 'undefined') {
            new_value = $element[0].selectedOptions[0].label;
        }
        swal.fire({
            title: '<strong id="title_swal">Actualización de datos</strong>',
            icon: 'warning',
            html: "¿Desea actualizar este registro?",
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Confirmar',
            confirmButtonAriaLabel: 'Sí, actualizarlo!',
            cancelButtonText: 'Cancelar',
            cancelButtonAriaLabel: 'Thumbs down'
        }).then((result) => {
            if (result.value) {
                let form_data = { 'fieldch': field, 'valuech': new_value, 'dni_id': dni_id };
                if(typeof ($input.attr('data-plate')) !== "undefined"){
                    form_data.plate = $input.data('plate');
                } 
                $.post($("#function-"+$input.data('module')+"-update").val(),form_data).done(function (response) {
                    if (Object.keys(response.errors).length > 0) {
                        swal.fire({
                            title: 'Error en el proceso!',
                            text: response.errors.response,
                            timer: 1500,
                            icon: 'success'
                        });
                    } else {
                        swal.fire({
                            title: 'Proceso Completo!',
                            text: 'Este registro se ha actualizado correctamente.',
                            timer: 1500,
                            icon: 'success'
                        });
                    }
                    if ($element == null) {
                        $input.attr("readonly", true);
                    } else {
                        $element.hide();
                        $input.show();
                        $input.val(new_value)
                    }
                });
            } else {
                if ($element == 'undefined') {
                    console.log("por acá");
                    $input.attr("readonly", true);
                    $input.val(old_val);
                } else {
                    console.log("else swal");
                    $element.hide();
                    $input.show();
                }
            }
        });
    }
    // The rest of the code goes here!
}));