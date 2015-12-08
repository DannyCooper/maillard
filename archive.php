<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package zues
 */

if ( have_posts() ) {

	get_template_part( 'template-parts/loop' );

} else {

	get_template_part( 'template-parts/content', 'none' );

}
