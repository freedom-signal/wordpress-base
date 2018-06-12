<?php
/*
Template Name: Kitchen Sink
*/
get_header();

if ( have_rows( 'content_section' ) ):
	while ( have_rows( 'content_section' ) ) : the_row();
		if ( get_row_layout() == 'cta_section' ):
			get_template_part( 'template-parts/flexible', 'cta' );
		elseif ( get_row_layout() == 'sliders_section' ):
			get_template_part( 'template-parts/flexible', 'events' );
		elseif ( get_row_layout() == 'events_section' ):
			get_template_part( 'template-parts/flexible', 'events' );
		elseif ( get_row_layout() == 'row_section' ):
			get_template_part( 'template-parts/flexible', 'columns' );
		elseif ( get_row_layout() == 'films_section' ):
			get_template_part( 'template-parts/flexible', 'films' );
		elseif ( get_row_layout() == 'podcast_section' ):
			get_template_part( 'template-parts/flexible', 'podcast' );
		elseif ( get_row_layout() == 'books_section' ):
			get_template_part( 'template-parts/flexible', 'books' );
		elseif ( get_row_layout() == 'orgs_section' ):
			get_template_part( 'template-parts/flexible', 'organizations' );
		elseif ( get_row_layout() == 'brochures_section' ):
			get_template_part( 'template-parts/flexible', 'brochures' );
		elseif ( get_row_layout() == 'staff_section' ):
			get_template_part( 'template-parts/flexible', 'staff' );
		elseif ( get_row_layout() == 'directors_section' ):
			get_template_part( 'template-parts/flexible', 'directors' );
		elseif (get_row_layout() == 'content_section'):
			get_template_part( 'template-parts/flexible', 'content' );
		elseif (get_row_layout() == 'volunteer_section'):
			get_template_part( 'template-parts/flexible', 'positions' );
		endif;
	endwhile;
endif;
get_footer(); ?>
