<?php
/**
 * The template for displaying a single page/post.
 *
 * See /core/structure/post.php and /core/structure/hooks.php
 *
 * @package zues
 */
?>

<main <?php zues_attr( 'content' ); ?>>

	<?php
	/**
	 * Load the standard zues-framework loop.
	 * @see zues-framework/structure/post.php:21
	 */
	zues_loop(); ?>

</main>
