<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jeverly
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

?>

<div id="comments" class="comments-area">

	<?php
	    // You can start editing here -- including this comment!
        if ( have_comments() ) :
    ?>
        <h5 class="comments-title">
            <?php
                $jeverly_comment_count = get_comments_number();

                if ( '1' === $jeverly_comment_count ) {
                    echo $jeverly_comment_count . __( ' Comment', 'jeverly' );
                } else {
                    echo $jeverly_comment_count . __( ' Comments', 'jeverly' );
                }
            ?>
        </h5><!-- .comments-title -->

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
                wp_list_comments('type=comment&callback=jeverly_comment_author');
            ?>
        </ol><!-- .comment-list -->

        <?php
            the_comments_navigation();

            // If comments are closed and there are comments, let's leave a little note, shall we?
            if ( ! comments_open() ) :
        ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'jeverly' ); ?></p>
        <?php
            endif;

        endif; // Check for have_comments().

        $comments_args = array(
            'comment_field'        => sprintf(
                '<p class="comment-form-comment">%s</p>',
                '<textarea id="comment autoresizing" name="comment" cols="45" rows="1" placeholder="Comment" maxlength="65525"></textarea>'
            ),
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
            'title_reply'          => __( 'Send Comment', 'jeverly' ),
            'title_reply_to'       => __( 'Reply', 'jeverly' ),
            'label_submit'         => __( 'Send Comment', 'jeverly' ),
            'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
            'format'               => 'xhtml',
        );

        comment_form( $comments_args );

	?>

</div><!-- #comments -->
