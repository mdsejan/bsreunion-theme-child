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

/* ------------------------------------------------------------------ */
/* Theme Settings — Admin Menu + Settings API (no plugins / ACF)       */
/* ------------------------------------------------------------------ */
define( 'BRC_SETTINGS_OPTION', 'brc_theme_settings' );
define( 'BRC_SETTINGS_GROUP', 'brc_settings_group' );
define( 'BRC_SETTINGS_PAGE', 'brc-theme-settings' );

add_action( 'admin_menu', 'brc_register_theme_settings_menu' );
function brc_register_theme_settings_menu() {
	add_menu_page(
		__( 'Theme Settings', 'bagbari-reunion-sejan' ),
		__( 'Theme Settings', 'bagbari-reunion-sejan' ),
		'manage_options',
		BRC_SETTINGS_PAGE,
		'brc_render_theme_settings_page',
		'dashicons-admin-generic',
		61
	);
}

add_action( 'admin_init', 'brc_register_theme_settings' );
function brc_register_theme_settings() {
	register_setting(
		BRC_SETTINGS_GROUP,
		BRC_SETTINGS_OPTION,
		array(
			'type'              => 'array',
			'sanitize_callback' => 'brc_sanitize_theme_settings',
			'default'           => array(),
		)
	);

	add_settings_section(
		'brc_contact_section',
		__( 'Contact Information', 'bagbari-reunion-sejan' ),
		'brc_contact_section_cb',
		BRC_SETTINGS_PAGE
	);

	add_settings_section(
		'brc_social_section',
		__( 'Social Links', 'bagbari-reunion-sejan' ),
		'brc_social_section_cb',
		BRC_SETTINGS_PAGE
	);

	add_settings_field(
		'phone',
		__( 'Contact Phone', 'bagbari-reunion-sejan' ),
		'brc_render_text_field',
		BRC_SETTINGS_PAGE,
		'brc_contact_section',
		array( 'id' => 'phone', 'placeholder' => '01793-548365', 'desc' => __( 'Shown in footer. Include country code for tel: link.', 'bagbari-reunion-sejan' ) )
	);

	add_settings_field(
		'email',
		__( 'Contact Email', 'bagbari-reunion-sejan' ),
		'brc_render_text_field',
		BRC_SETTINGS_PAGE,
		'brc_contact_section',
		array( 'id' => 'email', 'type' => 'email', 'placeholder' => 'help@bagbari-reunion.com' )
	);

	add_settings_field(
		'facebook_page',
		__( 'Facebook Page Link', 'bagbari-reunion-sejan' ),
		'brc_render_text_field',
		BRC_SETTINGS_PAGE,
		'brc_social_section',
		array( 'id' => 'facebook_page', 'type' => 'url', 'placeholder' => 'https://facebook.com/your-page' )
	);

	add_settings_field(
		'facebook_group',
		__( 'Facebook Group Link', 'bagbari-reunion-sejan' ),
		'brc_render_text_field',
		BRC_SETTINGS_PAGE,
		'brc_social_section',
		array( 'id' => 'facebook_group', 'type' => 'url', 'placeholder' => 'https://facebook.com/groups/your-group' )
	);
}

function brc_contact_section_cb() {
	echo '<p>' . esc_html__( 'Contact details displayed in the footer and across the site.', 'bagbari-reunion-sejan' ) . '</p>';
}

function brc_social_section_cb() {
	echo '<p>' . esc_html__( 'Social profile URLs displayed in the footer. Leave empty to hide.', 'bagbari-reunion-sejan' ) . '</p>';
}

function brc_general_section_cb() {
	echo '<p>' . esc_html__( 'Manage global theme options. All fields are safely stored via Settings API.', 'bagbari-reunion-sejan' ) . '</p>';
}

function brc_render_text_field( $args ) {
	$options = get_option( BRC_SETTINGS_OPTION, array() );
	$id      = $args['id'];
	$type    = $args['type'] ?? 'text';
	$value   = $options[ $id ] ?? '';
	printf(
		'<input type="%1$s" name="%2$s[%3$s]" value="%4$s" class="regular-text" placeholder="%5$s" />',
		esc_attr( $type ),
		esc_attr( BRC_SETTINGS_OPTION ),
		esc_attr( $id ),
		esc_attr( $value ),
		esc_attr( $args['placeholder'] ?? '' )
	);
	if ( ! empty( $args['desc'] ) ) {
		printf( '<p class="description">%s</p>', esc_html( $args['desc'] ) );
	}
}

function brc_sanitize_theme_settings( $input ) {
	$output = array();
	if ( isset( $input['phone'] ) ) {
		$output['phone'] = sanitize_text_field( $input['phone'] );
	}
	if ( isset( $input['email'] ) ) {
		$output['email'] = sanitize_email( $input['email'] );
	}
	if ( isset( $input['facebook_page'] ) ) {
		$output['facebook_page'] = esc_url_raw( trim( $input['facebook_page'] ) );
	}
	if ( isset( $input['facebook_group'] ) ) {
		$output['facebook_group'] = esc_url_raw( trim( $input['facebook_group'] ) );
	}
	return $output;
}

function brc_get_theme_settings() {
	$defaults = array(
		'phone'          => '',
		'email'          => '',
		'facebook_page'  => '',
		'facebook_group' => '',
	);
	return wp_parse_args( (array) get_option( BRC_SETTINGS_OPTION, array() ), $defaults );
}

function brc_get_phone_href( $phone_display ) {
	$raw = preg_replace( '/[^0-9+]/', '', (string) $phone_display );
	if ( '' === $raw ) {
		return '';
	}
	if ( preg_match( '/^0\d+$/', $raw ) ) {
		return 'tel:+88' . $raw;
	}
	return 'tel:' . $raw;
}

function brc_sc_phone() {
	$s = brc_get_theme_settings();
	$val = ! empty( $s['phone'] ) ? $s['phone'] : '01793 - 548 365';
	return esc_html( $val );
}
add_shortcode( 'brc_phone', 'brc_sc_phone' );

function brc_sc_phone_url() {
	$s = brc_get_theme_settings();
	$val = ! empty( $s['phone'] ) ? $s['phone'] : '01793 - 548 365';
	return esc_url( brc_get_phone_href( $val ) );
}
add_shortcode( 'brc_phone_url', 'brc_sc_phone_url' );

function brc_sc_email() {
	$s = brc_get_theme_settings();
	$val = ! empty( $s['email'] ) ? $s['email'] : 'help@bagbari-reunion.com';
	return esc_html( $val );
}
add_shortcode( 'brc_email', 'brc_sc_email' );

function brc_sc_email_url() {
	$s = brc_get_theme_settings();
	$val = ! empty( $s['email'] ) ? $s['email'] : 'help@bagbari-reunion.com';
	return esc_url( 'mailto:' . $val );
}
add_shortcode( 'brc_email_url', 'brc_sc_email_url' );

function brc_sc_facebook_page() {
	$s = brc_get_theme_settings();
	return esc_url( $s['facebook_page'] );
}
add_shortcode( 'brc_facebook_page', 'brc_sc_facebook_page' );

function brc_sc_facebook_group() {
	$s = brc_get_theme_settings();
	return esc_url( $s['facebook_group'] );
}
add_shortcode( 'brc_facebook_group', 'brc_sc_facebook_group' );

function brc_render_theme_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
			settings_fields( BRC_SETTINGS_GROUP );
			do_settings_sections( BRC_SETTINGS_PAGE );
			submit_button( __( 'Save Settings', 'bagbari-reunion-sejan' ) );
			?>
		</form>
	</div>
	<?php
}
