<?php
/**
 * Standard WordPress <head>.
 *
 * @package zues
 */
	?>

<!DOCTYPE html>
<html <?php echo get_language_attributes(); ?>>
<head>
<meta charset="<?php echo get_bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php echo get_bloginfo( 'pingback_url' ) ?>">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() . '/favicon.ico' ?>" />

	<?php wp_head(); ?>
	<?php do_action( 'zues_head' ); ?>

</head>
