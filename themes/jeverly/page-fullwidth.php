<?php

/**
* Template Name: Full Width Page
*
* @package WordPress
* @subpackage Jeverly
* @since Jeverly 1.0.0
*/

get_header();

?>

<div class="jeverly-container">
    <div class="javerly-frontier">
        <main id="primary" class="site-main fullwidth">

            <?php
                while ( have_posts() ) :
                    the_post();

                    get_template_part( 'template-parts/content', 'page' );

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
get_footer();