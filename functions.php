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

function brc_register_sponsors_cpt() {
	$labels = array(
		'name'               => __( 'Sponsors', 'bagbari-reunion-sejan' ),
		'singular_name'      => __( 'Sponsor', 'bagbari-reunion-sejan' ),
		'menu_name'          => __( 'Sponsors', 'bagbari-reunion-sejan' ),
		'name_admin_bar'     => __( 'Sponsor', 'bagbari-reunion-sejan' ),
		'add_new'            => __( 'Add New', 'bagbari-reunion-sejan' ),
		'add_new_item'       => __( 'Add New Sponsor', 'bagbari-reunion-sejan' ),
		'new_item'           => __( 'New Sponsor', 'bagbari-reunion-sejan' ),
		'edit_item'          => __( 'Edit Sponsor', 'bagbari-reunion-sejan' ),
		'view_item'          => __( 'View Sponsor', 'bagbari-reunion-sejan' ),
		'all_items'          => __( 'All Sponsors', 'bagbari-reunion-sejan' ),
		'search_items'       => __( 'Search Sponsors', 'bagbari-reunion-sejan' ),
		'not_found'          => __( 'No sponsors found.', 'bagbari-reunion-sejan' ),
		'not_found_in_trash' => __( 'No sponsors found in Trash.', 'bagbari-reunion-sejan' ),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'has_archive'        => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'menu_icon'          => 'dashicons-heart',
		'supports'           => array( 'title', 'thumbnail', 'page-attributes' ),
		'rewrite'            => array( 'slug' => 'sponsors' ),
		'capability_type'    => 'post',
	);
	register_post_type( 'sponsors', $args );
}
add_action( 'init', 'brc_register_sponsors_cpt' );

/* ------------------------------------------------------------------ */
/* Offline Registration Booths — CPT + Metabox                         */
/* ------------------------------------------------------------------ */

function brc_register_reg_booths_cpt() {
	$labels = array(
		'name'               => __( 'Registration Booths', 'bagbari-reunion-sejan' ),
		'singular_name'      => __( 'Registration Booth', 'bagbari-reunion-sejan' ),
		'menu_name'          => __( 'Registration Booths', 'bagbari-reunion-sejan' ),
		'name_admin_bar'     => __( 'Registration Booth', 'bagbari-reunion-sejan' ),
		'add_new'            => __( 'Add New', 'bagbari-reunion-sejan' ),
		'add_new_item'       => __( 'Add New Registration Booth', 'bagbari-reunion-sejan' ),
		'new_item'           => __( 'New Registration Booth', 'bagbari-reunion-sejan' ),
		'edit_item'          => __( 'Edit Registration Booth', 'bagbari-reunion-sejan' ),
		'view_item'          => __( 'View Registration Booth', 'bagbari-reunion-sejan' ),
		'all_items'          => __( 'All Registration Booths', 'bagbari-reunion-sejan' ),
		'search_items'       => __( 'Search Registration Booths', 'bagbari-reunion-sejan' ),
		'not_found'          => __( 'No registration booths found.', 'bagbari-reunion-sejan' ),
		'not_found_in_trash' => __( 'No registration booths found in Trash.', 'bagbari-reunion-sejan' ),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'has_archive'        => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'menu_icon'          => 'dashicons-location-alt',
		'supports'           => array( 'title' ),
		'rewrite'            => array( 'slug' => 'reg-booths' ),
		'capability_type'    => 'post',
	);
	register_post_type( 'reg_booths', $args );
}
add_action( 'init', 'brc_register_reg_booths_cpt' );

function brc_add_reg_booths_metabox() {
	add_meta_box(
		'brc_reg_booths_details',
		__( 'Office Registration Booth Details', 'bagbari-reunion-sejan' ),
		'brc_render_reg_booths_metabox',
		'reg_booths',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'brc_add_reg_booths_metabox' );

function brc_render_reg_booths_metabox( $post ) {
	wp_nonce_field( 'brc_reg_booths_meta', 'brc_reg_booths_nonce' );
	$address = esc_textarea( get_post_meta( $post->ID, 'booth_address', true ) );
	$phone   = esc_attr( get_post_meta( $post->ID, 'booth_phone', true ) );
	?>
	<p>
		<label for="booth_address"><strong><?php esc_html_e( 'Address', 'bagbari-reunion-sejan' ); ?></strong></label><br>
		<textarea name="booth_address" id="booth_address" rows="3" class="widefat" placeholder="<?php esc_attr_e( 'Booth address / venue', 'bagbari-reunion-sejan' ); ?>"><?php echo $address; ?></textarea>
	</p>
	<p>
		<label for="booth_phone"><strong><?php esc_html_e( 'Mobile Number', 'bagbari-reunion-sejan' ); ?></strong></label><br>
		<input type="text" name="booth_phone" id="booth_phone" class="regular-text" value="<?php echo $phone; ?>" placeholder="01XXX-XXXXXX" />
	</p>
	<?php
}

function brc_save_reg_booths_meta( $post_id ) {
	if ( ! isset( $_POST['brc_reg_booths_nonce'] ) || ! wp_verify_nonce( $_POST['brc_reg_booths_nonce'], 'brc_reg_booths_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['booth_address'] ) ) {
		update_post_meta( $post_id, 'booth_address', sanitize_textarea_field( wp_unslash( $_POST['booth_address'] ) ) );
	}
	if ( isset( $_POST['booth_phone'] ) ) {
		update_post_meta( $post_id, 'booth_phone', sanitize_text_field( wp_unslash( $_POST['booth_phone'] ) ) );
	}
}
add_action( 'save_post_reg_booths', 'brc_save_reg_booths_meta' );

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

	$brc_countdown_iso   = function_exists( 'brc_get_countdown_target_iso' ) ? brc_get_countdown_target_iso() : apply_filters( 'brc_countdown_target', '2026-11-25T09:00:00+06:00' );
	$brc_countdown_mode  = function_exists( 'brc_get_countdown_mode' ) ? brc_get_countdown_mode() : 0;
	wp_localize_script(
		'brc-theme',
		'BRC_THEME',
		array(
			'countdownTarget' => $brc_countdown_iso,
			'countdownMode'   => $brc_countdown_mode,
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
 * Enqueue the WordPress Media Library on the Theme Settings page
 * so gallery image upload/remove buttons work.
 */
function brc_enqueue_admin_assets( $hook ) {
	// The page is registered with add_menu_page(), so its admin hook is
	// "toplevel_page_{slug}". Match on "page_{slug}" to cover it robustly.
	if ( false === strpos( $hook, 'page_' . BRC_SETTINGS_PAGE ) ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_script(
		'brc-admin',
		get_stylesheet_directory_uri() . '/assets/js/admin.js',
		array( 'jquery' ),
		BRC_VERSION,
		true
	);
}
add_action( 'admin_enqueue_scripts', 'brc_enqueue_admin_assets' );

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
		'brc_event_section',
		__( 'Event Details', 'bagbari-reunion-sejan' ),
		'brc_event_section_cb',
		BRC_SETTINGS_PAGE
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

	add_settings_section(
		'brc_sponsor_section',
		__( 'Sponsor Settings', 'bagbari-reunion-sejan' ),
		'brc_sponsor_section_cb',
		BRC_SETTINGS_PAGE
	);

	add_settings_field(
		'event_date',
		__( 'Event Date', 'bagbari-reunion-sejan' ),
		'brc_render_text_field',
		BRC_SETTINGS_PAGE,
		'brc_event_section',
		array( 'id' => 'event_date', 'placeholder' => '২৫ ডিসেম্বর ২০২৬', 'desc' => __( 'Used in hero, banners, and info strips.', 'bagbari-reunion-sejan' ) )
	);

	add_settings_field(
		'event_time',
		__( 'Event Time / Schedule', 'bagbari-reunion-sejan' ),
		'brc_render_text_field',
		BRC_SETTINGS_PAGE,
		'brc_event_section',
		array( 'id' => 'event_time', 'placeholder' => 'শুক্রবার, সকাল ৯:০০' )
	);

	add_settings_field(
		'event_location',
		__( 'Event Location / Venue', 'bagbari-reunion-sejan' ),
		'brc_render_text_field',
		BRC_SETTINGS_PAGE,
		'brc_event_section',
		array( 'id' => 'event_location', 'placeholder' => 'স্কুল প্রাঙ্গণ, বাগবাড়ী, বগুড়া' )
	);

	add_settings_field(
		'pass_price',
		__( 'Pass Price', 'bagbari-reunion-sejan' ),
		'brc_render_text_field',
		BRC_SETTINGS_PAGE,
		'brc_event_section',
		array( 'id' => 'pass_price', 'placeholder' => '৳১,০০০' )
	);

	add_settings_section(
		'brc_countdown_section',
		__( 'Countdown Controller', 'bagbari-reunion-sejan' ),
		'brc_countdown_section_cb',
		BRC_SETTINGS_PAGE
	);

	add_settings_field(
		'countdown_mode',
		__( 'Countdown Mode', 'bagbari-reunion-sejan' ),
		'brc_render_countdown_mode_field',
		BRC_SETTINGS_PAGE,
		'brc_countdown_section',
		array(
			'id'   => 'countdown_mode',
			'desc' => __( 'Toggle OFF = Registration Countdown Mode (counts down to the registration deadline). Toggle ON = Event Date Countdown Mode (counts down to the main event start date & time).', 'bagbari-reunion-sejan' ),
		)
	);

	add_settings_field(
		'event_countdown_datetime',
		__( 'Target Date & Time', 'bagbari-reunion-sejan' ),
		'brc_render_datetime_field',
		BRC_SETTINGS_PAGE,
		'brc_countdown_section',
		array( 'id' => 'event_countdown_datetime', 'desc' => __( 'Controls the frontend countdown. Pick the exact date & time the countdown should target.', 'bagbari-reunion-sejan' ) )
	);

	add_settings_field(
		'phone',
		__( 'Contact Phone 1', 'bagbari-reunion-sejan' ),
		'brc_render_text_field',
		BRC_SETTINGS_PAGE,
		'brc_contact_section',
		array( 'id' => 'phone', 'placeholder' => '01793-548365', 'desc' => __( 'Shown in footer. Include country code for tel: link.', 'bagbari-reunion-sejan' ) )
	);

	add_settings_field(
		'phone_2',
		__( 'Contact Phone 2', 'bagbari-reunion-sejan' ),
		'brc_render_text_field',
		BRC_SETTINGS_PAGE,
		'brc_contact_section',
		array( 'id' => 'phone_2', 'placeholder' => '01700-000000', 'desc' => __( 'Optional. Shown in footer only when filled.', 'bagbari-reunion-sejan' ) )
	);

	add_settings_field(
		'phone_3',
		__( 'Contact Phone 3', 'bagbari-reunion-sejan' ),
		'brc_render_text_field',
		BRC_SETTINGS_PAGE,
		'brc_contact_section',
		array( 'id' => 'phone_3', 'placeholder' => '01800-000000', 'desc' => __( 'Optional. Shown in footer only when filled.', 'bagbari-reunion-sejan' ) )
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

	add_settings_field(
		'sponsor_form_link',
		__( 'Sponsor Form Link', 'bagbari-reunion-sejan' ),
		'brc_render_text_field',
		BRC_SETTINGS_PAGE,
		'brc_sponsor_section',
		array( 'id' => 'sponsor_form_link', 'type' => 'url', 'placeholder' => 'https://forms.gle/... or https://...', 'desc' => __( 'Google Form or contact URL for "স্পন্সর হতে চাই". Opens in new tab. Leave empty to use mailto fallback.', 'bagbari-reunion-sejan' ) )
	);

	add_settings_section(
		'brc_canvas_section',
		__( 'স্মৃতির ক্যানভাস - Gallery Settings', 'bagbari-reunion-sejan' ),
		'brc_canvas_section_cb',
		BRC_SETTINGS_PAGE
	);

	$canvas_items = array(
		1 => array( 'label' => '১ নম্বর ছবি (Top Left)',      'title' => 'আমাদের সেই প্রিয় ক্লাসরুম' ),
		2 => array( 'label' => '২ নম্বর ছবি (Top Middle)',    'title' => 'বিজয়ী হাসি আর আমাদের গল্প' ),
		3 => array( 'label' => '৩ নম্বর ছবি (Top Right)',     'title' => 'স্কুল বারান্দায় জমিয়ে রাখা আমাদের গল্প' ),
		4 => array( 'label' => '৪ নম্বর ছবি (Bottom Left)',   'title' => 'সিঁড়িতে বসা সেই পড়ালেখার দিনগুলো' ),
		5 => array( 'label' => '৫ নম্বর ছবি (Bottom Middle)', 'title' => 'বিকেলের ফুটবল আর বিজয়ের উল্লাস' ),
		6 => array( 'label' => '৬ নম্বর ছবি (Bottom Right)',  'title' => 'এক ফ্রেমে বন্দি শৈশবের শুদ্ধ আনন্দ' ),
	);

	foreach ( $canvas_items as $num => $info ) {
		add_settings_field(
			'canvas_img_' . $num,
			sprintf( __( 'Item %d — %s', 'bagbari-reunion-sejan' ), $num, $info['label'] ),
			'brc_render_image_field',
			BRC_SETTINGS_PAGE,
			'brc_canvas_section',
			array(
				'id'       => 'canvas_img_' . $num,
				'desc'     => sprintf( __( 'Gallery image #%d. Leave empty to use the default theme image.', 'bagbari-reunion-sejan' ), $num ),
			)
		);

		add_settings_field(
			'canvas_title_' . $num,
			sprintf( __( 'Item %d — Title Text', 'bagbari-reunion-sejan' ), $num ),
			'brc_render_text_field',
			BRC_SETTINGS_PAGE,
			'brc_canvas_section',
			array( 'id' => 'canvas_title_' . $num )
		);
	}
}

function brc_event_section_cb() {
	echo '<p>' . esc_html__( 'Central event details — update once, reflected everywhere (hero, banners, pricing, registration).', 'bagbari-reunion-sejan' ) . '</p>';
}

function brc_countdown_section_cb() {
	echo '<p>' . esc_html__( 'Set the countdown mode and the exact target date & time. Toggle OFF counts down to the registration deadline; Toggle ON counts down to the main event start.', 'bagbari-reunion-sejan' ) . '</p>';
}

function brc_contact_section_cb() {
	echo '<p>' . esc_html__( 'Contact details displayed in the footer and across the site.', 'bagbari-reunion-sejan' ) . '</p>';
}

function brc_social_section_cb() {
	echo '<p>' . esc_html__( 'Social profile URLs displayed in the footer. Leave empty to hide.', 'bagbari-reunion-sejan' ) . '</p>';
}

function brc_sponsor_section_cb() {
	echo '<p>' . esc_html__( 'Sponsor inquiry form URL used by both "স্পন্সর হতে চাই" buttons.', 'bagbari-reunion-sejan' ) . '</p>';
}

function brc_canvas_section_cb() {
	echo '<p>' . esc_html__( 'স্মৃতির ক্যানভাস gallery images and captions. Upload a custom image and set a title for each of the 6 gallery items. Leave an image empty to use the default theme image.', 'bagbari-reunion-sejan' ) . '</p>';
}

/**
 * Render an image upload field with WordPress Media Library integration.
 *
 * @param array $args Field arguments: id, placeholder, desc.
 */
function brc_render_image_field( $args ) {
	$options = get_option( BRC_SETTINGS_OPTION, array() );
	$id      = $args['id'];
	$value   = isset( $options[ $id ] ) ? $options[ $id ] : '';
	printf(
		'<div class="brc-image-field" style="margin-bottom: 12px;">' .
		'<input type="hidden" name="%1$s[%2$s]" id="%2$s" value="%3$s" class="brc-image-value" data-brc-encode="1" />' .
		'<div class="brc-image-preview" style="margin-bottom: 8px;">%4$s</div>' .
		'<div>' .
		'<button type="button" class="button brc-upload-btn">%5$s</button> ' .
		'<button type="button" class="button brc-remove-btn">%6$s</button>' .
		'</div>' .
		'</div>',
		esc_attr( BRC_SETTINGS_OPTION ),
		esc_attr( $id ),
		esc_attr( $value ),
		( $value ? sprintf( '<img src="%s" style="max-width:120px;max-height:120px;border:1px solid #ddd;padding:3px;" />', esc_url( $value ) ) : '' ),
		esc_html__( 'Upload Image', 'bagbari-reunion-sejan' ),
		esc_html__( 'Remove', 'bagbari-reunion-sejan' )
	);
	if ( ! empty( $args['desc'] ) ) {
		printf( '<p class="description">%s</p>', esc_html( $args['desc'] ) );
	}
}

function brc_general_section_cb() {
	echo '<p>' . esc_html__( 'Manage global theme options. All fields are safely stored via Settings API.', 'bagbari-reunion-sejan' ) . '</p>';
}

function brc_render_text_field( $args ) {
	$options = get_option( BRC_SETTINGS_OPTION, array() );
	$id      = $args['id'];
	$type    = $args['type'] ?? 'text';
	$value   = $options[ $id ] ?? '';
	$mark    = ( in_array( $type, array( 'text', 'url', 'email' ), true ) ) ? ' data-brc-encode="1"' : '';
	printf(
		'<input type="%1$s" name="%2$s[%3$s]" value="%4$s" class="regular-text" placeholder="%5$s"%6$s />',
		esc_attr( $type ),
		esc_attr( BRC_SETTINGS_OPTION ),
		esc_attr( $id ),
		esc_attr( $value ),
		esc_attr( $args['placeholder'] ?? '' ),
		$mark
	);
	if ( ! empty( $args['desc'] ) ) {
		printf( '<p class="description">%s</p>', esc_html( $args['desc'] ) );
	}
}

function brc_render_countdown_mode_field( $args ) {
	$options = get_option( BRC_SETTINGS_OPTION, array() );
	$id      = $args['id'];
	$value   = ! empty( $options[ $id ] ) ? 1 : 0;
	printf(
		'<label for="%1$s"> <input type="checkbox" id="%1$s" name="%2$s[%1$s]" value="1" %3$s /> %4$s</label>',
		esc_attr( $id ),
		esc_attr( BRC_SETTINGS_OPTION ),
		checked( 1, $value, false ),
		esc_html__( 'Enable Event Date Countdown Mode', 'bagbari-reunion-sejan' )
	);
	if ( ! empty( $args['desc'] ) ) {
		printf( '<p class="description">%s</p>', esc_html( $args['desc'] ) );
	}
}

function brc_render_datetime_field( $args ) {
	$options  = get_option( BRC_SETTINGS_OPTION, array() );
	$id       = $args['id'];
	$value    = $options[ $id ] ?? '';
	$tz       = wp_timezone();
	$dt_value = '';
	$ts       = ( '' !== $value ) ? strtotime( $value ) : false;
	if ( false !== $ts ) {
		// Show the stored instant in the site's timezone inside the datetime-local input.
		$dt_value = wp_date( 'Y-m-d\TH:i', $ts, $tz );
	} elseif ( '' !== $value && preg_match( '/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}/', $value ) ) {
		$dt_value = substr( $value, 0, 16 );
	}
	printf(
		'<input type="datetime-local" name="%1$s[%2$s]" value="%3$s" class="regular-text" />',
		esc_attr( BRC_SETTINGS_OPTION ),
		esc_attr( $id ),
		esc_attr( $dt_value )
	);
	if ( false !== $ts ) {
		// Preview the saved value in local time (matches the Site Timezone setting).
		printf(
			'<p class="description">%s: <code>%s</code> (%s)</p>',
			esc_html__( 'Saved', 'bagbari-reunion-sejan' ),
			esc_html( wp_date( 'c', $ts, $tz ) ),
			esc_html( wp_date( 'Y-m-d H:i', $ts, $tz ) )
		);
	}
	if ( ! empty( $args['desc'] ) ) {
		printf( '<p class="description">%s</p>', esc_html( $args['desc'] ) );
	}
}

/**
 * Normalize a submitted countdown date/time into a canonical UTC ISO-8601 string.
 *
 * The datetime-local input submits a bare wall-clock value ("Y-m-d\TH:i") that is
 * meant to be read in the site's timezone (wp_timezone()). Values that already
 * carry an explicit offset (the default and any legacy ISO strings) are respected
 * as-is. Either way the result is the same absolute instant, stored as UTC, so the
 * frontend countdown always targets the configured local moment.
 *
 * @param mixed $raw Raw submitted value.
 * @return string UTC "c" string, or the sanitized raw value when unparseable.
 */
function brc_normalize_countdown_datetime( $raw ) {
	$raw = trim( (string) $raw );
	if ( '' === $raw ) {
		return '';
	}
	$dt = false;
	if ( preg_match( '/^\d{4}-\d{2}-\d{2}[T ]\d{2}:\d{2}(:\d{2})?$/', $raw ) ) {
		// Bare wall-clock: interpret it in the site's timezone, not the PHP default (UTC).
		foreach ( array( 'Y-m-d\TH:i:s', 'Y-m-d\TH:i', 'Y-m-d H:i:s', 'Y-m-d H:i' ) as $format ) {
			$parsed = DateTimeImmutable::createFromFormat( $format, $raw, wp_timezone() );
			if ( $parsed instanceof DateTimeImmutable ) {
				$dt = $parsed;
				break;
			}
		}
	} else {
		try {
			$dt = new DateTimeImmutable( $raw );
		} catch ( Exception $e ) {
			$dt = false;
		}
	}
	if ( ! $dt instanceof DateTimeImmutable ) {
		return sanitize_text_field( $raw );
	}
	return $dt->setTimezone( new DateTimeZone( 'UTC' ) )->format( 'c' );
}

function brc_sanitize_theme_settings( $input ) {
	$output = array();
	if ( isset( $input['event_date'] ) ) {
		$output['event_date'] = sanitize_text_field( brc_decode_encode_field( $input['event_date'] ) );
	}
	if ( isset( $input['event_time'] ) ) {
		$output['event_time'] = sanitize_text_field( brc_decode_encode_field( $input['event_time'] ) );
	}
	if ( isset( $input['event_location'] ) ) {
		$output['event_location'] = sanitize_text_field( brc_decode_encode_field( $input['event_location'] ) );
	}
	if ( isset( $input['pass_price'] ) ) {
		$output['pass_price'] = sanitize_text_field( brc_decode_encode_field( $input['pass_price'] ) );
	}
	if ( isset( $input['event_countdown_datetime'] ) ) {
		$output['event_countdown_datetime'] = brc_normalize_countdown_datetime( $input['event_countdown_datetime'] );
	}
	if ( isset( $input['countdown_mode'] ) ) {
		$output['countdown_mode'] = ! empty( $input['countdown_mode'] ) ? 1 : 0;
	}
	// Backward compatibility: keep sanitizing a legacy registration_deadline key if present.
	if ( isset( $input['registration_deadline'] ) ) {
		$output['registration_deadline'] = sanitize_text_field( $input['registration_deadline'] );
	}
	if ( isset( $input['phone'] ) ) {
		$output['phone'] = sanitize_text_field( $input['phone'] );
	}
	if ( isset( $input['phone_2'] ) ) {
		$output['phone_2'] = sanitize_text_field( $input['phone_2'] );
	}
	if ( isset( $input['phone_3'] ) ) {
		$output['phone_3'] = sanitize_text_field( $input['phone_3'] );
	}
	if ( isset( $input['email'] ) ) {
		$output['email'] = sanitize_email( brc_decode_encode_field( $input['email'] ) );
	}
	if ( isset( $input['facebook_page'] ) ) {
		$output['facebook_page'] = esc_url_raw( trim( brc_decode_encode_field( $input['facebook_page'] ) ) );
	}
	if ( isset( $input['facebook_group'] ) ) {
		$output['facebook_group'] = esc_url_raw( trim( brc_decode_encode_field( $input['facebook_group'] ) ) );
	}
	if ( isset( $input['sponsor_form_link'] ) ) {
		$output['sponsor_form_link'] = esc_url_raw( trim( brc_decode_encode_field( $input['sponsor_form_link'] ) ) );
	}
	for ( $i = 1; $i <= 6; $i++ ) {
		if ( isset( $input['canvas_img_' . $i] ) ) {
			$output['canvas_img_' . $i] = esc_url_raw( trim( brc_decode_encode_field( $input['canvas_img_' . $i] ) ) );
		}
		if ( isset( $input['canvas_title_' . $i] ) ) {
			$output['canvas_title_' . $i] = sanitize_text_field( brc_decode_encode_field( $input['canvas_title_' . $i] ) );
		}
	}
	return $output;
}

/**
 * Decode a value that was base64-encoded client-side before submission.
 *
 * ModSecurity can block an options.php POST whose raw body contains Bengali
 * text or raw image URLs. Before the form submits, risky field values are
 * base64-encoded (prefixed `brc:`) so the transport is plain ASCII. Here we
 * reverse that. Plain values are returned untouched.
 *
 * @param mixed $value Raw submitted value.
 * @return string Decoded / original value.
 */
function brc_decode_encode_field( $value ) {
	$value = (string) $value;
	if ( 0 === strpos( $value, 'brc:' ) ) {
		$decoded = base64_decode( substr( $value, 4 ), true );
		if ( false !== $decoded ) {
			return $decoded;
		}
	}
	return $value;
}

function brc_get_theme_settings() {
	$defaults = array(
		'event_date'           => '২৫ ডিসেম্বর ২০২৬',
		'event_time'           => 'শুক্রবার, সকাল ৯:০০',
		'event_location'       => 'স্কুল প্রাঙ্গণ, বাগবাড়ী, বগুড়া',
		'pass_price'           => '৳১,০০০',
		'countdown_mode'           => 0,
		'event_countdown_datetime' => '2026-11-25T09:00:00+06:00',
		'registration_deadline'    => '',
		'phone'                    => '',
		'phone_2'                  => '',
		'phone_3'                  => '',
		'email'                => '',
		'facebook_page'        => '',
		'facebook_group'       => '',
		'sponsor_form_link'    => '',
		'canvas_img_1'         => get_stylesheet_directory_uri() . '/assets/classroom.webp',
		'canvas_img_2'         => get_stylesheet_directory_uri() . '/assets/achive.webp',
		'canvas_img_3'         => get_stylesheet_directory_uri() . '/assets/friends.webp',
		'canvas_img_4'         => get_stylesheet_directory_uri() . '/assets/img1.jpg',
		'canvas_img_5'         => get_stylesheet_directory_uri() . '/assets/football.webp',
		'canvas_img_6'         => get_stylesheet_directory_uri() . '/assets/img2.webp',
		'canvas_title_1'       => 'আমাদের সেই প্রিয় ক্লাসরুম',
		'canvas_title_2'       => 'বিজয়ী হাসি আর আমাদের গল্প',
		'canvas_title_3'       => 'স্কুল বারান্দায় জমিয়ে রাখা আমাদের গল্প',
		'canvas_title_4'       => 'সিঁড়িতে বসা সেই পড়ালেখার দিনগুলো',
		'canvas_title_5'       => 'বিকেলের ফুটবল আর বিজয়ের উল্লাস',
		'canvas_title_6'       => 'এক ফ্রেমে বন্দि শৈশবের শুদ্ধ আনন্দ',
	);
	$settings = wp_parse_args( (array) get_option( BRC_SETTINGS_OPTION, array() ), $defaults );
	// Backward compatibility: if a legacy registration_deadline exists and the new
	// unified target is empty, fall back to the legacy saved date.
	if ( empty( $settings['event_countdown_datetime'] ) && ! empty( $settings['registration_deadline'] ) ) {
		$settings['event_countdown_datetime'] = $settings['registration_deadline'];
	}
	return $settings;
}

/**
 * Get the স্মৃতির ক্যানভাস gallery items as an ordered array of
 * ['image' => url, 'title' => text] pairs.
 * Falls back to theme defaults when a field is empty.
 *
 * @return array{image:string,title:string}[]
 */
function brc_get_canvas_items() {
	$s = brc_get_theme_settings();
	return array(
		1 => array( 'image' => esc_url( $s['canvas_img_1'] ),   'title' => esc_html( $s['canvas_title_1'] ) ),
		2 => array( 'image' => esc_url( $s['canvas_img_2'] ),   'title' => esc_html( $s['canvas_title_2'] ) ),
		3 => array( 'image' => esc_url( $s['canvas_img_3'] ),   'title' => esc_html( $s['canvas_title_3'] ) ),
		4 => array( 'image' => esc_url( $s['canvas_img_4'] ),   'title' => esc_html( $s['canvas_title_4'] ) ),
		5 => array( 'image' => esc_url( $s['canvas_img_5'] ),   'title' => esc_html( $s['canvas_title_5'] ) ),
		6 => array( 'image' => esc_url( $s['canvas_img_6'] ),   'title' => esc_html( $s['canvas_title_6'] ) ),
	);
}

function brc_get_sponsor_cta_url() {
	$s = brc_get_theme_settings();
	if ( ! empty( $s['sponsor_form_link'] ) ) {
		return $s['sponsor_form_link'];
	}
	$email = ! empty( $s['email'] ) ? $s['email'] : 'sponsor@bagbari-reunion.com';
	return 'mailto:' . $email;
}

function brc_get_countdown_mode() {
	$s = brc_get_theme_settings();
	return ! empty( $s['countdown_mode'] ) ? 1 : 0;
}

function brc_get_countdown_target_iso() {
	$s   = brc_get_theme_settings();
	$raw = trim( (string) ( $s['event_countdown_datetime'] ?? '' ) );
	if ( '' !== $raw ) {
		$ts = strtotime( $raw );
		if ( false !== $ts ) {
			// Emit the target instant in the site's timezone (offset included) so the
			// frontend `new Date()` resolves the exact configured local moment.
			return wp_date( 'c', $ts, wp_timezone() );
		}
	}
	return apply_filters( 'brc_countdown_target', '2026-11-25T09:00:00+06:00' );
}

/**
 * One-time migration: move a legacy saved "registration_deadline" into the new
 * unified "event_countdown_datetime" key so existing saved dates stay intact.
 */
function brc_migrate_legacy_countdown() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$options = get_option( BRC_SETTINGS_OPTION, array() );
	if ( empty( $options ) || ! is_array( $options ) ) {
		return;
	}
	if ( empty( $options['event_countdown_datetime'] ) && ! empty( $options['registration_deadline'] ) ) {
		$options['event_countdown_datetime'] = $options['registration_deadline'];
		unset( $options['registration_deadline'] );
		update_option( BRC_SETTINGS_OPTION, $options );
	}
}
add_action( 'admin_init', 'brc_migrate_legacy_countdown' );

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

function brc_sc_phone_2() {
	$s = brc_get_theme_settings();
	return ! empty( $s['phone_2'] ) ? esc_html( $s['phone_2'] ) : '';
}
add_shortcode( 'brc_phone_2', 'brc_sc_phone_2' );

function brc_sc_phone_2_url() {
	$s = brc_get_theme_settings();
	return ! empty( $s['phone_2'] ) ? esc_url( brc_get_phone_href( $s['phone_2'] ) ) : '';
}
add_shortcode( 'brc_phone_2_url', 'brc_sc_phone_2_url' );

function brc_sc_phone_3() {
	$s = brc_get_theme_settings();
	return ! empty( $s['phone_3'] ) ? esc_html( $s['phone_3'] ) : '';
}
add_shortcode( 'brc_phone_3', 'brc_sc_phone_3' );

function brc_sc_phone_3_url() {
	$s = brc_get_theme_settings();
	return ! empty( $s['phone_3'] ) ? esc_url( brc_get_phone_href( $s['phone_3'] ) ) : '';
}
add_shortcode( 'brc_phone_3_url', 'brc_sc_phone_3_url' );

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

function brc_sc_sponsor_form_link() {
	return esc_url( brc_get_sponsor_cta_url() );
}
add_shortcode( 'brc_sponsor_form_link', 'brc_sc_sponsor_form_link' );

function brc_sc_event_date() {
	return esc_html( brc_get_theme_settings()['event_date'] );
}
add_shortcode( 'brc_event_date', 'brc_sc_event_date' );
add_shortcode( 'theme_event_date', 'brc_sc_event_date' );

function brc_sc_event_time() {
	return esc_html( brc_get_theme_settings()['event_time'] );
}
add_shortcode( 'brc_event_time', 'brc_sc_event_time' );
add_shortcode( 'theme_event_time', 'brc_sc_event_time' );

function brc_sc_event_location() {
	return esc_html( brc_get_theme_settings()['event_location'] );
}
add_shortcode( 'brc_event_location', 'brc_sc_event_location' );
add_shortcode( 'theme_event_location', 'brc_sc_event_location' );

function brc_sc_pass_price() {
	return esc_html( brc_get_theme_settings()['pass_price'] );
}
add_shortcode( 'brc_pass_price', 'brc_sc_pass_price' );
add_shortcode( 'theme_event_price', 'brc_sc_pass_price' );
add_shortcode( 'theme_event_pass_price', 'brc_sc_pass_price' );

function brc_sc_registration_deadline() {
	$s   = brc_get_theme_settings();
	$raw = $s['event_countdown_datetime'];
	$ts  = strtotime( $raw );
	if ( false !== $ts ) {
		return esc_html( wp_date( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), $ts ) );
	}
	return esc_html( $raw );
}
add_shortcode( 'brc_registration_deadline', 'brc_sc_registration_deadline' );
add_shortcode( 'theme_event_deadline', 'brc_sc_registration_deadline' );

function brc_render_theme_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post" data-brc-encode-form="1">
			<?php
			settings_fields( BRC_SETTINGS_GROUP );
			do_settings_sections( BRC_SETTINGS_PAGE );
			submit_button( __( 'Save Settings', 'bagbari-reunion-sejan' ) );
			?>
		</form>
	</div>
	<?php
}
