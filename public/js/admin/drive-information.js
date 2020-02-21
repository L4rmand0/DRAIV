// IIFE - Immediately Invoked Function Expression
(function(runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function($, window, document) {

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function() {

        $(document).click(function(event) {
            $target = $(event.target);
            $(this).editBehaviourSelectDT($target, "#drive_information_datatable", "#gender");
            $(this).editBehaviourSelectDT($target, "#drive_information_datatable", "#civil_state");
            $(this).editBehaviourSelectDT($target, "#drive_information_datatable", "#education");
            $(this).editBehaviourSelectDT($target, "#drive_information_datatable", "#country_born");
            $(this).editBehaviourInputDT($target, "#drive_information_datatable", "#first_name");
            $(this).editBehaviourInputDT($target, "#drive_information_datatable", "#second_name");
            $(this).editBehaviourInputDT($target, "#drive_information_datatable", "#f_last_name");
            $(this).editBehaviourInputDT($target, "#drive_information_datatable", "#s_last_name");
            $(this).editBehaviourInputDT($target, "#drive_information_datatable", "#e_mail_address");
            $(this).editBehaviourInputDT($target, "#drive_information_datatable", "#address");
            $(this).editBehaviourInputDT($target, "#drive_information_datatable", "#phone");
            $(this).editBehaviourInputDT($target, "#drive_information_datatable", "#score");
            $(this).editBehaviourInputDT($target, "#drive_information_datatable", "#number_of_vehicles");
        });

        $("#department_form").on('change', function() {
            let data_admin2 = $(this).val();
            let data_cities = new Array();
            let item = { "id": "", "text": "Seleccionar" };
            data_cities.push(item)
            $.each(list_admin3, function(index, value) {
                let admin2_item = value.adm2_id;
                if (data_admin2 == admin2_item) {
                    let admin3_item = { "id": value.adm3_id, "text": value.name };
                    data_cities.push(admin3_item)
                }
            });
            $("#city_residence_place_form").attr('disabled', false);
            $('#city_residence_place_form').html("");
            $("#city_residence_place_form").select2({
                data: data_cities
            });
        });

        var table_search;
        var $company_id_form_select2;
        var $department_form_select2;
        var $city_born_form_select2;
        $gender_select2 = $('#gender_form').select2();
        $education_select2 = $('#education_form').select2();
        $country_born_select2 = $('#country_born').select2();
        $civil_state_select2 = $('#civil_state_form').select2();
        $city_residence_select2 = $('#city_residence_place_form').select2();

        $.ajax({
            type: 'GET',
            url: $('#department_form').data('url'),
            data: { 'type': 'select_admin2' },
            success: function(data) {
                $department_form_select2 = $('#department_form').select2({
                    data: data
                });
            }
        });

        $.ajax({
            type: 'GET',
            url: $('#company_id_form').data('url'),
            data: { 'type': 'companies' },
            success: function(data) {
                $('#company_id_excel').select2({
                    data: data
                });
            }
        });

        $.ajax({
            type: 'GET',
            url: $('#company_id_form').data('url'),
            data: { 'type': 'companies' },
            success: function(data) {
                $company_id_form_select2 = $('#company_id_form').select2({
                    data: data
                });
            }
        });

        $.ajax({
            type: 'GET',
            url: $('#city_born_form').data('url'),
            data: { 'type': 'admin3' },
            success: function(data) {
                $city_born_form_select2 = $('#city_born_form').select2({
                    data: data
                });
            }
        });

        $("#btn_search_company").on("click", function() {
            $(this).hide();

            // DELETE
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
            $('#search_company_datatable tbody').on('click', 'tr', function() {
                var data = table_search.row(this).data();
                $("#Company_id").val(data['nit']);
            });

        });

        $("#modal_form_drive_info").on("click", function() {
            $("#btn_search_company").show();
        });

        $("#form_driver_info_admin").submit(function(event) {
            event.preventDefault();
            let score_val = parseFloat($("#score_form").val());
            if (score_val > 5 || score_val < 0 || !$.isNumeric($('#score_form').val())) {
                swal.fire(
                    'Error de formato',
                    'El puntaje deber ser un decimal entre 0 y 5. Ejemplo: 5.00',
                    'error'
                );
            } else {
                let data_form = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: $("#form_driver_info_admin").data('url'),
                    data: data_form,
                    success: function(data) {
                        console.log(data);
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
                            $(".form-dataconductores").val("");
                            $(".error-strong").text("");
                            $("#form_create_driver_information").modal('hide');
                            $('#drive_information_datatable').DataTable().ajax.reload();
                            $company_id_form_select2.val([""]).trigger("change");
                            $department_form_select2.val([""]).trigger("change");
                            $city_born_form_select2.val([""]).trigger("change");
                            $gender_select2.val([""]).trigger("change");
                            $education_select2.val([""]).trigger("change");
                            $country_born_select2.val([""]).trigger("change");
                            $civil_state_select2.val([""]).trigger("change");
                            $city_residence_select2.val([""]).trigger("change");
                        }
                    }
                });
            }
        });
        $("#form_excel_driver_info_admin").submit(function(event) {
            event.preventDefault();
            var datafr = new FormData($("#form_excel_driver_info_admin")[0]);
            $.ajax({
                type: 'POST',
                url: $("#form_excel_driver_info_admin").data('url'),
                cache: false,
                contentType: false,
                processData: false,
                data: datafr,
                success: function(data) {
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
            'dni_id',
            'first_name',
            'second_name',
            'f_last_name',
            's_last_name',
            'number_of_vehicles',
            'gender',
            'education',
            'e_mail_address',
            'address',
            'country_born',
            'city_Residence_place',
            'department',
            'phone',
            'civil_state',
            'score',
            'db_user_id',
            'company_id'
        ];

        var table = $('#drive_information_datatable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            "scrollY":"400px",
            "scrollCollapse": true,
            ajax: $('#driver-info-list-route').val(),
            columns: [
                { data: 'delete_row', name: 'delete_row', "data": null, "defaultContent": '<center><button class="btn btn-sm btn-danger" id="btn_delete_drive_info"><i class="fas fa-trash"></i></button></center>' },
                { data: 'dni_id', name: 'dni_id' },
                { data: 'first_name', name: 'first_name' },
                { data: 'second_name', name: 'second_name' },
                { data: 'f_last_name', name: 'f_last_name' },
                { data: 's_last_name', name: 's_last_name' },
                { data: 'number_of_vehicles', name: 'number_of_vehicles' },
                { data: 'gender', name: 'gender' },
                { data: 'education', name: 'education' },
                { data: 'e_mail_address', name: 'e_mail_address' },
                { data: 'address', name: 'address' },
                { data: 'country_born', name: 'country_born' },
                { data: 'department', name: 'department' },
                { data: 'city_residence_place', name: 'city_residence_place' },
                { data: 'phone', name: 'phone' },
                { data: 'civil_state', name: 'civil_state' },
                { data: 'score', name: 'score' },
                { data: 'db_user_id', name: 'db_user_id', "visible": false },
                { data: 'company_id', name: 'company_id', "visible": false },
                { data: 'user', name: 'user' },
                { data: 'company', name: 'company' },
            ],
            language: language_dt,

            columnDefs: [{
                targets: '_all',
                createdCell: function(td, cellData, rowData, row, col) {
                    $(td).attr("id", fields[col])
                }
            }],
        });

        $('#drive_information_datatable').on('click', 'tr td #btn_delete_drive_info', function() {
            let row = $(this).parents('tr')
            let data_delete = table.row(row).data();
            swal.fire({
                title: '<strong>Eliminar Información</strong>',
                icon: 'warning',
                html: '¿Está seguro que desea eliminar este registro? Se borrarán todos los registros asociados a este conductor.',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: 'Confirmar',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText: 'Cancelar',
                cancelButtonAriaLabel: 'Thumbs down'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: $("#form_driver_info_admin").data("url-delete"),
                        data: data_delete,
                        success: function(data) {
                            if (data.error == "") {
                                swal.fire(
                                    'Proceso Completado',
                                    'El usuario ha sido eliminado.',
                                    'success'
                                );
                                $('#drive_information_datatable').DataTable().ajax.reload();
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
            if (oldValue != updatedCell.data()) {
                dataSend = updatedRow.data();
                dataSend.valuech = updatedCell.data();
                dataSend.fieldch = updatedCell.nodes()[0].id;
                $.ajax({
                    type: 'POST',
                    url: $("#update-driver-info-route").val(),
                    data: dataSend,
                    async: false,
                    success: function(data) {
                        if (Object.keys(data.error).length > 0)
                            swal.fire(
                                'Error!',
                                data.error.response,
                                'error'
                            )
                    }
                });
            } else {
                $('#drive_information_datatable').DataTable().ajax.reload();
            }
            console.log("The values for each cell in that row are: " + updatedRow.data());
        }

        table.MakeCellsEditable({
            "onUpdate": myCallbackFunction,
            columns: [
                2 /* Nombre */, 3 /*S Nombre */, 4/*P apellido */, 5/*S apellido */, 7/*Género*/, 8/*Educación*/, 
                9 /*Email*/, 10/*Dirección*/, 14/*Número de celular*/, 15/*Estado Civil*/, 16/*Puntaje*/],
            "inputTypes": [{
                    "column": 7/*Género*/,
                    "type": "list",
                    "options": [
                        { "value": "Masculino", "display": "Masculino" },
                        { "value": "Femenino", "display": "Femenino" }
                    ]
                },
                {
                    "column": 8/*Educación*/,
                    "type": "list",
                    "options": enum_education
                },
                {
                    "column": 15/*Estado Civil*/,
                    "type": "list",
                    "options": enum_civil_state
                },
                // {
                //     "column": 11,
                //     "type": "list",
                //     "options": enum_country_born
                // }
            ]
        });

    });
    // The rest of the code goes here!
}));