<?php
if ( get_field( 'call_to_action' ) ):
	$cta = get_field( 'call_to_action' );
elseif ( get_sub_field( 'call_to_action' ) ):
	$cta = get_sub_field( 'call_to_action' );
endif;

if ( $cta['link'] ): ?>
	<section class="flexible flexible--cta">
		<div class="main-container">
			<div class="main-grid">
				<div class="flexible--cta--container">
					<h2 class="flexible--cta--title"><?= $cta['title'] ?></h2>
					<a class="button button-round button-large" href="<?= $cta['link']; ?>">
						<?= $cta['button_text'] ?>
					</a>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
