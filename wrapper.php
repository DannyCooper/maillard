<?php
/**
 * The wrapper used to build all front-facing pages.
 *
 * @package zues
 */

zues_head(); ?>

	<?php do_action( 'zues_body_open_before' ); ?>
	<body <?php zues_attr( 'body' ); ?>>
	<?php do_action( 'zues_body_open_after' ); ?>

			<?php get_header(); ?>

	    <?php do_action( 'zues_content_sidebar_wrapper_before' ); ?>
			<div class="site-content">
				<div class="wrap">
					<?php do_action( 'zues_content_sidebar_wrapper' ); ?>
				</div>
			</div>
		<?php do_action( 'zues_content_sidebar_wrapper_after' ); ?>

	    	<?php get_footer(); ?>

	<?php do_action( 'zues_body_close_before' ); ?>
	</body>
	<?php do_action( 'zues_body_close_after' ); ?>

</html>
