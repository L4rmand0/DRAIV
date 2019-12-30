// IIFE - Immediately Invoked Function Expression
(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {

        var $dni_drivers_selects2 = $('#driver_information_dni_id_images').select2();

        $('#driver_information_dni_id_images').on('change', function () {
            let element = $(this);
            let driver_information_dni_id = element.val();
            $.ajax({
                type: 'POST',
                url: element.data('url'),
                data: { 'driver_information_dni_id': driver_information_dni_id },
                success: function (data) {
                    console.log(data);
                    if (Object.keys(data.errors).length > 0) {
                        console.log(errors);
                    } else {
                        let table = "<table class='table'>"
                        table += "<thead>"
                        table += "  <th><center>Documento</center></th>"
                        table += "  <th><center>Verificación</center></th>"
                        table += "  <th><center>Archivo</center></th>"
                        table += "</thead>"
                        table += "<tbody>"
                        $.each(data.documents, function (index, value) {
                            table += "<tr>"
                            table += "  <td>" + index + "</td>"
                            if (value.check == "Y") {
                                let str = value.url;
                                let newurl = str.replace("/", " ");
                                table += "<td><center><span class='check_icon' aria-hidden='true' style='color:green;'></span></center></td>"
                                table += '<td><center><a href="downloads3/' + newurl + '" style="cursor:pointer;" class="a_file_image" class="download-file-s3"><span class="file_image_icon" style="color:#B62A2A;"></span></a></center></td>';
                                // table += '<td><center><a href="downloads3/'+value.url+'" class="download-file-s3"><span class="file_image_icon" style="color:#B62A2A;"></span></a></center></td>';
                            } else {
                                table += "<td><center><span class='x_icon' aria-hidden='true' style='color:red;'></span></center></td>"
                                table += "<td></td>"
                            }
                            table += "</tr>"
                        });
                        table += "</tbody>"
                        table += "</table>"
                        // table += '<script>'+
                        // '          $(".a_file_image").on("click", function(){'+
                        //          '  window.location.href = $(this).data("url");'+
                        //          ' })'+
                        //         '</script>';
                        $("#card_body_list_documents").html(table)
                        // swal.fire(
                        //     'Proceso Completado',
                        //     'Archivo subido correctamente.',
                        //     'success'
                        // );
                    }
                }
            });
        });



        $(".form_upload_image").submit(function (event) {
            event.preventDefault();
            let driver_information_dni_id = $("#driver_information_dni_id_images").val();
            var element = $(this);
            var datafr = new FormData(element[0]);
            element.find(".error_file").html("");
            if (driver_information_dni_id == "") {
                swal.fire(
                    'Información Incompleta!',
                    'Se debe elegir un conductor.',
                    'error'
                );
            } else {
                datafr.append('key', element.data('key'));
                datafr.append('driver_information_dni_id', driver_information_dni_id);
                $.ajax({
                    type: 'POST',
                    url: element.attr('action'),
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: datafr,
                    success: function (data) {
                        console.log(data);
                        if (Object.keys(data.errors).length > 0) {
                            if (data.response == "Carga fallida") {
                                swal.fire(
                                    'Proceso Incompleto',
                                    data.errors.message,
                                    'error'
                                );
                            } else if (data.response == "validator errors") {
                                let cadena = "";
                                $.each(data.errors, function (index, value) {
                                    cadena = cadena + "<strong id='file-error-strong' class='error-strong'>" + value[0] + "</strong>";
                                });
                                element.find(".error_file").html(cadena);
                            } else if (data.response == "file exists") {
                                // swal.fire(
                                //     'Archivo Duplicado',
                                //     data.errors.message,
                                //     'error'
                                // );
                                let id_image = data.errors.id;
                                let url = data.errors.path;
                                datafr.append('id', id_image);
                                datafr.append('url', url);
                                swal.fire({
                                    title: '<strong>Archivo Encontrado</strong>',
                                    icon: 'warning',
                                    html: data.errors.message,
                                    showCloseButton: true,
                                    showCancelButton: true,
                                    focusConfirm: false,
                                    confirmButtonText:
                                        'Confirmar',
                                    confirmButtonAriaLabel: 'Sí, reemplazarlo!',
                                    cancelButtonText:
                                        'Cancelar',
                                    cancelButtonAriaLabel: 'Thumbs down'
                                }).then((result) => {
                                    if (result.value) {
                                        $.ajax({
                                            type: 'POST',
                                            url: $("#driver_information_dni_id_images").data("url-update"),
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            data: datafr,
                                            success: function (data) {
                                                if (Object.keys(data.errors).length > 0) {
                                                    swal.fire(
                                                        'Error en el proceso',
                                                        data.errors.response,
                                                        'error'
                                                    );
                                                } else {
                                                    swal.fire(
                                                        'Proceso Completado',
                                                        data.messagge,
                                                        'success'
                                                    );
                                                    let dni_id_val = $('#driver_information_dni_id_images').val()
                                                    $dni_drivers_selects2.val([""]).trigger("change");
                                                    $dni_drivers_selects2.val([dni_id_val]).trigger("change");
                                                    element.find(".name_file").text("Seleccionar ...");
                                                }
                                            }
                                        });
                                    }
                                });
                            }
                        } else {
                            swal.fire(
                                'Proceso Completado',
                                'Archivo subido correctamente.',
                                'success'
                            );
                            let dni_id_val = $('#driver_information_dni_id_images').val()
                            $dni_drivers_selects2.val([""]).trigger("change");
                            $dni_drivers_selects2.val([dni_id_val]).trigger("change");
                            element.find(".name_file").text("Seleccionar ...");
                        }
                    }
                });
            }

        });

        // $("#download-file-s3").on('click', function () {
        //     let element = $(this);
        //     $.ajax({
        //         type: 'POST',
        //         url: element.data('url'),
        //         // cache: false,
        //         // contentType: false,
        //         // processData: false,
        //         data: { 'img_id': '12345' },
        //         success: function (data) {
        //             console.log(data);
        //         }
        //     });
        // });

        $(".input_files_drivers").on('change', function () {
            let element = $(this);
            let name = element[0].files[0].name;
            $(this).parent().find("label").text(name)
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

