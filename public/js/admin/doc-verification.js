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
            if (!$target.closest('#user_datatable tr #user_profile').length &&
                $('#user_datatable tr #user_profile select').is(":visible")) {
                let element = $('#user_datatable tr #user_profile select');
                let val_item = element.val();
                element.parent().html(val_item)
            }
        });

        var fields = [
            'first_name',
            'f_last_name',
            'dni_id',
            'plate_id',
            'licence_num',
            'validated_data',
        ];

        var table = $('#doc_verification_datatable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            ajax: $('#doc-verify-list-route').val(),
            columns: [
                // { data: 'delete_row', name: 'delete_row', "data": null, "defaultContent": '<center><button class="btn btn-sm btn-danger" id="btn_delete_user"><i class="fas fa-trash"></i></button></center>' },
                { data: 'first_name', name: 'first_name' },
                { data: 'f_last_name', name: 'f_last_name' },
                { data: 'dni_id', name: 'dni_id' },
                { data: 'plate_id', name: 'plate_id' },
                { data: 'licence_num', name: 'licence_num' },
                { data: 'validated_data', name: 'validated_data' },
            ],
            language: language_dt,
            columnDefs: [{
                targets: '_all',
                createdCell: function(td, cellData, rowData, row, col) {
                    $(td).attr("id", fields[col])
                    if (col == 5) {
                        let checked_attr;
                        if (cellData == 1) {
                            checked_attr = "checked='checked'";
                        } else {
                            checked_attr = "";
                        }
                        // $(td).html("<input type='checkbox' id='ejbeatycelledit' class=''>");
                        $(td).html("<label class='container_check'>" +
                            "<input type='checkbox'" + checked_attr + " class='check_validated_driver'>" +
                            "<span class='checkmark'></span></label>");
                    }
                }
            }],
        });


        $('#doc_verification_datatable').on('change', 'tr td .check_validated_driver', function() {
            let dni_id = $(this).parent('label').parent().parent().find("#dni_id").text();
            let validated;
            if (this.checked) {
                validated = 1;
            } else {
                validated = 0;
            }
            $.ajax({
                type: 'POST',
                url: $("#doc-verify-update").val(),
                data: { 'dni_id': dni_id, 'validated_data': validated },
            }).done(function(response) {
                if (Object.keys(response.response).length === 0) {
                    swal.fire(
                        'Error!',
                        response.response,
                        'error'
                    )
                }
            });
            // let row = $(this).parents('tr')
            // let data_delete = table.row(row).data();
            // swal.fire({
            //     title: '<strong>Eliminar Información</strong>',
            //     icon: 'warning',
            //     html: '¿Está seguro que desea eliminar este registro? ',
            //     showCloseButton: true,
            //     showCancelButton: true,
            //     focusConfirm: false,
            //     confirmButtonText: 'Confirmar',
            //     confirmButtonAriaLabel: 'Thumbs up, great!',
            //     cancelButtonText: 'Cancelar',
            //     cancelButtonAriaLabel: 'Thumbs down'
            // }).then((result) => {
            //     if (result.value) {
            //         $.ajax({
            //             type: 'POST',
            //             url: $("#form_user_admin").data("url-delete"),
            //             data: data_delete,
            //             success: function(data) {
            //                 if (data.error == "") {
            //                     swal.fire(
            //                         'Proceso Completado',
            //                         'El usuario ha sido eliminado.',
            //                         'success'
            //                     );
            //                     $('#user_datatable').DataTable().ajax.reload();
            //                 } else {
            //                     swal.fire(
            //                         'Ocurrió un error',
            //                         'La operación no pudo completarse, por favor intente de nuevo.',
            //                         'error'
            //                     );
            //                 }
            //             }
            //         });
            //     }
            // });
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
                    success: function(data) {
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
            columns: [],
            // "inputTypes": [{
            //     "column": 5,
            //     "type": "checkbox",
            // }]
        });

    });


    // The rest of the code goes here!
}));