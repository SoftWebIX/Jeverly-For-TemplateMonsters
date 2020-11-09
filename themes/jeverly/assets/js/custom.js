$(function () {

    $('.main-navigation .menu-item-has-children').on( 'mouseenter mouseleave', function () {
        let elm = $(this).find('.sub-menu');
        let off  = elm.offset();
        let l    = off.left;
        let w    = elm.width();
        let docW = $(window).width();
        let isEntirelyVisible = ( l + w <= docW );

        if ( ! isEntirelyVisible ) {
            $(this).find('.sub-menu').removeClass('left-position');
        } else {
            $(this).find('.sub-menu').addClass('left-position');
        }
    });

    function hamburgerMenu() {
        $('.menu-toggle').unbind('click').on( 'click', function() {
            $(this).toggleClass('menu-toggle-close');
            $('html, body').toggleClass('overflow-hidden');
            $('.site-primary-menu-responsive').slideToggle(500);
        });
    }

    $(window).on( 'load orientationchange resize', function (e) {
        if ( $(window).width() < 768 ) {
            hamburgerMenu();
        }
    });

    // Site title and description.
    wp.customize( 'blogname', function( value ) {
        value.bind( function( to ) {
            $( '.site-title a' ).text( to );
        } );
    } );
    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( to ) {
            $( '.site-description' ).text( to );
        } );
    } );

    // Header text color.
    wp.customize( 'header_textcolor', function( value ) {
        value.bind( function( to ) {
            if ( 'blank' === to ) {
                $( '.site-title, .site-description' ).css( {
                    clip: 'rect(1px, 1px, 1px, 1px)',
                    position: 'absolute',
                } );
            } else {
                $( '.site-title, .site-description' ).css( {
                    clip: 'auto',
                    position: 'relative',
                } );
                $( '.site-title a, .site-description' ).css( {
                    color: to,
                } );
            }
        } );
    } );

});