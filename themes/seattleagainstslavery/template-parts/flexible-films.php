<?php
if ( get_field( 'films' ) ):
	$films = get_field( 'films' );
elseif ( get_sub_field( 'films' ) ):
	$films = get_sub_field( 'films' );
endif;

if ( $films['category'] ):
	$the_query = new WP_Query( array(
		'post_type' => 'resource',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'tax_query' => array(
			array(
				'taxonomy' => 'type',
				'field'    => 'term_id',
				'terms'    => $films['category'],
			)
		),
	) );

	if ( $the_query->have_posts() ): ?>
		<section class="flexible flexible--films">
			<div class="main-container">
				<div class="main-grid">
					<div class="flexible--films--container">
						<?php if ( $films['title'] ): ?>
							<h2><?= $films['title']; ?></h2>
						<?php endif; ?>
						<?php if ( $films['subtitle'] ): ?>
							<h3><?= $films['subtitle']; ?></h3>
						<?php endif; ?>
						<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
							<div class="flexible--films--single">
								<a href="<?= get_field( 'link' ); ?>" target="<?php if ( get_field( 'target_blank' ) ) {
									echo '_blank';
								} ?>">
									<span><?php the_title() ?></span>
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
