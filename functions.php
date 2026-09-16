<?php
/**
 * Bagbari Reunion Child — theme setup and asset loading.
 *
 * @package Bagbari_Reunion_Child
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BRC_VERSION', '1.0.0' );
define( 'BRC_GSAP_VERSION', '3.12.5' );

/**
 * Theme setup: translations, supports, menus.
 */
function brc_setup() {
	load_child_theme_textdomain( 'bagbari-reunion-sejan', get_stylesheet_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'bagbari-reunion-sejan' ),
		)
	);
}
add_action( 'after_setup_theme', 'brc_setup' );

/**
 * Enqueue parent + child styles, GSAP, and theme assets.
 */
function brc_enqueue_assets() {
	$theme_version = wp_get_theme()->get( 'Version' ) ?: BRC_VERSION;

	wp_enqueue_style(
		'generatepress-parent',
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme( 'generatepress' ) ? wp_get_theme( 'generatepress' )->get( 'Version' ) : $theme_version
	);

	wp_enqueue_style(
		'bagbari-reunion-child',
		get_stylesheet_uri(),
		array( 'generatepress-parent' ),
		$theme_version
	);

	wp_enqueue_style(
		'brc-theme',
		get_stylesheet_directory_uri() . '/assets/css/theme.css',
		array( 'bagbari-reunion-child' ),
		$theme_version
	);

	wp_register_script(
		'brc-gsap',
		'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
		array(),
		BRC_GSAP_VERSION,
		true
	);

	wp_register_script(
		'brc-scrolltrigger',
		'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
		array( 'brc-gsap' ),
		BRC_GSAP_VERSION,
		true
	);

	wp_enqueue_script( 'brc-gsap' );
	wp_enqueue_script( 'brc-scrolltrigger' );

	wp_enqueue_script(
		'brc-theme',
		get_stylesheet_directory_uri() . '/assets/js/theme.js',
		array( 'brc-gsap', 'brc-scrolltrigger' ),
		$theme_version,
		true
	);

	wp_localize_script(
		'brc-theme',
		'BRC_THEME',
		array(
			'countdownTarget' => apply_filters( 'brc_countdown_target', '2026-11-25T09:00:00+06:00' ),
			'homeUrl'         => esc_url_raw( home_url( '/' ) ),
		)
	);

	if ( is_page_template( 'page-register.php' ) ) {
		brc_enqueue_reunion_form_assets();
	}
}
add_action( 'wp_enqueue_scripts', 'brc_enqueue_assets' );

/**
 * Enqueue reunion-form assets (also loaded on demand by the shortcode).
 */
function brc_enqueue_reunion_form_assets() {
	$theme_version = wp_get_theme()->get( 'Version' ) ?: BRC_VERSION;

	if ( ! wp_script_is( 'brc-reunion-form', 'enqueued' ) ) {
		wp_enqueue_script(
			'brc-reunion-form',
			get_stylesheet_directory_uri() . '/assets/js/reunion-form.js',
			array(),
			$theme_version,
			true
		);
	}
}

/**
 * Style WP-managed primary menu links to match the theme design.
 *
 * @param array    $atts Menu link attributes.
 * @param WP_Post  $item Menu item object.
 * @param stdClass $args Menu args.
 * @return array
 */
function brc_primary_menu_link_attributes( $atts, $item, $args ) {
	if ( isset( $args->theme_location ) && 'primary' === $args->theme_location ) {
		$atts['class'] = isset( $atts['class'] ) ? $atts['class'] . ' hover:text-gold transition-colors' : 'hover:text-gold transition-colors';
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'brc_primary_menu_link_attributes', 10, 3 );

/**
 * Canonical URL of the registration page.
 *
 * @return string Unescaped URL (escape at output with esc_url()).
 */
function brc_get_register_url() {
	$page = get_page_by_path( 'register' );

	if ( $page instanceof WP_Post ) {
		return get_permalink( $page );
	}

	return home_url( '/register/' );
}

/**
 * [reunion_form] — portable registration form block.
 *
 * @return string
 */
function brc_reunion_form_shortcode() {
	brc_enqueue_reunion_form_assets();

	ob_start();
	get_template_part( 'template-parts/reunion-form' );
	return (string) ob_get_clean();
}
add_shortcode( 'reunion_form', 'brc_reunion_form_shortcode' );
