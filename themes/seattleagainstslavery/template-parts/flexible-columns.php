<?php
if ( get_field( 'columns' ) ):
	$columns = get_field( 'columns' );
elseif ( get_sub_field( 'columns' ) ):
	$columns = get_sub_field( 'columns' );
endif;
if ( $columns['columns'] ): ?>
	<section class="flexible flexible--columns">
		<div class="main-container">
			<div class="main-grid">
				<div class="flexible--columns--container">
					<?php if ( $columns['section_title'] ): ?>
						<h2><?= $columns['section_title']; ?></h2>
					<?php endif; ?>
					<?php foreach ( $columns['columns'] as $column ): ?>
						<div class="flexible--columns--single">
							<div class="flexible--columns--single-image">
								<img src="<?= $column['icon']; ?>"/>
							</div>
							<div class="flexible--columns--single-content">
								<h3 class="flexible--columns--single-content--title"><?= $column['column_title']; ?></h3>
								<?= $column['content']; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="flexible--columns--footer">
					<?php if ( $columns['section_footer'] ): ?>
						<h3><?= $columns['section_footer']; ?></h3>
					<?php endif; ?>
					<?php if ( $columns['section_footer_link'] ): ?>
						<a class="button button-round button-large green" href="<?= $columns['section_footer_link']['url']; ?>">
							<?= $columns['section_footer_link']['button_text']; ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
