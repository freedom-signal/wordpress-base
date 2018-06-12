<?php
if ( get_field( 'directors' ) ):
	$directors = get_field( 'directors' );
elseif ( get_sub_field( 'directors' ) ):
	$directors = get_sub_field( 'directors' );
endif;

if ( $directors['category'] ):
	$the_query = new WP_Query( array(
		'posts_per_page' => - 1,
		'post_type'      => 'team',
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'tax_query'      => array(
			array(
				'taxonomy' => 'organization',
				'field'    => 'term_id',
				'terms'    => $directors['category'],
			)
		),
	) );

	if ( $the_query->have_posts() ): ?>
		<section class="flexible flexible--directors">
			<div class="main-container">
				<div class="main-grid">
					<div class="flexible--directors--container">
						<?php if ( $directors['title'] ): ?>
							<h2 class="flexible--directors--title"><?= $directors['title']; ?></h2>
						<?php endif; ?>
						<?php while ( $the_query->have_posts() ):
						$the_query->the_post(); ?>
						<div class="flexible--directors--single">
							<?php if ( get_field( 'email' ) ): ?>
							<a href="mailto:<?php the_field( 'email' ); ?>">
								<?php else: ?>
								<div class="flexible--directors--single-container">
									<?php endif; ?>
									<?php
									$thumbnail = get_stylesheet_directory_uri() . '/dist/assets/images/member.png';
									if ( has_post_thumbnail() ):
										$thumbnail = get_the_post_thumbnail_url();
									endif; ?>
									<div class="flexible--directors--single-image" style="background-image: url('<?= $thumbnail; ?>')">
										<div class="flexible--directors--single-image--hover">
											<?= __( 'Questions?', 'foundationpress' ); ?>
											<?= __( 'Email Me!', 'foundationpress' ); ?>
										</div>
									</div>
									<div class="flexible--directors--single-content">
										<?php the_title( '<h2>', '</h2>' ); ?>
										<h3><?php the_field( 'title' ); ?></h3>
									</div>
									<?php if ( get_field( 'email' ) ): ?>
							</a>
							<?php else: ?>
						</div>
					<?php endif; ?>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
			</div>
		</section>
	<?php endif;
	wp_reset_postdata();
endif; ?>


