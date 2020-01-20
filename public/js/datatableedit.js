// IIFE - Immediately Invoked Function Expression
var prev_element = new Array();
var new_element = new Array();

(function(runcode) {
    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function($, window, document) {
    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function() {

    });

    jQuery.fn.editBehaviourSelectFixedDT = function($target, $selector_table, $selector_cell) {
        console.log('entra');
        console.log($target);
        console.log($selector_table);
        console.log($selector_cell);

        // debugger
        if ($target.closest($selector_table + ' tr ' + $selector_cell).length) {
            if (typeof new_element['index'] === 'undefined') {
                prev_element['index'] = $target.find("select").data("index");
                prev_element['value'] = $target.find("select").children("option:selected").text();
                new_element['index'] = $target.find("select").data("index");
                new_element['value'] = $target.find("select").children("option:selected").text();
            } else {
                let old_new_element = new Array();
                old_new_element['index'] = new_element['index'];
                old_new_element['value'] = new_element['value'];
                if (typeof $target.find("select").data("index") === 'undefined') {} else {
                    new_element['index'] = $target.find("select").data("index");
                    new_element['value'] = $target.find("select").children("option:selected").text();
                    prev_element = old_new_element;
                }
                if (new_element['index'] != prev_element['index']) {
                    let selector = $selector_table + " tr " + $selector_cell + " ." + prev_element['index'];
                    $(selector).parent().html(prev_element['value']);
                }
            }
        } else {
            if (!$target.closest($selector_table + ' tr ' + $selector_cell).length &&
                $($selector_table + ' tr ' + $selector_cell + ' select').is(":visible")) {
                let element = $($selector_table + ' tr ' + $selector_cell + ' select');
                let val_item = element.children("option:selected").text();
                element.parent().html(val_item)
            }
        }
    }

    jQuery.fn.editBehaviourSelectDT = function($target, $selector_table, $selector_cell) {
        if ($target.closest($selector_table + ' tr ' + $selector_cell).length) {
            if (typeof new_element['index'] === 'undefined') {
                prev_element['index'] = $target.find("select").data("index");
                prev_element['value'] = $target.find("select").val();
                new_element['index'] = $target.find("select").data("index");
                new_element['value'] = $target.find("select").val();
            } else {
                let old_new_element = new Array();
                old_new_element['index'] = new_element['index'];
                old_new_element['value'] = new_element['value'];
                console.log("new class: " + $target.find("select").data("index"));
                console.log("new class: " + $target.find("select").val());
                if (typeof $target.find("select").data("index") === 'undefined') {} else {
                    new_element['index'] = $target.find("select").data("index");
                    new_element['value'] = $target.find("select").val();
                    prev_element = old_new_element;
                }
                if (new_element['index'] != prev_element['index']) {
                    let selector = $selector_table + " tr " + $selector_cell + " ." + prev_element['index'];
                    $(selector).parent().html(prev_element['value']);
                }
            }
        } else {
            if (!$target.closest($selector_table + ' tr ' + $selector_cell).length &&
                $($selector_table + ' tr ' + $selector_cell + ' select').is(":visible")) {
                let element = $($selector_table + ' tr ' + $selector_cell + ' select');
                let val_item = element.val();
                element.parent().html(val_item)
            }
        }
    }


    jQuery.fn.dataTable.Api.register('MakeCellsEditable()', function(settings) {
        var table = this.table();
        jQuery.fn.extend({
            // UPDATE
            updateEditableCell: function(callingElement) {
                // Need to redeclare table here for situations where we have more than one datatable on the page. See issue6 on github
                var confirmUpdate;
                var table = $(callingElement).closest("table").DataTable().table();
                var row = table.row($(callingElement).parents('tr'));
                var cell = table.cell($(callingElement).parents('td, th'));
                var columnIndex = cell.index().column;
                var inputField = getInputField(callingElement);
                var textoption = "";
                //Si el inputfield es select acutualiza la tabla con el texto de la opción seleccionada
                if (inputField.is("select")) {
                    textoption = inputField.children("option:selected").text()
                }

                // Update
                var newValue = inputField.val();
                if (!newValue && ((settings.allowNulls) && settings.allowNulls != true)) {
                    // If columns specified
                    if (settings.allowNulls.columns) {
                        // If current column allows nulls
                        if (settings.allowNulls.columns.indexOf(columnIndex) > -1) {
                            _update(newValue);
                        } else {
                            _addValidationCss();
                        }
                        // No columns allow null
                    } else if (!newValue) {
                        _addValidationCss();
                    }
                    //All columns allow null
                } else if (newValue && settings.onValidate) {
                    if (settings.onValidate(cell, row, newValue)) {
                        debugger
                        _update(newValue);
                    } else {
                        _addValidationCss();
                    }
                } else {
                    // confirmUpdate = _update(newValue);
                    if (textoption == "") {
                        confirmUpdate = _update(newValue);
                    } else {
                        confirmUpdate = _update(newValue, textoption);
                    }
                }

                function _addValidationCss() {
                    // Show validation error
                    if (settings.allowNulls.errorClass) {
                        $(inputField).addClass(settings.allowNulls.errorClass);
                    } else {
                        $(inputField).css({ "border": "red solid 1px" });
                    }
                }

                function _update(newValue, text = false) {
                    var oldValue = cell.data();
                    //revisa que se deba poner el texto de la tabla y no el valor si es select
                    if (text == false) {
                        cell.data(newValue);
                        return settings.onUpdate(cell, row, oldValue);
                    } else {
                        cell.data(text);
                        return settings.onUpdate(cell, row, oldValue, newValue);
                    }
                    //Return cell & row.
                }
                // Get current page
                var currentPageIndex = table.page.info().page;

                //Redraw table
                table.page(currentPageIndex).draw(false);
            },
            // CANCEL
            cancelEditableCell: function(callingElement) {
                var table = $(callingElement.closest("table")).DataTable().table();
                var cell = table.cell($(callingElement).parents('td, th'));
                // Set cell to it's original value
                cell.data(cell.data());

                // Redraw table
                table.draw();
            },

        });

        // Destroy
        if (settings === "destroy") {
            $(table.body()).off("click", "td");
            table = null;
        }

        if (table != null) {
            // On cell click
            $(table.body()).on('click', 'td', function() {
                var currentColumnIndex = table.cell(this).index().column;
                // DETERMINE WHAT COLUMNS CAN BE EDITED
                if ((settings.columns && settings.columns.indexOf(currentColumnIndex) > -1) || (!settings.columns)) {
                    var row = table.row($(this).parents('tr'));
                    editableCellsRow = row;

                    var cell = table.cell(this).node();
                    var oldValue = table.cell(this).data();
                    // Sanitize value
                    oldValue = sanitizeCellValue(oldValue);

                    // Show input
                    if (!$(cell).find('input').length && !$(cell).find('select').length && !$(cell).find('textarea').length) {
                        // Input CSS
                        var input = getInputHtml(currentColumnIndex, settings, oldValue, row);
                        $(cell).html(input.html);
                        if (input.focus) {
                            $('#ejbeatycelledit').focus();
                        }
                    }
                }
            });
        }

    });

    function getInputHtml(currentColumnIndex, settings, oldValue, row) {
        var inputSetting, inputType, input, inputCss, confirmCss, cancelCss, startWrapperHtml = '',
            endWrapperHtml = '',
            listenToKeys = false;

        input = { "focus": true, "html": null };

        if (settings.inputTypes) {
            $.each(settings.inputTypes, function(index, setting) {
                if (setting.column == currentColumnIndex) {
                    inputSetting = setting;
                    inputType = inputSetting.type.toLowerCase();
                }
            });
        }

        if (settings.inputCss) { inputCss = settings.inputCss; }
        if (settings.wrapperHtml) {
            var elements = settings.wrapperHtml.split('{content}');
            if (elements.length === 2) {
                startWrapperHtml = elements[0];
                endWrapperHtml = elements[1];
            }
        }

        if (settings.confirmationButton) {
            if (settings.confirmationButton.listenToKeys) { listenToKeys = settings.confirmationButton.listenToKeys; }
            confirmCss = settings.confirmationButton.confirmCss;
            cancelCss = settings.confirmationButton.cancelCss;
            inputType = inputType + "-confirm";
        }
        switch (inputType) {
            case "list":
                input.html = startWrapperHtml + "<select class='" + inputCss + " selselector" + row[0][0] + "' onchange='$(this).updateEditableCell(this);' data-index='selselector" + row[0][0] + "'> ";
                $.each(inputSetting.options, function(index, option) {
                    if (oldValue == option.value) {
                        input.html = input.html + "<option value='" + option.value + "' selected>" + option.display + "</option>"
                    } else {
                        input.html = input.html + "<option value='" + option.value + "' >" + option.display + "</option>"
                    }
                });
                input.html = input.html + "</select>" + endWrapperHtml;
                input.focus = false;
                break;
            case "list-fixed":
                input.html = startWrapperHtml + "<select class='" + inputCss + " selselector" + row[0][0] + "' onchange='$(this).updateEditableCell(this);' data-index='selselector" + row[0][0] + "'> ";
                $.each(inputSetting.options, function(index, option) {
                    if (oldValue == option.display) {
                        input.html = input.html + "<option value='" + option.value + "' selected>" + option.display + "</option>"
                    } else {
                        input.html = input.html + "<option value='" + option.value + "' >" + option.display + "</option>"
                    }
                });
                input.html = input.html + "</select>" + endWrapperHtml;
                input.focus = false;
                break;
            case "list-confirm": // List w/ confirm
                input.html = startWrapperHtml + "<select class='" + inputCss + "'>";
                $.each(inputSetting.options, function(index, option) {
                    if (oldValue == option.value) {
                        input.html = input.html + "<option value='" + option.value + "'>" + option.display + "</option>"
                    } else {
                        input.html = input.html + "<option value='" + option.value + "' >" + option.display + "</option>"
                    }
                });
                input.html = input.html + "</select>&nbsp;<a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this);'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
                input.focus = false;
                break;
            case "datepicker": //Both datepicker options work best when confirming the values
            case "datepicker-confirm":
                // Makesure jQuery UI is loaded on the page
                if (typeof jQuery.ui == 'undefined') {
                    alert("jQuery UI is required for the DatePicker control but it is not loaded on the page!");
                    break;
                }
                jQuery(".datepick").datepicker("destroy");
                input.html = startWrapperHtml + "<input id='ejbeatycelledit' type='text' name='date' class='datepick " + inputCss + "'   value='" + oldValue + "'></input> &nbsp;<a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this)'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
                setTimeout(function() { //Set timeout to allow the script to write the input.html before triggering the datepicker
                    var icon = "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif";
                    // Allow the user to provide icon
                    if (typeof inputSetting.options !== 'undefined' && typeof inputSetting.options.icon !== 'undefined') {
                        icon = inputSetting.options.icon;
                    }
                    var self = jQuery('.datepick').datepicker({
                        showOn: "button",
                        buttonImage: icon,
                        buttonImageOnly: true,
                        buttonText: "Select date"
                    });
                }, 100);
                break;
            case "text-confirm": // text input w/ confirm
                input.html = startWrapperHtml + "<input id='ejbeatycelledit' class='" + inputCss + "' value='" + oldValue + "'" + (listenToKeys ? " onkeyup='if(event.keyCode==13) {$(this).updateEditableCell(this);} else if (event.keyCode===27) {$(this).cancelEditableCell(this);}'" : "") + "></input>&nbsp;<a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this)'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
                break;
            case "undefined-confirm": // text input w/ confirm
                input.html = startWrapperHtml + "<input id='ejbeatycelledit' class='" + inputCss + "' value='" + oldValue + "'" + (listenToKeys ? " onkeyup='if(event.keyCode==13) {$(this).updateEditableCell(this);} else if (event.keyCode===27) {$(this).cancelEditableCell(this);}'" : "") + "></input>&nbsp;<a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this)'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
                break;
            case "textarea":
            case "textarea-confirm":
                input.html = startWrapperHtml + "<textarea id='ejbeatycelledit' class='" + inputCss + "'>" + oldValue + "</textarea><a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this)'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
                break;
            case "number-confirm":
                input.html = startWrapperHtml + "<input id='ejbeatycelledit' type='number' class='" + inputCss + "' value='" + oldValue + "'" + (listenToKeys ? " onkeyup='if(event.keyCode==13) {$(this).updateEditableCell(this);} else if (event.keyCode===27) {$(this).cancelEditableCell(this);}'" : "") + "></input>&nbsp;<a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this)'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
                break;
            case "checkbox":
                input.html = startWrapperHtml + "<input type='checkbox' id='ejbeatycelledit' class='" + inputCss + "' value='" + oldValue + "'" + "onclick='$(this).updateEditableCell(this)'>" + endWrapperHtml;
                // input.html = startWrapperHtml + "<input id='ejbeatycelledit' type='number' class='" + inputCss + "' value='" + oldValue + "'" + (listenToKeys ? " onkeyup='if(event.keyCode==13) {$(this).updateEditableCell(this);} else if (event.keyCode===27) {$(this).cancelEditableCell(this);}'" : "") + "></input>&nbsp;<a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this)'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
                break;
            default: // text input
                input.html = startWrapperHtml + "<input id='ejbeatycelledit' class='" + inputCss + "' onfocusout='$(this).updateEditableCell(this)' value='" + oldValue + "' style='width:100%'></input>" + endWrapperHtml;
                break;
        }
        return input;
    }

    function getInputField(callingElement) {
        // Update datatables cell value
        var inputField;
        switch ($(callingElement).prop('nodeName').toLowerCase()) {
            case 'a': // This means they're using confirmation buttons
                if ($(callingElement).siblings('input').length > 0) {
                    inputField = $(callingElement).siblings('input');
                }
                if ($(callingElement).siblings('select').length > 0) {
                    inputField = $(callingElement).siblings('select');
                }
                if ($(callingElement).siblings('textarea').length > 0) {
                    inputField = $(callingElement).siblings('textarea');
                }
                break;
            default:
                inputField = $(callingElement);
        }
        return inputField;
    }

    function sanitizeCellValue(cellValue) {
        if (typeof(cellValue) === 'undefined' || cellValue === null || cellValue.length < 1) {
            return "";
        }

        // If not a number
        if (isNaN(cellValue)) {
            // escape single quote
            cellValue = cellValue.replace(/'/g, "&#39;");
        }
        return cellValue;
    }
    // The rest of the code goes here!
}));