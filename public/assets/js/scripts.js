"use strict";
// Preloader
$(window).on('load', function() {
    $("#status").delay(700).fadeOut();
    $("#preloader").delay(700).fadeOut("slow");
});

// on ready function
$(document).ready(function($) {

    $('#btn-submit').click(function(){
        $('#ajax_loader').show();
        let dni = $('#dni_number').val();
        $.ajax({
            type: "POST",
            url: base_url+"validate",
            data: {
                "dni": dni,
            },
            dataType: "json",
            success: function(result){
                console.log(result);
            },
            complete: function(jqXHR, textStatus){
                if(textStatus == 'error'){
                    console.log(jqXHR);
                }
                $('#ajax_loader').hide();
            }
        });
    });

});
