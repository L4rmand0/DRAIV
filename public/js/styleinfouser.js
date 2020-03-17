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
                    //Revisa si el section es de vehiculos
                    if (typeof (current_fs.attr('data-vehicle')) !== "undefined") {
                        generateFormImageVehicle(next_fs, function () {
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
                                    console.log("placa: "+plate);
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

            if (current_fs.find(".next").is(":hidden") == true) {
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
            index_fieldset--;
        });

        $('.radio-group .radio').click(function () {
            $(this).parent().find('.radio').removeClass('selected');
            $(this).addClass('selected');
        });

        $(".submit").click(function () {
            return false;
        });
    });

    function generateFormImageVehicle(next_fs, callback) {
        let number_forms = $("#number_of_vehicles_form").val();
        let dataArray = $("#msform").serializeArray();
        let content = "";
        let contador = 0;
        $(dataArray).each(function (i, field) {
            if (field.name == "vehicle[plate_id][]") {
                content += String($("#card-form-vehicles").html())
                .replace("&amp;PLACA", "" + "Vehículo con placa: <span class='header_plate_id'>" + field.value + "</span>")
                .replace(/data-index=""/g,'data-index="'+contador+'"');
                contador++;
                // $(".select_user_vehicle").append("<option value='" + field.value + "'>" + field.value + "</option>");
            }
        });
        $("#forms_images_vehicle").html(content);
        callback();
    }

    // The rest of the code goes here!
}));