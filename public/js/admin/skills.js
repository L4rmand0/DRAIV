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
            $(this).editBehaviourSelectFixedDT($target, "#skills_m_t_m_datatable", "#profile_id");
            // $(this).editBehaviourInputDT($target, "#skills_m_t_m_datatable", "#name");
            // $(this).editBehaviourInputDT($target, "#skills_m_t_m_datatable", "#email");
        });

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

        $("#form_create_skills_mtm").submit(function(event) {
            event.preventDefault();
            $target = $(this);
            let data_form = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $("#register-route").val(),
                data: data_form,
                success: function(data) {
                    console.log(data);
                    $(".error-strong").text("");
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
                        $target.cleanForm("#form_create_skills_mtm");
                        swal.fire(
                            'Proceso Completado!',
                            data.success,
                            'success'
                        )
                        $('#skills_m_t_m_datatable').DataTable().ajax.reload();
                    }
                }
            });
        });

        //Arreglo que genera el atributo id de cada elemento td celda del datatable
        var fields = [
            'delete_row',
            'reg_id',
            // 'date_evaluation',
            'slalom',
            'projection',
            'braking',
            'evasion',
            // 'mobility',
            // 'result',
            'first_name',
            'f_last_name',
            'dni_id',
            'plate_id',
        ];

        //Instancia del datatable
        var table = $('#skills_m_t_m_datatable').DataTable({
            processing: true,
            serverSide: true,
            "scrollY":"400px",
            "scrollCollapse": true,
            ajax: $('#data-table-route').val(),
            columns: [
                { data: 'delete_row', name: 'delete_row', "data": null, "defaultContent": '<center><button class="btn btn-sm btn-danger" id="btn_delete_user"><i class="fas fa-trash"></i></button></center>' },
                { data: 'reg_id', name: 'reg_id', "visible": false },
                // { data: 'date_evaluation', name: 'date_evaluation' },
                { data: 'slalom', name: 'slalom' },
                { data: 'projection', name: 'projection' },
                { data: 'braking', name: 'braking' },
                { data: 'evasion', name: 'evasion' },
                // { data: 'mobility', name: 'mobility' },
                // { data: 'result', name: 'result' },
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
        $('#skills_m_t_m_datatable').on('click', 'tr td #btn_delete_user', function() {
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
                        url: $("#delete-route").val(),
                        data: data_delete,
                        success: function(data) {
                            if (data.error == "") {
                                swal.fire(
                                    'Proceso Completado',
                                     data.response,
                                    'success'
                                );
                                $('#skills_m_t_m_datatable').DataTable().ajax.reload();
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
            "columns":[2,3,4,5],
            "inputTypes": [{
                "column": 2,
                "type": "list-fixed",
                "options": category_t_list
            },
            {
                "column": 3,
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