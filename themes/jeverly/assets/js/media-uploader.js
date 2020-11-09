jQuery(document).ready(function($) {
    // Uploading files
    let file_frame;
    
    jQuery.fn.upload_decoration_image = function( button ) {
        let button_id = button.attr( 'id' );
        let field_id = button_id.replace( '_button', '' );

        // If the media frame already exists, reopen it.
        if ( file_frame ) {
            file_frame.open();

            return;
        }

        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: button.data( 'uploader_title' ),
            button: {
                text: button.data( 'uploader_button_text' ),
            },
            multiple: false
        });

        // When an image is selected, run a callback.
        file_frame.on( 'select', function() {
            let attachment = file_frame.state().get('selection').first().toJSON();
            jQuery( "#" + field_id ).val(attachment.id);
            jQuery( '#decorationimagediv img' ).attr( 'src', attachment.url );
            jQuery( '#decorationimagediv img' ).show();
            jQuery( '#' + button_id ).attr( 'id', 'remove_decoration_image_button' );
            jQuery( '#remove_decoration_image_button' ).text( 'Remove decoration image' );
        });

        // Finally, open the modal
        file_frame.open();
    };

    jQuery( '#decorationimagediv' ).on( 'click', '#upload_decoration_image_button', function( event ) {
        event.preventDefault();
        jQuery.fn.upload_decoration_image( jQuery(this) );
    });

    jQuery( '#decorationimagediv' ).on( 'click', '#remove_decoration_image_button', function( event ) {
        event.preventDefault();
        jQuery( '#upload_decoration_image' ).val( '' );
        jQuery( '#decorationimagediv img' ).attr( 'src', '' );
        jQuery( '#decorationimagediv img' ).hide();
        jQuery( this ).attr( 'id', 'upload_decoration_image_button' );
        jQuery( '#upload_decoration_image_button' ).text( 'Set decoration image' );
    });

});