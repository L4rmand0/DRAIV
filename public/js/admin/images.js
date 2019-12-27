// IIFE - Immediately Invoked Function Expression
(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {
    
    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {

        $('#driver_information_dni_id_images').select2();

        $('#driver_information_dni_id_images').on('change', function(){

        });

        $(".form_upload_image").submit(function (event) {
            event.preventDefault();
            let element = $(this);
            var datafr = new FormData(element[0]);
            datafr.append('key',element.data('key'));
            $.ajax({
                type: 'POST',
                url: element.attr('action'),
                cache: false,
                contentType: false,
                processData: false,
                data: datafr,
                success: function (data) {
                    console.log(data);
                }
            });
        });


        // function myCallbackFunction(updatedCell, updatedRow, oldValue) {
        //     console.log("The new value for the cell is: " + updatedCell.data());
        //     if (oldValue != updatedCell.data()) {
        //         dataSend = updatedRow.data();
        //         dataSend.valuech = updatedCell.data();
        //         dataSend.fieldch = updatedCell.nodes()[0].id;
        //         $.ajax({
        //             type: 'POST',
        //             url: $("#update-driving-licence-route").val(),
        //             data: dataSend,
        //             success: function (data) {
        //                 if (Object.keys(data.error).length > 0)
        //                     swal.fire(
        //                         'Error!',
        //                         data.error.response,
        //                         'error'
        //                     )
        //             }
        //         });
        //     }
        //     console.log("The values for each cell in that row are: " + updatedRow.data());
        // }

        // table.MakeCellsEditable({
        //     "onUpdate": myCallbackFunction,
        //     columns: [2, 6, 7, 8, 9, 10],
        //     "inputTypes": [
        //         {
        //             "column": 6,
        //             "type": "list",
        //             "options": enum_country_expedition
        //         },
        //         {
        //             "column": 7,
        //             "type": "list",
        //             "options": enum_category
        //         },
        //         {
        //             "column": 8,
        //             "type": "list",
        //             "options": enum_state
        //         }

        //     ]
        // });

        // $('#user_datatable').on('click', 'tbody td', function () {
        //     alert('oye mi perro')
        //     table_user.cell( this ).edit();
        // } );
    });


    // The rest of the code goes here!
}));

