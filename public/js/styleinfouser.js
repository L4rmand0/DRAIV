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
        var index_fieldset = 1;
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
            if (typeof (current_fs.attr('data-vehicle')) !== "undefined") {
                // Limpia los errores del radio y los selects
                $(".error-radio-select").remove();
                $(".error-radio").remove();
                $(".label_radio").css("color", "");
                let num_cards = $("#msform .card_single_vehicle_register").length
                for (let i = 0; i < num_cards; i++) {
                    $input = $("input[name=radio_vehicle" + i + "]");
                    if (!$("input[name=radio_vehicle" + i + "]").is(":checked")) {
                        $row = $input.closest(".row");
                        $row.append("<span role='alert' class='ml-3 error-radio'><strong class='el-red'>Debe elegir una opción</strong></p>");
                        $row.find(".label_radio").css('color', 'var(--red)');
                        return
                    }
                }
                for (let j = 0; j < num_cards; j++) {
                    let $select = $("#plate_id" + j);
                    if ($select.val() == "") {
                        $select.closest(".select_vehicle_exist").append("<span role='alert' class='ml-1 mt-2 error-radio-select'><strong class='el-red'>Debe seleccionar una placa</strong></p>");
                        return
                    }
                }
            }
            $.ajax({
                type: 'POST',
                url: $url_action,
                data: $form_data_arr,
            }).done(function (response) {
                // debugger
                // if (typeof (current_fs.attr('data-vehicle')) !== "undefined") {
                //     container_validate = current_fs.find("section:last-child");
                // } else {
                //     container_validate = current_fs;
                // }
                container_validate = current_fs;
                if (!current_fs.hasErrorsForms(container_validate, response)) {
                    // if (true) {
                    //Add Class Active
                    //Revisa si el section es de vehiculos
                    if (typeof (current_fs.attr('data-vehicle')) !== "undefined") {
                        generateFormImageVehicle(next_fs, arr_all_types_vehicle, function () {
                            //Lógica para subir las imágenes del formulario de vehiculos
                            $(".btn_images_vehicle").on('click', function (event) {
                                event.preventDefault();
                                $btn = $(this);
                                $key = $btn.data('key');
                                $input = $btn.parent().parent().find(".input_files_drivers");
                                $index = $btn.data('index');
                                $col = $btn.parent().parent();
                                var element = $("#msform");
                                var datafr = new FormData(element[0]);
                                var val_file = $input.val();
                                if (val_file == "") {
                                    swal.fire(
                                        'Archivo vacío!',
                                        'No se ha elegido ningún archivo.',
                                        //     'Archivo Duplicado',
                                        //     data.errors.message,
                                        //     'error'
                                        // );
                                        'error'
                                    );
                                } else {
                                    let plate = $btn.parent().parent().parent().parent().parent().find(".header_plate_id").text();
                                    console.log("placa: " + plate);
                                    datafr.append('key', $key);
                                    datafr.append('plate', plate);
                                    datafr.append('index', $index);
                                    $.ajax({
                                        type: 'POST',
                                        url: $('#function_store_image_vehicle').val(),
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        data: datafr,
                                        success: function (data) {
                                            console.log(data);
                                            if (Object.keys(data.errors).length > 0) {
                                                if (data.response == "Carga fallida") {
                                                    swal.fire(
                                                        'Proceso Incompleto',
                                                        data.errors.message,
                                                        'error'
                                                    );
                                                } else if (data.response == "validator errors") {
                                                    let cadena = "";
                                                    $.each(data.errors, function (index, value) {
                                                        cadena = cadena + "<strong id='file-error-strong' class='error-strong'>" + value[0] + "</strong>";
                                                    });
                                                    $col.find(".error_file" + $key).html(cadena);
                                                } else if (data.response == "file exists") {
                                                    let id_image = data.errors.id;
                                                    let url = data.errors.path;
                                                    datafr.append('id', id_image);
                                                    datafr.append('url', url);
                                                    swal.fire({
                                                        title: '<strong>Archivo Encontrado</strong>',
                                                        icon: 'warning',
                                                        html: data.errors.message,
                                                        showCloseButton: true,
                                                        showCancelButton: true,
                                                        focusConfirm: false,
                                                        confirmButtonText: 'Confirmar',
                                                        confirmButtonAriaLabel: 'Sí, reemplazarlo!',
                                                        cancelButtonText: 'Cancelar',
                                                        cancelButtonAriaLabel: 'Thumbs down'
                                                    }).then((result) => {
                                                        if (result.value) {
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: $("#function_update_images-vehicle").val(),
                                                                cache: false,
                                                                contentType: false,
                                                                processData: false,
                                                                data: datafr,
                                                                success: function (data) {
                                                                    if (Object.keys(data.errors).length > 0) {
                                                                        swal.fire(
                                                                            'Error en el proceso',
                                                                            data.errors.response,
                                                                            'error'
                                                                        );
                                                                    } else {
                                                                        swal.fire(
                                                                            'Proceso Completado',
                                                                            data.messagge,
                                                                            'success'
                                                                        );
                                                                        $input.next().text("Seleccionar ...");
                                                                        $input.val("");
                                                                    }
                                                                }
                                                            });
                                                        }
                                                    });
                                                }
                                            } else {
                                                swal.fire(
                                                    'Proceso Completado',
                                                    'Archivo subido correctamente.',
                                                    'success'
                                                );
                                                $input.next().text("Seleccionar ...");
                                                $input.val("");
                                            }
                                        }
                                    });
                                }
                            });
                            $(".input_files_drivers").on('change', function () {
                                let element = $(this);
                                let name = element[0].files[0].name;
                                $(this).parent().find("label").text(name)
                                element.parent().parent().find("#file-error").text("")
                            });
                        });
                    }

                    //revisar si el section es de Licencia e inserta la información recogida
                    if (typeof (current_fs.attr('data-licence')) !== "undefined") {
                        $.post($("#route-register-primary-information").val(), $("#msform").serialize())
                            .done(function (response) {
                                if (Object.keys(response.errors).length > 0) {
                                    swal.fire({
                                        title: 'Proceso Incompleto!',
                                        text: response.errors.response,
                                        timer: 1500,
                                        icon: 'error'
                                    });
                                } else {
                                    swal.fire({
                                        title: 'Proceso Completo!',
                                        text: response.response,
                                        timer: 1500,
                                        icon: 'success'
                                    });
                                    let url_old = $("#btn_evaluate_driver").attr("href");
                                    let dni_id = $("#dni_id").val();
                                    let new_url = `${url_old}/${dni_id}`;
                                    $("#btn_evaluate_driver").attr("href", new_url);
                                }
                            });
                    }
                    //revisar si el section es de vehículo e inserta la información recogida
                    if (typeof (current_fs.attr('data-vehicle')) !== "undefined") {
                        $.post($("#route-register-secondary-information").val(), $("#msform").serialize())
                            .done(function (response) {
                                if (Object.keys(response.errors).length > 0) {
                                    swal.fire({
                                        title: 'Proceso Incompleto!',
                                        text: response.errors.response,
                                        timer: 1500,
                                        icon: 'error'
                                    });
                                } else {
                                    swal.fire({
                                        title: 'Proceso Completo!',
                                        text: response.response,
                                        timer: 1500,
                                        icon: 'success'
                                    });
                                }
                            });
                    }
                    if (typeof current_fs.data('endsection') !== "undefined") {
                        index_fieldset++;
                        $("#progressbar li").eq(index_fieldset).addClass("active");
                    }
                    //show the next fieldset
                    while(next_fs.data('pass')==true){
                        next_fs = next_fs.next();
                    }
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
            //show the previous fieldset
            while(previous_fs.data('pass')==true){
                previous_fs = previous_fs.prev();
            }

            if (current_fs.find(".next").is(":hidden") == true) {
                current_fs.find(".next").show()
            }
            //Remove class active
            if (typeof previous_fs.data('endsection') !== "undefined") {
                $("#progressbar li").eq(index_fieldset).removeClass("active");
                index_fieldset--;
            }

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
    });

    function generateFormImageVehicle(next_fs, arr_all_types_vehicle, callback) {
        let dataArray = $("#msform").serializeArray();
        let content_cards = "";
        // Genera la imágenes de los selects de los vehículos ya existentes
        $("#msform .select_plate_vehicle").each(function (i, element) {
            let plate = element.value;
            let indexSelected = element.options.selectedIndex;
            let type = $(element.options[indexSelected]).data('type');
            if(type == "Taxis"){
                generateFormSingleV(arr_all_types_vehicle.taxis, plate, function (content) {
                    content_cards += content;
                });
            }else if(type != "Taxis"){
                generateFormSingleV(arr_all_types_vehicle.general, plate, function (content) {
                    content_cards += content;
                });
            } 
        });
        // Genera la imágenes de los inputs de vehículos nuevos
        $("#msform .plate_id_input").each(function (i, element) {
            let plate = element.value;
            generateFormSingleV(arr_type_images_vehicle, plate, function (content) {
                content_cards += content;
            });
        });
        // $(dataArray).each(function (i, field) {
        //     if (String(field.name).includes("vehicle[plate_id]") || String(field.name).includes("vehicle_exist[plate_id]")) {
        //         let plate = field.value;
        //         generateFormSingleV(arr_type_images_vehicle,plate, function(content){
        //             content_cards+=content;
        //         });
        //     }
        // });
        $("#forms_images_vehicle").html(content_cards);
        callback();
    }

    function generateFormSingleV(arr_type_images_vehicle, plate, callback) {
        let content = `<div class="card"><div class="card-header"> ${plate} </div><div class="card-body">`;
        $.each(arr_type_images_vehicle, function (key, value) {
            content += "<div class='row'>";
            $.each(value, function (key_item, value_item) {
                let example_form = String($("#example_col_form_single_image_v").html());
                let title = value_item.title;
                let type_image = value_item.type;
                example_form = example_form.replace(/&amp;TITLE/g, title)
                    .replace(/&amp;TYPE_IMG/g, title)
                    .replace(/&amp;INDEX/g, title);
                content += example_form;
            })
            content += "</div>";
        });
        content += "</div></div>";
        callback(content);
    }

    // The rest of the code goes here!
}));