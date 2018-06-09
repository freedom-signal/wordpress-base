<?php
/*
Template Name: Resources
*/
get_header(); ?>

<?php get_template_part('template-parts/featured-image', 'resources'); ?>
<?php get_template_part('template-parts/flexible', 'films'); ?>
<?php get_template_part('template-parts/flexible', 'podcasts'); ?>
<?php get_template_part('template-parts/flexible', 'books'); ?>
<?php get_template_part('template-parts/flexible', 'organizations'); ?>
<?php get_template_part('template-parts/flexible', 'brochures'); ?>
<?php get_footer();
