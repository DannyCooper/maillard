<?php
/**
 * Build Featured Post Widget.
 *
 * @package     maillard
 * @copyright   Copyright (c) 2017, Danny Cooper
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Adds Knowledge Base Articles widget.
 */
class Maillard_Featured_Post_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'maillard_featured_post_widget',
			esc_html__( 'Featured Post', 'maillard' ),
			array(
				'description' => esc_html__( 'Displays the featured post on the home page template.', 'maillard' ),
			)
		);

		add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue' ) );

	}

	/**
	 * Enqueue the scripts and stylesheets.
	 */
	public function enqueue() {

		global $wp_customize;

		$current_screen = get_current_screen();

		if ( 'widgets' === $current_screen->id || isset( $wp_customize ) ) {

			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );

			wp_enqueue_media();

			wp_enqueue_script( 'maillard-upload-media-widget', get_template_directory_uri() . '/assets/js/upload-media.js', array( 'jquery' ) );
			wp_enqueue_script( 'maillard-color-picker', get_template_directory_uri() . '/assets/js/color-picker.js', array( 'wp-color-picker' ) );

			// Localize the script with new data.
			$translation_array = array(
				'title' => esc_html__( 'Select image', 'maillard' ),
				'button_text' => esc_html__( 'Use this image', 'maillard' ),
			);
			wp_localize_script( 'maillard-upload-media-widget', 'maillard_widget_translations', $translation_array );

		}

	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		$post_id = ( ! empty( $instance['post_id'] ) ) ? $instance['post_id'] : false;

		$post_title = ( ! empty( $instance['post_title'] ) ) ? $instance['post_title'] : '';
		$image_url = ( ! empty( $instance['image_url'] ) ) ? $instance['image_url'] : '';

		$bg_color = ( ! empty( $instance['bg_color'] ) ) ? $instance['bg_color'] : '#079d46';

		echo $args['before_widget']; // WPCS: XSS ok.

		if ( $post_id ) {

			// Store the image ID in a var.
			$image_id = maillard_get_image_id( $image_url );

			// Retrieve the thumbnail size of our image.
			$image_thumb = wp_get_attachment_image_src( $image_id, 'maillard-featured-post' );

			$featured_post = get_post( $post_id );

			echo '<a href="' . esc_url( get_permalink( $featured_post->ID ) ) . '">';

			echo '<div class="featured-post">';

			if ( ! empty( $image_url ) ) {
				echo '<img src="' . esc_url( $image_thumb[0] ) . '"/>';
			}

			if ( ! empty( $post_title ) ) {
				echo '<div class="featured-post-title-wrapper">';
					echo '<h3 class="featured-post-title-heading">' . esc_html__( 'Featured Post', 'maillard' ) . '</h3>';

					echo '<h3 style="background-color:' . esc_attr( $bg_color ) . '" class="featured-post-title">' . esc_html( $post_title ) . '</h3>';
				echo '</div>';
			}

			echo '</div>';

			echo '</a>';

		}

		echo $args['after_widget']; // WPCS: XSS ok.
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$post_id = ! empty( $instance['post_id'] ) ? $instance['post_id'] : '';
		$post_title = ! empty( $instance['post_title'] ) ? $instance['post_title'] : '';
		$image_url = ! empty( $instance['image_url'] ) ? $instance['image_url'] : '';
		$bg_color = ! empty( $instance['bg_color'] ) ? $instance['bg_color'] : '#079d46';
		?>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_id' ) ); ?>"><?php esc_html_e( 'Post to Display:', 'maillard' ); ?></label>
		<select id="<?php echo esc_attr( $this->get_field_id( 'post_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_id' ) ); ?>" class="widefat" style="width:100%;">
			<?php foreach ( get_posts( array( 'posts_per_page' => -1 ) ) as $post ) : ?>
				<option <?php selected( $post_id, $post->ID ); ?> value="<?php echo intval( $post->ID ); ?>">
					<?php echo esc_html( $post->post_name ); ?>
				</option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>"><?php esc_attr_e( 'Image:', 'maillard' ); ?></label>
				<div class="maillard-media-container">
						<div class="maillard-media-inner">
							<?php $img_style = ( '' !== $image_url ) ? '' : 'style="display:none;"'; ?>
							<img id="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>-preview" src="<?php echo esc_attr( $image_url ); ?>" <?php echo $img_style; ?> />
							<?php $no_img_style = ( '' !== $image_url ) ? 'style="display:none;"' : ''; ?>
							<span class="maillard-no-image" id="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>-noimg" <?php echo $no_img_style; ?>><?php esc_attr_e( 'No image selected', 'maillard' ); ?></span>
						</div>

				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_url' ) ); ?>" value="<?php echo esc_url( $image_url ); ?>" class="maillard-media-url" />

				<input type="button" value="<?php echo esc_attr_e( 'Remove', 'maillard' ); ?>" class="button maillard-media-remove" id="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>-remove" <?php echo $img_style; ?> />

				<?php $button_text = ( '' !== $image_url ) ? esc_attr__( 'Change Image', 'maillard' ) : esc_attr__( 'Select Image', 'maillard' ); ?>
				<input type="button" value="<?php echo esc_attr( $button_text ); ?>" class="button maillard-media-upload" id="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>-button" />
				<br class="clear">
				</div>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_title' ) ); ?>"><?php esc_html_e( 'Post Title:', 'maillard' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_title' ) ); ?>" type="text" value="<?php echo esc_html( $post_title ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'bg_color' ) ); ?>"><?php esc_html_e( 'Title Background Color:', 'maillard' ); ?></label><br>
			<input class="widefat color-picker" id="<?php echo esc_attr( $this->get_field_id( 'bg_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bg_color' ) ); ?>" type="text" value="<?php echo esc_attr( $bg_color ); ?>">
		</p>

		<?php
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['post_id'] = ( ! empty( $new_instance['post_id'] ) ) ? intval( $new_instance['post_id'] ) : '';
		$instance['post_title'] = ( ! empty( $new_instance['post_title'] ) ) ? esc_html( $new_instance['post_title'] ) : '';
		$instance['image_url'] = ( ! empty( $new_instance['image_url'] ) ) ? esc_url_raw( $new_instance['image_url'] ) : '';
		$instance['bg_color'] = ( ! empty( $new_instance['bg_color'] ) ) ? sanitize_hex_color( $new_instance['bg_color'] ) : '#079d46';

		return $instance;
	}
}
/**
 * Register articles widget on widgets_init.
 */
function register_maillard_featured_post_widget() {
	register_widget( 'Maillard_Featured_Post_Widget' );
}
add_action( 'widgets_init', 'register_maillard_featured_post_widget' );
