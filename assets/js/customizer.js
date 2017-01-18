/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @package maillard
 */

( function( $ ) {

	// Site title and description.
	wp.customize(
		'blogname', function( value ) {
			value.bind(
				function( to ) {
					$( '.site-title a' ).text( to );
				}
			);
		}
	);

	wp.customize(
		'blogdescription', function( value ) {
			value.bind(
				function( to ) {
					$( '.site-description' ).text( to );
				}
			);
		}
	);

	// Update site link color in real time...
	// wp.customize( 'accent-color', function( value ) {
	// 	value.bind( function( to ) {
	// 		$('.entry-content a, .sub-footer a').css("color", to );
	// 	} );
	// } );

} )( jQuery );
