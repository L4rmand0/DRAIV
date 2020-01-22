// IIFE - Immediately Invoked Function Expression


(function(runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function($, window, document) {

    // Listen for the jQuery ready event on the document
    $(function() {
        $("#btn_free_plan").on('click', function() {
            $(this).css("background", '')
            $("#medium_plan").hide();
            $("#all_plan").hide();
            $("#free_plan").show();
        });

    });
    // The rest of the code goes here!
}));