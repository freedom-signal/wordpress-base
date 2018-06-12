<?php
$background = '';
$class      = '';
if ( has_post_thumbnail( $post->ID ) ):
	$background = get_the_post_thumbnail_url( $post->ID );
	$class      = 'featured-hero--thumbnail';
endif;
?>

<div class="featured-hero featured-hero--red <?= $class; ?>" style="background-image: url(<?= $background; ?>)">
	<div class="main-container">
		<div class="main-grid">
			<div class="featured-hero--container">
				<?= $post->post_content ?>
			</div>
		</div>
	</div>
</div>
