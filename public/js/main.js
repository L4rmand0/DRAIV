// Función para que solo permita digitar número en los inputs
function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
        textbox.addEventListener(event, function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    });
}

// IIFE - Immediately Invoked Function Expression
(function (runcode) {
    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {
    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {
        if ($("#pageactive").length > 0) {
            let selector = $("#pageactive").data('page');
            $(selector).addClass('active')
        }


        // Funcion STYLE que permite agregarle el important a una propieda css de un selecto jquery
        if ($.fn.style) {
            return;
        }

        // Escape regex chars with \
        var escape = function (text) {
            return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
        };

        // For those who need them (< IE 9), add support for CSS functions
        var isStyleFuncSupported = !!CSSStyleDeclaration.prototype.getPropertyValue;
        if (!isStyleFuncSupported) {
            CSSStyleDeclaration.prototype.getPropertyValue = function (a) {
                return this.getAttribute(a);
            };
            CSSStyleDeclaration.prototype.setProperty = function (styleName, value, priority) {
                this.setAttribute(styleName, value);
                var priority = typeof priority != 'undefined' ? priority : '';
                if (priority != '') {
                    // Add priority manually
                    var rule = new RegExp(escape(styleName) + '\\s*:\\s*' + escape(value) +
                        '(\\s*;)?', 'gmi');
                    this.cssText =
                        this.cssText.replace(rule, styleName + ': ' + value + ' !' + priority + ';');
                }
            };
            CSSStyleDeclaration.prototype.removeProperty = function (a) {
                return this.removeAttribute(a);
            };
            CSSStyleDeclaration.prototype.getPropertyPriority = function (styleName) {
                var rule = new RegExp(escape(styleName) + '\\s*:\\s*[^\\s]*\\s*!important(\\s*;)?',
                    'gmi');
                return rule.test(this.cssText) ? 'important' : '';
            }
        }

        // The style function
        $.fn.style = function (styleName, value, priority) {
            // DOM node
            var node = this.get(0);
            // Ensure we have a DOM node
            if (typeof node == 'undefined') {
                return this;
            }
            // CSSStyleDeclaration
            var style = this.get(0).style;
            // Getter/Setter
            if (typeof styleName != 'undefined') {
                if (typeof value != 'undefined') {
                    // Set style property
                    priority = typeof priority != 'undefined' ? priority : '';
                    style.setProperty(styleName, value, priority);
                    return this;
                } else {
                    // Get style property
                    return style.getPropertyValue(styleName);
                }
            } else {
                // Get CSSStyleDeclaration
                return style;
            }
        };

        // <--------- Termina la función STYLE ---------->



    });

    jQuery.fn.hasErrorsForms = function (callingElement, data) {
        $(".error-strong").text("");
        //Revisa si la petición tiene errores y los muestra
        if (Object.keys(data.errors).length > 0) {
            let arr_errores = data.errors;
            $.each(arr_errores, function (index, value) {
                let html_content = "" +
                    "<div class='row mt-0'>" +
                    "   <div class='col-md-12'>" +
                    "       <span role='alert' id='" + index + "-error'>" +
                    "           <strong id='" + index + "-error-strong' class='error-strong'></strong>" +
                    "       </span>" +
                    "   </div>" +
                    "</div>";
                $(html_content).insertAfter(callingElement.find("#" + index));
                changeColorInputError(callingElement.find("#" + index));
                changeColorLabelError(callingElement.find("#" + index));
                let selector = "#" + index + "-error";
                let selector_strong = "#" + index + "-error-strong";
                $(selector).show();
                $(selector_strong).text(value[0]);
            });
            return true;
        } else {
            return false;
        }
    };


    jQuery.fn.cleanForm = function (selector_form) {
        $(selector_form+" input[type=text]").val("");
        $(selector_form+" input[type=password]").val("");
        $(selector_form+" select").val("");
        $(selector_form+" input[type=email]").val("");
        $(selector_form).modal('hide');
    }

    jQuery.fn.cleanErrorElementForm = function ($target) {
        $target.css("border-color", "");
        $("#label-" + $target.attr("id")).css("color", "")
        $("#" + $target.attr("id") + "-error-strong").text("")
        if ($target.is("input[type=checkbox]")) {
            $("#label-" + $target.attr("id")).toggleClass('error');
        }
    }

    function changeColorInputError($target) {
        if ($target.is("input[type=checkbox]")) {
            $("#label-" + $target.attr("id")).toggleClass('error');
        } else if ($target.is("input[type=password]")) {
            $target.style('border-color', '#e3342f', 'important');
            // $target.css("border-color", "#e3342f");
        } else if ($target.is("input[type=text]")) {
            // $target.css("border-color", "#e3342f");
            $target.style('border-color', '#e3342f', 'important');
        } else if ($target.is("input[type=email]")) {
            $target.style('border-color', '#e3342f', 'important');
        }
    }

    function changeColorLabelError($target) {
        $("#label-" + $target.attr("id")).style('color', '#e3342f');
    }

}));