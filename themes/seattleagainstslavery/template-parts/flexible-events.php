<?php

if(function_exists('tribe_get_events')):
$events = tribe_get_events( array(
	'posts_per_page' => 3,
) );

if ( $events ): ?>
	<section class="flexible flexible--events">
		<div class="main-container">
			<div class="main-grid">
				<div class="flexible--events--container">
					<h2 class="flexible--events--title">
						<span class="spacer"></span>
						<span><?= __( 'Upcoming Events', 'foundationpress' ); ?></span>
						<span class="spacer"></span>
					</h2>
					<div class="flexible--events--wrapper">
						<?php foreach ( $events as $event ): ?>
							<div class="flexible--events--single">
								<a href="<?= esc_url( tribe_get_events_link( $event->ID ) ); ?>">
									<h3 class="flexible--events--single--title"><?= $event->post_title; ?></h3>
									<h4 class="flexible--events--single--date">
										<?= tribe_events_event_schedule_details( $event->ID ); ?>
									</h4>
									<h4 class="flexible--events--single--venue">
										<?= tribe_get_venue( $event->ID ) ?>
									</h4>
								</a>
							</div>
						<?php endforeach; ?>
					</div>
					<?php if ( class_exists( 'Tribe__Events__Main' ) ):
						$link = esc_url( Tribe__Events__Main::instance()->getLink() ); ?>
						<div class="flexible--events--footer">
							<a class="button" href="<?= $link; ?>">
								<?= __( 'View More', 'foundationpress' ); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
	</section>
<?php endif;
endif; ?>
