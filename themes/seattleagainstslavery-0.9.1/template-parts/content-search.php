<article id="post-<?php the_ID(); ?>" <?php post_class( 'content--post-container' ); ?>>
	<div class="content--post-related">
		<?php if ( has_post_thumbnail() ) :
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
	</div>
</article>
<div class="post-border">
	<hr>
</div>

