<?php
/**
 * The loop template file.
 *
 * Included on pages like index.php, archive.php and search.php to display a loop of posts
 * Learn more: http://codex.wordpress.org/The_Loop
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
