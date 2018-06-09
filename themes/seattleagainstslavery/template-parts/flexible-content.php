<?php
if ( get_field( 'free_content' ) ):
	$content = get_field( 'free_content' );
elseif ( get_sub_field( 'free_content' ) ):
	$content = get_sub_field( 'free_content' );
endif; ?>
<section class="flexible flexible--content">
	<div class="main-container">
		<div class="main-grid">
			<div class="flexible--container">
				<?php if ( $content['title'] ): ?>
					<h2><?= $content['title']; ?></h2>
				<?php endif; ?>
				<?php if ( $content['subtitle'] ): ?>
					<h3><?= $content['subtitle']; ?></h3>
				<?php endif; ?>
				<?= $content['content']; ?>
			</div>
		</div>
	</div>
</section>
