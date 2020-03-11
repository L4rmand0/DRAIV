// IIFE - Immediately Invoked Function Expression
(function(runcode) {
    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function($, window, document) {

    //Titúlos que deben ser llenados con información
    var titles = [
        'dni_id','phone'
    ];

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function() {
        $("#form_search_information").submit(function(event){
            event.preventDefault();
            $form = $(this);
            //Revisa si el contenedor de información de conductor está oculto
            if($("#container_card_driver").is(":visible")){
                $("#container_card_driver").hide();
            }
            $.post( $("#route-search-information").val(),$form.serialize())
            .done(function(response){
                target_element = "nav-driver-information";
                if(response.response == "no data"){
                    swal.fire(
                        'Información no encontrada!',
                        response.message,
                        'warning'
                    )
                }else{
                    $("#container_card_driver").attr('hidden', false);
                    $("#container_card_driver").show('hidden', false);
                    console.log(response);
                    fillTitles(response.data, titles);
                    fillInformation(target_element,response.data);
                    fillNameDriver(response.data);
                    fillExpiredSoat(response);
                }
            });
        })
    });


    function fillInformation(target_element, data){
        $target = "#"+target_element;
        $.each(data, function(key, value){
            $("#"+target_element).find("#"+key).val(value);
        })
    }

    function fillTitles(data, titles){
        $.each(data, function(key, value){
            if(titles.indexOf(key) != -1){
                $("#title_"+key).text(value);
            }
        })
    }

    function fillNameDriver(data){
        let name = data.first_name+" "+data.f_last_name;
        $("#title_name_driver").text(name);
    }

    function fillExpiredSoat(response){
        if (Object.keys(response.soats_vencidos).length > 0) {
            $("#title_expired_soat").text("Soats vencidos: "+response.soats_vencidos.length);
        }else{
            $("#title_expired_soat").text("Soat al día");
        }
    }
    // The rest of the code goes here!
}));