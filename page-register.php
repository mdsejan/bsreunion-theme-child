<?php
/**
 * Template Name: Register Page
 * Custom page template for the registration interface and form shortcode support.
 *
 * @package Bagbari_Reunion_Child
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$brc = function_exists( 'brc_get_theme_settings' ) ? brc_get_theme_settings() : array(
	'event_date'           => '২৫ ডিসেম্বর ২০২৬',
	'event_time'           => 'শুক্রবার, সকাল ৯:০০',
	'event_location'       => 'স্কুল প্রাঙ্গণ, বাগবাড়ী, বগুড়া',
	'pass_price'           => '৳১,০০০',
	'registration_deadline' => '১৫ ডিসেম্বর ২০২৬',
);
?>

	<div class="relative bg-maroon overflow-hidden">
		<div class="grain"></div>
		<div class="pointer-events-none absolute -top-32 right-0 w-[34rem] h-[34rem] glow-gold opacity-25"></div>
		<div class="pointer-events-none absolute -bottom-32 -left-24 w-[30rem] h-[30rem] glow-maroon opacity-50"></div>
		<div class="relative max-w-3xl mx-auto px-5 sm:px-8 pt-36 sm:pt-44 pb-12 text-center">
			<p class="kicker justify-center inline-flex text-gold text-sm"><?php esc_html_e( 'অ্যালুমনাই পাস', 'bagbari-reunion-sejan' ); ?></p>
			<h1 class="font-display text-3xl sm:text-4xl md:text-5xl mt-4 text-paper"><?php esc_html_e( 'নিবন্ধন', 'bagbari-reunion-sejan' ); ?> <span class="gold-text"><?php esc_html_e( 'ফরম', 'bagbari-reunion-sejan' ); ?></span></h1>
			<p class="mt-5 text-paper/75 max-w-xl mx-auto leading-relaxed"><?php esc_html_e( 'নিচের তথ্যগুলো সঠিকভাবে পূরণ করে আপনার আসনটি নিশ্চিত করুন।', 'bagbari-reunion-sejan' ); ?></p>
			<div class="mt-7 flex flex-wrap items-center justify-center gap-2.5">
				<span class="pill">📅 <?php echo esc_html( $brc['event_date'] ); ?></span>
				<span class="pill">🎟 <?php printf( esc_html__( 'পাস %s', 'bagbari-reunion-sejan' ), esc_html( $brc['pass_price'] ) ); ?></span>
				<span class="pill">👨‍👩‍👧 <?php esc_html_e( 'অতিথি ৳৫০০/জন', 'bagbari-reunion-sejan' ); ?></span>
			</div>
		</div>
	</div>

	<?php
	while ( have_posts() ) :
		the_post();

		$content = get_the_content();

		if ( ! empty( trim( $content ) ) ) {
			echo '<div class="relative bg-maroon overflow-hidden"><div class="relative max-w-3xl mx-auto px-5 sm:px-8 pb-8 text-paper/80 leading-relaxed">';
			the_content();
			echo '</div></div>';
		}
	endwhile;
	?>

	<!-- ফর্মের চারপাশের মারুন ব্যাকগ্রাউন্ড এবং নিচের পর্যাপ্ত প্যাডিংয়ের জন্য র‍্যাপার -->
    <div class="relative bg-maroon overflow-hidden pb-24">
        <div class="relative max-w-4xl mx-auto px-5 sm:px-8">
            <?php
            if ( shortcode_exists( 'reunion_registration_form' ) ) {
                echo do_shortcode( '[reunion_registration_form]' );
            } else {
                echo do_shortcode( '[reunion_form]' );
            }
            ?>
        </div>
    </div>

<?php
get_footer();
