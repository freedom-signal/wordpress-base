<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>
<?php get_template_part( 'template-parts/featured-image', '404' ); ?>
	<section class="flexible flexible--not-found">
		<div class="main-container">
			<div class="main-grid">
				<div class="flexible--not-found--container">
					<h2><?= __( 'Please try the following:', 'foundationpress' ); ?></h2>
					<ul>
						<li><?= __( 'Check your spelling', 'foundationpress' ); ?></li>
						<li>
							<?php printf(
								__( 'Return to the <a href="%s">home page</a>', 'foundationpress' ),
								home_url() ); ?>
						</li>
						<li><?= __( 'Click the <a href="javascript:history.back()">Back</a> button', 'foundationpress' ); ?></li>
					</ul>
				</div>
			</div>
		</div>
	</section>
<?php get_footer();
