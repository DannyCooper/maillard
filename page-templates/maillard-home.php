<?php
/**
 * Template Name: Home Template
 * Template Post Type: page
 *
 * @package    maillard
 * @copyright  Copyright (c) 2017, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

get_header(); ?>


	<?php if ( is_active_sidebar( 'featured-post' ) || is_active_sidebar( 'featured-categories' ) ) : ?>
		<div class="homepage-widget-area clear">
				<div class="widget-area-featured-post">
					<?php dynamic_sidebar( 'featured-post' ); ?>
				</div><!-- .widget-area-featured-post -->

				<div class="widget-area-featured-categories">
					<?php dynamic_sidebar( 'featured-categories' ); ?>
				</div><!-- .widget-area-featured-categories -->
		</div><!-- .homepage-widget-area -->
	<?php else : ?>

		<hr class="no-features" />

	<?php endif; ?>

<div class="content-area">
	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'home' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;
	?>

</div><!-- .content-area -->

<?php
get_sidebar();
get_footer();
