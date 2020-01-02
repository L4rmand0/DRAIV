// IIFE - Immediately Invoked Function Expression
(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {

        var enums = {
            'User_profile': {
                'User': 'User', 'Administrator': 'Administrator', 'Evaluator': 'Evaluator'
            }
        }

        $("#form_user_admin").submit(function (event) {
            event.preventDefault();
            let data_form = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $("#btn_admin_user ").data('url'),
                data: data_form,
                success: function (data) {
                    console.log(data);
                    $(".error-strong").text("");
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
                        $("#form_user_admin input[type=text]").val("");
                        $("#form_user_admin input[type=password]").val("");
                        $("#form_user_admin select").val("");
                        $("#form_user_admin input[type=email]").val("");
                        $("#defaultChecked2").prop('checked', false);
                        $('#form_create_user').modal('hide');
                        swal.fire(
                            'Proceso Completado!',
                            data.success,
                            'success'
                        )
                        $('#user_datatable').DataTable().ajax.reload();
                    }
                }
            });
        });

        var fields = [
            'delete_row',
            'id',
            'name',
            'email',
            'user_profile',
        ];
        var table = $('#user_datatable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 5,
            ajax: $('#users-list-route').val(),
            columns: [
                { data: 'delete_row', name: 'delete_row', "data": null, "defaultContent": '<center><button class="btn btn-sm btn-danger" id="btn_delete_user"><span class="trash_icon"></span></button></center>' },
                { data: 'id', name: 'id', "visible": false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'user_profile', name: 'user_profile' }
            ],
            language: language_dt,
            columnDefs: [
                {
                    targets: '_all',
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).attr("id", fields[col])
                    }
                },
                {
                    "targets": [0],
                    "data": null,
                    "defaultContent": '<input id="check" type="checkbox">'
                }
            ],
            // columnDefs: [{
            //     targets: '_all',
            //     createdCell: createdCell
            // }],
            // createdRow: function (row, data, dataIndex) {
            // if( data.hasOwnProperty("id") ) {
            //     row.id = "row-" + data.id;
            // } 
            //     $(row).attr({ 'data-id': data.id, id: 'idUser' });
            // }
        });


        $('#user_datatable').on('click', 'tr td #btn_delete_user', function () {
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
                        url: $("#form_user_admin").data("url-delete"),
                        data: data_delete,
                        success: function (data) {
                            if (data.error == "") {
                                swal.fire(
                                    'Proceso Completado',
                                    'El usuario ha sido eliminado.',
                                    'success'
                                );
                                $('#user_datatable').DataTable().ajax.reload();
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
                    url: $("#update-users-route").val(),
                    data: dataSend,
                    async: false,
                    success: function (data) {
                        if (Object.keys(data.response).length === 0)
                            swal.fire(
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
            "inputTypes": [
                {
                    "column": 4,
                    "type": "list",
                    "options": [
                        { "value": enums.User_profile['User'], "display": enums.User_profile['User'] },
                        { "value": enums.User_profile['Administrator'], "display": enums.User_profile['Administrator'] },
                        { "value": enums.User_profile['Evaluator'], "display": enums.User_profile['Evaluator'] }
                    ]
                }
            ]
        });

    });


    // The rest of the code goes here!
}));