<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package zues
 */
?>

<main <?php zues_attr( 'content' ); ?>>

<?php do_action( 'zues_404_before' ); ?>

	<section class="error-404 not-found">

		<div class="entry-content">

			<header class="entry-header">
				<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'zues' ); ?></h1>
			</header>

			<p><?php esc_html_e( 'Nothing was found at this location. Try searching, or check out the links below.', 'zues' ); ?></p>

		</div>
	</section>

<?php do_action( 'zues_404_after' ); ?>

</main>
