<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jeverly
 */

?>
    <div class="jeverly-container">
        <div class="javerly-frontier">
            <footer id="colophon" class="site-footer">
                <div class="site-info">
                    <?php
                        $img_url = get_site_icon_url(30);

                        if ( ! empty( $img_url ) ) {
                    ?>
                        <div>
                            <?php
                                $rm_image_id = attachment_url_to_postid( $img_url );

                                if ( $rm_image_id) {
                                    // Using wp_get_attachment_image should return your alt text added in the WordPress admin.
                                    echo wp_get_attachment_image( $rm_image_id, 'full' );
                                } else {
                                    // Fallback in case it's not found.
                                    echo '<img src="' . $img_url . '" alt="" />';
                                }
                            ?>
                        </div>
                    <?php } ?>

                    <div class="site-contact">
                        <?php dynamic_sidebar( 'footer_widgets' ); ?>
                    </div>
                </div><!-- .site-info -->
            </footer><!-- #colophon -->
        </div>
    </div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
