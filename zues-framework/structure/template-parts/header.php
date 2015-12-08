<?php
/**
 * Template used for the site heaader.
 *
 * @package zues
 */

?>

<header <?php zues_attr( 'header' ); ?>">
	<div class="wrap">
		<div <?php zues_attr( 'branding' ); ?>>

			<?php

			if ( get_header_image() ) {
				zues_image_header();
			} else {
				zues_text_header();
			}

			?>

		</div>
	</div>
</header>
