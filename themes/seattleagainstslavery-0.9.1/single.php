<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<?php get_template_part( 'template-parts/featured-image', 'post' ); ?>
	<div class="main-container">
		<div class="main-grid">
			<main class="main-content-full-width">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'post' ); ?>
					<footer>
						<?php if ( shortcode_exists( 'addtoany' ) ): ?>
							<div class="content--post-social">
								<?= do_shortcode( '[addtoany buttons="facebook,twitter,google_plus,linkedin"]' ); ?>
							</div>
						<?php endif; ?>
						<?php get_template_part( 'template-parts/content', 'related' ); ?>
						<div class="content--post-link">
							<div class="content--post-link--container">
								<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"
								   class="button button-large button-right orange"><?= __( 'View More', 'foundationpress' ); ?></a>
							</div>
						</div>
					</footer>
				<?php endwhile; ?>
			</main>
		</div>
	</div>
<?php get_footer();
