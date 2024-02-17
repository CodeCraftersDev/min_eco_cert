/**
 * Login Functions
 * ------------------
 */
(function ($) {
    'use strict'

    $('form').submit(function(ev){
        ev.preventDefault();
        $('.alert').hide();

        let username = $('#username').val();
        let password= btoa($('#password').val());

        $.ajax({
            url: base_url + '/login',
            type: "POST",
            data: {
                'username': username,
                'password': password,
            },
            // headers: { 'X-Auth-Token' : token },
            success: function(res) {
                if(res.action) {
                    window.location.reload();
                } else {
                    $('.alert').prop('textContent',res.msg);

                    $('.alert').show();
                }
            }
        });
    });

})(jQuery)
