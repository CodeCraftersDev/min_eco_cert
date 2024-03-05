"use strict";
// Preloader
$(window).on('load', function() {
    $("#status").delay(700).fadeOut();
    $("#preloader").delay(700).fadeOut("slow");
});

// on ready function
$(document).ready(function($) {

    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });

    const validator = $( "#formid" ).validate({
        rules: {
            nombre: "required",
            apellido: "required",
            dni_number: {
                required: true,
                number: true
            }
        },
        messages: {
            nombre: "Por favor ingrese su nombre",
            apellido: "Por favor ingrese su apellido",
            dni_number: {
                required: "Por favor ingrese su DNI",
                number: "Por favor ingresar solo números"
            }
        }
    });

    $('#btn-submit').click(function(){
        $('#ajax_loader').show();
        let valid = validator.form();
        if(valid){
            let dni = $('#dni_number').val();
            let nombre = $('#nombre').val();
            let apellido = $('#apellido').val();
            $.ajax({
                type: "POST",
                url: base_url+"validatedni",
                data: {
                    "dni": dni,
                    "nombre": nombre,
                    "apellido": apellido
                },
                dataType: "json",
                success: function(result){
                    $('#ajax_loader').hide();
                    $('#modal-box #nook').hide();
                    modal('modal-box', 'Certificado', result.message, function(){
                        window.location.href = result.url;
                    }, function(){
                        $('#'+id_modal).modal('hide');
                    });

                }
            });
        }
        else{
            $('#ajax_loader').hide();
        }
    });

});


function modal(id_modal, title, text_body, ok, nook){
    $('#'+id_modal+' #title').html(title);
    $('#'+id_modal+' #text-body').html(text_body);
    $('#'+id_modal+' #ok').click(ok);
    $('#'+id_modal+' #nook').click(nook);
    $('#'+id_modal).modal('show');
}