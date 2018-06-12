<?php
/**
 * The front page template file
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header();
$slider = get_field( 'slider' );
$slides = $slider['sliders']; ?>
<main class="main-content-full-width">
	<?php if ( $slides ): ?>
		<section class="header-container">
			<div class="sas-hero" role="region"
			     aria-label="Seattle Against Slavery Homepage Slider">
				<?php foreach ( $slides as $key => $slide ): ?>
					<div class="sas-hero-slide" style="background-image: url(<?= $slide['image']; ?>);">
						<div class="sas-hero-slide-container">
							<div class="sas-hero-slide-caption">
								<?= $slide['caption']; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>
	<?php get_template_part( 'template-parts/flexible', 'events' ); ?>
	<?php get_template_part( 'template-parts/flexible', 'cta' ); ?>
</main>
<?php get_footer(); ?>
