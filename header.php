<?php
/**
 * The default header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package zues
 */

zues_head();

do_action( 'zues_body_open_before' );
    echo '<body '.zues_get_attr( 'body' ) .'>';
do_action( 'zues_body_open_after' );

/**
 * Zues header function
 *
 * @see /zues-framework/structure/header.php:25
 */
zues_site_header();
