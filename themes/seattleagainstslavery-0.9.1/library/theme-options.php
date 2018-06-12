<?php
/**
 * Add postMessage support
 */
function customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

	$wp_customize->add_setting( 'sas_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sas_logo', array(
		'label'    => __( 'Logo', 'foundationpress' ),
		'section'  => 'title_tagline',
		'settings' => 'sas_logo',
	) ) );
	$wp_customize->add_setting( 'sas_logo_desktop' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sas_logo_desktop', array(
		'label'    => __( 'Desktop Logo', 'foundationpress' ),
		'section'  => 'title_tagline',
		'settings' => 'sas_logo_desktop',
	) ) );

	$wp_customize->add_section( 'api', array(
		'priority' => 30,
		'title'    => __( 'API Keys', 'foundationpress' )
	) );
	$wp_customize->add_setting( 'stripe_publishable' );
	$wp_customize->add_control( 'stripe_publishable', array(
		'label'   => __( 'Stripe Publishable Key', 'foundationpress' ),
		'section' => 'api',
		'type'    => 'text'
	) );
	$wp_customize->add_setting( 'stripe_secret' );
	$wp_customize->add_control( 'stripe_secret', array(
		'label'   => __( 'Stripe Secret Key', 'foundationpress' ),
		'section' => 'api',
		'type'    => 'text'
	) );

	$wp_customize->add_section( 'contact_social', array(
		'priority' => 30,
		'title'    => __( 'Contact & Social', 'foundationpress' )
	) );
	$wp_customize->add_setting( 'sas_phone' );
	$wp_customize->add_control( 'sas_phone', array(
		'label'   => __( 'Phone Number', 'foundationpress' ),
		'section' => 'contact_social',
		'type'    => 'text'
	) );
	$wp_customize->add_setting( 'sas_email' );
	$wp_customize->add_control( 'sas_email', array(
		'label'   => __( 'Email Address', 'foundationpress' ),
		'section' => 'contact_social',
		'type'    => 'text'
	) );
	$wp_customize->add_setting( 'sas_address' );
	$wp_customize->add_control( 'sas_address', array(
		'label'   => __( 'Main Address', 'foundationpress' ),
		'section' => 'contact_social',
		'type'    => 'textarea'
	) );
	$wp_customize->add_setting( 'sas_facebook' );
	$wp_customize->add_control( 'sas_facebook', array(
		'label'   => __( 'Facebook URL', 'foundationpress' ),
		'section' => 'contact_social',
		'type'    => 'text'
	) );
	$wp_customize->add_setting( 'sas_twitter' );
	$wp_customize->add_control( 'sas_twitter', array(
		'label'   => __( 'Twitter URL', 'foundationpress' ),
		'section' => 'contact_social',
		'type'    => 'text'
	) );
	$wp_customize->add_setting( 'sas_instagram' );
	$wp_customize->add_control( 'sas_instagram', array(
		'label'   => __( 'Instagram URL', 'foundationpress' ),
		'section' => 'contact_social',
		'type'    => 'text'
	) );
	$wp_customize->add_setting( 'sas_linkedin' );
	$wp_customize->add_control( 'sas_linkedin', array(
		'label'   => __( 'LinkedIn URL', 'foundationpress' ),
		'section' => 'contact_social',
		'type'    => 'text'
	) );
	$wp_customize->add_setting( 'sas_github' );
	$wp_customize->add_control( 'sas_github', array(
		'label'   => __( 'Github URL', 'foundationpress' ),
		'section' => 'contact_social',
		'type'    => 'text'
	) );
}

add_action( 'customize_register', 'customize_register' );
