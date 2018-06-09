<?php $books = get_field( 'books' );

if ( $books['category'] ):
	$the_query = new WP_Query( array(
		'post_type' => 'resource',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'tax_query' => array(
			array(
				'taxonomy' => 'type',
				'field'    => 'term_id',
				'terms'    => $books['category'],
			)
		),
	) );

	if ( $the_query->have_posts() ): ?>
		<section class="flexible flexible--books">
			<div class="main-container">
				<div class="main-grid">
					<div class="flexible--books--container">
						<?php if ( $books['title'] ): ?>
							<h2><?= $books['title']; ?></h2>
						<?php endif; ?>
						<?php if ( $books['subtitle'] ): ?>
							<h3><?= $books['subtitle']; ?></h3>
						<?php endif; ?>
						<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
							<div class="flexible--books--single">
								<a href="<?= get_field('url'); ?>" target="<?php if ( get_field( 'target_blank' ) ) {
									echo '_blank';
								} ?>">
									<span>
										<?php the_title() ?>
										<small><?= __( 'By', 'foundationpress' ); ?> <?= get_field('author'); ?></small>
									</span>
								</a>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif;
	wp_reset_postdata();
endif; ?>
