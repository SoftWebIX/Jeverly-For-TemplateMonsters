<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jeverly
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
        if ( is_home() && is_front_page() ) {

            $decoration_img   = get_post_meta( $post->ID, '_decoration_image_id', true );
            $output_decor_img = wp_get_attachment_image( $decoration_img, 'full' );

            if ( ! empty( $output_decor_img ) && isset( $output_decor_img ) ) :
                echo '<div class="entry-header-decor">' . $output_decor_img . '</div>';
            endif;

            ?>
                <div class="site-home-post">
                    <?php jeverly_post_thumbnail(); ?>

                    <div class="site-home-content">
                        <?php
                            jeverly_posted_on();
                            jeverly_posted_by();
                        ?>
                        <header class="entry-header">
                            <?php
                                if ( is_singular() ) :
                                    the_title( '<h1 class="entry-title">', '</h1>' );
                                else :
                                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                endif;
                            ?>
                        </header><!-- .entry-header -->
                        <?php
                            $content = get_the_content();

                            if ( ! empty( $content) ) {
                        ?>
                            <div class="entry-content">
                                <?php echo mb_strimwidth( $content, 0, 287, '...' ); ?>
                            </div>
                        <?php
                            }
                        ?>
                        <div class="entry-info-post">
                            <a class="read-more" href="<?php the_permalink() ?>"><?php echo __( 'Read more', 'jeverly' ); ?> </a>
                            <span class="comment-counter">
                                <?php echo get_comments_number( $post->ID ); ?>
                                <i class="fas fa-comment-alt"></i>
                            </span>
                        </div>
                    </div>
                </div>
            <?php

        } else {
    ?>
        <?php
            $decoration_img   = get_post_meta( $post->ID, '_decoration_image_id', true );
            $output_decor_img = wp_get_attachment_image( $decoration_img, 'full' );

            if ( ! empty( $output_decor_img ) && isset( $output_decor_img ) ) :
                echo '<div class="entry-header-decor">' . $output_decor_img . '</div>';
            endif;
        ?>

        <header class="entry-header">
            <?php
                if ( is_singular() ) :
                    the_title( '<h1 class="entry-title">', '</h1>' );
                else :
                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                endif;
            ?>
        </header><!-- .entry-header -->

        <?php jeverly_post_thumbnail(); ?>

        <?php
            if ( 'post' === get_post_type() ) :
        ?>
            <div class="entry-meta">
                <?php
                    jeverly_posted_on();
                    jeverly_posted_by();
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>

        <div class="entry-content">
            <?php
                the_content(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'jeverly' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        wp_kses_post( get_the_title() )
                    )
                );

                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jeverly' ),
                        'after'  => '</div>',
                    )
                );
            ?>
        </div><!-- .entry-content -->
    <?php } ?>

</article><!-- #post-<?php the_ID(); ?> -->
