// IIFE - Immediately Invoked Function Expression
(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {
        $("#department").on('change', function(){
            let data_admin2 = $(this).val();
            let data_cities = new Array();
            $.each(list_admin3, function( index, value ) {
                let admin2_item = value.adm2_id;
                if(data_admin2==admin2_item){
                    let admin3_item = {"id":value.adm3_id,"text":value.name};
                    data_cities.push(admin3_item)
                }
            });
            $("#city_born_form").attr('disabled', false);

            $('#city_born_form').html("");
            $("#city_born_form").select2({
                data:data_cities
            });
        });

        var table_search;
        $('#gender').select2();
        $('#education').select2();
        $('#country_born').select2();
        $('#civil_state').select2();
        $('#city_born_form').select2();
        
        $.ajax({
            type: 'GET',
            url: $('#department').data('url'),
            data: { 'type': 'select_admin2' },
            success: function (data) {
                $('#department').select2({
                    data: data
                });
            }
        });

        $.ajax({
            type: 'GET',
            url: $('#company_id').data('url'),
            data: { 'type': 'companies' },
            success: function (data) {
                $('#company_id_excel').select2({
                    data: data
                });
            }
        });

        $.ajax({
            type: 'GET',
            url: $('#company_id').data('url'),
            data: { 'type': 'companies' },
            success: function (data) {
                $('#company_id').select2({
                    data: data
                });
            }
        });

        $.ajax({
            type: 'GET',
            url: $('#city_residence_place').data('url'),
            data: { 'type': 'admin3' },
            success: function (data) {
                $('#city_residence_place').select2({
                    data: data
                });
            }
        });

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

        $("#form_driver_info_admin").submit(function (event) {
            event.preventDefault();
            let data_form = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $("#form_driver_info_admin").data('url'),
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
                        $("#form_create_driver_information").modal('hide');
                        $('#drive_information_datatable').DataTable().ajax.reload();
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
            'dni_id',
            'first_name',
            'second_name',
            'f_last_name',
            's_last_name',
            'gender',
            'education',
            'e_mail_address',
            'address',
            'country_born',
            'city_born',
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
            ajax: $('#driver-info-list-route').val(),
            columns: [
                { data: 'delete_row', name: 'delete_row', "data": null, "defaultContent": '<center><button class="btn btn-danger" id="btn_delete_drive_info"><span class="trash_icon"></span></button></center>' },
                { data: 'dni_id', name: 'dni_id' },
                { data: 'first_name', name: 'first_name' },
                { data: 'second_name', name: 'second_name' },
                { data: 'f_last_name', name: 'f_last_name' },
                { data: 's_last_name', name: 's_last_name' },
                { data: 'gender', name: 'gender' },
                { data: 'education', name: 'education' },
                { data: 'e_mail_address', name: 'e_mail_address' },
                { data: 'address', name: 'address' },
                { data: 'country_born', name: 'country_born' },
                { data: 'city_born', name: 'city_born' },
                { data: 'city_residence_place', name: 'city_residence_place' },
                { data: 'department', name: 'department' },
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

        $('#drive_information_datatable').on('click', 'tr td #btn_delete_drive_info', function () {
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
                        url: $("#form_driver_info_admin").data("url-delete"),
                        data: data_delete,
                        success: function (data) {
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
                    success: function (data) {
                        if (Object.keys(data.response).length === 0)
                            swal(
                                'Error!',
                                data.response,
                                'error'
                            )
                    }
                });
            }else{
                $('#drive_information_datatable').DataTable().ajax.reload();
            }
            console.log("The values for each cell in that row are: " + updatedRow.data());
        }

        table.MakeCellsEditable({
            "onUpdate": myCallbackFunction,
            columns: [2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 14, 15, 16, 17, 18],
            "inputTypes": [
                {
                    "column": 6,
                    "type": "list",
                    "options": [
                        {"value":"","display":"Seleccionar"},
                        {"value":"Masculino","display":"Masculino"},
                        {"value":"Femenino","display":"Femenino"}
                    ]
                },
                {
                    "column": 7,
                    "type": "list",
                    "options": enum_education
                },
                {
                    "column": 15,
                    "type": "list",
                    "options": enum_civil_state
                },
                {
                    "column": 10,
                    "type": "list",
                    "options": enum_country_born
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