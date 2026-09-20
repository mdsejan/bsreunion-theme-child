<?php
/**
 * Static home page template.
 *
 * @package Bagbari_Reunion_Child
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$assets_uri   = get_stylesheet_directory_uri() . '/assets';
$register_url = brc_get_register_url();
$about_url    = home_url( '/#about' );
$schedule_url = home_url( '/#schedule' );
$brc          = function_exists( 'brc_get_theme_settings' ) ? brc_get_theme_settings() : array(
	'event_date'           => '২৫ ডিসেম্বর ২০২৬',
	'event_time'           => 'শুক্রবার, সকাল ৯:০০',
	'event_location'       => 'স্কুল প্রাঙ্গণ, বাগবাড়ী, বগুড়া',
	'pass_price'           => '৳১,০০০',
	'registration_deadline' => '১৫ ডিসেম্বর ২০২৬',
);
$brc_time_parts = array_map( 'trim', explode( ',', $brc['event_time'] ) );
$brc_has_split  = count( $brc_time_parts ) > 1 && '' !== $brc_time_parts[1];
?>

	<section class="relative min-h-[100svh] flex items-end overflow-hidden">
		<div class="absolute inset-0">
			<picture class="block w-full h-full">
				<source media="(max-width: 640px)" srcset="<?php echo esc_url( $assets_uri . '/hero-mobile.webp' ); ?>">
				<img id="heroImg" src="<?php echo esc_url( $assets_uri . '/hero-desktop.webp' ); ?>" alt="<?php echo esc_attr__( 'বাগবাড়ী কলিম মাহমুদ উচ্চ বিদ্যালয়ের ক্যাম্পাস', 'bagbari-reunion-sejan' ); ?>" class="w-full h-full object-cover scale-110" fetchpriority="high" decoding="async">
			</picture>
			<div class="absolute inset-0 bg-gradient-to-t from-ink via-ink/60 to-ink/20"></div>
			<div class="absolute inset-0 bg-gradient-to-r from-ink/80 via-ink/30 to-transparent"></div>
			<div class="pointer-events-none absolute -top-32 -right-24 w-[36rem] h-[36rem] glow-gold opacity-50"></div>
			<div class="pointer-events-none absolute -bottom-40 -left-28 w-[40rem] h-[40rem] glow-maroon opacity-45"></div>
			<div class="grain"></div>
		</div>

		<div id="heroContent" class="relative max-w-7xl mx-auto w-full px-5 sm:px-8 pb-12 sm:pb-16 lg:pb-14 pt-32 sm:pt-36 lg:pt-32 min-h-[100svh] flex flex-col justify-center">
			<p id="heroKicker" class="inline-flex items-center gap-3 text-gold text-xs sm:text-sm tracking-[.18em] mb-4 opacity-0">
				<span class="w-8 h-px bg-gold/50"></span> <?php esc_html_e( 'বাগবাড়ী কলিম মাহমুদ উচ্চ বিদ্যালয়', 'bagbari-reunion-sejan' ); ?>
			</p>
			<h1 id="heroTitle" class="font-display text-[11vw] leading-[1.3] sm:text-6xl md:text-7xl lg:text-[clamp(2.8rem,5.2vw,5rem)] text-paper max-w-4xl">
				<span class="hero-line"><span class="hero-line-in block translate-y-full"><?php esc_html_e( 'স্মৃতির আঙিনায়', 'bagbari-reunion-sejan' ); ?></span></span>
				<span class="hero-line"><span class="hero-line-in block translate-y-full gold-text"><?php esc_html_e( 'পুনর্মিলনী ২০২৬', 'bagbari-reunion-sejan' ); ?></span></span>
			</h1>
			<p id="heroSub" class="mt-5 max-w-xl text-paper/80 text-base sm:text-lg leading-relaxed opacity-0">
				<?php esc_html_e( 'এক ঝাঁক পুরোনো মুখ, টিফিনের চেনা ঘণ্টা আর মেঠো আঙিনার সেই নিরীহ হাসি — একদিনের জন্য হলেও চলুন ফিরে যাই কৈশোরের সোনালী দিনে।', 'bagbari-reunion-sejan' ); ?>
			</p>
			<div id="heroCtas" class="mt-6 flex flex-wrap items-center gap-3 sm:gap-4 opacity-0">
				<a href="<?php echo esc_url( $register_url ); ?>" class="btn-gold inline-flex items-center gap-2 rounded-full font-semibold px-7 py-3.5">
					<?php esc_html_e( 'রেজিস্ট্রেশন করুন', 'bagbari-reunion-sejan' ); ?> <span aria-hidden="true">→</span>
				</a>
				<a href="<?php echo esc_url( $schedule_url ); ?>" class="btn-ghost link-arrow inline-flex items-center gap-2 rounded-full font-medium px-6 py-3.5">
					<?php esc_html_e( 'দিনের রূপরেখা', 'bagbari-reunion-sejan' ); ?> <span class="arw" aria-hidden="true">→</span>
				</a>
			</div>
			<div id="heroPills" class="mt-6 flex flex-wrap items-center gap-2.5 opacity-0">
				<span class="pill">📅 <?php echo esc_html( $brc['event_date'] ); ?></span>
				<?php if ( $brc_has_split ) : ?>
					<span class="pill">🗓 <?php echo esc_html( $brc_time_parts[0] ); ?></span>
					<span class="pill">⏰ <?php echo esc_html( $brc_time_parts[1] ); ?></span>
				<?php else : ?>
					<span class="pill">⏰ <?php echo esc_html( $brc['event_time'] ); ?></span>
				<?php endif; ?>
				<span class="pill">📍 <?php echo esc_html( $brc['event_location'] ); ?></span>
			</div>
		</div>

		<div id="pinnedCard" class="hidden lg:block absolute right-10 bottom-10 w-64 bg-paper text-ink px-6 py-5 -rotate-3 shadow-2xl opacity-0">
			<div class="tape -top-3 left-1/2 -translate-x-1/2 rotate-2"></div>
			<p class="font-display text-sm text-maroon">📅 <?php esc_html_e( 'তারিখ ও বার', 'bagbari-reunion-sejan' ); ?></p>
			<p class="font-display text-lg mt-1 leading-snug"><?php echo esc_html( $brc['event_date'] ); ?><br><?php echo esc_html( $brc['event_time'] ); ?></p>
			<div class="h-px bg-ink/15 my-3"></div>
			<p class="font-display text-sm text-maroon">📍 <?php esc_html_e( 'ভেন্যু', 'bagbari-reunion-sejan' ); ?></p>
			<p class="text-sm mt-1 leading-snug"><?php echo esc_html( $brc['event_location'] ); ?></p>
		</div>

		<div id="scrollCue" class="absolute bottom-5 left-5 sm:left-8 flex items-center gap-3 text-paper/60 text-xs">
			<span class="w-8 h-px bg-paper/40"></span> <?php esc_html_e( 'স্ক্রল করুন', 'bagbari-reunion-sejan' ); ?>
		</div>
	</section>

	<section class="relative w-full overflow-hidden border-y border-gold/20" style="background:linear-gradient(165deg,#0e5a3d 0%,#0b4a32 50%,#08402a 100%)">
		<div class="grain"></div>
		<div class="pointer-events-none absolute -top-28 left-1/2 -translate-x-1/2 w-[42rem] h-[20rem] glow-gold opacity-25"></div>
		<div class="relative max-w-6xl mx-auto px-5 sm:px-8 py-8 sm:py-10 text-center">
			<p class="font-display gold-text inline-block text-base sm:text-lg tracking-[.12em] leading-[1.7] pt-1">— <?php esc_html_e( 'রেজিস্ট্রেশন চলছে', 'bagbari-reunion-sejan' ); ?></p>
			<h2 class="font-display text-3xl sm:text-4xl md:text-[2.75rem] mt-2 leading-[1.45] pt-2"><?php esc_html_e( 'রেজিস্ট্রেশনের সময় বাকি', 'bagbari-reunion-sejan' ); ?></h2>
			<div id="countdown" class="mt-6 sm:mt-7 flex justify-center gap-3 sm:gap-5" data-countdown-target="<?php echo esc_attr( brc_get_countdown_target_iso() ); ?>">
				<div class="text-center">
					<div class="w-[72px] sm:w-28 lg:w-32 rounded-xl bg-white/10 border border-[#e7b24c]/35 py-4 sm:py-5 shadow-md backdrop-blur-sm font-display font-bold text-[#facc15] text-3xl sm:text-5xl leading-[1.25] pt-5" style="text-shadow:0 0 18px rgba(250,204,21,.45)" data-cd="days">০০</div>
					<p class="text-xs sm:text-sm text-emerald-50/80 mt-2 tracking-wide leading-relaxed"><?php esc_html_e( 'দিন', 'bagbari-reunion-sejan' ); ?></p>
				</div>
				<div class="text-center">
					<div class="w-[72px] sm:w-28 lg:w-32 rounded-xl bg-white/10 border border-[#e7b24c]/35 py-4 sm:py-5 shadow-md backdrop-blur-sm font-display font-bold text-[#facc15] text-3xl sm:text-5xl leading-[1.25] pt-5" style="text-shadow:0 0 18px rgba(250,204,21,.45)" data-cd="hours">০০</div>
					<p class="text-xs sm:text-sm text-emerald-50/80 mt-2 tracking-wide leading-relaxed"><?php esc_html_e( 'ঘণ্টা', 'bagbari-reunion-sejan' ); ?></p>
				</div>
				<div class="text-center">
					<div class="w-[72px] sm:w-28 lg:w-32 rounded-xl bg-white/10 border border-[#e7b24c]/35 py-4 sm:py-5 shadow-md backdrop-blur-sm font-display font-bold text-[#facc15] text-3xl sm:text-5xl leading-[1.25] pt-5" style="text-shadow:0 0 18px rgba(250,204,21,.45)" data-cd="mins">০০</div>
					<p class="text-xs sm:text-sm text-emerald-50/80 mt-2 tracking-wide leading-relaxed"><?php esc_html_e( 'মিনিট', 'bagbari-reunion-sejan' ); ?></p>
				</div>
				<div class="text-center">
					<div class="w-[72px] sm:w-28 lg:w-32 rounded-xl bg-white/10 border border-[#e7b24c]/35 py-4 sm:py-5 shadow-md backdrop-blur-sm font-display font-bold text-[#facc15] text-3xl sm:text-5xl leading-[1.25] pt-5" style="text-shadow:0 0 18px rgba(250,204,21,.45)" data-cd="secs">০০</div>
					<p class="text-xs sm:text-sm text-emerald-50/80 mt-2 tracking-wide leading-relaxed"><?php esc_html_e( 'সেকেন্ড', 'bagbari-reunion-sejan' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<section id="about" class="relative bg-ink py-24 sm:py-32 overflow-hidden">
		<div class="pointer-events-none absolute top-1/4 -left-32 w-[30rem] h-[30rem] glow-maroon opacity-30"></div>
		<div class="relative max-w-7xl mx-auto px-5 sm:px-8 grid lg:grid-cols-2 gap-16 items-center">
			<div class="reveal-up order-2 lg:order-1 relative">
				<div class="polaroid max-w-md mx-auto lg:mx-0 -rotate-2">
					<img src="<?php echo esc_url( $assets_uri . '/campus.webp' ); ?>" alt="<?php echo esc_attr__( 'স্কুল ক্যাম্পাসের ল্যান্ডস্কেপ', 'bagbari-reunion-sejan' ); ?>" width="800" height="600" loading="lazy" decoding="async" class="w-full h-72 object-cover">
					<p class="font-display text-center text-ink/70 text-sm mt-3"><?php esc_html_e( 'প্রাণপ্রিয় চেনা প্রাঙ্গণ', 'bagbari-reunion-sejan' ); ?></p>
				</div>
				<div class="tape top-8 -right-3 rotate-6 hidden sm:block"></div>
			</div>
			<div class="order-1 lg:order-2 reveal-up">
				<p class="kicker text-gold text-sm"><?php esc_html_e( 'আমাদের কথা', 'bagbari-reunion-sejan' ); ?></p>
				<h2 class="font-display text-3xl sm:text-4xl md:text-[2.75rem] leading-tight mt-4 text-paper">
					<?php esc_html_e( 'শেকড়ের টানে, আবার সেই', 'bagbari-reunion-sejan' ); ?> <span class="gold-text"><?php esc_html_e( 'চেনা আঙিনায়', 'bagbari-reunion-sejan' ); ?></span>
				</h2>
				<p class="mt-6 text-paper/75 leading-loose max-w-lg">
					<?php esc_html_e( 'সময় বদলেছে, বদলেছে শহর আর আমরা নিজেরাও। কিন্তু স্কুলের সেই উঠোন, বারান্দার রোদ আর বন্ধুদের আড্ডা — কোথাও একটুও বদলায়নি। পুনর্মিলনী ’২৬ সাজানো হয়েছে ঠিক সেই অমলিন দিনগুলোতে ফেরার জন্য।', 'bagbari-reunion-sejan' ); ?>
				</p>
				<p class="mt-4 text-paper/75 leading-loose max-w-lg">
					<?php esc_html_e( 'এ শুধু একদিনের মিলন নয় — একে অপরকে নতুন করে চেনার, পুরোনো অভিমান ভুলে যাওয়ার আর যে বন্ধুত্ব সময়ের স্রোতেও ম্লান হয়নি, তা উদযাপনের একটা উপলক্ষ।', 'bagbari-reunion-sejan' ); ?>
				</p>
				<blockquote class="mt-7 border-l-2 border-gold/50 pl-5 text-paper/70 italic font-display leading-relaxed">
					<?php esc_html_e( '“স্কুল কখনো আমাদের ছাড়ে না — সে শুধু ফিরে আসার অপেক্ষায় থাকে।”', 'bagbari-reunion-sejan' ); ?>
				</blockquote>
				<a href="<?php echo esc_url( $about_url ); ?>" class="link-arrow inline-flex items-center gap-2 mt-8 text-gold font-medium border-b border-gold/40 hover:border-gold pb-0.5">
					<?php esc_html_e( 'আমাদের সম্পূর্ণ গল্প পড়ুন', 'bagbari-reunion-sejan' ); ?> <span class="arw" aria-hidden="true">→</span>
				</a>
			</div>
		</div>
	</section>

	<section id="schedule" class="relative bg-maroon py-24 sm:py-32 overflow-hidden">
		<div class="grain"></div>
		<div class="pointer-events-none absolute -top-32 right-0 w-[34rem] h-[34rem] glow-gold opacity-25"></div>
		<div class="relative max-w-4xl mx-auto px-5 sm:px-8 text-center">
			<p class="kicker justify-center inline-flex text-gold text-sm"><?php esc_html_e( 'দিনটির রূপরেখা', 'bagbari-reunion-sejan' ); ?></p>
			<h2 class="font-display text-3xl sm:text-4xl md:text-[2.75rem] mt-4 text-paper"><?php esc_html_e( 'সকাল থেকে রাত — ফিরে পাওয়া সেই', 'bagbari-reunion-sejan' ); ?> <span class="gold-text"><?php esc_html_e( 'বাঁধভাঙা কৈশোর', 'bagbari-reunion-sejan' ); ?></span></h2>
		</div>
		<div class="relative max-w-4xl mx-auto px-5 sm:px-8 mt-20">
			<div class="absolute left-[27px] sm:left-1/2 top-0 bottom-0 w-px bg-gold/25 sm:-translate-x-1/2"></div>
			<div class="space-y-14" id="timeline">
				<div class="relative pl-16 sm:pl-0 sm:grid sm:grid-cols-2 sm:gap-10 timeline-item">
					<div class="sm:text-right sm:pr-10">
						<p class="font-display text-gold text-lg"><?php esc_html_e( 'সকাল ৯:০০ টা', 'bagbari-reunion-sejan' ); ?></p>
						<h3 class="font-display text-xl text-paper mt-1"><?php esc_html_e( 'স্বাগতম, কিট সংগ্রহ ও সকালের নাস্তা', 'bagbari-reunion-sejan' ); ?></h3>
						<p class="text-paper/70 mt-2 leading-relaxed"><?php esc_html_e( 'গেট-পাস হাতে ক্যাম্পাসে প্রবেশ, উৎসবের স্মরণিকা কিট সংগ্রহ আর সকালের নাশতায় দিনের শুরু।', 'bagbari-reunion-sejan' ); ?></p>
					</div>
					<div></div>
					<span class="absolute left-0 sm:left-1/2 top-1 -translate-x-1/2 w-4 h-4 rounded-full bg-gold ring-4 ring-maroon"></span>
				</div>
				<div class="relative pl-16 sm:pl-0 sm:grid sm:grid-cols-2 sm:gap-10 timeline-item">
					<div></div>
					<div class="sm:pl-10">
						<p class="font-display text-gold text-lg"><?php esc_html_e( 'সকাল ১০:১৫ টা', 'bagbari-reunion-sejan' ); ?></p>
						<h3 class="font-display text-xl text-paper mt-1"><?php esc_html_e( 'উদ্বোধন ও বর্ণাঢ্য আনন্দ র‍্যালি', 'bagbari-reunion-sejan' ); ?></h3>
						<p class="text-paper/70 mt-2 leading-relaxed"><?php esc_html_e( 'কুরআন তিলাওয়াত, পতাকা উত্তোলন ও বেলুন-পায়রা উড়িয়ে আনুষ্ঠানিক উদ্বোধন; এরপর রঙিন র‍্যালিতে ভরে ওঠে চেনা প্রাঙ্গণ।', 'bagbari-reunion-sejan' ); ?></p>
					</div>
					<span class="absolute left-0 sm:left-1/2 top-1 -translate-x-1/2 w-4 h-4 rounded-full bg-gold ring-4 ring-maroon"></span>
				</div>
				<div class="relative pl-16 sm:pl-0 sm:grid sm:grid-cols-2 sm:gap-10 timeline-item">
					<div class="sm:text-right sm:pr-10">
						<p class="font-display text-gold text-lg"><?php esc_html_e( 'সকাল ১১:৩০ টা', 'bagbari-reunion-sejan' ); ?></p>
						<h3 class="font-display text-xl text-paper mt-1"><?php esc_html_e( 'স্মৃতিচারণ ও গুণীজন সংবর্ধনা', 'bagbari-reunion-sejan' ); ?></h3>
						<p class="text-paper/70 mt-2 leading-relaxed"><?php esc_html_e( 'শ্রদ্ধেয় প্রাক্তন ও বর্তমান শিক্ষকদের সম্মাননা ক্রেস্ট প্রদান, আর একেক ব্যাচের মুখে একেক গল্প।', 'bagbari-reunion-sejan' ); ?></p>
					</div>
					<div></div>
					<span class="absolute left-0 sm:left-1/2 top-1 -translate-x-1/2 w-4 h-4 rounded-full bg-gold ring-4 ring-maroon"></span>
				</div>
				<div class="relative pl-16 sm:pl-0 sm:grid sm:grid-cols-2 sm:gap-10 timeline-item">
					<div></div>
					<div class="sm:pl-10">
						<p class="font-display text-gold text-lg"><?php esc_html_e( 'দুপুর ১:৪৫ টা', 'bagbari-reunion-sejan' ); ?></p>
						<h3 class="font-display text-xl text-paper mt-1"><?php esc_html_e( 'মধ্যাহ্নভোজ ও মুক্ত আড্ডা', 'bagbari-reunion-sejan' ); ?></h3>
						<p class="text-paper/70 mt-2 leading-relaxed"><?php esc_html_e( 'বিশাল প্যান্ডেলে সব ব্যাচ একসাথে দুপুরের খাবার, সাথে খোলা আকাশের নিচে স্মৃতি বন্দি আর হারানো দিনের আড্ডা।', 'bagbari-reunion-sejan' ); ?></p>
					</div>
					<span class="absolute left-0 sm:left-1/2 top-1 -translate-x-1/2 w-4 h-4 rounded-full bg-gold ring-4 ring-maroon"></span>
				</div>
				<div class="relative pl-16 sm:pl-0 sm:grid sm:grid-cols-2 sm:gap-10 timeline-item">
					<div class="sm:text-right sm:pr-10">
						<p class="font-display text-gold text-lg"><?php esc_html_e( 'বিকেল ৪:০০ টা', 'bagbari-reunion-sejan' ); ?></p>
						<h3 class="font-display text-xl text-paper mt-1"><?php esc_html_e( 'ব্যাচভিত্তিক ফটোসেশন ও মুক্তমঞ্চ', 'bagbari-reunion-sejan' ); ?></h3>
						<p class="text-paper/70 mt-2 leading-relaxed"><?php esc_html_e( 'বিকেলের নরম আলোয় ব্যাচভিত্তিক গ্রুপ ছবি, আর মুক্তমঞ্চে গান-কবিতা-হাসির পরিবেশনা।', 'bagbari-reunion-sejan' ); ?></p>
					</div>
					<div></div>
					<span class="absolute left-0 sm:left-1/2 top-1 -translate-x-1/2 w-4 h-4 rounded-full bg-gold ring-4 ring-maroon"></span>
				</div>
				<div class="relative pl-16 sm:pl-0 sm:grid sm:grid-cols-2 sm:gap-10 timeline-item">
					<div></div>
					<div class="sm:pl-10">
						<p class="font-display text-gold text-lg"><?php esc_html_e( 'সন্ধ্যা ৬:৩০ টা', 'bagbari-reunion-sejan' ); ?></p>
						<h3 class="font-display text-xl text-paper mt-1"><?php esc_html_e( 'সাংস্কৃতিক সন্ধ্যা ও লাইভ কনসার্ট', 'bagbari-reunion-sejan' ); ?></h3>
						<p class="text-paper/70 mt-2 leading-relaxed"><?php esc_html_e( 'আমন্ত্রিত শিল্পী ও ব্যান্ডের সুরে, আলোকসজ্জায় মাতোয়ারা হবে চেনা ক্যাম্পাস।', 'bagbari-reunion-sejan' ); ?></p>
					</div>
					<span class="absolute left-0 sm:left-1/2 top-1 -translate-x-1/2 w-4 h-4 rounded-full bg-gold ring-4 ring-maroon"></span>
				</div>
				<div class="relative pl-16 sm:pl-0 sm:grid sm:grid-cols-2 sm:gap-10 timeline-item">
					<div class="sm:text-right sm:pr-10">
						<p class="font-display text-gold text-lg"><?php esc_html_e( 'রাত ৯:০০ টা', 'bagbari-reunion-sejan' ); ?></p>
						<h3 class="font-display text-xl text-paper mt-1"><?php esc_html_e( 'মেগা র‍্যাফেল ও বিদায়', 'bagbari-reunion-sejan' ); ?></h3>
						<p class="text-paper/70 mt-2 leading-relaxed"><?php esc_html_e( 'আকর্ষণীয় পুরস্কারের মেগা র‍্যাফেল ড্র, এরপর রাত ১০টায় আয়োজনের সমাপ্তি।', 'bagbari-reunion-sejan' ); ?></p>
					</div>
					<div></div>
					<span class="absolute left-0 sm:left-1/2 top-1 -translate-x-1/2 w-4 h-4 rounded-full bg-gold ring-4 ring-maroon"></span>
				</div>
			</div>
		</div>
	</section>

	<section id="gallery" class="relative bg-ink py-24 sm:py-32">
		<div class="max-w-7xl mx-auto px-5 sm:px-8 text-center space-y-3">
			<p class="kicker justify-center inline-flex text-gold text-sm leading-relaxed py-1"><?php esc_html_e( 'স্মৃতির ক্যানভাস', 'bagbari-reunion-sejan' ); ?></p>
			<h2 class="font-display text-3xl leading-normal sm:text-4xl md:text-[2.75rem] py-2 text-paper overflow-visible">
				<?php esc_html_e( 'ক্যামেরার ফ্রেমে,', 'bagbari-reunion-sejan' ); ?> <span class="gold-text"><?php esc_html_e( 'সময়কে হারিয়ে দেওয়া স্মৃতি', 'bagbari-reunion-sejan' ); ?></span>
			</h2>
			<p class="text-paper/75 max-w-xl mx-auto leading-relaxed"><?php esc_html_e( 'আমাদের গল্পের কিছু অমলিন মুহূর্ত — এক নজরে।', 'bagbari-reunion-sejan' ); ?></p>
		</div>
		<div class="max-w-6xl mx-auto px-5 sm:px-8 mt-20 grid sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-16">
			<div class="polaroid reveal-up -rotate-3">
				<img src="<?php echo esc_url( $assets_uri . '/classroom.webp' ); ?>" width="600" height="450" loading="lazy" decoding="async" class="w-full h-56 object-cover" alt="<?php echo esc_attr__( 'ক্লাসরুম', 'bagbari-reunion-sejan' ); ?>">
				<p class="font-display text-center text-ink/70 text-sm mt-3"><?php esc_html_e( 'আমাদের সেই প্রিয় ক্লাসরুম', 'bagbari-reunion-sejan' ); ?></p>
			</div>
			<div class="polaroid reveal-up rotate-2 sm:mt-10">
				<img src="<?php echo esc_url( $assets_uri . '/achive.webp' ); ?>" width="600" height="450" loading="lazy" decoding="async" class="w-full h-56 object-cover" alt="<?php echo esc_attr__( 'বন্ধুদের আড্ডা', 'bagbari-reunion-sejan' ); ?>">
				<p class="font-display text-center text-ink/70 text-sm mt-3"><?php esc_html_e( 'বিজয়ী হাসি আর আমাদের গল্প', 'bagbari-reunion-sejan' ); ?></p>
			</div>
			<div class="polaroid reveal-up -rotate-2">
				<img src="<?php echo esc_url( $assets_uri . '/friends.webp' ); ?>" width="600" height="450" loading="lazy" decoding="async" class="w-full h-56 object-cover" alt="<?php echo esc_attr__( 'সমাবর্তন', 'bagbari-reunion-sejan' ); ?>">
				<p class="font-display text-center text-ink/70 text-sm mt-3"><?php esc_html_e( 'স্কুল বারান্দায় জমিয়ে রাখা আমাদের গল্প', 'bagbari-reunion-sejan' ); ?></p>
			</div>
			<div class="polaroid reveal-up rotate-3">
				<img src="<?php echo esc_url( $assets_uri . '/img1.jpg' ); ?>" width="600" height="450" loading="lazy" decoding="async" class="w-full h-56 object-cover" alt="<?php echo esc_attr__( 'লাইব্রেরি', 'bagbari-reunion-sejan' ); ?>">
				<p class="font-display text-center text-ink/70 text-sm mt-3"><?php esc_html_e( 'সিঁড়িতে বসা সেই পড়ালেখার দিনগুলো', 'bagbari-reunion-sejan' ); ?></p>
			</div>
			<div class="polaroid reveal-up -rotate-2 sm:mt-10">
				<img src="<?php echo esc_url( $assets_uri . '/football.webp' ); ?>" width="600" height="450" loading="lazy" decoding="async" class="w-full h-56 object-cover" alt="<?php echo esc_attr__( 'খেলার মাঠ', 'bagbari-reunion-sejan' ); ?>">
				<p class="font-display text-center text-ink/70 text-sm mt-3"><?php esc_html_e( 'বিকেলের ফুটবল আর বিজয়ের উল্লাস', 'bagbari-reunion-sejan' ); ?></p>
			</div>
			<div class="polaroid reveal-up rotate-2">
				<img src="<?php echo esc_url( $assets_uri . '/img2.webp' ); ?>" width="600" height="450" loading="lazy" decoding="async" class="w-full h-56 object-cover" alt="<?php echo esc_attr__( 'উৎসব', 'bagbari-reunion-sejan' ); ?>">
				<p class="font-display text-center text-ink/70 text-sm mt-3"><?php esc_html_e( 'এক ফ্রেমে বন্দি শৈশবের শুদ্ধ আনন্দ', 'bagbari-reunion-sejan' ); ?></p>
			</div>
		</div>
	</section>

	<section id="sponsors" class="relative bg-paper text-ink py-24 sm:py-32 overflow-hidden">
		<div class="grain" style="--grain-opacity:.06"></div>
		<div class="relative max-w-6xl mx-auto px-5 sm:px-8">
			<div class="text-center">
				<p class="kicker justify-center inline-flex text-maroon text-sm leading-relaxed py-1"><?php esc_html_e( 'স্পন্সর ও পৃষ্ঠপোষক', 'bagbari-reunion-sejan' ); ?></p>
				<h2 class="font-display text-3xl sm:text-4xl md:text-[2.75rem] leading-[1.45] py-2 mt-2"><?php esc_html_e( 'যাদের পাশে থাকায় সম্ভব এই আয়োজন', 'bagbari-reunion-sejan' ); ?></h2>
				<p class="text-ink/70 max-w-2xl mx-auto leading-[1.7]"><?php esc_html_e( "প্রাক্তন শিক্ষার্থী ও শুভানুধ্যায়ী প্রতিষ্ঠানগুলোর অকুণ্ঠ পৃষ্ঠপোষকতায় গড়ে উঠছে স্মৃতির আঙিনায় '২৬।", 'bagbari-reunion-sejan' ); ?></p>
			</div>
			<?php
			$sponsors_q = new WP_Query( array( 'post_type' => 'sponsors', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC', 'no_found_rows' => true, 'update_post_meta_cache' => false, 'update_post_term_cache' => false ) );
			if ( $sponsors_q->have_posts() ) :
				?>
			<div class="mt-12 sm:mt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
				<?php while ( $sponsors_q->have_posts() ) : $sponsors_q->the_post(); ?>
					<div class="sponsor-card sponsor-anim bg-white/60 border border-amber-900/10 rounded-xl p-5 flex flex-col items-center text-center gap-3 transition-all duration-300 hover:border-maroon/35 hover:scale-[1.03]">
						<div class="h-20 md:h-24 w-full flex items-center justify-center">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php echo get_the_post_thumbnail( get_the_ID(), 'medium', array( 'class' => 'sponsor-logo max-h-full max-w-full object-contain', 'loading' => 'lazy', 'decoding' => 'async', 'alt' => get_the_title() ) ); ?>
							<?php endif; ?>
						</div>
						<p class="font-display text-lg leading-[1.5] py-0.5"><?php echo esc_html( get_the_title() ); ?></p>
					</div>
				<?php endwhile; ?>
			</div>
				<?php wp_reset_postdata(); endif; ?>
			<div class="mt-16 text-center sponsor-anim">
				<p class="text-ink/60 leading-[1.7]"><?php esc_html_e( 'আপনার প্রতিষ্ঠানও এই আয়োজনের অংশ হতে চায়?', 'bagbari-reunion-sejan' ); ?></p>
				<a href="mailto:sponsor@bagbari-reunion.com" class="link-arrow inline-flex items-center gap-2 mt-5 rounded-full bg-maroon text-paper font-semibold px-7 py-3.5 hover:bg-ink transition-colors">
					<?php esc_html_e( 'স্পন্সর হতে চাই', 'bagbari-reunion-sejan' ); ?> <span class="arw" aria-hidden="true">→</span>
				</a>
			</div>
		</div>
	</section>

	<section id="pricing" class="relative bg-maroon py-24 sm:py-32 overflow-hidden">
		<div class="grain"></div>
		<div class="pointer-events-none absolute -top-24 -right-24 w-[32rem] h-[32rem] glow-gold opacity-50"></div>
		<div class="pointer-events-none absolute -bottom-32 -left-24 w-[34rem] h-[34rem] glow-maroon opacity-60"></div>
		<div class="relative max-w-2xl mx-auto px-5 sm:px-8">
			<div class="text-center">
				<p class="kicker justify-center inline-flex text-gold text-sm"><?php esc_html_e( 'অ্যালুমনাই পাস', 'bagbari-reunion-sejan' ); ?></p>
				<h2 class="font-display text-3xl sm:text-4xl md:text-[2.75rem] mt-4 text-paper"><?php esc_html_e( 'একটি পাস, সারা দিনের', 'bagbari-reunion-sejan' ); ?> <span class="gold-text"><?php esc_html_e( 'অমূল্য স্মৃতি', 'bagbari-reunion-sejan' ); ?></span></h2>
				<p class="mt-5 text-paper/75 max-w-lg mx-auto leading-relaxed"><?php esc_html_e( 'দিনভর আড্ডা, আপ্যায়ন আর সাংস্কৃতিক সন্ধ্যা—সব মিলিয়ে এক অবিস্মরণীয় দিন।', 'bagbari-reunion-sejan' ); ?></p>
			</div>
			<div class="pass reveal-up mt-14" aria-label="<?php echo esc_attr__( 'অ্যালুমনাই পাস ২০২৬', 'bagbari-reunion-sejan' ); ?>">
				<div class="px-7 sm:px-10 pt-7 pb-6 text-center">
					<div class="pass-slot mx-auto" aria-hidden="true"></div>
					<p class="mt-5 text-[11px] tracking-[.3em] text-gold/85">Alumni Pass</p>
					<h3 class="font-display text-3xl sm:text-4xl mt-2 gold-text"><?php esc_html_e( 'অ্যালুমনাই পাস', 'bagbari-reunion-sejan' ); ?></h3>
					<p class="text-paper/50 text-xs mt-1"><?php esc_html_e( "স্মৃতির আঙিনায় '২৬ · বাগবাড়ী কলিম মাহমুদ উচ্চ বিদ্যালয়", 'bagbari-reunion-sejan' ); ?></p>
				</div>
				<div class="px-7 sm:px-10 grid grid-cols-3 gap-2 text-center border-y border-gold/15 py-4">
					<div>
						<p class="pass-label"><?php esc_html_e( 'তারিখ', 'bagbari-reunion-sejan' ); ?></p>
						<p class="font-display text-paper mt-1"><?php echo esc_html( $brc['event_date'] ); ?></p>
					</div>
					<div class="border-x border-gold/15">
						<p class="pass-label"><?php esc_html_e( 'বার', 'bagbari-reunion-sejan' ); ?></p>
						<p class="font-display text-paper mt-1"><?php echo esc_html( $brc_has_split ? $brc_time_parts[0] : $brc['event_time'] ); ?></p>
					</div>
					<div>
						<p class="pass-label"><?php esc_html_e( 'সময়', 'bagbari-reunion-sejan' ); ?></p>
						<p class="font-display text-paper mt-1"><?php echo esc_html( $brc_has_split ? $brc_time_parts[1] : $brc['event_time'] ); ?></p>
					</div>
				</div>
				<div class="px-7 sm:px-10 py-6">
					<p class="pass-label mb-4"><?php esc_html_e( 'পাসে অন্তর্ভুক্ত', 'bagbari-reunion-sejan' ); ?></p>
					<ul class="space-y-3 text-sm text-paper/85">
						<li class="flex gap-3"><span class="text-gold" aria-hidden="true">✓</span> <?php esc_html_e( 'দিনব্যাপী সকল ইভেন্টে প্রবেশাধিকার', 'bagbari-reunion-sejan' ); ?></li>
						<li class="flex gap-3"><span class="text-gold" aria-hidden="true">✓</span> <?php esc_html_e( 'সকালের নাস্তা, মধ্যাহ্নভোজ', 'bagbari-reunion-sejan' ); ?></li>
						<li class="flex gap-3"><span class="text-gold" aria-hidden="true">✓</span> <?php esc_html_e( 'স্মরণিকা কিট ও আকর্ষণীয় স্যুভেনির', 'bagbari-reunion-sejan' ); ?></li>
						<li class="flex gap-3"><span class="text-gold" aria-hidden="true">✓</span> <?php esc_html_e( 'লাইভ কনসার্ট ও সাংস্কৃতিক অনুষ্ঠান', 'bagbari-reunion-sejan' ); ?></li>
					</ul>
					<p class="text-xs text-paper/55 mt-5"><?php esc_html_e( 'পরিবারের অতিরিক্ত সদস্যের জন্য প্রতি জন মাত্র', 'bagbari-reunion-sejan' ); ?> <span class="text-xl text-gold font-semibold"> ৳৫০০ </span></p>
				</div>
				<div class="pass-perf" aria-hidden="true"></div>
				<div class="px-7 sm:px-10 py-7">
					<div class="flex items-center justify-between gap-6">
						<div>
							<p class="pass-label"><?php esc_html_e( 'পাসের মূল্য', 'bagbari-reunion-sejan' ); ?></p>
							<p class="font-display text-4xl sm:text-5xl mt-1 gold-text"><?php echo esc_html( $brc['pass_price'] ); ?></p>
							<p class="text-xs text-paper/50 mt-1"><?php esc_html_e( 'প্রতি জন', 'bagbari-reunion-sejan' ); ?></p>
						</div>
						<div class="seal w-16 h-16 sm:w-20 sm:h-20 grid place-items-center shrink-0" aria-hidden="true">
							<span class="font-display text-2xl">✺</span>
						</div>
					</div>
					<div class="barcode mt-6" aria-hidden="true"></div>
					<p class="text-center text-[10px] tracking-[.35em] text-paper/45 mt-2">BKMHS · 2026 · 0159</p>
					<a href="<?php echo esc_url( $register_url ); ?>" class="btn-gold mt-6 w-full inline-flex justify-center items-center rounded-full font-semibold px-6 py-4">
						<?php esc_html_e( 'রেজিস্ট্রেশন করুন', 'bagbari-reunion-sejan' ); ?>
					</a>
					<p class="text-center text-[11px] text-paper/45 mt-3">🔒 <?php esc_html_e( '১০০% নিরাপদ পেমেন্ট · পছন্দনীয় মাধ্যমে সহজ পেমেন্ট', 'bagbari-reunion-sejan' ); ?></p>
				</div>
			</div>
		</div>
	</section>

<?php
get_footer();
