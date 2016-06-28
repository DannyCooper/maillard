<?php
/**
 * Template used for the site heaader.
 *
 * @package zeus
 */

echo '<div ' . zeus_get_attr( 'branding' ) . '>';

	if ( get_header_image() ) {
		zeus_image_header();
	} else {
		zeus_text_header();
	}

echo '</div><!-- .site-branding -->';
