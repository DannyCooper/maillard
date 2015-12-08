<?php
/**
 * Outputs the primary navigation.
 *
 * @package zues
 */

do_action( 'zues_primary_nav_before' ); ?>

	<nav <?php zues_attr( 'menu', 'primary' ) ?>">
		<div class="wrap">
			<?php wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container' => false,
				'depth'      => 3,
				)
		); ?>
		</div>
	</nav>
	<?php do_action( 'zues_primary_nav_before' ); ?>
