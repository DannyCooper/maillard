<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package maillard
 */

 remove_action( 'zeus_loop', 'zeus_content', 20 );
 add_action( 'zeus_loop', 'zeus_content_excerpt', 20 );

 zeus();
