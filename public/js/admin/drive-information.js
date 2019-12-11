// IIFE - Immediately Invoked Function Expression
(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {
        var table_search;
        $("#btn_search_company").on("click", function () {
            $(this).hide();
            // let company = $("#search_name_company").val();
            // let nit_company = $("#search_nit").val();
            // data_send = { 'company': company, 'nit_company': nit_company }
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
                // }],
            });

            

            $('#search_company_datatable tbody').on('click', 'tr', function () {
                var data = table_search.row( this ).data();
                $("#Company_id").val(data['nit']);
            } );

            // $.ajax({
            //     type: 'POST',
            //     url: $(this).data('url'),
            //     data: data_send,
            //     success: function (data) {
            //         console.log(data);

            //     }
            // });
        });

        $("#modal_form_drive_info").on("click", function(){
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
                        $("#form_create_driver_information").modal('hide');
                        table_search.destroy();
                    }
                }
            });
        });

        var fields = [
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


        var table = $('#drive_information_datatable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: $('#driver-info-list-route').val(),
            columns: [
                { data: 'DNI_id', name: 'DNI_id' },
                { data: 'First_name', name: 'First_name' },
                { data: 'Second_name', name: 'Second_name' },
                { data: 'F_last_name', name: 'F_last_name' },
                { data: 'S_last_name', name: 'S_last_name' },
                { data: 'Gender', name: 'Gender' },
                { data: 'Education', name: 'Education' },
                { data: 'E_mail_address', name: 'E_mail_address' },
                { data: 'address', name: 'address' },
                { data: 'Country_born', name: 'Country_born' },
                { data: 'City_born', name: 'City_born' },
                { data: 'City_Residence_place', name: 'City_Residence_place' },
                { data: 'Department', name: 'Department' },
                { data: 'phone', name: 'phone' },
                { data: 'Civil_state', name: 'Civil_state' },
                { data: 'Score', name: 'Score' },
                { data: 'Db_user_id', name: 'Db_user_id', "visible": false },
                { data: 'Company_id', name: 'Company_id', "visible": false },
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
        // var table = $('#user_datatable').DataTable();

        function myCallbackFunction(updatedCell, updatedRow, oldValue) {
            debugger
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
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17],
            "inputTypes": [
                {
                    "column": 6,
                    "type": "list",
                    "options": [
                        { "value": enums.Education['Primaria'], "display": enums.Education['Primaria'] },
                        { "value": enums.Education['Secundaria'], "display": enums.Education['Secundaria'] },
                        { "value": enums.Education['Pregrado'], "display": enums.Education['Pregrado'] },
                        { "value": enums.Education['Postgrado'], "display": enums.Education['Postgrado'] },
                        { "value": enums.Education['Sin información'], "display": enums.Education['Sin información'] },
                    ]
                },
                {
                    "column": 14,
                    "type": "list",
                    "options": [
                        { "value": enums.Civil_state['Soltero'], "display": enums.Civil_state['Soltero'] },
                        { "value": enums.Civil_state['Casado'], "display": enums.Civil_state['Casado'] },
                        { "value": enums.Civil_state['Separado'], "display": enums.Civil_state['Separado'] },
                        { "value": enums.Civil_state['Divorciado'], "display": enums.Civil_state['Divorciado'] },
                        { "value": enums.Civil_state['Viudo'], "display": enums.Civil_state['Viudo'] },
                        { "value": enums.Civil_state['Union libre'], "display": enums.Civil_state['Union libre'] },
                        { "value": enums.Civil_state['Sin información'], "display": enums.Civil_state['Sin información'] },
                    ]
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