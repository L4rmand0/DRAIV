// IIFE - Immediately Invoked Function Expression
(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {
        
        $(document).click(function(event) { 
            $target = $(event.target);
            if(!$target.closest('#driving_licence_datatable tr #country_expedition').length && 
            $('#driving_licence_datatable tr #country_expedition select').is(":visible")) {
                let element = $('#driving_licence_datatable tr #country_expedition select');
                let val_item = element.val();
                element.parent().html(val_item)
            }
            if(!$target.closest('#driving_licence_datatable tr #category').length && 
            $('#driving_licence_datatable tr #category select').is(":visible")) {
                let element = $('#driving_licence_datatable tr #category select');
                let val_item = element.val();
                element.parent().html(val_item)
            }
            if(!$target.closest('#driving_licence_datatable tr #state').length && 
            $('#driving_licence_datatable tr #state select').is(":visible")) {
                let element = $('#driving_licence_datatable tr #state select');
                let val_item = element.val();
                element.parent().html(val_item)
            }
            
        });
        
        var table_search;
        // $.ajax({
        //     type: 'GET',
        //     url: $('#Country_born').data('url'),
        //     data: { 'type': 'select_admin1' },
        //     success: function (data) {
        //         $('#Country_born').select2({
        //             data: data
        //         });
        //     }
        // });

        //Datepickers del formulario de licencia
        $("#expi_date_form").datepicker({ dateFormat: 'yy-mm-dd' });

        $("#expedition_day_form").datepicker({ dateFormat: 'yy-mm-dd' });

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
        // Selects del formulario de registro de licencias
        $("#category").select2();
        $("#country_expedition").select2();
        $("#state").select2();

        $.ajax({
            type: 'GET',
            url: $('#driver_information_dni_id').data('url'),
            data: { 'type': 'select_admin2' },
            success: function (data) {
                $('#driver_information_dni_id').select2({
                    data: data
                });
            }
        });

        $('#driver_information_dni_id').on('change', function () {
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




        $("#modal_form_drive_info").on("click", function () {
            $("#btn_search_company").show();
        });

        $("#form_driving_licence_admin").submit(function (event) {
            event.preventDefault();
            let data_form = $(this).serialize();
            let fecha_vencimiento = $("#expi_date_form").datepicker('getDate');
            let fecha_expedicion = $("#expedition_day_form").datepicker('getDate');
            if (fecha_expedicion >= fecha_vencimiento) {
                swal.fire(
                    'Fechas Incorrectas!',
                    'La fecha de expedición no puede ser mayor a la fecha de vencimiento.',
                    'warning'
                );
            } else {
                $.ajax({
                    type: 'POST',
                    url: $("#form_driving_licence_admin").data('url'),
                    data: data_form,
                    success: function (data) {
                        console.log(data);

                        if (Object.keys(data.errors).length > 0) {
                            let arr_errores = data.errors;
                            console.log(arr_errores);
                            $.each(arr_errores, function (index, value) {
                                let selector = "#" + index + "-error";
                                let selector_strong = "#" + index + "-error-strong";
                                $(selector).show();
                                $(selector_strong).text(value[0]);
                            });
                        } else {
                            $(".form-dataconductores").val("");
                            $(".error-strong").text("");
                            $("#form_create_driving_licence").modal('hide');
                            $('#driving_licence_datatable').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });
        $("#form_excel_driving_licence_admin").submit(function (event) {
            event.preventDefault();
            var datafr = new FormData($("#form_excel_driving_licence_admin")[0]);
            $.ajax({
                type: 'POST',
                url: $("#form_excel_driving_licence_admin").data('url'),
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
            'licence_id',
            'licence_num',
            'user_information_DNI_id',
            'first_name',
            'f_last_name',
            'country_expedition',
            'category',
            'state',
            'expedition_day',
            'expi_date'
        ];

        var enums = {
            'Education': {
                'Primaria': 'Primaria', 'Secundaria': 'Secundaria', 'Pregrado': 'Pregrado', 'Postgrado': 'Postgrado', 'Sin informacion': 'Sin informacion'
            },
            'Civil_state': {
                'Soltero': 'Soltero', 'Casado': 'Casado', 'Separado': 'Separado', 'Divorciado': 'Divorciado', 'Viudo': 'Viudo', 'Union libre': 'Union libre', 'Sin información': 'Sin información'
            }
        }


        var table = $('#driving_licence_datatable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: $('#driving_licence_datatable').data('url-list'),
            columns: [
                { data: 'delete_row', name: 'delete_row', "data": null, "defaultContent": '<center><button class="btn btn-danger" id="btn_delete_driving_licence"><span class="trash_icon"></span></button></center>' },
                { data: 'licence_id', name: 'licence_id', "visible": false },
                { data: 'licence_num', name: 'licence_num' },
                { data: 'driver_information_dni_id', name: 'driver_information_dni_id', "visible": false },
                { data: 'first_name', name: 'first_name' },
                { data: 'f_last_name', name: 'f_last_name' },
                { data: 'country_expedition', name: 'country_expedition' },
                { data: 'category', name: 'category' },
                { data: 'state', name: 'state' },
                { data: 'expedition_day', name: 'expedition_day' },
                { data: 'expi_date', name: 'expi_date' },
            ],
            language: language_dt,

            columnDefs: [{
                targets: '_all',
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).attr("id", fields[col])
                }
            }],
            // createdRow: function( row, data, dataIndex ) {

            //     if( data.hasOwnProperty("id") ) {
            //         row.id = "row-" + data.id;
            //     } 
            //     debugger
            //     $( row ).attr({'data-id': data.id, id:'idUser'});
            // }

        });

        $('#driving_licence_datatable').on('click', 'tr td #btn_delete_driving_licence', function () {
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
                        url: $("#driving_licence_datatable").data("url-delete"),
                        data: data_delete,
                        success: function (data) {
                            if (data.error == "") {
                                swal.fire(
                                    'Proceso Completado',
                                    'El usuario ha sido eliminado.',
                                    'success'
                                );
                                $('#driving_licence_datatable').DataTable().ajax.reload();
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
                    url: $("#update-driving-licence-route").val(),
                    data: dataSend,
                    success: function (data) {
                        if (Object.keys(data.response).length === 0)
                            swal(
                                'Error!',
                                data.response,
                                'error'
                            )
                    }
                });
            }
            console.log("The values for each cell in that row are: " + updatedRow.data());
        }

        table.MakeCellsEditable({
            "onUpdate": myCallbackFunction,
            columns: [2, 6, 7, 8, 9, 10],
            "inputTypes": [
                {
                    "column": 6,
                    "type": "list",
                    "options": enum_country_expedition
                },
                {
                    "column": 7,
                    "type": "list",
                    "options": enum_category
                },
                {
                    "column": 8,
                    "type": "list",
                    "options": enum_state
                }

            ]
        });

        // $('#user_datatable').on('click', 'tbody td', function () {
        //     alert('oye mi perro')
        //     table_user.cell( this ).edit();
        // } );
    });


    // The rest of the code goes here!
}));