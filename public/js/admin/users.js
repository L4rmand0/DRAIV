// IIFE - Immediately Invoked Function Expression
(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {

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
                            // $(selector).show();
                            // $(selector).text(value);
                            // error_founds = error_founds + 1;
                        });
                    } else {
                        $("#form_user_admin input[type=text]").val("");
                        $("#form_user_admin input[type=password]").val("");
                        $("#form_user_admin select").val("");
                        $("#form_user_admin input[type=email]").val("");
                        $("#defaultChecked2").prop('checked', false); 
                        $('#form_create_user').modal('hide');
                        swal(
                            'Proceso Completado!',
                            data.success,
                            'success'
                        )
                    }
                }
            });
        });
        // const createdCell = function (cell, cellData) {

        //     if (cell._DT_CellIndex.column == 1) {
        //         $(cell).attr('id','idUser')
        //     }
        //     let original
        //     cell.setAttribute('contenteditable', true)
        //     cell.setAttribute('spellcheck', false)

        //     cell.addEventListener('focus', function (e) {
        //         original = e.target.textContent
        //         $(this).css("background-color", "#FFFFFF"); 
        //     })

        //     cell.addEventListener('blur', function (e) {
        //         if (original !== e.target.textContent) {
        //             const row = table_user.row(e.target.parentElement)
        //             // row.invalidate()
        //             debugger
        //             console.log('Row changed: ', row.data())
        //             console.log('Row changed: ', row.data())
        //             console.log('change', e.target.textContent);
        //         }
        //         $(this).css("background-color", "#f8f9fc"); 
        //     })
        // }

        // var table_user = $('#user_datatable').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: $('#users-list-route').val(),
        //     columns: [
        //         { data: 'id', name: 'id', "visible": false },
        //         { data: 'name', name: 'name' },
        //         { data: 'email', name: 'email' }
        //     ],
        // columnDefs: [{
        //     targets: '_all',
        //     createdCell: createdCell
        // }],
        //     createdRow: function( row, data, dataIndex ) {
        //         $( row ).find('td:eq(0)').attr({'data-id': data.id});
        //     }
        // });

        var table = $('#user_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: $('#users-list-route').val(),
            columns: [
                { data: 'id', name: 'id', "visible": false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'User_profile', name: 'User_profile' }
            ],
            language: language_dt
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