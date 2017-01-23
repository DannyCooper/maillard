<?php
/**
 * Build Featured Post Widget.
 *
 * @package     maillard
 * @copyright   Copyright (c) 2016, Danny Cooper
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
			__( 'Homepage Featured Post', 'maillard' ),
			array( 'description' => __( 'Displays the featured post on the home page template.', 'maillard' ) )
		);

		add_action( 'admin_enqueue_scripts', array(&$this, 'scripts') );

	}

	public function scripts() {

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );

		wp_enqueue_media();

		wp_register_script('upload_media_widget', ZEUS_THEME_URI . '/assets/js/upload-media.js', array('jquery'));

		// Localize the script with new data
		$translation_array = array(
			'title' => __( 'Select image', 'maillard' ),
			'button_text' => __( 'Use this image', 'maillard' ),
		);
		wp_localize_script( 'upload_media_widget', 'translations', $translation_array );

		// Enqueued script with localized data.
		wp_enqueue_script( 'upload_media_widget' );

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
						echo '<img src="' . esc_url( $image_url ) . '"/>';
					}

					if ( ! empty( $post_title ) ) {
						echo '<div class="featured-post-title-wrapper">';
							echo '<h3 class="featured-post-title-heading">Featured Post</h3><br>';

							echo '<h3 style="background-color:'. esc_attr( $bg_color ).'" class="featured-post-title">'. esc_html( $post_title ).'</h3>';
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

		?>

		<script type='text/javascript'>
				( function( $ ){
		   function initColorPicker( widget ) {
				   widget.find( '.color-picker' ).wpColorPicker( {
						   change: _.throttle( function() { // For Customizer
								   $(this).trigger( 'change' );
						   }, 3000 )
				   });
		   }
			   function onFormUpdate( event, widget ) {
				   initColorPicker( widget );
		   }
		   $( document ).on( 'widget-added widget-updated', onFormUpdate );

		   $( document ).ready( function() {
				   $( '#widgets-right .widget:has(.color-picker)' ).each( function () {
						   initColorPicker( $( this ) );
				   } );
		   } );
		}( jQuery ) );
		 </script>

		<?php

		$post_id = ! empty( $instance['post_id'] ) ? $instance['post_id'] : '';
		$post_title = ! empty( $instance['post_title'] ) ? $instance['post_title'] : '';
		$image_url = ! empty( $instance['image_url'] ) ? $instance['image_url'] : '';
		$bg_color = ! empty( $instance['bg_color'] ) ? $instance['bg_color'] : '#079d46';
		?>

        <p>
			<label for="<?php echo $this->get_field_id( 'post_id' ); ?>"><?php _e( 'Post to Display:', 'maillard' ); ?></label>
			<select id="<?php echo $this->get_field_id('post_id'); ?>" name="<?php echo $this->get_field_name('post_id'); ?>" class="widefat" style="width:100%;">
				 <?php foreach( get_posts( array('posts_per_page' => -1) ) as $post) { ?>
				 <option <?php selected( $post_id, $post->ID ); ?> value="<?php echo $post->ID; ?>"><?php echo $post->post_name; ?></option>
				 <?php } ?>
			 </select>
        </p>

		<p>
			<label for="<?php echo $this->get_field_name( 'image_url' ); ?>"><?php _e( 'Post Image:', 'maillard' ); ?></label>
			<input name="<?php echo $this->get_field_name( 'image_url' ); ?>" id="<?php echo $this->get_field_id( 'image_url' ); ?>" class="widefat img custom_media_url" type="text" size="36"  value="<?php echo esc_url( $image_url ); ?>" />
            <input class="custom_media_upload" id="custom_media_button" type="button" value="<?php esc_attr_e('Upload Image', 'maillard'); ?>" />
        </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'post_title' ); ?>"><?php _e( 'Post Title:', 'maillard' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'post_title' ); ?>" name="<?php echo $this->get_field_name( 'post_title' ); ?>" type="text" value="<?php echo $post_title  ?>">
        </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'bg_color' ); ?>"><?php _e( 'Title Background Color:', 'maillard' ); ?></label><br>
			<input class="widefat color-picker" id="<?php echo $this->get_field_id( 'bg_color' ); ?>" name="<?php echo $this->get_field_name( 'bg_color' ); ?>" type="text" value="<?php echo $bg_color ?>">
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

		$instance['post_id'] = ( ! empty( $new_instance['post_id'] ) ) ?  intval( $new_instance['post_id'] ) : '';
		$instance['post_title'] = ( ! empty( $new_instance['post_title'] ) ) ?  esc_html( $new_instance['post_title'] ) : '';
		$instance['image_url'] = ( ! empty( $new_instance['image_url'] ) ) ?  esc_url( $new_instance['image_url'] ) : '';
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
