<?php
/**
 * Maillard Theme Customizer
 *
 * @package    maillard
 * @copyright  Copyright (c) 2017, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function maillard_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'maillard_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function maillard_customize_preview_js() {
	wp_enqueue_script( 'maillard_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'maillard_customize_preview_js' );

/**
 * Create Logo Setting and Upload Control
 *
 * @param object $wp_customize WP_Customize object.
 */
function maillard_customizer_settings( $wp_customize ) {

	$wp_customize->add_setting( 'accent-color', array(
		'default' => '#079d46',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control(
		'accent-color-control',
		array(
			'label'    => esc_html__( 'Accent Color', 'maillard' ),
			'section'  => 'colors',
			'settings' => 'accent-color',
			'type'     => 'color',
		)
	);

	$wp_customize->add_setting( 'accent-hover-color', array(
		'default' => '#3b8a38',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control(
		'accent-hover-color-control',
		array(
			'label'    => esc_html__( 'Accent Hover Color', 'maillard' ),
			'section'  => 'colors',
			'settings' => 'accent-hover-color',
			'type'     => 'color',
		)
	);

	$wp_customize->add_section( 'maillard_social_settings' , array(
		'title' => esc_html__( 'Social Settings','maillard' ),
		'priority' => 30,
	) );

	$wp_customize->add_setting( 'social_header_display', array(
		'sanitize_callback' => 'maillard_sanitize_checkbox',
	) );

	$wp_customize->add_control(
		'social_header_display_control',
		array(
			'label'    => esc_html__( 'Display in Header?', 'maillard' ),
			'section'  => 'maillard_social_settings',
			'settings' => 'social_header_display',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting( 'social_footer_display', array(
		'sanitize_callback' => 'maillard_sanitize_checkbox',
	) );

	$wp_customize->add_control(
		'social_footer_display_control',
		array(
			'label'    => esc_html__( 'Display in Footer?', 'maillard' ),
			'section'  => 'maillard_social_settings',
			'settings' => 'social_footer_display',
			'type'     => 'checkbox',
		)
	);

	$websites = array(
		'facebook' => 'Facebook',
		'twitter' => 'Twitter',
		'instagram' => 'Instagram',
		'youtube' => 'YouTube',
		'pinterest' => 'Pinterest',
		'linkedin' => 'LinkedIn',
		'googleplus' => 'Google+',
		'rss' => 'RSS',
		'mail' => 'Contact Form',
	);

	foreach ( $websites as $id => $name ) {

		$wp_customize->add_setting( $id . '-url', array(
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control(
			$id . '_url_control',
			array(
				'label'    => $name . ' URL',
				'section'  => 'maillard_social_settings',
				'settings' => $id . '-url',
				'type'     => 'text',
			)
		);
	}
}
add_action( 'customize_register', 'maillard_customizer_settings' );

/**
 * Sanitize function for checkboxs in customizer settings.
 *
 * @param bool $input The setting value to sanitize.
 */
function maillard_sanitize_checkbox( $input ) {
	// Returns true if checkbox is checked.
	return ( ( isset( $input ) && true === $input ) ? true : false );
}

/**
 * Output the Customize CSS to wp_head
 */
function maillard_customizer_css() {
	?>
	<style>

	a {
		color: <?php echo get_theme_mod( 'accent-color' ); ?>;
	}

	a:hover {
		color: <?php echo get_theme_mod( 'accent-hover-color' ); ?>;
	}

	.menu-2 li:hover,
	.menu-2 li.focus,
	.menu-2 ul ul li {
		background-color: <?php echo get_theme_mod( 'accent-color' ); ?>;
	}

	.menu-2 .sub-menu li:hover {
		background-color: <?php echo get_theme_mod( 'accent-hover-color' ); ?>;
	}

	</style>
	<?php
}
add_action( 'wp_head', 'maillard_customizer_css' );
