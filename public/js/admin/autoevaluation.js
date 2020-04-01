// IIFE - Immediately Invoked Function Expression
(function(runcode) {
    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function($, window, document) {
    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function() {
        $("#example-async").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slide"
        });
    });


    // The rest of the code goes here!
}));