// IIFE - Immediately Invoked Function Expression
(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {
        // $("#form_user_admin").submit(function (event) {
        //     event.preventDefault();
        //     let data_form = $(this).serialize();
        //     $.ajax({
        //         type: 'POST',
        //         url: $("#btn_admin_user ").data('url'),
        //         data: data_form,
        //         success: function (data) {
        //             console.log(data);
        //             $(".error-strong").text("");
        //             if (Object.keys(data.errors).length > 0) {
        //                 let arr_errores = data.errors;
        //                 console.log(arr_errores);
        //                 $.each(arr_errores, function (index, value) {
        //                     let selector = "#" + index + "-error";
        //                     let selector_strong = "#" + index + "-error-strong";
        //                     $(selector).show();
        //                     $(selector_strong).text(value[0]);
        //                     // $(selector).show();
        //                     // $(selector).text(value);
        //                     // error_founds = error_founds + 1;
        //                 });
        //             } else {
        //                 $("#form_user_admin input[type=text]").val("");
        //                 $("#form_user_admin input[type=password]").val("");
        //                 $("#form_user_admin select").val("");
        //                 $("#form_user_admin input[type=email]").val("");
        //                 $("#defaultChecked2").prop('checked', false); 
        //                 swal(
        //                     'Proceso Completado!',
        //                     data.success,
        //                     'success'
        //                 )
        //             }
        //         }
        //     });
        // });

        var table = $('#drive_information_datatable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: $('#driver-info-list-route').val(),
            columns: [
                { data: 'DNI_id', name: 'DNI_id', "visible": false },
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
                { data: 'Db_user_id', name: 'Db_user_id' },
                { data: 'Company_id', name: 'Company_id' },
            ],
            language: language_dt,
            
            // columnDefs: [{
            //     targets: '_all',
            //     createdCell: createdCell
            // }],
            // createdRow: function( row, data, dataIndex ) {
            //     // if( data.hasOwnProperty("id") ) {
            //     //     row.id = "row-" + data.id;
            //     // } 
            //     $( row ).attr({'data-id': data.id, id:'idUser'});
            // }
        });
        // var table = $('#user_datatable').DataTable();

        function myCallbackFunction(updatedCell, updatedRow, oldValue) {
            console.log("The new value for the cell is: " + updatedCell.data());
            if (oldValue != updatedCell.data()) {
                dataSend = updatedRow.data();
                dataSend.valuech = updatedCell.data();
                $.ajax({
                    type: 'POST',
                    url: $("#update-users-route").val(),
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
            "onUpdate": myCallbackFunction
        });

        // $('#user_datatable').on('click', 'tbody td', function () {
        //     alert('oye mi perro')
        //     table_user.cell( this ).edit();
        // } );
    });


    // The rest of the code goes here!
}));