<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link       https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package    maillard
 * @copyright  Copyright (c) 2017, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

?>

		</div><!-- .wrapper -->
	</div><!-- .site-content -->

	<footer class="site-footer">
		<div class="wrapper">
			<?php get_template_part( 'template-parts/footer-widget-area' ); ?>
			<?php maillard_social_output_footer(); ?>
			<div class="site-info">

				<?php
				// translators: %1$s: theme name.
				// translators: %2$s: theme author.
				printf( esc_html__( '%1$s by %2$s.', 'maillard' ), '<a href="https://olympusthemes.com/theme/maillard/">Food Blog Theme</a>', 'OlympusThemes' );
				?>

			</div><!-- .site-info -->
		</div><!-- .wrapper -->
	</footer><!-- .site-footer -->

<?php wp_footer(); ?>

</div><!-- .site-wrapper -->

</body>
</html>
