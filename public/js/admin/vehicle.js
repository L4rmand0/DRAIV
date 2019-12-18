// IIFE - Immediately Invoked Function Expression
(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {
        var table_search;

        //Selects de vehículos
        $("#Type_V").select2();
        $("#Owner_V").select2();
        $("#Taxi_type").select2();
        $("#taxi_Number_of_drivers").select2();
        $("#Capacity").select2();
        $("#Service").select2();



        //Datepickers del formulario de vehículos
        $("#Soat_expi_date").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#technomechanical_date").datepicker({ dateFormat: 'yy-mm-dd' });


        $.ajax({
            type: 'GET',
            url: $('#User_information_DNI_id').data('url'),
            data: { 'type': 'select_admin2' },
            success: function (data) {
                $('#User_information_DNI_id').select2({
                    data: data
                });
            }
        });

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


        // $('#Company_id').select2({
        //     ajax: {
        //         url: $('#Company_id').data('url'),
        //         dataType: 'json'
        //     }
        // });

        // $('#City_born').select2({
        //     ajax: {
        //         url: $('#City_born').data('url'),
        //         dataType: 'json'
        //     }
        // });


        // $('#Company_id').select2({
        //     ajax: {
        //         url: $('#Company_id').data('url'),
        //         dataType: 'json'
        //     }
        // });

        $("#btn_search_company").on("click", function () {
            $(this).hide();
            // let company = $("#search_name_company").val();
            // let nit_company = $("#search_nit").val();
            // data_send = { 'company': company, 'nit_company': nit_company }

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
                // columnDefs: [{
                //     targets: '_all',
                //     createdCell: function (td, cellData, rowData, row, col) {
                //         $(td).attr("id", fields[col])
                //     }
                // }]
            });


            // DELETE
            $('#search_company_datatable tbody').on('click', 'tr', function () {
                var data = table_search.row(this).data();
                $("#Company_id").val(data['nit']);
            });



            // $('#button').click( function () {
            //     table.row('.selected').remove().draw( false );
            // } );

            // $.ajax({
            //     type: 'POST',
            //     url: $(this).data('url'),
            //     data: data_send,
            //     success: function (data) {
            //         console.log(data);

            //     }
            // });
        });




        $("#modal_form_drive_info").on("click", function () {
            $("#btn_search_company").show();
        });

        $("#form_vehicle_admin").submit(function (event) {
            event.preventDefault();
            let data_form = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $("#form_vehicle_admin").data('url'),
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
                            // $(selector).show();
                            // $(selector).text(value);
                            // error_founds = error_founds + 1;
                        });
                    } else {
                        $(".form-dataconductores").val("");
                        $(".error-strong").text("");
                        $("#form_create_vehicle").modal('hide');
                        $('#vehicle_datatable').DataTable().ajax.reload();
                    }
                }
            });
        });
        $("#form_excel_driver_info_admin").submit(function (event) {
            event.preventDefault();
            var datafr = new FormData($("#form_excel_driver_info_admin")[0]);
            $.ajax({
                type: 'POST',
                url: $("#form_excel_driver_info_admin").data('url'),
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
            'DNI_id',
            'First_name',
            'Second_name',
            'F_last_name',
            'S_last_name',
            'Gender',
            'Education',
            'E_mail_address',
            'address',
            'Country_born',
            'City_born',
            'City_Residence_place',
            'Department',
            'phone',
            'Civil_state',
            'Score',
            'Db_user_id',
            'Company_id'
        ];

        var enums = {
            'Education': {
                'Primaria': 'Primaria', 'Secundaria': 'Secundaria', 'Pregrado': 'Pregrado', 'Postgrado': 'Postgrado', 'Sin informacion': 'Sin informacion'
            },
            'Civil_state': {
                'Soltero': 'Soltero', 'Casado': 'Casado', 'Separado': 'Separado', 'Divorciado': 'Divorciado', 'Viudo': 'Viudo', 'Union libre': 'Union libre', 'Sin información': 'Sin información'
            }
        }


        var table = $('#vehicle_datatable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: $('#vehicle_datatable').data('url-list'),
            columns: [
                { data: 'delete_row', name: 'delete_row', "data": null, "defaultContent": '<center><button class="btn btn-danger" id="btn_delete_vehicle"><span class="trash_icon"></span></button></center>' },
                { data: 'Plate_id', name: 'Plate_id' },
                { data: 'Type_V', name: 'Type_V' },
                { data: 'Owner_V', name: 'Owner_V' },
                { data: 'Taxi_type', name: 'Taxi_type' },
                { data: 'taxi_Number_of_drivers', name: 'taxi_Number_of_drivers' },
                { data: 'Soat_expi_date', name: 'Soat_expi_date' },
                { data: 'Capacity', name: 'Capacity' },
                { data: 'Service', name: 'Service' },
                { data: 'Cylindrical_cc', name: 'Cylindrical_cc' },
                { data: 'V_class', name: 'V_class' },
                { data: 'Model', name: 'Model' },
                { data: 'Line', name: 'Line' },
                { data: 'Brand', name: 'Brand' },
                { data: 'Color', name: 'Color' },
                { data: 'technomechanical_date', name: 'technomechanical_date' },
                { data: 'First_name', name: 'First_name' },
                { data: 'S_last_name', name: 'S_last_name' },
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
            // columns: [2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 14, 15, 16, 17, 18],
            // "inputTypes": [
            //     {
            //         "column": 7,
            //         "type": "list",
            //         "options": [
            //             { "value": enums.Education['Primaria'], "display": enums.Education['Primaria'] },
            //             { "value": enums.Education['Secundaria'], "display": enums.Education['Secundaria'] },
            //             { "value": enums.Education['Pregrado'], "display": enums.Education['Pregrado'] },
            //             { "value": enums.Education['Postgrado'], "display": enums.Education['Postgrado'] },
            //             { "value": enums.Education['Sin información'], "display": enums.Education['Sin información'] },
            //         ]
            //     },
            //     {
            //         "column": 15,
            //         "type": "list",
            //         "options": [
            //             { "value": enums.Civil_state['Soltero'], "display": enums.Civil_state['Soltero'] },
            //             { "value": enums.Civil_state['Casado'], "display": enums.Civil_state['Casado'] },
            //             { "value": enums.Civil_state['Separado'], "display": enums.Civil_state['Separado'] },
            //             { "value": enums.Civil_state['Divorciado'], "display": enums.Civil_state['Divorciado'] },
            //             { "value": enums.Civil_state['Viudo'], "display": enums.Civil_state['Viudo'] },
            //             { "value": enums.Civil_state['Union libre'], "display": enums.Civil_state['Union libre'] },
            //             { "value": enums.Civil_state['Sin información'], "display": enums.Civil_state['Sin información'] },
            //         ]
            //     }

            // ]
        });

        // $('#user_datatable').on('click', 'tbody td', function () {
        //     alert('oye mi perro')
        //     table_user.cell( this ).edit();
        // } );
    });


    // The rest of the code goes here!
}));