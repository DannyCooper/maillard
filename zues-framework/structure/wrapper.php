<?php

function zues() {

	get_header();

	do_action( 'zues_content_sidebar_wrapper_before' );
	echo '<div class="site-content">';
	do_action( 'zues_content_sidebar_wrapper' );
	echo '</div>';
	do_action( 'zues_content_sidebar_wrapper_after' );

	get_footer();

}
