// IIFE - Immediately Invoked Function Expression


(function(runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function($, window, document) {

    // Listen for the jQuery ready event on the document
    $(function() {

        setInputFilter(document.getElementById("company_id"), function(value) {
            return /^\d*$/.test(value);
        });


        $("#btn_free_plan").on('click', function() {
            // Manejo del color de los botones
            $(this).css("background", '#fff');
            $("#btn_medium_plan").css("background", "#EDE6DD");
            $("#btn_all_plan").css("background", "#EDE6DD");
            // Manejo de la clase active
            $("#btn_medium_plan").removeClass("active");
            $("#btn_all_plan").removeClass("active");
            $(this).addClass("active");
            // Manejo de mostrar y ocultar los cards
            $("#medium_plan").hide();
            $("#all_plan").hide();
            $("#free_plan").show();
        });

        $("#btn_medium_plan").on('click', function() {
            // Manejo del color de los botones
            $(this).css("background", '#fff');
            $("#btn_free_plan").css("background", "#EDE6DD");
            $("#btn_all_plan").css("background", "#EDE6DD");
            // Manejo de la clase active
            $("#btn_free_plan").removeClass("active");
            $("#btn_all_plan").removeClass("active");
            $(this).addClass("active");
            // Manejo de mostrar y ocultar los cards
            $("#free_plan").hide();
            $("#all_plan").hide();
            $("#medium_plan").show();
            $("#medium_plan").attr("hidden", false);
        });
        $("#btn_all_plan").on('click', function() {
            // Manejo del color de los botones
            $(this).css("background", '#fff');
            $("#btn_free_plan").css("background", "#EDE6DD");
            $("#btn_medium_plan").css("background", "#EDE6DD");
            // Manejo de la clase active
            $("#btn_free_plan").removeClass("active");
            $("#btn_medium_plan").removeClass("active");
            $(this).addClass("active");
            // Manejo de mostrar y ocultar los cards
            $("#medium_plan").hide();
            $("#free_plan").hide();
            $("#all_plan").show();
            $("#all_plan").attr("hidden", false);
        });

        $("#btn_call_login").on('click', function() {
            $("#login_card").show();
            $("#register_card").hide();
        });

        $("#btn_call_register").on('click', function() {
            $("#login_card").hide();
            $("#register_card").show();
            $("#register_card").attr("hidden", false);
        });

    });
    // The rest of the code goes here!
}));