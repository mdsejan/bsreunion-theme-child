<?php
/**
 * Template Name: Privacy Policy
 * Custom page template for policy / legal pages. Renders everything written
 * in the Block Editor (Gutenberg) through the_content() inside the theme's
 * dark maroon + gold content area.
 *
 * @package Bagbari_Reunion_Child
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

	<main class="relative bg-maroon overflow-hidden">
		<div class="grain" aria-hidden="true"></div>
		<div class="pointer-events-none absolute -top-32 right-0 w-[34rem] h-[34rem] glow-gold opacity-25" aria-hidden="true"></div>
		<div class="pointer-events-none absolute -bottom-32 -left-24 w-[30rem] h-[30rem] glow-maroon opacity-50" aria-hidden="true"></div>

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<header class="relative max-w-4xl mx-auto px-5 sm:px-8 pt-36 sm:pt-44 pb-8 text-center">
				<p class="kicker justify-center inline-flex text-gold text-sm"><?php esc_html_e( 'নীতিমালা', 'bagbari-reunion-sejan' ); ?></p>
				<h1 class="font-display text-3xl sm:text-4xl md:text-5xl mt-4 text-paper"><?php the_title(); ?></h1>
				<div class="mt-7 mx-auto h-px w-40 max-w-full" style="background:linear-gradient(90deg,transparent,rgba(231,178,76,.6),transparent)"></div>
			</header>

			<div class="relative max-w-4xl mx-auto px-5 sm:px-8 pb-24">
				<article class="brc-prose">
					<?php the_content(); ?>
				</article>
			</div>
			<?php
		endwhile;
		?>
	</main>

<?php
get_footer();
