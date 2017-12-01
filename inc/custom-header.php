<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 * <?php the_header_image_tag(); ?>
 *
 * @link       https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package    maillard
 * @copyright  Copyright (c) 2017, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses maillard_header_style()
 */
function maillard_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'maillard_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'maillard_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'maillard_custom_header_setup' );

if ( ! function_exists( 'maillard_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see maillard_custom_header_setup().
	 */
	function maillard_header_style() {

		$header_text_color = get_header_textcolor();

		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>

	<?php if ( has_header_image() ) : ?>
		.site-header {
			background: url( <?php header_image(); ?> ) no-repeat;
			background-size: cover;
		}
	<?php endif; ?>

	</style>
	<?php
	}
endif;
