// IIFE - Immediately Invoked Function Expression
var table_relation;

(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {

        $(document).click(function (event) {
            $target = $(event.target);
            if (!$target.closest('#vehicle_datatable tr #taxi_type').length &&
                $('#vehicle_datatable tr #taxi_type select').is(":visible")) {
                let element = $('#vehicle_datatable tr #taxi_type select');
                let val_item = element.val();
                element.parent().html(val_item)
            }
            if (!$target.closest('#vehicle_datatable tr #type_v').length &&
                $('#vehicle_datatable tr #type_v select').is(":visible")) {
                let element = $('#vehicle_datatable tr #type_v select');
                let val_item = element.val();
                element.parent().html(val_item)
            }
            if (!$target.closest('#vehicle_datatable tr #service').length &&
                $('#vehicle_datatable tr #service select').is(":visible")) {
                let element = $('#vehicle_datatable tr #service select');
                let val_item = element.val();
                element.parent().html(val_item)
            }
            if (!$target.closest('#vehicle_datatable tr #owner_v').length &&
                $('#vehicle_datatable tr #owner_v select').is(":visible")) {
                let element = $('#vehicle_datatable tr #owner_v select');
                let val_item = element.val();
                element.parent().html(val_item)
            }


        });

        var table_search;



        //Selects de vehículos
        var $type_v_select2 = $("#type_v_form").select2();
        var $owner_v_select2 = $("#owner_v_form").select2();
        var $taxi_type_select2 = $("#taxi_type_form").select2();
        var $number_of_drivers_select2 = $("#number_of_drivers_form").select2();
        var $capacity_select2 = $("#capacity_form").select2();
        var $service_select2 = $("#service_form").select2();

        $("#number_of_drivers_form").on('change', function () {
            $("#vehicle_drivers_relation").attr('hidden', true);
            $("#vehicle_drivers_relation").show();
            let number_of_drivers = parseInt($(this).val());
            let rest = parseInt($(this).val());
            let number_rows = Math.round(parseInt($(this).val()) / 2);
            if (!isNaN(number_of_drivers)) {
                cadena = "<hr class='sidebar-divider divider-form-vehicle' style='margin-bottom: 21px;'>";
                cadena += "<h5 class='text-primary d-flex justify-content-center' style='font-weight:600;margin-bottom:10px'>Registrar Conductores al Vehículo</h5>";
            }
            for (let index = 0; index < number_rows; index++) {
                cadena += "<div class='row row_form_input_vehicle mt-2'>";
                if (number_of_drivers > 0 && number_of_drivers > 1) {
                    cadena += "" +
                        "<div class='col-md-6 col-select-drivers'>" +
                        "   <label for='driver_vehicle_form" + number_of_drivers + "' id='driver_vehicle_form" + number_of_drivers + "_label'>C.C Conductor</label><br>" +
                        "   <select class='form-control driver_vehicle_form' name='driver_vehicle[]' id='driver_vehicle_form" + number_of_drivers + "' style='width: 100%' required>" +
                        "   </select>" +
                        "   <span class='error_admin input_user_admin' role='alert' id=''>" +
                        "       <strong class='error-strong'> </strong>" +
                        "   </span>" +
                        "</div>";
                    number_of_drivers = number_of_drivers - 1;
                    cadena += "" +
                        "<div class='col-md-6 col-select-drivers'>" +
                        "   <label for='driver_vehicle_form" + number_of_drivers + "' id='driver_vehicle_form" + number_of_drivers + "_label'>C.C Conductor</label><br>" +
                        "   <select class='form-control driver_vehicle_form' name='driver_vehicle[]' id='driver_vehicle_form" + number_of_drivers + "' style='width: 100%' required>" +
                        "   </select>" +
                        "   <span class='error_admin input_user_admin' role='alert' id=''>" +
                        "       <strong class='error-strong'> </strong>" +
                        "   </span>" +
                        "</div>";
                    number_of_drivers = number_of_drivers - 1;
                } else if (number_of_drivers > 0) {
                    cadena = cadena + "" +
                        "<div class='col-md-6 col-select-drivers'>" +
                        "   <label for='driver_vehicle_form" + number_of_drivers + "' id='driver_vehicle_form" + number_of_drivers + "_label'  >C.C Conductor</label><br>" +
                        "   <select class='form-control driver_vehicle_form' name='driver_vehicle[]' id='driver_vehicle_form" + number_of_drivers + "' style='width: 100%' required>" +
                        "   </select>" +
                        "   <span class='error_admin input_user_admin' role='alert' id=''>" +
                        "       <strong class='error-strong'> </strong>" +
                        "   </span>" +
                        "</div>";
                    number_of_drivers = number_of_drivers - 1;
                }
                cadena += "</div>";
            }
            cadena += "<hr class='sidebar-divider divider-form-vehicle' style='margin-top: 31px;'>";
            $("#vehicle_drivers_relation").html(cadena);
            $.ajax({
                type: 'GET',
                url: $('#drivers-select-list-route').val(),
                data: { 'type': 'select_admin2' },
                success: function (data) {
                    $('.driver_vehicle_form').select2({
                        data: data
                    });
                    $("#vehicle_drivers_relation").attr('hidden', false);
                }
            });
        });


        //Datepickers del formulario de vehículos
        $("#soat_expi_date_form").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#technomechanical_date_form").datepicker({ dateFormat: 'yy-mm-dd' });


        $.ajax({
            type: 'GET',
            url: $('#company-select-list-route').val(),
            data: { 'type': 'companies' },
            success: function (data) {
                $('#company_id_excel').select2({
                    data: data
                });
            }
        });

        $("#btn_search_company").on("click", function () {
            $(this).hide();
            table_search = $("#search_company_datatable").DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: $('#btn_search_company').data('url'),
                columns: [
                    { data: 'nit', name: 'nit' },
                    { data: 'company', name: 'company' },
                ],
                language: language_dt,
            });
            // DELETE
            $('#search_company_datatable tbody').on('click', 'tr', function () {
                var data = table_search.row(this).data();
                $("#company_id").val(data['nit']);
            });
        });


        $("#plate_id_form").on('change', function () {
            let element = $(this);
            $(".error-strong").text("");
            $.ajax({
                type: 'GET',
                url: element.data('check'),
                data: { 'plate_id': element.val() },
                success: function (data) {
                    if (Object.keys(data.errors).length > 0) {
                        // swal.fire(
                        //     'Información Errónea',
                        //     data.errors.response,
                        //     'warning'
                        // );
                        displayErrorsSpan(data.errors);
                        element.focus();
                    }
                }
            });
        });

        $("#type_v_form").on('change', function () {
            if ($(this).val() == "Taxis") {
                $("#row-taxi-inputs").attr("hidden", false);
            } else {
                $("#row-taxi-inputs").attr("hidden", true);
                $("#vehicle_drivers_relation").attr("hidden", true);
            }
        });

        $('#drive_information_dni_id').on('change', function () {
            let user_info_id = $(this).val();
            $.ajax({
                type: 'GET',
                url: $('#driver_information_dni_id').data('url-name'),
                data: { 'type': 'select_admin2', 'user_info_id': user_info_id },
                success: function (data) {
                    $("#name_driver").text(data.name);
                }
            });
            $(".error-strong").text("");
        })

        $("#modal_form_drive_info").on("click", function () {
            $("#btn_search_company").show();
        });

        $("#form_vehicle_admin").submit(function (event) {
            event.preventDefault();
            let data_form = $(this).serialize();
            let arr_values = new Array();
            let repetidos = 0;

            //Limpia los colores de errores en los select de los conductores
            $(".divider-form-vehicle").css({
                "background": ""
            });
            let columns = $(".col-select-drivers")
            $.each(columns, function (index, value) {
                $($(value).find("span")[2]).css("border", "")
                $(value).find("label").css({ "color": "", "font-weight": "" })
            });
            // valida los valores de los selects de los conductores
            $.each($(".driver_vehicle_form"), function (index_select, values_select) {
                valor_select = $(values_select).val();
                valor_select_label = "#" + $(values_select).attr('id') + "_label";
                let coincidencias = 0;
                $.each(arr_values, function (index_arr, value_arr) {
                    if (valor_select == value_arr) {
                        coincidencias++;
                    }
                });
                if (coincidencias == 0) {
                    arr_values.push(valor_select);
                } else {
                    $(valor_select_label).css({ "color": "#DF2D2D", "font-weight": "600" });
                    $($(valor_select_label).parent().find("span")[2]).css({ "border": "#DF2D2D 1px solid" });
                    repetidos++;
                }
            });
            //revisa si hay conductores repetidos en los selects
            if ($("#soat_expi_date_form").val() == "") {
                swal.fire(
                    'Información Incompleta!',
                    'Se debe seleccionar una fecha de vencimiento de soat',
                    'error'
                );
            } else if (repetidos > 0) {
                swal.fire(
                    'Información Duplicada!',
                    'Los conductores asociados al vehículo deben tener cédulas diferentes.',
                    'error'
                );
                $(".divider-form-vehicle").css({
                    "background": "#DF2D2D",
                    "height": "1px"
                });
            } else {
                $.ajax({
                    type: 'POST',
                    url: $("#form_vehicle_admin").data('url'),
                    data: data_form,
                    success: function (data) {
                        $(".error-strong").text("");
                        if (Object.keys(data.errors).length > 0) {
                            if (data.errors.response == "vehicle exists") {
                                let arr_errores = data.errors;
                                console.log(arr_errores);
                                $("#plate_id_form").focus();
                                displayErrorsSpan(arr_errores);
                            } else if (data.errors.response == "Conductores Duplicados") {
                                let duplicates = data.duplicates;
                                let selects = $(".driver_vehicle_form ");
                                console.log(duplicates);
                                $.each(selects, function (index_selects, value_selects) {
                                    $.each(duplicates, function (index_duplicates, value_duplicates) {
                                        let valor_select = $(value_selects).val();
                                        let valor_duplicate = value_duplicates.driver_information_dni_id;
                                        if (valor_select == valor_duplicate) {
                                            $(value_selects).parent().find('strong').text("Este conductor ya tiene otro vehículo")
                                        }
                                    });
                                });
                            } else {
                                let arr_errores = data.errors;
                                console.log(arr_errores);
                                $.each(arr_errores, function (index, value) {
                                    let selector = "#" + index + "-error";
                                    let selector_strong = "#" + index + "-error-strong";
                                    $(selector).show();
                                    $(selector_strong).text(value[0]);
                                });
                            }

                        } else {
                            $(".form-vehicles").val("");
                            $(".error-strong").text("");
                            $("#form_create_vehicle").modal('hide');
                            $('#vehicle_datatable').DataTable().ajax.reload();
                            $type_v_select2.val([""]).trigger("change");
                            $owner_v_select2.val([""]).trigger("change");
                            $number_of_drivers_select2.val([""]).trigger("change");
                            $taxi_type_select2.val([""]).trigger("change");
                            $capacity_select2.val([""]).trigger("change");
                            $service_select2.val([""]).trigger("change");
                            $("#vehicle_drivers_relation").hide();
                            $("#div-table-relation-vehicle-driver").hide();
                        }
                    }
                });
            }
        });

        $("#form_excel_vehicle_admin").submit(function (event) {
            event.preventDefault();
            var datafr = new FormData($("#form_excel_vehicle_admin")[0]);
            $.ajax({
                type: 'POST',
                url: $("#form_excel_vehicle_admin").data('url'),
                cache: false,
                contentType: false,
                processData: false,
                data: datafr,
                success: function (data) {
                    console.log(data);
                    if (data.response == "ok") {
                        swal.fire(
                            'Información Registrada!',
                            'El archivo ha sido subido con éxito.',
                            'success'
                        );
                    }
                }
            });
        });

        var fields = [
            'delete_row',
            'plate_id',
            'type_v',
            'owner_v',
            'taxi_type',
            'number_of_drivers',
            'soat_expi_date',
            'capacity',
            'service',
            'cylindrical_cc',
            'v_class',
            'model',
            'line',
            'brand',
            'color',
            'technomechanical_date',
        ];

        var table = $('#vehicle_datatable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            pageLength: 7,
            ajax: $('#vehicle_datatable').data('url-list'),
            columns: [
                { data: 'delete_row', name: 'delete_row', "data": null, "defaultContent": '<center><button class="btn btn-sm btn-danger" id="btn_delete_vehicle"><span class="trash_icon"></span></button></center>' },
                { data: 'plate_id', name: 'plate_id' },
                { data: 'type_v', name: 'type_v' },
                { data: 'owner_v', name: 'owner_v' },
                { data: 'taxi_type', name: 'taxi_type' },
                { data: 'number_of_drivers', name: 'number_of_drivers' },
                { data: 'soat_expi_date', name: 'soat_expi_date' },
                { data: 'capacity', name: 'capacity' },
                { data: 'service', name: 'service' },
                { data: 'cylindrical_cc', name: 'cylindrical_cc' },
                { data: 'v_class', name: 'v_class' },
                { data: 'model', name: 'model' },
                { data: 'line', name: 'line' },
                { data: 'brand', name: 'brand' },
                { data: 'color', name: 'color' },
                { data: 'technomechanical_date', name: 'technomechanical_date' },
            ],
            language: language_dt,

            columnDefs: [{
                targets: '_all',
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).attr("id", fields[col])
                    if (fields[col] == "plate_id") {
                        $(td).html("<a href='#' id='plate_id_link' style='text-decoration: underline;'>" + rowData[fields[col]] + "</a>")
                    }
                }
            }],
        });

        $('#vehicle_datatable').on('click', 'tr td #plate_id_link', function () {
            let plate_id = $(this).text();
            $.ajax({
                type: 'POST',
                url: $('#relation_driver_vehicle_datatable').data('url-list'),
                data: { "plate_id": plate_id },
                success: function (dataset) {
                    console.log(dataset);
                    $("#div-table-relation-vehicle-driver").attr("hidden", false);
                    $("#div-table-relation-vehicle-driver").show();
                    table_relation = $('#relation_driver_vehicle_datatable').DataTable({
                        scrollX: true,
                        destroy: true,
                        data: dataset.data,
                        columns: [
                            { data: 'delete_row', name: 'delete_row', "data": null, "defaultContent": '<center><button class="btn btn-sm btn-danger" id="btn_delete_driver_vehicle"><span class="trash_icon"></span></button></center>' },
                            { data: 'id', name: 'id', "visible": false },
                            { data: 'driver_information_dni_id', name: 'driver_information_dni_id' },
                            { data: 'first_name', name: 'first_name' },
                            { data: 'f_last_name', name: 'f_last_name' },
                            { data: 'vehicle_plate_id', name: 'vehicle_plate_id' },
                            { data: 'type_v', name: 'type_v' }
                        ],
                        language: language_dt,
                    });
                    
                }
            });

        });
        $('#vehicle_datatable').on('click', 'tr td #btn_delete_vehicle', function () {
            let row = $(this).parents('tr')
            let data_delete = table.row(row).data();
            swal.fire({
                title: '<strong>Eliminar Información</strong>',
                icon: 'warning',
                html:
                    '¿Está seguro que desea eliminar este registro? ',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText:
                    'Confirmar',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText:
                    'Cancelar',
                cancelButtonAriaLabel: 'Thumbs down'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: $("#vehicle_datatable").data("url-delete"),
                        data: data_delete,
                        success: function (data) {
                            if (data.error == "") {
                                swal.fire(
                                    'Proceso Completado',
                                    'El usuario ha sido eliminado.',
                                    'success'
                                );
                                $('#vehicle_datatable').DataTable().ajax.reload();
                                $("#div-table-relation-vehicle-driver").hide();
                            } else {
                                swal.fire(
                                    'Ocurrió un error',
                                    'La operación no pudo completarse, por favor intente de nuevo.',
                                    'error'
                                );
                            }
                        }
                    });
                }
            });
        });

        $('#relation_driver_vehicle_datatable').on('click', 'tr td #btn_delete_driver_vehicle', function () {
            let row = $(this).parents('tr')
            let data_delete = table_relation.row(row).data();
            swal.fire({
                title: '<strong>Eliminar Información</strong>',
                icon: 'warning',
                html:
                    '¿Está seguro que desea eliminar este registro? ',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText:
                    'Confirmar',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText:
                    'Cancelar',
                cancelButtonAriaLabel: 'Thumbs down'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: $("#relation_driver_vehicle_datatable").data("url-delete"),
                        data: data_delete,
                        success: function (data) {
                            if (data.error == "") {
                                swal.fire(
                                    'Proceso Completado',
                                    'El usuario ha sido eliminado.',
                                    'success'
                                );
                                $("#div-table-relation-vehicle-driver").hide();
                                $('#vehicle_datatable').DataTable().ajax.reload();
                            } else {
                                swal.fire(
                                    'Ocurrió un error',
                                    'La operación no pudo completarse, por favor intente de nuevo.',
                                    'error'
                                );
                            }
                        }
                    });
                }
            });
        });


        function myCallbackFunction(updatedCell, updatedRow, oldValue) {
            console.log("The new value for the cell is: " + updatedCell.data());
            confirmUpdate = false;
            if (oldValue != updatedCell.data()) {
                console.log("datax new " + updatedCell.data());
                console.log("datax old " + oldValue);

                dataSend = updatedRow.data();
                dataSend.valuech = updatedCell.data();
                dataSend.fieldch = updatedCell.nodes()[0].id;
                element_node = updatedCell.nodes()[0];
                $.ajax({
                    type: 'POST',
                    url: $("#update-vehicle-route").val(),
                    data: dataSend,
                    async: false,
                    success: function (data) {
                        if (Object.keys(data.error).length > 0) {

                            swal.fire(
                                'Error!',
                                data.error.response,
                                'error'
                            )
                        } else {
                            confirmUpdate = true;
                        }
                    }
                });
            }
            return confirmUpdate;
            // console.log("The values for each cell in that row are: " + updatedRow.data());
        }

        table.MakeCellsEditable({
            "onUpdate": myCallbackFunction,
            columns: [2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
            "inputTypes": [
                {
                    "column": 2,
                    "type": "list",
                    "options": enum_type_v
                },
                {
                    "column": 3,
                    "type": "list",
                    "options": [
                        { 'value': "Sí", "display": "Sí" },
                        { 'value': "No", "display": "No" }
                    ]
                },
                {
                    "column": 4,
                    "type": "list",
                    "options": enum_taxi_type
                },
                {
                    "column": 8,
                    "type": "list",
                    "options": enum_service
                }

            ]
        });
    });

    function displayErrorsSpan(arr_errores) {
        $.each(arr_errores, function (index, value) {
            let selector = "#" + index + "-error";
            let selector_strong = "#" + index + "-error-strong";
            $(selector).show();
            $(selector_strong).text(value[0]);
        });
    }
    // The rest of the code goes here!
}));