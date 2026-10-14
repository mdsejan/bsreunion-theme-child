<?php
/**
 * 404 — Page not found template.
 *
 * Custom, self-contained error page matching the registration page's deep
 * crimson + gold design system. Styles are inlined so no extra stylesheet
 * request is required.
 *
 * @package Bagbari_Reunion_Child
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main error-404-container">
	<div class="grain" aria-hidden="true"></div>
	<span class="e404-glow e404-glow--gold" aria-hidden="true"></span>
	<span class="e404-glow e404-glow--vignette" aria-hidden="true"></span>

	<div class="e404-inner">
		<figure class="e404-art" aria-hidden="true">
			<svg width="240" height="200" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false">
				<defs>
					<linearGradient id="e404Gold" x1="0" y1="0" x2="1" y2="1">
						<stop offset="0" stop-color="#f2d27a" />
						<stop offset="55%" stop-color="#e3b156" />
						<stop offset="100%" stop-color="#c99a2e" />
					</linearGradient>
				</defs>
				<circle cx="100" cy="100" r="74" stroke="url(#e404Gold)" stroke-opacity="0.32" stroke-width="1.5" stroke-dasharray="6 10" />
				<path d="M28 138 C 58 100 82 152 110 120 S 156 88 176 116" stroke="url(#e404Gold)" stroke-opacity="0.6" stroke-width="2" stroke-linecap="round" stroke-dasharray="2 9" />
				<path d="M100 48c-15.5 0-28 12.5-28 28 0 21 28 48 28 48s28-27 28-48c0-15.5-12.5-28-28-28Z" fill="url(#e404Gold)" />
				<circle cx="100" cy="76" r="9.5" fill="#4a0d18" />
				<circle cx="100" cy="76" r="4" fill="#f2d27a" />
			</svg>
		</figure>

		<p class="kicker e404-kicker"><?php esc_html_e( 'Error 404', 'bagbari-reunion-sejan' ); ?></p>

		<h1 class="e404-title font-display"><?php esc_html_e( '404 - পৃষ্ঠাটি পাওয়া যায়নি', 'bagbari-reunion-sejan' ); ?></h1>

		<p class="e404-sub"><?php esc_html_e( 'আপনি যে লিঙ্কটি খুঁজছেন তা হয়তো মুছে ফেলা হয়েছে অথবা ঠিকানাটি ভুল লিখা হয়েছে।', 'bagbari-reunion-sejan' ); ?></p>

		<div class="e404-actions">
			<a class="btn-gold e404-cta" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="e404-cta-ico" aria-hidden="true">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10.5 12 3l9 7.5" /><path d="M5 9.5V21h14V9.5" /><path d="M9.5 21v-5.5h5V21" /></svg>
				</span>
				<?php esc_html_e( 'হোম পেজে ফিরে যান', 'bagbari-reunion-sejan' ); ?>
			</a>
		</div>
	</div>
</main>

<style>
	/* Full-bleed reset — kill any theme wrapper margins/padding on the 404 page. */
	body.error404,
	body.error404 #page,
	body.error404 .site-content,
	body.error404 .site-main,
	body.error404 #content {
		width: 100%;
		max-width: 100%;
		margin: 0;
		padding: 0;
	}
	body.error404 {
		margin: 0;
		padding: 0;
		overflow-x: hidden;
		background: #4a0d18;
	}

	.error-404-container {
		position: relative;
		display: flex;
		align-items: center;
		justify-content: center;
		width: 100vw;
		max-width: 100%;
		min-height: 100vh;
		margin: 0;
		padding: 0;
		overflow: hidden;
		background: linear-gradient(135deg, #741728 0%, #4a0d18 100%);
	}

	.e404-inner {
		position: relative;
		z-index: 1;
		width: 100%;
		max-width: 40rem;
		margin: 0 auto;
		padding: 8rem 1.25rem 4.5rem; /* top padding clears the fixed header */
		display: flex;
		flex-direction: column;
		align-items: center;
		text-align: center;
	}

	.e404-glow {
		position: absolute;
		border-radius: 9999px;
		pointer-events: none;
		z-index: 0;
	}
	.e404-glow--gold {
		top: -9rem;
		right: -7rem;
		width: 34rem;
		height: 34rem;
		background: radial-gradient(50% 50% at 50% 50%, rgba(227, 177, 86, 0.34), transparent 70%);
		opacity: 0.6;
	}
	.e404-glow--vignette {
		bottom: -12rem;
		left: -10rem;
		width: 36rem;
		height: 36rem;
		background: radial-gradient(50% 50% at 50% 50%, rgba(0, 0, 0, 0.42), transparent 70%);
		opacity: 0.6;
	}

	.e404-art {
		margin: 0 0 0.5rem;
		line-height: 0;
		filter: drop-shadow(0 18px 30px rgba(227, 177, 86, 0.2));
		animation: e404-float 6s ease-in-out infinite;
	}
	.e404-art svg {
		width: clamp(10rem, 45vw, 14rem);
		height: auto;
	}

	.e404-kicker {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		margin: 0;
		padding: 0.45rem 1.05rem;
		border: 1px solid rgba(227, 177, 86, 0.42);
		border-radius: 9999px;
		background: rgba(0, 0, 0, 0.28);
		color: #e3b156;
		font-size: 0.85rem;
		letter-spacing: 0.06em;
		line-height: 1;
	}

	.e404-title {
		margin: 1.15rem 0 0;
		font-size: clamp(1.7rem, 5.5vw, 2.7rem);
		line-height: 1.3;
		color: #e3b156;
	}

	.e404-sub {
		max-width: 34rem;
		margin: 1.05rem 0 0;
		font-size: 1.0625rem;
		line-height: 1.85;
		color: #ffffff;
	}

	.e404-actions {
		margin-top: 2rem;
	}

	.e404-cta {
		display: inline-flex;
		align-items: center;
		gap: 0.6rem;
		border-radius: 9999px;
		padding: 0.9rem 1.9rem;
		font-size: 1rem;
		font-weight: 600;
		text-decoration: none;
	}
	.e404-cta-ico {
		display: inline-flex;
		line-height: 0;
	}
	.e404-cta:hover .e404-cta-ico {
		transform: translateY(-1px);
	}

	@keyframes e404-float {
		0%,
		100% {
			transform: translateY(0);
		}
		50% {
			transform: translateY(-9px);
		}
	}

	@media (max-width: 640px) {
		.e404-inner {
			padding: 6.75rem 1.1rem 3.5rem;
		}
	}

	@media (prefers-reduced-motion: reduce) {
		.e404-art {
			animation: none;
		}
		.btn-gold {
			transition: none;
		}
	}
</style>

<?php
get_footer();
