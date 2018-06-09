<?php
if ( get_field( 'donate' ) ):
	$donate = get_field( 'donate' );
elseif ( get_sub_field( 'donate' ) ):
	$donate = get_sub_field( 'donate' );
endif;
if ( $donate['columns'] ): ?>
	<section class="flexible flexible--donate">
		<div class="main-container">
			<div class="main-grid">
				<div class="flexible--donate--container">
					<?php foreach ( $donate['columns'] as $key => $column ): ?>
						<div class="flexible--donate--single">
							<div class="flexible--donate--background">
								<div class="flexible--donate--single-image">
									<img src="<?= $column['icon']; ?>"/>
								</div>
								<div class="flexible--donate--single-content">
									<h3 class="flexible--donate--single-content--title"><?= $column['column_title']; ?></h3>
									<?= $column['content']; ?>
									<div class="sas-donate-form">
										<div class="sas-donate-form--input-group">
											<span class="sas-donate-form--input-group--label sas-donate-form--input-group--label-symbol">
												<?= __( '$', 'foundationpress' ) ?>
											</span>
											<input type="text" name="amount" class="sas-donate-form--input-group--field" placeholder="xx" tabindex="-1"/>
											<span class="sas-donate-form--input-group--label sas-donate-form--input-group--label-cents">
												<?= __( '.00', 'foundationpress' ); ?>
											</span>
											<span class="sas-donate-form--input-group--label sas-donate-form--input-group--label-currency">
												<?= __( 'USD', 'foundationpress' ); ?>
											</span>
										</div>
										<div class="sas-donate-form--credit-card">
											<?php if ( $column['form'] && function_exists( 'gravity_form' ) ):
												gravity_form_enqueue_scripts( $column['form'], true );
												gravity_form( $column['form'], false, false, false, null, true );
											endif; ?>
										</div>
										<?php $text = __( 'Contribute', 'foundationpress' ); ?>
										<?php if ( $column['button_text'] ):
											$text = $column['button_text'];
										endif; ?>
										<button class="sas-donate-form--button">
											<?= $text; ?>
										</button>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<?php if ( $donate['section_footer'] ): ?>
					<div class="flexible--donate--footer">
						<h3><?= $donate['section_footer']; ?></h3>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif; ?>
