<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Jeverly
 */

get_header();

?>

    <div class="jeverly-container">
        <div class="javerly-frontier">
            <main id="primary" class="site-main">

                <?php
                    while ( have_posts() ) :
                        the_post();

                        get_template_part( 'template-parts/content', get_post_type() );

                        function jeverly_the_post_navigation( $args = array() ) {
                            $args = wp_parse_args( $args, array(
                                'prev_text'          => '<span><img src="' . get_stylesheet_directory_uri() . '/assets/imgs/left-arrow.png" class="arrow" /></span>',
                                'next_text'          => '<span><img src="' . get_stylesheet_directory_uri() . '/assets/imgs/right-arrow.png" class="arrow" /></span>',
                                'in_same_term'       => false,
                                'excluded_terms'     => '',
                                'taxonomy'           => 'category',
                                'screen_reader_text' => __( 'Post navigation', 'jeverly' ),
                            ) );

                            $navigation = '';

                            $prev_post = get_previous_post();
                            $next_post = get_next_post();

                            $prev_title = ! empty( $prev_post ) ? $prev_post->post_title : '';
                            $next_title = ! empty( $next_post ) ? $next_post->post_title : '';

                            $previous = get_previous_post_link(
                                '<div class="nav-previous"><div class="nav-icon">%link</div><div class="nav-info"><span class="nav-subtitle">' . __( 'Previous Post', 'jeverly' ) . '<br></span><span class="nav-title">' . $prev_title . '</span></div></div>',
                                $args[ 'prev_text' ],
                                $args[ 'in_same_term' ],
                                $args[ 'excluded_terms' ],
                                $args[ 'taxonomy' ]
                            );

                            $next = get_next_post_link(
                                '<div class="nav-next"><div class="nav-info"><span class="nav-subtitle">' . __( 'Next Post', 'jeverly' ) . '<br></span><span class="nav-title">' . $next_title . '</span></div><div class="nav-icon">%link</div></div>',
                                $args[ 'next_text' ],
                                $args[ 'in_same_term' ],
                                $args[ 'excluded_terms' ],
                                $args[ 'taxonomy' ]
                            );

                            // Only add markup if there's somewhere to navigate to.
	                        if ( $previous || $next ) {
                                $navigation = _navigation_markup( $previous . $next, 'post-navigation' );
                            }

                            return $navigation;
                        }

                        echo jeverly_the_post_navigation();

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                    endwhile; // End of the loop.
                ?>

            </main><!-- #main -->
        </div>
    </div>

<?php
get_sidebar();
get_footer();
