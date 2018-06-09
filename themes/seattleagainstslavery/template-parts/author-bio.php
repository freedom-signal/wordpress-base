<?php $author = $wp_query->get_queried_object(); ?>
<div class="author--bio">
	<div class="author--bio--content">
		<h1><?= sprintf( __('Posts by: %1$s', 'foundationpress'), $author->display_name); ?></h1>
	</div>
</div>
