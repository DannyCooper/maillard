<?php

if ( ! function_exists( 'zeus_body_open_html' ) ) {
	/**
	 * Output opening body HTML.
	 */
	function zeus_body_open_html() {

		echo '<body '. zeus_get_attr( 'body' ) .'>';

	}
}

if ( ! function_exists( 'zeus_body_close_html' ) ) {
	/**
	 * Output opening body HTML.
	 */
	function zeus_body_close_html() {

		echo '</body>';

	}
}
