<?php

class jeverly_email_form_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'jeverly_email_form_widget',

            __( 'Footer Email Form', 'jeverly' ),

            array( 'description' => __( 'Widget that displays form email.', 'jeverly' ), )
        );
    }

    public function widget( $args, $instance ) {
        $current_user     = wp_get_current_user();

        $placeholder_text = apply_filters( 'widget_placeholder_text', $instance[ 'placeholder_text' ] );
        $button_text      = apply_filters( 'widget_button_text', $instance[ 'button_text' ] );

        echo $args[ 'before_widget' ];

        $output = '<div class="site-info--subs"><img src="' . get_template_directory_uri() . '/assets/imgs/mail.png' .' " alt="message" /><form method="post"><input placeholder="'. $placeholder_text .' "  id="jeverly_email" type="email" name="jeverly_email" /><input type="submit" id="jeverly_subscribe_btn" name="jeverly_subscribe" value="Subscribe" /></form></div>';

        echo $output;

        echo $args[ 'after_widget' ];
    }

    public function form( $instance ) {
        if ( isset( $instance[ 'placeholder_text' ] ) ) {
            $placeholder_text = $instance[ 'placeholder_text' ];
        } else {
            $placeholder_text = __( 'Enter email', 'jeverly' );
        }

        if ( isset( $instance[ 'button_text' ] ) ) {
            $button_text = $instance[ 'button_text' ];
        } else {
            $button_text = __( 'Subscribe', 'jeverly' );
        }
    ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'placeholder_text' ); ?>"><?php _e( 'Placeholder Input Text:', 'jeverly' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'placeholder_text' ); ?>" name="<?php echo $this->get_field_name( 'placeholder_text' ); ?>" type="text" value="<?php echo esc_attr( $placeholder_text ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Send Text:', 'jeverly' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>" />
        </p>

    <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();

        $instance[ 'placeholder_text' ] = ( ! empty( $new_instance[ 'placeholder_text' ] ) ) ? strip_tags( $new_instance[ 'placeholder_text' ] ) : '';
        $instance[ 'button_text' ]      = ( ! empty( $new_instance[ 'button_text' ] ) ) ? strip_tags( $new_instance[ 'button_text' ] ) : '';

        return $instance;
    }

}

// Register and load the widget.
function jeverly_email_form_load_widget() {
    register_widget( 'jeverly_email_form_widget' );
}

add_action( 'widgets_init', 'jeverly_email_form_load_widget' );