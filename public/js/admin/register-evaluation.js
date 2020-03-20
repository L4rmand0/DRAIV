(function(runcode) {
    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function($, window, document) {
    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function() {
        (function(runcode) {
            // The global jQuery object is passed as a parameter
            runcode(window.jQuery, window, document);
        
        }(function($, window, document) {
            // The $ is now locally scoped 
            // Listen for the jQuery ready event on the document
            $(function() {
                $("#driver_select_evaluation").on('change', function(){
                    $select = $(this);
                    dni_id = $select.val();
                    $.post($("#function-list-driver-vehicles").val(), {'dni_id':dni_id}).done(function(response){
                        console.log(response);
                    });
                });
            });
            // The rest of the code goes here!
        }));
    });


    // The rest of the code goes here!
}));