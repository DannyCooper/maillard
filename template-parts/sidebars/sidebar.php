<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package zeus
 */

if ( ! is_active_sidebar( 'sidebar-primary' ) ) {
	return;
}

zeus_sidebar_primary();
