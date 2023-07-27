<?php
/**
 * @author  UiGigs
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'softcoders_Postmeta' ) ) {
	return;
}

$Postmeta = \softcoders_Postmeta::getInstance();

$prefix = softcoderselements_PREFIX;
$ctp_socials = array(
	'facebook' => array(
		'label' => __( 'Facebook', 'softcoders-core' ),
		'type'  => 'text',
		'icon'  => 'fab fa-facebook-f',
		'color' => '#3b5998',
	),
	'twitter' => array(
		'label' => __( 'Twitter', 'softcoders-core' ),
		'type'  => 'text',
		'icon'  => 'fab fa-twitter',
		'color' => '#1da1f2',
	),
	'linkedin' => array(
		'label' => __( 'Linkedin', 'softcoders-core' ),
		'type'  => 'text',
		'icon'  => 'fab fa-linkedin-in',
		'color' => '#0077b5',
	),
	'instagram' => array(
		'label' => __( 'Instagram', 'softcoders-core' ),
		'type'  => 'text',
		'icon'  => 'fab fa-instagram',
		'color' => '#AA3DB2',
	),
	'pinterest' => array(
		'label' => __( 'Pinterest', 'softcoders-core' ),
		'type'  => 'text',
		'icon'  => 'fab fa-pinterest-p',
		'color' => '#E60023',
	),
);
$softcoders_ctp_socials = apply_filters( 'ctp_socials', $ctp_socials );

/*---------------------------------------------------------------------
#. = Layout Settings
-----------------------------------------------------------------------*/
$nav_menus = wp_get_nav_menus( array( 'fields' => 'id=>name' ) );
$nav_menus = array( 'default' => __( 'Default', 'softcoders-core' ) ) + $nav_menus;

$Postmeta->add_meta_box( "{$prefix}_page_settings", __( 'Page Settings', 'softcoders-core' ), array( 'page', 'post', 'artex_team' ), '', '', 'high', array(
	'fields' => array(
	
		"{$prefix}_layout_settings" => array(
			'label'   => __( 'Layouts', 'softcoders-core' ),
			'type'    => 'group',
			'value'  => array(	
			
				"{$prefix}_layout" => array(
					'label'   => __( 'Page Sidebar Settings', 'softcoders-core' ),
					'type'    => 'select',
					'options' => array(
						'default'       => __( 'Default', 'softcoders-core' ),
						'full-width'    => __( 'Full Width', 'softcoders-core' ),
						'left-sidebar'  => __( 'Left Sidebar', 'softcoders-core' ),
						'right-sidebar' => __( 'Right Sidebar', 'softcoders-core' ),
					),
					'default'  => 'default',
				),	
				"{$prefix}_page_top_padding" => array(
					'label'   => __( 'Page Top Padding', 'softcoders-core' ),
					'type'    => 'number',
					'default'  => '100',
				),
				"{$prefix}_page_bottom_padding" => array(
					'label'   => __( 'Page Bottom Padding ', 'softcoders-core' ),
					'type'    => 'number',
					'default'  => '100',
				),	
				"{$prefix}_banner" => array(
					'label'   => __( 'Banner Show/Hide', 'softcoders-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'softcoders-core' ),
						'on'	  => __( 'Show', 'softcoders-core' ),
						'off'	  => __( 'Hide', 'softcoders-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_breadcrumb" => array(
					'label'   => __( 'Breadcrumb Show/Hide', 'softcoders-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'softcoders-core' ),
						'on'      => __( 'Show', 'softcoders-core' ),
						'off'	  => __( 'Hide', 'softcoders-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_banner_type" => array(
					'label'   => __( 'Banner Background Type', 'softcoders-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'softcoders-core' ),
						'bgimg'   => __( 'Background Image', 'softcoders-core' ),
						'bgcolor' => __( 'Background Color', 'softcoders-core' ),
					),
					'default' => 'default',
				),
				"{$prefix}_banner_bgimg" => array(
					'label' => __( 'Banner Background Image', 'softcoders-core' ),
					'type'  => 'image',
					'desc'  => __( 'Please select your background type', 'softcoders-core' ),
				),
				"{$prefix}_banner_bgcolor" => array(
					'label' => __( 'Banner Background Color', 'softcoders-core' ),
					'type'  => 'color_picker',
					'desc'  => __( 'Please select your background type', 'softcoders-core' ),
				),
				"{$prefix}_top_padding" => array(
					'label'   => __( 'Banner Top Padding', 'softcoders-core' ),
					'type'    => 'number',
					'default'  => '100',
				),
				"{$prefix}_bottom_padding" => array(
					'label'   => __( 'Banner Bottom Padding ', 'softcoders-core' ),
					'type'    => 'number',
					'default'  => '100',
				),
			)
		)
	),
) );

/*---------------------------------------------------------------------
#. = Speaker
-----------------------------------------------------------------------*/
$Postmeta->add_meta_box( $prefix.'_speaker_info', __( 'Speaker Information', 'softcoders-core' ), array( $prefix.'_speaker' ), '', '', 'high', array(
	'fields' => array(
		"{$prefix}_speaker_desigantion" => array(
			'label' => esc_html__( 'Designation', 'softcoders-core' ),
			'type'  => 'text',
		),
		"{$prefix}_speaker_socials" => array(
			'type'  => 'group',
			'label' => esc_html__( 'Speaker Socials', 'artex-core' ),
			'value'  => $softcoders_ctp_socials
		),
	)
) );