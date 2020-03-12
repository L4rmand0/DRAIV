// IIFE - Immediately Invoked Function Expression
(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {
    // vars form vehicles
    var current_sec, next_sec, previous_sec; //fieldsets
    var opacity_sec;
    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {
        $city_residence_select2 = $('#city_residence_place').select2();
        $gender_select2 = $('#gender').select2();
        $education_select2 = $('#education').select2();
        $country_born_select2 = $('#country_born').select2();
        $civil_state_select2 = $('#civil_state').select2();
        $company_select2 = $('#company_id').select2();
        // var index_section = 0;
        $("#index_section").val("0")

        //Adiciona un nuevo formulario de vehículos según escoja
        $("#number_of_vehicles_form").on('change', function () {
            // index_section = 0;
            //------------------ LÓGICA DEL FORMULARIO DE VEHÍCULOS ----------------
            //Se agregan la cantidad de formularios de vehículos elegida por el usuario
            $("#index_section").val("0")
            let number_of_vehicles = parseInt($(this).val());
            cadena_form = "";
            for (let i = 0; i < number_of_vehicles; i++) {
                let item = String($("#form_vehicle_driver").html()).replace("&amp;num_vehicle", "" + (i + 1))
                //le pone el número a expi_date para que se pueda poner el datepicker
                item = item.replace('id="soat_expi_date"', 'id="soat_expi_date' + (i + 1) + '"')
                item = item.replace('name="vehicle[soat_expi_date][]"', 'name="vehicle[soat_expi_date' + (i + 1) + ']"')
                //le pone el número a technomechanical_date para que se pueda poner el datepicker
                item = item.replace('id="technomechanical_date"', 'id="technomechanical_date' + (i + 1) + '"')
                item = item.replace('name="vehicle[technomechanical_date][]"', 'name="vehicle[technomechanical_date' + (i + 1) + ']"')
                // let item =  String($("#form_vehicle_driver").html())
                cadena_form = cadena_form + item;
            }
            $("#forms_vehicles").html(cadena_form);
            //esconde el botón de regresa en caso sea que el primer formulario de vehículos
            $($("#msform [class=previous_vehicle]")[0]).hide();
            //esconde el botón de siguiente en  el último formulario de vehículos
            $($("#msform [class=next_vehicle]")[parseInt($("#number_of_vehicles_form").val()) - 1]).hide();
            //Le agrega la clase next al último botón de vehículos

            //revisa si es el último formulario de vehículos para mostrar el botón de siguiente
            // debugger
            if (parseInt($("#index_section").val()) == parseInt($("#number_of_vehicles_form").val()) - 1) {
                $(".next").attr('hidden', false)
                $(".next").show()
            } else {
                $(".next").hide()
            }

            // FUNCIÓN DE PASO SIGUIENTE EN EL FORMULARIO DE VEHÍCULOS
            $(".next_vehicle").on('click', function () {
                let element_button = $(this);
                var $url_action = element_button.data('validate');
                let data_error = element_button.data("error");
                // let $form_data = $("#msform").serialize();
                let $form_data_arr = $("#msform").serializeArray();
                // let data_fr = new FormData($("#msform")[0]);
                let index = $("#index_section").val();
                $form_data_arr.push({ name: 'index', value: parseInt(index) });
                // datafr.append('index', index_section);
                current_sec = element_button.parent();
                next_sec = element_button.parent().next();
                $.ajax({
                    type: 'POST',
                    url: $url_action,
                    data: $form_data_arr,
                }).done(function (response) {
                    if (!current_sec.hasErrorsForms(current_sec, response)) {
                        // if (true) {
                        //Add Class Active
                        // if(typeof current_sec.data('endsection') !== "undefined"){
                        //     index_fieldset++;
                        //     $("#progressbar li").eq(index_fieldset).addClass("active");
                        // }
                        //show the next fieldset
                        next_sec.show();
                        //hide the current fieldset with style
                        current_sec.animate({ opacity_sec: 0 }, {
                            step: function (now) {
                                // for making fielset appear animation
                                opacity_sec = 1 - now;
                                current_sec.css({
                                    'display': 'none',
                                    'position': 'relative'
                                });
                                next_sec.css({ 'opacity': opacity_sec });
                            },
                            duration: 600
                        });
                        $("#index_section").val(parseInt($("#index_section").val() + 1))
                        // index_section++;
                        if (parseInt($("#index_section").val()) == parseInt($("#number_of_vehicles_form").val()) - 1) {
                            $(".next").attr('hidden', false)
                            $(".next").show()
                        } else {
                            $(".next").hide()
                        }
                    }
                });
            });

            $(".previous_vehicle").click(function () {
                current_sec = $(this).parent();
                previous_sec = $(this).parent().prev();
                //Remove class active
                $("#progressbar li").eq($("fieldset").index(current_sec)).removeClass("active");
                //show the previous fieldset
                previous_sec.show();
                //hide the current fieldset with style
                current_sec.animate({ opacity_sec: 0 }, {
                    step: function (now) {
                        // for making fielset appear animation
                        opacity_sec = 1 - now;

                        current_sec.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        previous_sec.css({ 'opacity': opacity_sec });
                    },
                    duration: 600
                });
                $("#index_section").val(parseInt($("#index_section").val()) - 1)
                // index_section--;
            });
            if ($(".date_vehicle").hasClass("hasDatepicker")) {
                // $(".date_vehicle").datepicker( "destroy" );
                $(".date_vehicle").removeClass("hasDatepicker");
                $(".date_vehicle").datepicker({ dateFormat: 'yy-mm-dd' });
            } else {
                $(".date_vehicle").datepicker({ dateFormat: 'yy-mm-dd' });
            }
            //-------------- TERMINA LA LÓGICA DEL FORMULARIO DE VEHÍCULOS --------------------


            // ----- Limpia los estilos de error en los formularios -----
            $("#msform input[type=text], #msform input[type=email], #msform input[type=password], #msform input[type=number], #msform input[type=tel]").on("keypress", function () {
                let $target = $(this);
                $(this).cleanErrorElementForm($target);
            });
            $("#msform input[type=text], #msform input[type=email], #msform input[type=password], #msform input[type=number], #msform input[type=tel], #msform input[type=date]").on("change", function () {
                let $target = $(this);
                $(this).cleanErrorElementForm($target);
            });
            $("#msform input[type=checkbox], #msform select").on("change", function () {
                let $target = $(this);
                $(this).cleanErrorElementForm($target);
            });
            // ------- Termina limpiar el formulario -------


        });

        //Datepickers del formulario de licencia
        $("#expi_date").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#expedition_day").datepicker({ dateFormat: 'yy-mm-dd' });


        //Limpia los estilos de error en los formularios
        $("#msform input[type=text], #msform input[type=email], #msform input[type=password], #msform input[type=number], #msform input[type=tel]").on("keypress", function () {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });

        $("#msform input[type=text], #msform input[type=email], #msform input[type=password], #msform input[type=number], #msform input[type=tel]").on("change", function () {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });

        $("#msform input[type=checkbox], #msform select").on("change", function () {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });

        $.ajax({
            type: 'GET',
            url: $('#department').data('url'),
            data: { 'type': 'select_admin2' },
            success: function (data) {
                $department_form_select2 = $('#department').select2({
                    data: data
                });
            }
        });

        $("#department").on('change', function () {
            let data_admin2 = $(this).val();
            let data_cities = new Array();
            let item = { "id": "", "text": "Seleccionar" };
            data_cities.push(item)
            $.each(list_admin3, function (index, value) {
                let admin2_item = value.adm2_id;
                if (data_admin2 == admin2_item) {
                    let admin3_item = { "id": value.adm3_id, "text": value.name };
                    data_cities.push(admin3_item)
                }
            });
            $("#city_residence_place").attr('disabled', false);
            $('#city_residence_place').html("");
            $("#city_residence_place").select2({
                data: data_cities
            });
        });

        $('#msform').submit(function (e) {
            debugger
            e.preventDefault();
            let url_action = $(this).attr('action');
            let form_data = $("#msform").serialize();

            $.post(url_action, form_data, function (result) {

            });
        });

        //Modifica el nombre del archivo en el texto del input
        $(".input_files_drivers").on('change', function () {
            $input = $(this);
            let name_file = $input[0].files[0].name
            $input.next().text(name_file);
            $(".error_file" + $input.data('key')).text("")
        });


        // $("#btn_upload_img").on("click", function () {
        //     let element_button = $(this);
        //     let form_data = $("#msform").serialize();
        //     let url_action = element_button.data('url');
        //     $.post(url_action, form_data, function (result) {
        //         console.log(result);
        //     });
        // });

        //Lógica de la función de subir imágenes
        $(".btn_images_drivers").on('click', function (event) {
            debugger
            event.preventDefault();
            $key = $(this).data('key');
            $input = $("#file" + $(this).data('key'));
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
                datafr.append('driver_information_dni_id', $("#dni_id").val());
                datafr.append('key', $key);
                $.ajax({
                    type: 'POST',
                    url: $('#function_store_image').val(),
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
                                element.find(".error_file" + $key).html(cadena);
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
                                            url: $("#function_update_images").val(),
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

        //Lógica para subir las imágenes del formulario de vehiculos
        $(".btn_images_vehicle").on('click', function (event) {
            event.preventDefault();
            $key = $(this).data('key');
            $input = $("#file" + $(this).data('key'));
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
                datafr.append('key', $key);
                $.ajax({
                    type: 'POST',
                    url: $('#function_store_image').val(),
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
                                element.find(".error_file" + $key).html(cadena);
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
                                            url: $("#function_update_images").val(),
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

    });
   // The rest of the code goes here!
}));