<?php
/**
 * Template used for the site comments.
 *
 * @package zeus
 */
?>

<?php $GLOBALS['comment'] = $comment; ?>

<li <?php zeus_attr( 'comment' ); ?>>

    <article>
        <header class="comment-meta">

            <div class="comment-author-avatar">
                <?php echo get_avatar( $comment->comment_author_email, 100 ); ?>
            </div><!-- .comment-author-avatar -->

            <?php printf( __( '<cite %s>%s</cite>', 'zeus' ), zeus_get_attr( 'comment-author' ), get_comment_author_link() ); ?>

            <?php
			// Check if author of comment is also author of post.
			zeus_bypostauthor( $comment ); ?>

            <time <?php zeus_attr( 'comment-published' ); ?>>
                <?php printf( esc_html__( '%s ago', 'zeus' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
            </time>

            <?php edit_comment_link( '<i class="icon-edit"></i>', '' ); ?>

        </header><!-- .comment-meta -->

        <div <?php zeus_attr( 'comment-content' ); ?>>
            <?php comment_text(); ?>
        </div><!-- .comment-content -->

        <?php comment_reply_link(); ?>

        <?php if ( $comment->comment_approved === '0' ) : ?>
            <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'zeus' ); ?></em>
        <?php endif; ?>
    </article>
