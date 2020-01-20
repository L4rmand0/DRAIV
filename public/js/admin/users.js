// IIFE - Immediately Invoked Function Expression
// var previous_element;
// var new_element;
// var new_element_val;


(function(runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function($, window, document) {

    // Listen for the jQuery ready event on the document
    $(function() {
        $(document).click(function(event) {
            $target = $(event.target);
            $(this).editBehaviourSelectFixedDT($target, "#user_datatable", "#profile_id");
            // if ($target.closest('#user_datatable tr #user_profile').length) {
            //     if (typeof new_element['index'] === 'undefined') {
            //         prev_element['index'] = $target.find("select").data("index");
            //         prev_element['value'] = $target.find("select").val();
            //         new_element['index'] = $target.find("select").data("index");
            //         new_element['value'] = $target.find("select").val();
            //     } else {
            //         let old_new_element = new Array();
            //         old_new_element['index'] = new_element['index'];
            //         old_new_element['value'] = new_element['value'];
            //         console.log("new class: " + $target.find("select").data("index"));
            //         console.log("new class: " + $target.find("select").val());
            //         if (typeof $target.find("select").data("index") === 'undefined') {} else {
            //             new_element['index'] = $target.find("select").data("index");
            //             new_element['value'] = $target.find("select").val();
            //             prev_element = old_new_element;
            //         }
            //         if (new_element['index'] != prev_element['index']) {
            //             let selector = "#user_datatable tr #user_profile ." + prev_element['index'];
            //             $(selector).parent().html(prev_element['value']);
            //         }
            //     }
            // } else {
            //     if (!$target.closest('#user_datatable tr #user_profile').length &&
            //         $('#user_datatable tr #user_profile select').is(":visible")) {
            //         let element = $('#user_datatable tr #user_profile select');
            //         let val_item = element.val();
            //         element.parent().html(val_item)
            //     }
            // }
        });

        var enums = {
            'User_profile': {
                'User': 'User',
                'administrator': 'administrator',
                'evaluator': 'evaluator'
            }
        }

        $.ajax({
            type: 'GET',
            url: $('#company_id_form').data('url'),
            data: { 'type': 'select_admin2' },
            success: function(data) {
                $('#company_id_form').select2({
                    data: data
                });
            }
        });

        $.ajax({
            type: 'GET',
            url: $('#profile_id_form').data('url'),
            data: { 'type': 'select_admin2' },
            success: function(data) {
                $('#profile_id_form').select2({
                    data: data
                });
            }
        });

        $("#form_user_admin").submit(function(event) {
            event.preventDefault();
            let data_form = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $("#btn_admin_user").data('url'),
                data: data_form,
                success: function(data) {
                    console.log(data);
                    $(".error-strong").text("");
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

        //Arreglo que genera los id de cada celda del datatable
        var fields = [
            'delete_row',
            'id',
            'name',
            'email',
            'profile_id',
        ];

        var table = $('#user_datatable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            ajax: $('#users-list-route').val(),
            columns: [
                { data: 'delete_row', name: 'delete_row', "data": null, "defaultContent": '<center><button class="btn btn-sm btn-danger" id="btn_delete_user"><i class="fas fa-trash"></i></button></center>' },
                { data: 'id', name: 'id', "visible": false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'user_profile', name: 'user_profile' }
            ],
            language: language_dt,
            columnDefs: [{
                    targets: '_all',
                    //Función que crea el atributo id de cada celda
                    createdCell: function(td, cellData, rowData, row, col) {
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


        $('#user_datatable').on('click', 'tr td #btn_delete_user', function() {
            let row = $(this).parents('tr')
            let data_delete = table.row(row).data();
            swal.fire({
                title: '<strong>Eliminar Información</strong>',
                icon: 'warning',
                html: '¿Está seguro que desea eliminar este registro? ',
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
                        url: $("#form_user_admin").data("url-delete"),
                        data: data_delete,
                        success: function(data) {
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

        function myCallbackFunction(updatedCell, updatedRow, oldValue, id = false) {
            console.log("The new value for the cell is: " + updatedCell.data());
            if (oldValue != updatedCell.data()) {
                dataSend = updatedRow.data();
                if (id == false) {
                    dataSend.valuech = updatedCell.data();
                } else {
                    dataSend.valuech = id;
                }
                dataSend.fieldch = updatedCell.nodes()[0].id;
                $.ajax({
                    type: 'POST',
                    url: $("#update-users-route").val(),
                    data: dataSend,
                    async: false,
                    success: function(data) {
                        if (Object.keys(data.errors).length > 0) {
                            swal.fire(
                                'Error!',
                                data.errors.response,
                                'error'
                            )
                        }

                    }
                });
            }
            console.log("The values for each cell in that row are: " + updatedRow.data());
        }

        table.MakeCellsEditable({
            "onUpdate": myCallbackFunction,
            "inputTypes": [{
                "column": 4,
                "type": "list-fixed",
                "options": profile_list
                    // [
                    //     { "value": enums.User_profile['User'], "display": enums.User_profile['User'] },
                    //     { "value": enums.User_profile['administrator'], "display": enums.User_profile['administrator'] },
                    //     { "value": enums.User_profile['evaluator'], "display": enums.User_profile['evaluator'] }
                    // ]
            }]
        });

    });
    // The rest of the code goes here!
}));