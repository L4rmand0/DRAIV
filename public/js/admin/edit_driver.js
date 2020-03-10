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
            $form = $(this);
            event.preventDefault();
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
                    fillTitles(response.data, titles);
                    fillInformation(target_element,response.data)
                    console.log(response);
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
    // The rest of the code goes here!
}));