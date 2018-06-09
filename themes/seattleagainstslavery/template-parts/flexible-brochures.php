<?php $brochures = get_field( 'brochures' );

if ( $brochures['category'] ):
	$the_query = new WP_Query( array(
		'post_type' => 'resource',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'tax_query' => array(
			array(
				'taxonomy' => 'type',
				'field'    => 'term_id',
				'terms'    => $brochures['category'],
			)
		),
	) );

	if ( $the_query->have_posts() ): ?>
		<section class="flexible flexible--brochures">
			<div class="main-container">
				<div class="main-grid">
					<div class="flexible--brochures--container">
						<?php if ( $brochures['title'] ): ?>
							<h2><?= $brochures['title']; ?></h2>
						<?php endif; ?>
						<?php if ( $brochures['subtitle'] ): ?>
							<h3><?= $brochures['subtitle']; ?></h3>
						<?php endif; ?>
						<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
							<div class="flexible--brochures--single">
								<a href="<?= get_field('url'); ?>" target="<?php if ( get_field( 'target_blank' ) ) {
									echo '_blank';
								} ?>"><?php the_title() ?></a>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif;
	wp_reset_postdata();
endif; ?>
