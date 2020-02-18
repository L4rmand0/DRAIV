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
            // $(this).editBehaviourSelectFixedDT($target, "#skills_m_t_m_datatable", "#profile_id");
        });

        

        $("#technom_expi_date_form").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#date_penality_1_form").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#date_penality_2_form").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#date_penality_3_form").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#date_penality_4_form").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#date_penality_5_form").datepicker({ dateFormat: 'yy-mm-dd' });

        $.ajax({
            type: 'GET',
            url: $('#user_vehicle_id_form').data('url'),
            data: { 'type': 'select_admin2' },
            success: function(data) {
                $('#user_vehicle_id_form').select2({
                    data: data
                });
                if($("#user_vehicle_id_form option").length == 1){
                    $("#user_vehicle_id_form-error-strong").html("<p>No se ha registrado ningún conductor.<a href='"+$("#route-driver-information").val()+"'> Registrar</a></p>");
                }
            }
        });

        $("#form_manual_doc_v_admin").submit(function(event) {
            event.preventDefault();
            let data_form = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $("#register-route").val(),
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
                        $("#form_create_skills_mtm input[type=text]").val("");
                        $("#form_create_skills_mtm input[type=password]").val("");
                        $("#form_create_skills_mtm select").val("");
                        $("#form_create_skills_mtm input[type=email]").val("");
                        $("#defaultChecked2").prop('checked', false);
                        $('#form_create_skills_mtm').modal('hide');
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

        //Arreglo que genera el atributo id de cada elemento td celda del datatable
        var fields = [
            'delete_row',
            'id',
            'name',
            'email',
            'profile_id',
        ];

        //Instancia del datatable
        var table = $('#manual_doc_v_datatable').DataTable({
            processing: true,
            serverSide: true,
            "scrollY":"400px",
            "scrollCollapse": true,
            ajax: $('#data-table-route').val(),
            columns: [
                { data: 'delete_row', name: 'delete_row', "data": null, "defaultContent": '<center><button class="btn btn-sm btn-danger" id="btn_delete_user"><i class="fas fa-trash"></i></button></center>' },
                { data: 'doc_id', name: 'doc_id', "visible": false },
                { data: 'valid_licence', name: 'valid_licence' },
                { data: 'category', name: 'category' },
                { data: 'soat_avalaible', name: 'soat_avalaible' },
                { data: 'technom_review', name: 'technom_review' },
                { data: 'technom_expi_date', name: 'technom_expi_date' },
                { data: 'run_state', name: 'run_state' },
                { data: 'accident_rate', name: 'accident_rate' },
                { data: 'penalty_record', name: 'penalty_record' },
                { data: 'date_penalty_1', name: 'date_penalty_1' },
                { data: 'date_penalty_2', name: 'date_penalty_2' },
                { data: 'date_penalty_3', name: 'date_penalty_3' },
                { data: 'date_penalty_4', name: 'date_penalty_4' },
                { data: 'date_penalty_5', name: 'date_penalty_5' },
                { data: 'code_penalty_1', name: 'code_penalty_1' },
                { data: 'code_penalty_2', name: 'code_penalty_2' },
                { data: 'code_penalty_3', name: 'code_penalty_3' },
                { data: 'code_penalty_4', name: 'code_penalty_4' },
                { data: 'code_penalty_5', name: 'code_penalty_5' },
                { data: 'validated_data', name: 'validated_data' },
                { data: 'first_name', name: 'first_name' },
                { data: 'f_last_name', name: 'f_last_name' },
                { data: 'dni_id', name: 'dni_id' },
                { data: 'plate_id', name: 'plate_id' },
            ],
            language: language_dt,
            columnDefs: [{
                    targets: '_all',
                    //Función que crea el atributo id de cada celda
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr("id", fields[col])
                    }
                },
            ],
        });

        // Función para borrar registro de la tabla
        $('#manual_doc_v_datatable').on('click', 'tr td #btn_delete_user', function() {
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
                        url: $("#form_manual_doc_v_admin").data("url-delete"),
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
            // debugger
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
            // "inputTypes": [{
            //     "column": 4,
            //     "type": "list-fixed",
            //     "options": profile_list
            // }]
        });

    });
    // The rest of the code goes here!
}));