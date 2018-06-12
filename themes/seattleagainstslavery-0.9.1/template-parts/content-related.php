<?php
$orig_post = $post;
global $post;
$categories = get_the_category( $post->ID );

if ( $categories ) :
	$category_ids = array();

	foreach ( $categories as $individual_category ) :
		$category_ids[] = $individual_category->term_id;
	endforeach;

	$args = array(
		'category__in'   => $category_ids,
		'post__not_in'   => array( $post->ID ),
		'posts_per_page' => 1
	);

	$query = new wp_query( $args );

	if ( $query->have_posts() ): ?>
		<hr/>
		<div class="content--post-related">
			<?php while ( $query->have_posts() ): $query->the_post();
				if ( has_post_thumbnail() ) :
					$url = get_the_post_thumbnail_url(); ?>
					<div class="content--post-related--image" style="background-image: url('<?= $url; ?>')"></div>
				<?php endif; ?>
				<div class="content--post-related--content">
					<h2 class="content--post-content--title"><?php the_title(); ?></h2>
					<span class="content--post-content--meta">
						<?php foundationpress_entry_meta(); ?>
					</span>
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" class="button button-large button-right secondary">
						<?= __( 'Read more', 'foundationpress' ); ?>
					</a>
				</div>
			<? endwhile; ?>
		</div>
		<hr/>
	<?php endif;
endif;
$post = $orig_post;
wp_reset_query(); ?>
