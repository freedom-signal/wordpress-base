<?php
/**
 * The author template file
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>
<div class="main-container">
	<div class="main-grid">
		<main class="main-content-full-width">
			<?php get_template_part( 'template-parts/author', 'bio' ); ?>
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', get_post_format() === null ? get_post_format() : get_post_type() ); ?>
				<?php endwhile; ?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
			<div class="post-border">
				<hr>
			</div>
			<nav class="post-navigation" id="post-nav">
				<div class="post-navigation--next"><?php previous_posts_link( __( 'View newer', 'foundationpress' ) ); ?></div>
				<div class="post-navigation--previous"><?php next_posts_link( __( 'View older', 'foundationpress' ) ); ?></div>
			</nav>
			<div class="post-border">
				<hr>
			</div>
		</main>
	</div>
</div>
<?php get_footer(); ?>
