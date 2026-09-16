<?php
/**
 * Global header template.
 *
 * @package Bagbari_Reunion_Child
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$home_url     = home_url( '/' );
$register_url = brc_get_register_url();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#150e0a">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla:ital@0;1&family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<script src="https://cdn.tailwindcss.com"></script>
	<script>
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						ink: '#150e0a', ink2: '#1f1610', ink3: '#2a1d14',
						maroon: '#7e1e2a', maroon2: '#5a1420', maroondeep: '#2a0910',
						marigold: '#e7b24c', marigold2: '#c08a25',
						gold: '#e7b24c', goldlite: '#f6d98c', golddark: '#c08a25',
						emerald: '#0e5b43', emeralddeep: '#073526',
						paper: '#f8efdb', paper2: '#f0e0bf'
					},
					fontFamily: {
						serif: ['"Tiro Bangla"', 'serif'],
						sans: ['"Hind Siliguri"', 'sans-serif']
					}
				}
			}
		};
	</script>

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'text-paper antialiased overflow-x-hidden' ); ?>>
<?php wp_body_open(); ?>

	<span id="top" aria-hidden="true"></span>
	<div class="fixed top-0 inset-x-0 h-[3px] z-[60] pointer-events-none" aria-hidden="true">
		<div id="progressBar" class="h-full w-full" style="background:linear-gradient(90deg,#c08a25,#f6d98c)"></div>
	</div>

	<header id="siteHeader" class="fixed top-0 inset-x-0 z-50 transition-colors duration-500">
		<div class="max-w-7xl mx-auto px-5 sm:px-8 flex items-center justify-between h-20">
			<a href="<?php echo esc_url( $home_url ); ?>" class="font-display text-xl sm:text-2xl text-paper flex items-center gap-2">
				<span class="text-gold" aria-hidden="true">✺</span>
				<span><?php esc_html_e( 'স্মৃতির আঙিনায়', 'bagbari-reunion-sejan' ); ?> <span class="gold-text">'২৬</span></span>
			</a>

			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => 'nav',
						'container_aria_label' => __( 'Primary Menu', 'bagbari-reunion-sejan' ),
						'menu_class'     => 'hidden md:flex items-center gap-9 text-[15px] text-paper/85',
						'link_before'    => '',
						'depth'          => 1,
					)
				);
				?>
			<?php else : ?>
				<nav class="hidden md:flex items-center gap-9 text-[15px] text-paper/85" aria-label="<?php echo esc_attr__( 'প্রধান মেনু', 'bagbari-reunion-sejan' ); ?>">
					<a href="<?php echo esc_url( $home_url ); ?>" class="hover:text-gold transition-colors"><?php esc_html_e( 'হোম', 'bagbari-reunion-sejan' ); ?></a>
					<a href="<?php echo esc_url( home_url( '/#about' ) ); ?>" class="hover:text-gold transition-colors"><?php esc_html_e( 'আমাদের কথা', 'bagbari-reunion-sejan' ); ?></a>
					<a href="<?php echo esc_url( home_url( '/#schedule' ) ); ?>" class="hover:text-gold transition-colors"><?php esc_html_e( 'সময়সূচী', 'bagbari-reunion-sejan' ); ?></a>
					<a href="<?php echo esc_url( home_url( '/#gallery' ) ); ?>" class="hover:text-gold transition-colors"><?php esc_html_e( 'স্মৃতির ক্যানভাস', 'bagbari-reunion-sejan' ); ?></a>
					<a href="<?php echo esc_url( home_url( '/#sponsors' ) ); ?>" class="hover:text-gold transition-colors"><?php esc_html_e( 'স্পন্সর', 'bagbari-reunion-sejan' ); ?></a>
				</nav>
			<?php endif; ?>

			<a href="<?php echo esc_url( $register_url ); ?>" class="btn-gold hidden sm:inline-flex items-center rounded-full font-semibold px-6 py-2.5 text-[15px]">
				<?php esc_html_e( 'রেজিস্ট্রেশন করুন', 'bagbari-reunion-sejan' ); ?>
			</a>

			<button id="menuBtn" class="md:hidden text-paper" aria-label="<?php echo esc_attr__( 'মেনু খুলুন', 'bagbari-reunion-sejan' ); ?>" aria-expanded="false" aria-controls="mobileMenu">
				<svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
					<path d="M3 7h20M3 13h20M3 19h20" />
				</svg>
			</button>
		</div>

		<div id="mobileMenu" class="hidden md:hidden bg-ink/98 nav-blur border-t border-gold/15 px-6 py-6 flex flex-col gap-5 text-paper/90 text-lg">
			<a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'হোম', 'bagbari-reunion-sejan' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/#about' ) ); ?>"><?php esc_html_e( 'আমাদের কথা', 'bagbari-reunion-sejan' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/#schedule' ) ); ?>"><?php esc_html_e( 'সময়সূচী', 'bagbari-reunion-sejan' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/#gallery' ) ); ?>"><?php esc_html_e( 'স্মৃতির ক্যানভাস', 'bagbari-reunion-sejan' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/#sponsors' ) ); ?>"><?php esc_html_e( 'স্পন্সর', 'bagbari-reunion-sejan' ); ?></a>
			<a href="<?php echo esc_url( $register_url ); ?>" class="btn-gold inline-flex justify-center rounded-full font-semibold px-6 py-3 mt-2"><?php esc_html_e( 'রেজিস্ট্রেশন করুন', 'bagbari-reunion-sejan' ); ?></a>
		</div>
	</header>
