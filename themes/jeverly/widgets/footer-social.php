<?php

class jeverly_footer_social_widget extends WP_Widget {
  
    function __construct() {
        parent::__construct(
            'jeverly_footer_social_widget',
              
            __( 'Footer Social Item', 'jeverly' ),
              
            array( 'description' => __( 'Widget that displays item social menus', 'jeverly' ), )
        );
    }
  
    public function widget( $args, $instance ) {
        $current_user = wp_get_current_user();

        $social_first = apply_filters( 'widget_social', $instance[ 'social_first' ] );
        $link_first   = apply_filters( 'widget_link', $instance[ 'link_first' ] );

        $social_second = apply_filters( 'widget_social', $instance[ 'social_second' ] );
        $link_second   = apply_filters( 'widget_link', $instance[ 'link_second' ] );

        $social_tertiary = apply_filters( 'widget_social', $instance[ 'social_tertiary' ] );
        $link_tertiary   = apply_filters( 'widget_link', $instance[ 'link_tertiary' ] );

        echo $args[ 'before_widget' ];

        $output = '<div class="site-info--social"><ul class="site-info--social-items"><li><a href="' . $link_first . '">' . $social_first . '</a></li><li><a href="' . $link_second . '">' . $social_second . '</a></li><li><a href="' . $link_tertiary . '">' . $social_tertiary . '</a></li></ul></div>';

        echo $output;

        echo $args[ 'after_widget' ];
    }

    public function form( $instance ) {
        $social_first   = ! empty( $instance[ 'social_first' ]  ) ? $instance[ 'social_first' ] : __( 'Instagram', 'jeverly' );
        $link_first     = ! empty( $instance[ 'link_first' ]  ) ? $instance[ 'link_first' ] : __( '#', 'jeverly' );

        $social_second   = ! empty( $instance[ 'social_second' ]  ) ? $instance[ 'social_second' ] : __( 'Facebook', 'jeverly' );
        $link_second     = ! empty( $instance[ 'link_second' ]  ) ? $instance[ 'link_second' ] : __( '#', 'jeverly' );

        $social_tertiary = ! empty( $instance[ 'social_tertiary' ]  ) ? $instance[ 'social_tertiary' ] : __( 'Pinterest', 'jeverly' );
        $link_tertiary   = ! empty( $instance[ 'link_tertiary' ]  ) ? $instance[ 'link_tertiary' ] : __( '#', 'jeverly' );

        ?>

            <p>
                <h4 style="margin-bottom: 12px"><?php echo __( 'First Item', 'jeverly' ); ?></h6>
                <label for="<?php echo $this->get_field_id( 'social_first' ); ?>"><?php _e( 'Social Name:', 'jeverly' ); ?></label>
                <input style="margin-bottom: 8px"  class="widefat" id="<?php echo $this->get_field_id( 'social_first' ); ?>" name="<?php echo $this->get_field_name( 'social_first' ); ?>" type="text" value="<?php echo esc_attr( $social_first ); ?>" />
                <label for="<?php echo $this->get_field_id( 'link_first' ); ?>"><?php _e( 'Link:', 'jeverly' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link_first' ); ?>" type="url" value="<?php echo esc_attr( $link_first ); ?>" />
            </p>

            <p>
                <h4 style="margin-bottom: 12px"><?php echo __( 'Second Item', 'jeverly' ); ?></h6>
                <label for="<?php echo $this->get_field_id( 'social_second' ); ?>"><?php _e( 'Social Name:', 'jeverly' ); ?></label>
                <input style="margin-bottom: 8px"   class="widefat" id="<?php echo $this->get_field_id( 'social_second' ); ?>" name="<?php echo $this->get_field_name( 'social_second' ); ?>" type="text" value="<?php echo esc_attr( $social_second ); ?>" />
                <label for="<?php echo $this->get_field_id( 'link_second' ); ?>"><?php _e( 'Link:', 'jeverly' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'link_second' ); ?>" name="<?php echo $this->get_field_name( 'link_second' ); ?>" type="url" value="<?php echo esc_attr( $link_second ); ?>" />
            </p>

            <p>
                <h4 style="margin-bottom: 15px"><?php echo __( 'Tertiary Item', 'jeverly' ); ?></h6>
                <label for="<?php echo $this->get_field_id( 'social_tertiary' ); ?>"><?php _e( 'Social Name:', 'jeverly' ); ?></label>
                <input style="margin-bottom: 8px"   class="widefat" id="<?php echo $this->get_field_id( 'social_tertiary' ); ?>" name="<?php echo $this->get_field_name( 'social_tertiary' ); ?>" type="text" value="<?php echo esc_attr( $social_tertiary ); ?>" />
                <label for="<?php echo $this->get_field_id( 'link_tertiary' ); ?>"><?php _e( 'Link:', 'jeverly' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'link_tertiary' ); ?>" name="<?php echo $this->get_field_name( 'link_tertiary' ); ?>" type="url" value="<?php echo esc_attr( $link_tertiary ); ?>" />
            </p>

        <?php
    }
      
    public function jeverly_update( $new_instance, $old_instance ) {
        $instance = array();

        $instance[ 'social_first' ] = ( ! empty( $new_instance[ 'social_first' ] ) ) ? strip_tags( $new_instance[ 'social_first' ] ) : '';
        $instance[ 'link_first' ] = ( ! empty( $new_instance[ 'link_first' ] ) ) ? strip_tags( $new_instance[ 'link_first' ] ) : '';

        $instance[ 'social_second' ] = ( ! empty( $new_instance[ 'social_second' ] ) ) ? strip_tags( $new_instance[ 'social_second' ] ) : '';
        $instance[ 'link_second' ] = ( ! empty( $new_instance[ 'link_second' ] ) ) ? strip_tags( $new_instance[ 'link_second' ] ) : '';

        $instance[ 'social_tertiary' ] = ( ! empty( $new_instance[ 'social_tertiary' ] ) ) ? strip_tags( $new_instance[ 'social_tertiary' ] ) : '';
        $instance[ 'link_tertiary' ] = ( ! empty( $new_instance[ 'link_tertiary' ] ) ) ? strip_tags( $new_instance[ 'link_tertiary' ] ) : '';

        return $instance;
    }

} 

// Register and load the widget.
function jeverly_footer_social_load_widget() {
    register_widget( 'jeverly_footer_social_widget' );
}

add_action( 'widgets_init', 'jeverly_footer_social_load_widget' );