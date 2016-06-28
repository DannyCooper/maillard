<?php
/**
 * The template for displaying the footer.
 *
 * @package zeus
 */

if ( ! is_active_sidebar( 'footer-1' )
	&& ! is_active_sidebar( 'footer-2' )
	&& ! is_active_sidebar( 'footer-3' )
	&& ! is_active_sidebar( 'footer-4' ) ) {
	return;
} ?>

 <div class="footer-widgets">
		<?php zeus_widget_area( 'footer-1' ); ?>
		<?php zeus_widget_area( 'footer-2' ); ?>
		<?php zeus_widget_area( 'footer-3' ); ?>
		<?php zeus_widget_area( 'footer-4' ); ?>
 </div><!-- .footer-widgets -->
