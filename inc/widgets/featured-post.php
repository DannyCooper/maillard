<?php
/**
 * Build Featured Post Widget.
 *
 * @package     maillard
 * @copyright   Copyright (c) 2015, Danny Cooper
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

/**
 * Adds Knowledge Base Articles widget.
 */
class Maillard_Featured_Post_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'maillard_featured_post_widget',
			__( 'Featured Post', 'maillard' ),
			array( 'description' => __( 'Displays the featured post on the home page template.', 'maillard' ) )
		);
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

			extract( $args );

			$post_id = ( ! empty( $instance['post_id'] ) ) ? $instance['post_id'] : FALSE;

			$post_title = ( ! empty( $instance['post_title'] ) ) ? $instance['post_title'] : '';
			$image_url = ( ! empty( $instance['image_url'] ) ) ? $instance['image_url'] : '';

			$bg_color = ( ! empty( $instance['bg_color'] ) ) ? $instance['bg_color'] : '#079d46';

			echo $before_widget;

				if ( $post_id ) {

					get_the_post_thumbnail( $post_id, 'thumbnail' );

					$featured_post = get_post( $post_id );

					echo '<div class="featured-post">';

					if ( ! empty( $image_url ) ) {
						echo '<img src="' . $image_url . '"/>';
					}

					if ( ! empty( $post_title ) ) {
						echo '<div class="featured-post-title-wrapper">';
							echo '<h3 class="featured-post-title-heading">Featured Post</h3><br>';

							echo '<h3 class="featured-post-title">'.$post_title.'</h3>';
						echo '</div>';
					}

					echo '</div>';

				}

			echo $after_widget;
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
			<label for="<?php echo $this->get_field_id( 'post_id' ); ?>"><?php _e( 'Post to Display:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'post_id' ); ?>" name="<?php echo $this->get_field_name( 'post_id' ); ?>" type="text" value="<?php echo $post_id  ?>">
        </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'post_title' ); ?>"><?php _e( 'Post to Display:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'post_title' ); ?>" name="<?php echo $this->get_field_name( 'post_title' ); ?>" type="text" value="<?php echo $post_title  ?>">
        </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'image_url' ); ?>"><?php _e( 'Post to Display:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'image_url' ); ?>" name="<?php echo $this->get_field_name( 'image_url' ); ?>" type="text" value="<?php echo $image_url  ?>">
        </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'bg_color' ); ?>"><?php _e( 'Post to Display:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'bg_color' ); ?>" name="<?php echo $this->get_field_name( 'bg_color' ); ?>" type="text" value="<?php echo $bg_color ?>">
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

		$instance['post_id'] = ( ! empty( $new_instance['post_id'] ) ) ?  $new_instance['post_id']  : '';
		$instance['post_title'] = ( ! empty( $new_instance['post_title'] ) ) ?  $new_instance['post_title']  : '';
		$instance['image_url'] = ( ! empty( $new_instance['image_url'] ) ) ?  $new_instance['image_url']  : '';
		$instance['bg_color'] = ( ! empty( $new_instance['bg_color'] ) ) ?  $new_instance['bg_color']  : '#079d46';

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
