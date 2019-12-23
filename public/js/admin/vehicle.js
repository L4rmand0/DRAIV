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
            if(!$target.closest('#vehicle_datatable tr #taxi_type').length && 
            $('#vehicle_datatable tr #taxi_type select').is(":visible")) {
                let element = $('#vehicle_datatable tr #taxi_type select');
                let val_item = element.val();
                element.parent().html(val_item)
            }
            if(!$target.closest('#vehicle_datatable tr #type_v').length && 
            $('#vehicle_datatable tr #type_v select').is(":visible")) {
                let element = $('#vehicle_datatable tr #type_v select');
                let val_item = element.val();
                element.parent().html(val_item)
            }
            if(!$target.closest('#vehicle_datatable tr #service').length && 
            $('#vehicle_datatable tr #service select').is(":visible")) {
                let element = $('#vehicle_datatable tr #service select');
                let val_item = element.val();
                element.parent().html(val_item)
            }
            
            
        });

        var table_search;

        //Selects de vehículos
        $("#type_v").select2();
        $("#owner_v").select2();
        $("#taxi_type").select2();
        $("#taxi_number_of_drivers").select2();
        $("#capacity").select2();
        $("#service").select2();



        //Datepickers del formulario de vehículos
        $("#soat_expi_date_form").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#technomechanical_date_form").datepicker({ dateFormat: 'yy-mm-dd' });


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


        $("#plate_id_form").on('change', function(){
            $(".error-strong").text("");
        });

        $('#drive_information_dni_id').on('change', function () {
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
        $("#form_excel_vehicle_admin").submit(function (event) {
            event.preventDefault();
            var datafr = new FormData($("#form_excel_vehicle_admin")[0]);
            $.ajax({
                type: 'POST',
                url: $("#form_excel_vehicle_admin").data('url'),
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
            'plate_id',
            'type_v',
            'owner_v',
            'taxi_type',
            'taxi_number_of_drivers',
            'soat_expi_date',
            'capacity',
            'service',
            'cylindrical_cc',
            'v_class',
            'model',
            'line',
            'brand',
            'color',
            'technomechanical_date',
        ];

        var enums = {
            'service': {
                'Particular': 'Particular', 'Transporte_mercancia': 'Transporte_mercancia', 'Transporte_publico': 'Transporte_publico', 'Otros': 'Otros'
            },
            'taxi_type': {
                'Taxi amarillo': 'Taxi amarillo', 'Taxi blanco': 'Taxi blanco', 'NA': 'NA'
            },
            'type_v': {
                'Motos':'Motos','Camperos':'Camperos','Camionetas':'Camionetas','Vehículos de carga o\nmixtos':'Vehículos de carga o\nmixtos','vehículos oficiales especiales y ambulancias':'vehículos oficiales especiales y ambulancias','Autos familiares':'Autos familiares','Vehículos particulares para seis (6) o más\npasajeros':'Vehículos particulares para seis (6) o más\npasajeros','Autos de negocios':'Autos de negocios','Taxis':'Taxis','Microbuses urbanos':'Microbuses urbanos','Buses\ny busetas':'Buses\ny busetas','Vehículos de servicio público intermunicipal':'Vehículos de servicio público intermunicipal'
            }
        }


        var table = $('#vehicle_datatable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: $('#vehicle_datatable').data('url-list'),
            columns: [
                { data: 'delete_row', name: 'delete_row', "data": null, "defaultContent": '<center><button class="btn btn-danger" id="btn_delete_vehicle"><span class="trash_icon"></span></button></center>' },
                { data: 'plate_id', name: 'plate_id' },
                { data: 'type_v', name: 'type_v' },
                { data: 'owner_v', name: 'owner_v' },
                { data: 'taxi_type', name: 'taxi_type' },
                { data: 'taxi_number_of_drivers', name: 'taxi_number_of_drivers' },
                { data: 'soat_expi_date', name: 'soat_expi_date' },
                { data: 'capacity', name: 'capacity' },
                { data: 'service', name: 'service' },
                { data: 'cylindrical_cc', name: 'cylindrical_cc' },
                { data: 'v_class', name: 'v_class' },
                { data: 'model', name: 'model' },
                { data: 'line', name: 'line' },
                { data: 'brand', name: 'brand' },
                { data: 'color', name: 'color' },
                { data: 'technomechanical_date', name: 'technomechanical_date' },
            ],
            language: language_dt,

            columnDefs: [{
                targets: '_all',
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).attr("id", fields[col])
                }
            }],
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
                    url: $("#update-vehicle-route").val(),
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
            columns: [2,3,4,5,6,7,8,9,10,11,12,13,14,15],
            "inputTypes": [
                {
                    "column": 2,
                    "type": "list",
                    "options": enum_type_v
                },
                {
                    "column": 4,
                    "type": "list",
                    "options": enum_taxi_type
                },
                {
                    "column": 8,
                    "type": "list",
                    "options": enum_service
                }

             ]
        });
    });


    // The rest of the code goes here!
}));