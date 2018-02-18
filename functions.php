<?php
/**
 * Maillard functions and definitions
 *
 * @link       https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package    maillard
 * @copyright  Copyright (c) 2017, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

if ( ! function_exists( 'maillard_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function maillard_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary Menu', 'maillard' ),
			'menu-2' => esc_html__( 'Above Header Menu', 'maillard' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'maillard_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add image size for blog posts, 770px wide (and unlimited height).
		add_image_size( 'maillard-blog', 770 );
		// Add image size for the featured post on the homepage, 970px wide by 550px wide.
		add_image_size( 'maillard-featured-post', 970, 550, true );
		// Add image size for the featured post on the homepage, 170px wide by 115px wide.
		add_image_size( 'maillard-featured-cat', 170, 115, true );
		// Add image size for the blog posts on the homepage, 250px wide (and unlimited height).
		add_image_size( 'maillard-home-blog', 250 );

		// Add stylesheet for the WordPress editor.
		add_editor_style( '/assets/css/editor-style.css' );

		// Add support for custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		// Add support for WooCommerce.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

	}
endif;
add_action( 'after_setup_theme', 'maillard_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function maillard_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'maillard_content_width', 1040 );
}
add_action( 'after_setup_theme', 'maillard_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function maillard_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'maillard' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'maillard' ),
		'before_widget' => '<section class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Featured Post', 'maillard' ),
		'id'            => 'featured-post',
		'description'   => esc_html__( 'Add widgets here.', 'maillard' ),
		'before_widget' => '<section class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Featured Categories', 'maillard' ),
		'id'            => 'featured-categories',
		'description'   => esc_html__( 'Add widgets here.', 'maillard' ),
		'before_widget' => '<section class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'maillard' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'maillard' ),
		'before_widget' => '<section class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'maillard' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'maillard' ),
		'before_widget' => '<section class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'maillard' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'maillard' ),
		'before_widget' => '<section class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Four', 'maillard' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'maillard' ),
		'before_widget' => '<section class="widget %2$s last">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'maillard_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function maillard_scripts() {
	wp_enqueue_style( 'maillard-style', get_stylesheet_uri() );
	wp_enqueue_style( 'socicons', get_template_directory_uri() . '/assets/css/socicons.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style( 'maillard-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'maillard_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * If the WooCommerce plugin is active, load the related functions.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/woocommerce/functions.php';
}

/**
 * Load the widgets.
 */
require get_stylesheet_directory() . '/template-parts/widgets/featured-category.php';
require get_stylesheet_directory() . '/template-parts/widgets/featured-post.php';

/**
 * Display the admin notice.
 */
function maillard_admin_notice() {
	global $current_user;
	$user_id = $current_user->ID;

	if ( class_exists( 'Olympus_Google_Fonts' ) ) {
		return;
	}

	/* Check that the user hasn't already clicked to ignore the message */
	if ( ! current_user_can( 'install_plugins' ) ) {
		return;
	}

	if ( ! get_user_meta( $user_id, 'maillard_ignore_notice' ) ) {
		?>

		<div class="notice notice-info">
			<p>
				<?php
				printf(
					/* translators: 1: plugin link */
					esc_html__( 'Easily change the font of your website with our new plugin - %1$s', 'maillard' ),
					'<a href="' . esc_url( admin_url( 'plugin-install.php?s=olympus+google+fonts&tab=search&type=term' ) ) . '">Google Fonts for WordPress</a>'
				);
				?>
				<span style="float:right">
					<a href="?maillard_ignore_notice=0">
						<?php esc_html_e( 'Hide Notice', 'maillard' ); ?>
					</a>
				</span>
			</p>
		</div>

		<?php
	}
}
add_action( 'admin_notices', 'maillard_admin_notice' );

/**
 * Dismiss the admin notice.
 */
function maillard_dismiss_admin_notice() {

	global $current_user;
	$user_id = $current_user->ID;
	/* If user clicks to ignore the notice, add that to their user meta */
	if ( isset( $_GET['maillard_ignore_notice'] ) && '0' === $_GET['maillard_ignore_notice'] ) {
		add_user_meta( $user_id, 'maillard_ignore_notice', 'true', true );
	}
}
add_action( 'admin_init', 'maillard_dismiss_admin_notice' );

/**
 * Output the social profile icons.
 */
function maillard_social_output() {

	$social_websites = array(
		'facebook'   => esc_html__( 'Facebook', 'maillard' ),
		'twitter'    => esc_html__( 'Twitter', 'maillard' ),
		'instagram'  => esc_html__( 'Instagram', 'maillard' ),
		'youtube'    => esc_html__( 'YouTube', 'maillard' ),
		'pinterest'  => esc_html__( 'Pinterest', 'maillard' ),
		'linkedin'   => esc_html__( 'LinkedIn', 'maillard' ),
		'googleplus' => esc_html__( 'Google+', 'maillard' ),
		'rss'        => esc_html__( 'RSS', 'maillard' ),
		'mail'       => esc_html__( 'Contact', 'maillard' ),
	);

	echo '<div class="maillard-social-icons">';

	foreach ( $social_websites as $id => $name ) {

		$url = get_theme_mod( $id . '-url' );

		if ( $url ) {

			echo '<a href="' . esc_url( $url ) . '">
				<span class="socicon socicon-' . esc_attr( $id ) . '"></span>
			</a>';

		}
	}

	echo '</div><!-- .maillard-social-icons -->';

}

/**
 * Enqueue the admin stylesheet.
 *
 * @param string $hook check which admin pagd we are on.
 */
function maillard_admin_css_enqueue( $hook ) {
	if ( 'widgets.php' !== $hook ) {
		return;
	}

	wp_enqueue_style( 'maillard_admin', get_template_directory_uri() . '/assets/css/admin.css' );
}

add_action( 'admin_enqueue_scripts', 'maillard_admin_css_enqueue' );

/**
 * Add a class to the 'WP Instagram Widget' plugin button for styling.
 */
function maillard_instagram_widget_link_class() {
	return 'maillard-instagram-widget-link';
}
add_filter( 'wpiw_link_class', 'maillard_instagram_widget_link_class' );

/**
 * Retrieves the attachment ID from the file URL.
 *
 * @param string $image_url The URL of the image we need the id for.
 */
function maillard_get_image_id( $image_url ) {
	if ( ! empty( $image_url ) ) {
		global $wpdb;
		$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );
		return $attachment[0];
	}
}

// Remove yummly-rich-recipes styles.
add_filter( 'wp_head', 'amd_yrecipe_process_head' );
