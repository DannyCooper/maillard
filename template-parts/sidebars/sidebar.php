<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package zues
 */

if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
	return;
}

zues_primary_sidebar();

