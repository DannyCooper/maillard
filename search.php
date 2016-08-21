<?php
/**
 * The template for displaying search results pages.
 *
 * @package maillard
 */

remove_action( 'zeus_loop', 'zeus_content', 20 );
add_action( 'zeus_loop', 'zeus_content_excerpt', 20 );

zeus();
