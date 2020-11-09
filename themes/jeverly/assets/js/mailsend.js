$(function(){
    $( '#jeverly_subscribe_btn' ).click(function(e) {
        e.preventDefault();

        let admin_url = ajaxobj.ajaxurl;

        $.ajax({
            type: 'POST',
            data: {
                action: 'mail_func',
            },
            url: admin_url
        }).done(function( response ) {
            $('.site-info--subs').append('<span class="success-mail">You are successfully subscribed!</span>');
        }).fail(function( response ) {
            $('.site-info--subs').append('<span class="fail-mail">Try again later!</span>');
        });
    })
})