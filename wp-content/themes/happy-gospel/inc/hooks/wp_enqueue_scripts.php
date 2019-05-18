<?php


function scripts() {
global $is_IE;

	/**
		Styles
	*/
	//Grid Layout : https://blueprintcss.io/docs
	wp_enqueue_style( 'slick', get_template_directory_uri().'/assets/libs/slick/slick.css');
	wp_enqueue_style( 'slick-theme', get_template_directory_uri().'/assets/libs/slick/slick-theme.css');

	wp_enqueue_style( 'home', get_template_directory_uri().'/assets/css/home.css');

	wp_enqueue_style( 'style', get_stylesheet_uri());

	// Load the Internet Explorer specific stylesheet.
	if ($is_IE) {
	wp_enqueue_style( 'ie11', get_template_directory_uri() . '/assets/css/ie11.css', array( 'style', 'responsive' ) );
	}
	wp_enqueue_style( 'gfonts', 'https://fonts.googleapis.com/css?family=Overpass:300,600,900', array( 'style', 'responsive' ) );

	/**
		Scripts
	*/

	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/libs/slick/slick.min.js', array('jquery'), null, true);
if ($is_IE) {
	wp_enqueue_script( 'polyfill-promise', get_template_directory_uri() . '/assets/libs/node_modules/promise-polyfill/dist/polyfill.min.js', null, null, true);
}
	wp_enqueue_script( 'GSAP', get_template_directory_uri() . '/assets/libs/gsap/src/minified/TweenMax.min.js', null, null, true);
    wp_enqueue_script( 'GSAP-pseudo-elements', get_template_directory_uri() . '/assets/libs/gsap/src/minified/plugins/CSSRulePlugin.min.js', null, null, true);
	wp_enqueue_script( 'init', get_template_directory_uri() . '/assets/js/init.js', array('jquery'), '', true);
		wp_localize_script( 'init', 'templateURL', get_template_directory_uri().'/');
		wp_localize_script( 'init', 'ajaxurl', admin_url( 'admin-ajax.php' ) );

}
add_action( 'wp_enqueue_scripts', 'scripts', 1 );
