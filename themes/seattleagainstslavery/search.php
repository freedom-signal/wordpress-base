<?php
/**
 * The template for displaying search results pages.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header();
get_template_part( 'template-parts/featured-image', 'search' ); ?>
<section class="flexible flexible--search">
	<div class="main-container">
		<div class="main-grid">
			<header>
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content', 'search' ); ?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part( 'template-parts/content', 'none' ); ?>
				<?php endif; ?>
				<nav class="post-navigation" id="post-nav">
					<div class="post-navigation--next">
						<?php previous_posts_link( __( 'View newer', 'foundationpress' ) ); ?>
					</div>
					<div class="post-navigation--previous">
						<?php next_posts_link( __( 'View older', 'foundationpress' ) ); ?>
					</div>
				</nav>
				<div class="post-border">
					<hr>
				</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
