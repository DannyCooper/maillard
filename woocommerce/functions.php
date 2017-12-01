<?php
/**
 * Maillard WooCommerce functions and definitions
 *
 * @package    maillard
 * @copyright  Copyright (c) 2017, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

if ( ! function_exists( 'maillard_wc_checkout_link' ) ) {
	/**
	 * If there are products in the cart, show a checkout link.
	 */
	function maillard_wc_checkout_link() {
		global $woocommerce;

		if ( count( $woocommerce->cart->cart_contents ) > 0 ) :

			echo '<a href="' . esc_url( $woocommerce->cart->get_checkout_url() ) . '" title="' . esc_attr__( 'Checkout', 'maillard' ) . '">' . esc_html__( 'Checkout', 'maillard' ) . '</a>';

		endif;
	}
}
