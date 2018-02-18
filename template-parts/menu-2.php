<?php
/**
 * Template part for displaying the secondary navigation menu.
 *
 * @package    maillard
 * @copyright  Copyright (c) 2017, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

?>

<nav class="menu-2 h-menu">
	<div class="wrapper">
		<button class="menu-toggle" aria-controls="above-header-menu" aria-expanded="false">
			<?php esc_html_e( 'Site Navigation', 'maillard' ); ?>
		</button>

		<?php
		wp_nav_menu( array(
			'theme_location' => 'menu-2',
			'menu_id'        => 'above-header-menu',
			'fallback_cb'    => false,
		) );
		?>
		<?php maillard_social_output_header(); ?>
	</div><!-- .wrapper -->
</nav><!-- .menu-2 -->
