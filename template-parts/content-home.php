<?php
/**
 * Template part for displaying homepage articles
 *
 * @link       https://codex.wordpress.org/Template_Hierarchy
 *
 * @package    maillard
 * @copyright  Copyright (c) 2017, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

$args = array(
	'posts_per_page' => 3, // @TODO add a filter.
);

$loop = new WP_Query( $args );

if ( $loop->have_posts() ) :

	while ( $loop->have_posts() ) :

		$loop->the_post();
		?>

		<article <?php post_class( 'clear' ); ?> >

			<?php maillard_thumbnail( 'maillard-home-blog' ); ?>

			<div class="home-post-content">

				<?php

				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

				the_excerpt();

				?>

			</div><!-- .home-post-content -->

		</article><!-- .post-<?php echo get_the_ID(); ?> -->
		<?php
	endwhile;
endif;

wp_reset_postdata();
