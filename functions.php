<?php
/**
 * Zeus functions and definitions
 *
 * @package maillard
 */

define( 'USE_ZEUS_CUSTOMIZER', true );

/**
 * Load zeus framework.
 */
require_once( get_template_directory() . '/zeus-framework/init.php' );

if ( ! function_exists( 'maillard_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function maillard_setup() {
		/*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Core, use a find and replace
         * to change 'maillard' to the name of your theme in all the template files
        */
		load_theme_textdomain( 'maillard', get_template_directory() . '/languages' );


		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_editor_style( '/assets/css/editor-styles.css' );

		/*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
        */
		add_theme_support( 'title-tag' );

		$args = array(
			'flex-height' => true,
			'width' => 1170,
			'flex-height' => true,
			'height' => 250,
			'default-text-color' => '313131',
		);
		add_theme_support( 'custom-header', $args );

		/*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
        */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'maillard-homepage-blog-thumbnail', 250, 250, true ); // 250 pixels wide by 250px high
		add_image_size( 'maillard-blog-post', 770 ); // 770 pixels wide (and unlimited height)

		/*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
        */
		add_theme_support(
			'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters(
				'zeus_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
				)
			)
		);

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
			'menu-1' => esc_html__( 'Primary Menu', 'maillard' ),
			'menu-2' => esc_html__( 'Header Menu', 'maillard' ),
			)
		);

	}
}
add_action( 'after_setup_theme', 'maillard_setup' );


if ( ! function_exists( 'maillard_content_width' ) ) {
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function maillard_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'maillard_content_width', 1170 );
	}
	add_action( 'after_setup_theme', 'maillard_content_width', 0 );
}

/**
 * Register the widget areas this theme supports
 */
function maillard_register_sidebars() {

	zeus_register_widget_area(
		array(
		'id'          => 'sidebar-primary',
		'name'        => __( 'Primary Sidebar', 'maillard' ),
		'description' => __( 'Widgets added here are shown in the sidebar next to your content.', 'maillard' ),
		)
	);

	zeus_register_widget_area(
		array(
		'id'          => 'footer-1',
		'name'        => __( 'Footer One', 'maillard' ),
		'description' => __( 'The footer is divided into four widget areas, each spanning 25% of the layout\'s width.', 'maillard' ),
		)
	);

	zeus_register_widget_area(
		array(
		'id'          => 'footer-2',
		'name'        => __( 'Footer Two', 'maillard' ),
		'description' => __( 'The footer is divided into four widget areas, each spanning 25% of the layout\'s width.', 'maillard' ),
		)
	);

	zeus_register_widget_area(
		array(
		'id'          => 'footer-3',
		'name'        => __( 'Footer Three', 'maillard' ),
		'description' => __( 'The footer is divided into four widget areas, each spanning 25% of the layout\'s width.', 'maillard' ),
		)
	);

	zeus_register_widget_area(
		array(
		'id'          => 'footer-4',
		'name'        => __( 'Footer Four', 'maillard' ),
		'description' => __( 'The footer is divided into four widget areas, each spanning 25% of the layout\'s width.', 'maillard' ),
		)
	);

	zeus_register_widget_area(
		array(
		'id'          => 'featured-post',
		'name'        => __( 'Featured Post', 'maillard' ),
		'description' => __( '', 'maillard' ),
		)
	);

	zeus_register_widget_area(
		array(
		'id'          => 'featured-categories',
		'name'        => __( 'Featured Categories', 'maillard' ),
		'description' => __( '', 'maillard' ),
		)
	);

}

add_action( 'widgets_init', 'maillard_register_sidebars', 5 );

/**
 * Enqueue scripts and styles.
 */
function maillard_scripts() {
	wp_enqueue_style( 'ot-maillard-style', get_stylesheet_uri() );
	wp_enqueue_style( 'maillard-socicons', ZEUS_THEME_URI . '/assets/css/socicons.css' );

	wp_enqueue_script( 'maillard-scripts', ZEUS_THEME_URI . '/assets/js/scripts.js', array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'maillard_scripts' );

/**
 * Move the navigation above the header.
 */
remove_action( 'zeus_header_after', 'zeus_nav', 10 );
add_action( 'zeus_header_before', 'zeus_nav', 10 );

/**
 * @TODO
 */
remove_action( 'zeus_sub_footer', 'zeus_footer_attribution', 15 );

/**
 * @todo
 */
require_once( get_stylesheet_directory() . '/inc/customizer.php' );
require_once( get_stylesheet_directory() . '/inc/customizer-output.php' );

/**
 * @todo
 */
require( get_stylesheet_directory() . '/template-parts/widgets/featured-category.php' );
require( get_stylesheet_directory() . '/template-parts/widgets/featured-post.php' );

/**
 * @TODO
 */
function maillard_social_output() {

	$social_websites = array(
		'facebook' => 'Facebook',
		'twitter' => 'Twitter',
		'instagram' => 'Instagram',
		'youtube' => 'YouTube',
		'pinterest' => 'Pinterest',
		'linkedin' => 'LinkedIn',
		'googleplus' => 'Google+',
		'rss' => 'RSS',
		'mail' => 'Contact',
	);

	echo '<div class="maillard-social-icons">';

	foreach ( $social_websites as $id => $name ) {

		if( $url = get_theme_mod( $id.'-url' ) ) {

			echo '<a href="'. esc_url( $url ) .'">
				<span class="socicon socicon-'.esc_attr( $id ).'"></span>
			</a>';

		}

	}

	echo '</div>';

}

/**
 * @todo
 */
function maillard_social_output_header() {

	if( get_theme_mod( 'social_header_display' ) !== '1' ) {
		return;
	}

	maillard_social_output();

}
add_action( 'zeus_nav_menu_after', 'maillard_social_output_header', 15 );

/**
 * @todo
 */
function maillard_social_output_footer() {

	if( get_theme_mod( 'social_footer_display' ) !== '1' ) {
		return;
	}

	maillard_social_output();

}
add_action( 'zeus_sub_footer', 'maillard_social_output_footer', 15 );

/**
 * @todo
 */
function maillard_instagram_widget_link_class() {
	return 'maillard-instagram-widget-link';
}

add_filter( 'wpiw_link_class', 'maillard_instagram_widget_link_class' );

/**
 * @todo
 */
function maillard_instagram_widget_ul_class( $classes ) {
	return $classes . ' clear';
}

add_filter( 'wpiw_list_class', 'maillard_instagram_widget_ul_class' );

/**
 * @todo
 */
function maillard_footer_attribution( ){

	$text = __( 'Copyright &copy; %1$s <a href="%2$s">%3$s</a> &middot; Powered by  the %4$s.', 'maillard' );

	$date = date_i18n( 'Y' );
	$url = esc_url( home_url() );
	$name = get_bloginfo( 'name' );
	$attribution = '<a href="https://olympusthemes.com/maillard">Maillard Theme</a>';

	return sprintf( $text, $date, $url, $name, $attribution );

}
add_filter( 'zeus_footer_copyright', 'maillard_footer_attribution' );

/**
 * @todo
 */
function maillard_header_nav() {

	wp_nav_menu( array(
	    'theme_location' => 'menu-2',
		'menu_class' => 'zeus-nav-horizontal right',
		'fallback_cb' => 'false'
		)
	);
}
add_action( 'zeus_header', 'maillard_header_nav', 15 );


/**
 * @todo
 */
if( ! is_single() ) {
	remove_action( 'zeus_loop', 'zeus_entry_footer', 30 );
}


add_action( 'customize_preview_init', 'zeus_customizer_preview_js' );
