var form_contact_us = document.getElementById("form_contact_us");
const http = new XMLHttpRequest();

form_contact_us.addEventListener("submit", function(event) {
    event.preventDefault()
    let url = form_contact_us.dataset.url;
    let data = new FormData(form_contact_us);
    http.open("POST", url)
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var resultado = JSON.parse(this.responseText)
            if (Object.keys(resultado.errors).length > 0) {
                let arr_errores = resultado.errors;
                console.log(arr_errores);
                $.each(arr_errores, function(index, value) {
                    let selector = "" + index + "-error";
                    let selector_strong = "" + index + "-error-strong";
                    document.getElementById(selector).hidden = false;
                    document.getElementById(selector_strong).textContent = value[0];
                    // document.querySelector(selector).hidden = false;
                    // debugger
                    // document.querySelector(selector_strong).textContent = value[0];
                    // $(selector).show();
                    // $(selector_strong).text(value[0]);
                });
                setTimeout(function() {
                    setTextClassElements("error-strong", "&nbsp;")
                        // hideClassElements("error_contact_us");
                }, 3000);
            } else {
                swal.fire(
                    'Gracias!',
                    resultado.response,
                    'success'
                );
                document.getElementById('close_modal_c').click();
            }
            // console.log(resultado)
        }
    }
    http.send(data)
});

function closeOneModal(modalId) {
    // get modal
    const modal = document.getElementById(modalId);

    // change state like in hidden modal
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
    modal.setAttribute('style', 'display: none');

    // get modal backdrop
    const modalBackdrops = document.getElementsByClassName('modal-backdrop');

    // remove opened modal backdrop
    document.body.removeChild(modalBackdrops[0]);
}


function hideClassElements(classname) {
    elements = document.getElementsByClassName(classname);
    for (var i = 0; i < elements.length; i++) {
        elements[i].hidden = true
    }
}

function setTextClassElements(classname, text) {
    elements = document.getElementsByClassName(classname);
    for (var i = 0; i < elements.length; i++) {
        // document.getElementById("demo")
        elements[i].innerHTML = text;
        // elements[i].textContent = text
    }
}

function showClassElements(classname) {
    elements = document.getElementsByClassName(classname);
    for (var i = 0; i < elements.length; i++) {
        elements[i].hidden = false
    }
}