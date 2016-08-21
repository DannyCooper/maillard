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

	wp.customize( 'accent-color', function( value ) {
		value.bind( function( newval ) {
			$('.menu-primary .menu li.current_page_item a, .menu-primary .menu li a:hover').css('border-color', newval );
		} );
	} );

	//Update site link color in real time...
	wp.customize( 'accent-color', function( value ) {
		value.bind( function( newval ) {
			$('.content a').css('color', newval );
		} );
	} );

	wp.customize( 'accent-color', function( value ) {
		value.bind( function( newval ) {
			$('.submit, button').css('background-color', newval );
		} );
	} );

} )( jQuery );
