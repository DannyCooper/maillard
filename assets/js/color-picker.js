/**
 * Maillard ColorPicker JS
 *
 * @package     maillard
 * @copyright   Copyright (c) 2017, Danny Cooper
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
*/

( function( $ ){
function maillard_initColorPicker( widget ) {
   widget.find( '.color-picker' ).wpColorPicker( {
		   change: _.throttle( function() { // For Customizer
				   $(this).trigger( 'change' );
		   }, 3000 )
   });
}
function maillard_onFormUpdate( event, widget ) {
   maillard_initColorPicker( widget );
}
$( document ).on( 'widget-added widget-updated', maillard_onFormUpdate );

$( document ).ready( function() {
   $( '#widgets-right .widget:has(.color-picker)' ).each( function () {
		   maillard_initColorPicker( $( this ) );
   } );
} );
}( jQuery ) );
