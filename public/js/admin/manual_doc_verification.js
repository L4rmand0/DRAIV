// IIFE - Immediately Invoked Function Expression
// var previous_element;
// var new_element;
// var new_element_val;


(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {

    // Listen for the jQuery ready event on the document
    $(function () {
        $(document).click(function (event) {
            $target = $(event.target);
            $(this).editBehaviourInputDT($target, "#drive_information_datatable", "#valid_licence");
            $(this).editBehaviourSelectFixedDT($target, "#manual_doc_v_datatable", "#category");
            $(this).editBehaviourSelectFixedDT($target, "#manual_doc_v_datatable", "#soat_available");
            $(this).editBehaviourSelectFixedDT($target, "#manual_doc_v_datatable", "#technom_review");
            $(this).editBehaviourInputDT($target, "#manual_doc_v_datatable", "#technom_expi_date");
            $(this).editBehaviourSelectFixedDT($target, "#manual_doc_v_datatable", "#run_state");
            $(this).editBehaviourInputDT($target, "#manual_doc_v_datatable", "#accident_rate");
            $(this).editBehaviourInputDT($target, "#manual_doc_v_datatable", "#penality_record");
            $(this).editBehaviourInputDT($target, "#manual_doc_v_datatable", "#date_penality_1");
            $(this).editBehaviourInputDT($target, "#manual_doc_v_datatable", "#date_penality_2");
            $(this).editBehaviourInputDT($target, "#manual_doc_v_datatable", "#date_penality_3");
            $(this).editBehaviourInputDT($target, "#manual_doc_v_datatable", "#date_penality_4");
            $(this).editBehaviourInputDT($target, "#manual_doc_v_datatable", "#date_penality_5");
            $(this).editBehaviourInputDT($target, "#manual_doc_v_datatable", "#code_penality_1");
            $(this).editBehaviourInputDT($target, "#manual_doc_v_datatable", "#code_penality_2");
            $(this).editBehaviourInputDT($target, "#manual_doc_v_datatable", "#code_penality_3");
            $(this).editBehaviourInputDT($target, "#manual_doc_v_datatable", "#code_penality_4");
            $(this).editBehaviourInputDT($target, "#manual_doc_v_datatable", "#code_penality_5");
            $(this).editBehaviourInputDT($target, "#manual_doc_v_datatable", "#validated_data");
            $(this).editBehaviourInputDT($target, "#manual_doc_v_datatable", "#first_name");
            $(this).editBehaviourInputDT($target, "#manual_doc_v_datatable", "#f_last_name");
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
            success: function (data) {
                $('#user_vehicle_id_form').select2({
                    data: data
                });
                if ($("#user_vehicle_id_form option").length == 1) {
                    $("#user_vehicle_id_form-error-strong").html("<p>No se ha registrado ningún conductor.<a href='" + $("#route-driver-information").val() + "'> Registrar</a></p>");
                }
            }
        });

        $("#form_manual_doc_v_admin").submit(function (event) {
            $target = $(this);
            event.preventDefault();
            let data_form = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $("#register-route").val(),
                data: data_form,
                success: function (data) {
                    console.log(data);
                    if (Object.keys(data.errors).length > 0) {
                        if (data.response == "error_swal") {
                            swal.fire(
                                'Error en el proceso!',
                                data.message,
                                'error'
                            )
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
                        $target.cleanForm("#form_manual_doc_v_admin");
                        // $("#form_create_skills_mtm input[type=text]").val("");
                        // $("#form_create_skills_mtm input[type=password]").val("");
                        // $("#form_create_skills_mtm select").val("");
                        // $("#form_create_skills_mtm input[type=email]").val("");
                        // $('#form_create_skills_mtm').modal('hide');
                        swal.fire(
                            'Proceso Completado!',
                            data.success,
                            'success'
                        )
                        $('#manual_doc_v_datatable').DataTable().ajax.reload();
                    }
                }
            });
        });

        //Arreglo que genera el atributo id de cada elemento td celda del datatable
        var fields = [
            'delete_row',
            'doc_id',
            'valid_licence',
            'category',
            'soat_available',
            'technom_review',
            'technom_expi_date',
            'run_state',
            'accident_rate',
            'penality_record',
            'date_penality_1',
            'date_penality_2',
            'date_penality_3',
            'date_penality_4',
            'date_penality_5',
            'code_penality_1',
            'code_penality_2',
            'code_penality_3',
            'code_penality_4',
            'code_penality_5',
            'validated_data',
            'first_name',
            'f_last_name',
            'dni_id',
            'plate_id',
        ];

        //Instancia del datatable
        var table = $('#manual_doc_v_datatable').DataTable({
            processing: true,
            serverSide: true,
            // "scrollY":"400px",
            // "scrollCollapse": true,
            "sScrollY": "600",
            "sScrollX": "100%",
            "bScrollCollapse": true,
            ajax: $('#data-table-route').val(),
            columns: [
                { data: 'delete_row', name: 'delete_row', "data": null, "defaultContent": '<center><button class="btn btn-sm btn-danger" id="btn_delete_user"><i class="fas fa-trash"></i></button></center>' },
                { data: 'doc_id', name: 'doc_id', "visible": false },
                { data: 'valid_licence', name: 'valid_licence' },
                { data: 'category', name: 'category' },
                { data: 'soat_available', name: 'soat_available' },
                { data: 'technom_review', name: 'technom_review' },
                { data: 'technom_expi_date', name: 'technom_expi_date' },
                { data: 'run_state', name: 'run_state' },
                { data: 'accident_rate', name: 'accident_rate' },
                { data: 'penality_record', name: 'penality_record' },
                { data: 'date_penality_1', name: 'date_penality_1' },
                { data: 'date_penality_2', name: 'date_penality_2' },
                { data: 'date_penality_3', name: 'date_penality_3' },
                { data: 'date_penality_4', name: 'date_penality_4' },
                { data: 'date_penality_5', name: 'date_penality_5' },
                { data: 'code_penality_1', name: 'code_penality_1' },
                { data: 'code_penality_2', name: 'code_penality_2' },
                { data: 'code_penality_3', name: 'code_penality_3' },
                { data: 'code_penality_4', name: 'code_penality_4' },
                { data: 'code_penality_5', name: 'code_penality_5' },
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
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).attr("id", fields[col])
                }
            },
            ],
        }).columns.adjust().draw();

        // Función para borrar registro de la tabla
        $('#manual_doc_v_datatable').on('click', 'tr td #btn_delete_user', function () {
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
                    url: $("#update-route").val(),
                    data: dataSend,
                    async: false,
                    success: function (data) {
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
            "columns":[2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20],
            "inputTypes": [{
                "column": 3,
                "type": "list-fixed",
                "options": category_t_list
            },
            {
                "column": 7,
                "type": "list-fixed",
                "options": runstate_t_list
            },
            {
                "column": 4,
                "type": "list-fixed",
                "options": soat_available_t_list
            },
            {
                "column": 5,
                "type": "list-fixed",
                "options": technom_review_t_list
            }]
        });

    });
    // The rest of the code goes here!
}));