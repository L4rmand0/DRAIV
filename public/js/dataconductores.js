// IIFE - Immediately Invoked Function Expression
(function (runcode) {

    // The global jQuery object is passed as a parameter
    runcode(window.jQuery, window, document);

}(function ($, window, document) {
    
    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function () {
        $city_residence_select2 = $('#city_residence_place').select2();
        $gender_select2 = $('#gender').select2();
        $education_select2 = $('#education').select2();
        $country_born_select2 = $('#country_born').select2();
        $civil_state_select2 = $('#civil_state').select2();
        $company_select2 = $('#company_id').select2();

        //Limpia los estilos de error en los formularios
        $("#msform input[type=text], #msform input[type=email], #msform input[type=password], #msform input[type=number], #msform input[type=tel]").on("keypress", function() {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });

        $("#msform input[type=checkbox], #msform select").on("change", function() {
            let $target = $(this);
            $(this).cleanErrorElementForm($target);
        });

        $.ajax({
            type: 'GET',
            url: $('#department').data('url'),
            data: { 'type': 'select_admin2' },
            success: function(data) {
                $department_form_select2 = $('#department').select2({
                    data: data
                });
            }
        });

        $("#department").on('change', function() {
            let data_admin2 = $(this).val();
            let data_cities = new Array();
            let item = { "id": "", "text": "Seleccionar" };
            data_cities.push(item)
            $.each(list_admin3, function(index, value) {
                let admin2_item = value.adm2_id;
                if (data_admin2 == admin2_item) {
                    let admin3_item = { "id": value.adm3_id, "text": value.name };
                    data_cities.push(admin3_item)
                }
            });
            $("#city_residence_place").attr('disabled', false);
            $('#city_residence_place').html("");
            $("#city_residence_place").select2({
                data: data_cities
            });
        });

        $('#msform').submit(function (e) {
            e.preventDefault();
            let url_action = $(this).attr('action');
            let form_data = $("#msform").serialize();
            
            $.post(url_action, form_data, function (result) {
                
            });
        });

        $("#btn_upload_img").on("click",function(){
            let element_button = $(this);
            let form_data = $("#msform").serialize();
            let url_action = element_button.data('url');
            $.post(url_action, form_data, function (result) {
                console.log(result);
            });
        });
    });

    // The rest of the code goes here!
}));