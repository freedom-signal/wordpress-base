<?php
if ( get_field( 'podcast' ) ):
	$podcasts = get_field( 'podcast' );
elseif ( get_sub_field( 'podcast' ) ):
	$podcasts = get_sub_field( 'podcast' );
endif;

if ( $podcasts['category'] ):
	$the_query = new WP_Query( array(
		'post_type' => 'resource',
		'orderby'   => 'menu_order',
		'order'     => 'ASC',
		'tax_query' => array(
			array(
				'taxonomy' => 'type',
				'field'    => 'term_id',
				'terms'    => $podcasts['category'],
			)
		),
	) );

	if ( $the_query->have_posts() ): ?>
		<section class="flexible flexible--podcasts">
			<div class="main-container">
				<div class="main-grid">
					<div class="flexible--podcasts--container">
						<?php if ( $podcasts['title'] ): ?>
							<h2><?= $podcasts['title']; ?></h2>
						<?php endif; ?>
						<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
							<div class="flexible--podcasts--single">
								<a href="<?= get_field( 'link' ); ?>" target="<?php if ( get_field( 'target_blank' ) ) {
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
