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
	<?php if( $slides ): ?>
	<section class="header-container">
		<div class="orbit" role="region"
		     aria-label="Seattle Against Slavery Homepage Slider"
		     data-orbit data-auto-play="false">
			<div class="orbit-wrapper">
				<ul class="orbit-container">
					<?php foreach ( $slides as $key => $slide ):
					$classes = '';
					if ( $key === 0 ):
					$classes = 'is-active';
					endif; ?>
					<li class="<?= $classes; ?> orbit-slide">
						<figure class="orbit-figure">
							<img class="orbit-image" src="<?= $slide['image']; ?>"/>
							<figcaption class="orbit-caption">
								<div class="orbit-caption--container">
									<?= $slide['caption']; ?>
								</div>
							</figcaption>
						</figure>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<nav class="orbit-bullets">
				<?php foreach ( $slides as $key => $slide ):
				$classes = '';
				if ( $key === 0 ):
				$classes = 'is-active';
				endif; ?>
				<button class="<?= $classes; ?>" data-slide="<?= $key; ?>">
					<span class="show-for-sr"><?= $slide['caption']; ?></span>
				</button>
				<?php endforeach; ?>
			</nav>
		</div>
	</section>
	<?php endif; ?>
	<?php get_template_part( 'template-parts/flexible', 'events' ); ?>
	<?php get_template_part( 'template-parts/flexible', 'cta' ); ?>
</main>
<?php get_footer(); ?>
