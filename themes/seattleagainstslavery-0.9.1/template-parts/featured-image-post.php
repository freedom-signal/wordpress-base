<section class="featured-image--post--container">
	<div class="featured-image--post--image-container">
		<?php
		$url     = '';
		$classes = 'featured-image--post--image';
		if ( has_post_thumbnail( $post->ID ) ) :
			$classes .= ' featured-image--post--image-single'; ?>
			<div class="<?= $classes; ?>" role="banner"
			     data-interchange="[<?php the_post_thumbnail_url( 'featured-small' ); ?>, small], [<?php the_post_thumbnail_url( 'featured-medium' ); ?>, medium], [<?php the_post_thumbnail_url( 'featured-large' ); ?>, large], [<?php the_post_thumbnail_url( 'featured-xlarge' ); ?>, xlarge]">
			</div>
		<?php else:
			$classes .= ' featured-image--post--image-default'; ?>
			<div class="<?= $classes; ?>"></div>
		<?php endif; ?>
	</div>
	<div class="featured-image--post--title">
		<h1><?php the_title(); ?>
	</div>
</section>
