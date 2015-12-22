<?php
/**
 * Template functions used for the site comments.
 *
 * @package zues
 */

if ( ! function_exists( 'zues_display_comments' ) ) {
	/**
	 * Zues display comments
	 */
	function zues_display_comments() {

		$template = apply_filters( 'zues_comments_template', '/comments.php' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || '0' !== get_comments_number() ) :
		    comments_template( $template );
		endif;
	}
}

if ( ! function_exists( 'zues_comment' ) ) {
	/**
	 * Custom comment output
	 *
	 * @param object $comment The comment object.
	 * @param array  $args Comment display args.
	 * @param int    $depth Levels of comment depth to be shown.
	 */
	function zues_comment( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment; ?>

	<li <?php zues_attr( 'comment' ); ?>>

	    <article>
	        <header class="comment-meta">

	            <div class="comment-author-avatar">
	                <?php echo get_avatar( $comment->comment_author_email, 100 ); ?>
	            </div>

	            <?php printf( __( '<cite %s>%s</cite> - ', 'zues' ), zues_get_attr( 'comment-author' ), get_comment_author_link() ); ?>

	            <?php
	            // Check if author of comment is also author of post.
	            zues_bypostauthor( $comment ); ?>

	            <time <?php zues_attr( 'comment-published' ); ?>>
	                <?php printf( esc_html__( '%s ago', 'zues' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
	            </time>

	            <?php edit_comment_link( '<i class="icon-edit"></i>', '' ); ?>

	        </header>

	        <div <?php zues_attr( 'comment-content' ); ?>>
	            <?php comment_text(); ?>
	        </div><!-- .comment-content -->

	        <?php comment_reply_link(); ?>

	        <?php if ( $comment->comment_approved === '0' ) : ?>
	            <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'zues' ); ?></em>
	        <?php endif; ?>
	    </article>

	    <?php
	}
}

if ( ! function_exists( 'zues_bypostauthor' ) ) {
	/**
	 * Check if comment is by the author of the post
	 */
	function zues_bypostauthor( $comment ) {

		global $post;

		// If current post author is also comment author, make it known visually.
		$visual = ( $comment->user_id === $post->post_author ? '<span>' . esc_html__( 'Post author', 'zues' ) . '</span>' : '');
		echo $visual;
	}
}

if ( ! function_exists( 'zues_comments_nav' ) ) {
	/**
	 * Output the comment navigation.
	 *
	 * Can be overwritten  by adding a file named entry-meta.php to /template-parts in your
	 * theme or child theme.
	 */
	function zues_comments_nav() {

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

			<nav id="comment-nav-above" class="navigation comment-navigation">

				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'zues' ); ?></h2>

				<div class="nav-links nav-links-comments clear">

					<div class="nav-previous">
						<?php previous_comments_link( esc_html__( '&larr; Older Comments', 'zues' ) ); ?>
					</div>

					<div class="nav-next">
						<?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'zues' ) ); ?>
					</div>

				</div><!-- .nav-links -->

			</nav><!-- #comment-nav-above -->

		<?php endif; // Check for comment navigation. 

	}
}
