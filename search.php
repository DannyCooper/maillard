<?php
/**
 * The template for displaying search results pages.
 *
 * @package zues
 */

if ( have_posts() ) :

	get_template_part( 'template-parts/loop' );

else :

	get_template_part( 'template-parts/content', 'none' );

endif;
