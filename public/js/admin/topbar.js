// IIFE - Immediately Invoked Function Expression
(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {
        $("#select_company_main").select2();
        $("#select_company_main").on('change', function(){
            $target = $(this);
            $.ajax({
                type: 'post',
                url: $('#select_company_main').data('update'),
                data: { 'type': 'select_admin2', 'company_id': $target.val() }
            }).done(function(response){
                location.reload();
            });
        });

    });

    // The rest of the code goes here!
}));