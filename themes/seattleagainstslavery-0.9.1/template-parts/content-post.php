<article id="post-<?php the_ID(); ?>" <?php post_class( 'content--post-container' ); ?>>
	<section class="content--post-date">
		<?php foundationpress_entry_date(); ?>
	</section>
	<section class="content--post-content">
		<header>
			<?php if ( ! is_single() ) :
				$classes = 'content--post-content--image';
				$url = get_stylesheet_directory_uri() . '/dist/assets/images/default-bg.png';
				if ( has_post_thumbnail() ):
					$url = get_the_post_thumbnail_url();
				else:
					$classes .= ' content--post-content--image-default';
				endif; ?>
				<a href="<?php the_permalink(); ?>">
					<div class="<?= $classes; ?>"
					     style="background-image: url(<?= $url ?>);">
					</div>
				</a>
			<?php endif; ?>
			<?php if ( is_single() ) : ?>
				<?php if ( get_field( 'post_subtitle' ) ): ?>
					<h2 class="content--post-content--title"><?= get_field( 'post_subtitle' ); ?></h2>
				<?php endif; ?>
			<?php else :
				the_title( '<h2 class="content--post-content--title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>
			<span class="content--post-content--meta">
			<?php foundationpress_entry_meta(); ?>
			</span>
		</header>
		<div class="entry-content">
			<?php if ( is_single() ):
				the_content();
			else:
				the_excerpt(); ?>
				<a href="<?php the_permalink(); ?>"
				   class="button button-large button-right secondary"><?= __( 'Read more', 'foundationpress' ); ?></a>
			<?php endif; ?>
		</div>
	</section>
</article>
