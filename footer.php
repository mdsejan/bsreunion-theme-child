<?php
/**
 * Global footer template.
 *
 * @package Bagbari_Reunion_Child
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$home_url     = home_url( '/' );
$register_url = brc_get_register_url();
$about_url    = home_url( '/#about' );
?>
	<footer class="relative overflow-hidden" style="background:linear-gradient(180deg,#20070b 0%,#160407 100%)">
		<div class="f2026-line" aria-hidden="true"></div>
		<div class="grain" aria-hidden="true"></div>
		<div class="f2026-float-a pointer-events-none absolute -top-28 left-[8%] w-[26rem] h-[26rem] glow-gold opacity-[0.13]" aria-hidden="true"></div>
		<div class="f2026-float-b pointer-events-none absolute -bottom-40 right-[4%] w-[28rem] h-[28rem] glow-maroon opacity-30" aria-hidden="true"></div>

		<div class="relative max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 pt-10 sm:pt-12 pb-7">
			<div class="grid gap-8 md:gap-8 lg:gap-12 md:grid-cols-2 lg:grid-cols-3 items-center">

				<div class="f2026-reveal text-center lg:text-left" style="--d:.05s">
					<a href="<?php echo esc_url( $home_url ); ?>" class="inline-flex items-center gap-2.5 font-display text-2xl sm:text-[1.65rem] text-paper">
						<span class="f2026-brand-mark text-gold text-[1.35em] leading-none" aria-hidden="true">✺</span>
						<span><?php esc_html_e( 'স্মৃতির আঙিনায়', 'bagbari-reunion-sejan' ); ?> <span class="gold-text gold-text-tight">'২৬</span></span>
					</a>
					<p class="mt-3 max-w-xs mx-auto lg:mx-0 text-[15px] leading-[1.9] text-[#e2d5c3]/65">
						<?php esc_html_e( "একদিনের জন্য ফিরে যাই কৈশোরের সোনালী আঙিনায়।", 'bagbari-reunion-sejan' ); ?>
					</p>
				</div>

				<div class="f2026-reveal text-center" style="--d:.12s">
					<div class="flex flex-row flex-wrap items-center justify-center gap-2.5 sm:gap-3">
						<a href="tel:+8801793548365" class="f2026-pill">
							<span class="f2026-ico" aria-hidden="true">
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z" /></svg>
							</span>
							<span dir="ltr"><?php esc_html_e( '01793 - 548 365', 'bagbari-reunion-sejan' ); ?></span>
						</a>
						<a href="mailto:help@bagbari-reunion.com" class="f2026-pill">
							<span class="f2026-ico" aria-hidden="true">
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2" /><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" /></svg>
							</span>
							<span>help@bagbari-reunion.com</span>
						</a>
					</div>
					<div class="mt-4 flex flex-wrap items-center justify-center gap-x-7 gap-y-2">
						<a href="#" target="_blank" rel="noopener noreferrer" class="f2026-fb">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13.5 21v-7h2.4l.4-3h-2.8V9.1c0-.9.3-1.5 1.6-1.5h1.3V4.9c-.3 0-1.2-.1-2.2-.1-2.2 0-3.7 1.3-3.7 3.8V11H8v3h2.5v7h3Z" /></svg>
							<?php esc_html_e( 'ফেসবুক পেজ', 'bagbari-reunion-sejan' ); ?>
						</a>
						<a href="#" target="_blank" rel="noopener noreferrer" class="f2026-fb">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" /></svg>
							<?php esc_html_e( 'ফেসবুক গ্রুপ', 'bagbari-reunion-sejan' ); ?>
						</a>
					</div>
				</div>

				<nav class="f2026-reveal text-center md:col-span-2 lg:col-span-1 lg:text-right lg:justify-self-end" style="--d:.2s" aria-label="<?php echo esc_attr__( 'ফুটার নেভিগেশন', 'bagbari-reunion-sejan' ); ?>">
					<ul class="f2026-nav flex flex-wrap items-center justify-center lg:justify-end gap-x-7 gap-y-3 text-[15px]">
						<li><a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'হোম', 'bagbari-reunion-sejan' ); ?></a></li>
						<li><a href="<?php echo esc_url( $about_url ); ?>"><?php esc_html_e( 'আমাদের কথা', 'bagbari-reunion-sejan' ); ?></a></li>
						<li><a href="<?php echo esc_url( $register_url ); ?>"><?php esc_html_e( 'রেজিস্টার', 'bagbari-reunion-sejan' ); ?></a></li>
					</ul>
					<div class="mt-4 flex justify-center lg:justify-end">
						<a href="#top" class="f2026-top link-arrow inline-flex items-center gap-2 rounded-full border border-[rgba(234,184,90,0.22)] bg-white/[0.02] px-5 py-2.5 text-sm text-[#e2d5c3]/65">
							<?php esc_html_e( 'উপরে ফিরে যান', 'bagbari-reunion-sejan' ); ?> <span class="arw" aria-hidden="true">↑</span>
						</a>
					</div>
				</nav>
			</div>
		</div>

		<div class="relative border-t border-[rgba(234,184,90,0.15)]">
			<div class="relative max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-5 flex flex-col sm:flex-row items-center justify-between gap-2.5 text-center sm:text-left text-sm text-[#e2d5c3]/55">
				<p class="leading-relaxed">© ২০২৬ <?php esc_html_e( "স্মৃতির আঙিনায় '২৬ - বাগবাড়ী কলিম মাহমুদ উচ্চ বিদ্যালয়। সকল অধিকার সংরক্ষিত।", 'bagbari-reunion-sejan' ); ?></p>
				<p class="shrink-0">Developed by <a href="https://www.facebook.com/sejan.kp/" target="_blank" rel="noopener noreferrer" class="dev-gold gold-text gold-text-tight font-display font-semibold">Sejan</a></p>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
