jQuery(document).ready( function($) {
	function media_upload( button_class ) {
	    $( 'body' ).on( 'click', button_class, function( e ) {
	        var $button = $( this ), frame;

	        e.preventDefault();

	        // Create a proper popup for selecting an image
	        frame = wp.media({
	            title:    maillard_widget_translations.title,
	            multiple: false,
	            button: {
	                text: maillard_widget_translations.button_text
	            }
	        });

	        // Add a callback for when an item is selected
	        frame.state( 'library' ).on( 'select', function(){
	            var image = this.get( 'selection' ).first();

	            // Inspect the image variable further
	            // console.log( image.toJSON() )

	            // Save the actual URL within the input
	            $button.siblings( '.custom_media_url' ).val( image.get( 'url' ) );
	        });

	        // Finally, open the frame
	        frame.open();
	    });
	}
    media_upload('.custom_media_upload');



});
