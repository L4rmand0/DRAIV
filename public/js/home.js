
// IIFE - Immediately Invoked Function Expression
(function (runcode) {
    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {
    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {
        const $body = $("body");
        const $header = $(".page-header");
        const $navCollapse = $(".navbar-collapse");
        const scrollClass = "scroll";

        $(window).on("scroll", () => {
            if (window.matchMedia("(min-width: 992px)").matches) {
                const scrollY = $(this).scrollTop();
                scrollY > 0
                    ? $body.addClass(scrollClass)
                    : $body.removeClass(scrollClass);
            } else {
                $body.removeClass(scrollClass);
            }
        });

        $(".page-header .nav-link, .navbar-brand").on("click", function (e) {
            e.preventDefault();
            const href = $(this).attr("href");
            $("html, body").animate({
                scrollTop: $(href).offset().top - 71
            }, 600);
        });
    });


}));