// IIFE - Immediately Invoked Function Expression
(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {
    
    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {
        $('#msform').submit(function (e) {
            e.preventDefault();
            let url_action = $(this).attr('action');
            let form_data = $("#msform").serialize();
            
            debugger
            $.post(url_action, form_data, function (result) {
                
            });
        });

        $("#btn_upload_img").on("click",function(){
            let element_button = $(this);
            let form_data = $("#msform").serialize();
            let url_action = element_button.data('url');
            debugger
            $.post(url_action, form_data, function (result) {
                console.log(result);
            });
        });
    });

    // The rest of the code goes here!
}));