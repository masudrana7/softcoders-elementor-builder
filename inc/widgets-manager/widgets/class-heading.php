<?php
/**
 * Elementor Classes.
 *
 */

namespace softcoderselements\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Widget_Base;
use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Heading extends Widget_Base {

	public function get_name() {
		return 'heading';
	}
	/**
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'SoftCoders Heading', 'SoftCoders-header-footer-elementor' );
	}
	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.2.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-elementor-circle';
	}
	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.2.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'sce-widgets' ];
	}

	/**
	 * Register Heading controls.
	 *
	 * @since 1.5.7
	 * @access protected
	 */
	protected function register_controls() {
		$this->register_content_heading_controls();
	}
	/**
	 * Register Heading General Controls.
	 *
	 * @since 1.2.0
	 * @access protected
	 */

    protected function register_content_heading_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Heading Info', 'SoftCoders-header-footer-elementor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'style',
            [
                'label'   => esc_html__( 'Select Heading Style', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Default', 'SoftCoders-header-footer-elementor'),
                    'style1'  => esc_html__( 'Intro Border Right', 'SoftCoders-header-footer-elementor'),
                    'style2'  => esc_html__( 'Border Bottom', 'SoftCoders-header-footer-elementor'),
                    'style3'  => esc_html__( 'Intro Border Left', 'SoftCoders-header-footer-elementor' ),
                    'style4'  => esc_html__( 'Border Top', 'SoftCoders-header-footer-elementor' ),
                    'style6'  => esc_html__( 'Border Top Left', 'SoftCoders-header-footer-elementor' ),
                    'style7'  => esc_html__( 'Border Top Right', 'SoftCoders-header-footer-elementor' ),
                    'style8'  => esc_html__( 'Boder Left Vertical Style', 'SoftCoders-header-footer-elementor' ),
                    'style9'  => esc_html__( 'Heading Image Style', 'SoftCoders-header-footer-elementor' ),
                    'style5'  => esc_html__( 'Heading Bracket Style', 'SoftCoders-header-footer-elementor' ),
                    'style10' => esc_html__( 'Heading Left Rotate Style', 'SoftCoders-header-footer-elementor' ),
                    'style11' => esc_html__( 'Heading Right Rotate Style', 'SoftCoders-header-footer-elementor' ),
                    'style12' => esc_html__( 'Left Vertical Border', 'SoftCoders-header-footer-elementor' ),
                    'style13' => esc_html__( 'Left Right Icon', 'SoftCoders-header-footer-elementor' ),

                ],
            ]
        );
        $this->add_control(
            'sub_left_image',
            [
                'label' => esc_html__( 'Choose Image', 'SoftCoders-header-footer-elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition'=>[
                    'style'=> 'style13',
                ],
            ]
        );


        $this->add_control(
            'sub_right_image',
            [
                'label' => esc_html__( 'Choose Image', 'SoftCoders-header-footer-elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition'=>[
                    'style'=> 'style13',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_image_wt',
            [
                'label' => esc_html__( 'Image Height', 'scelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sub-text img' => 'height:{{SIZE}}{{UNIT}};',
                ],
                'condition'=>[
                    'style'=> 'style13',
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_image_margin',
            [
                'label' => esc_html__( 'Image Margin', 'scelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .sub-text img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'=>[
                    'style'=> 'style13',
                ],
            ]
        );
        $this->add_control(
            'animate_style',
            [
                'label'   => esc_html__( 'Animate Border Style', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    'default'  => esc_html__( 'Select', 'SoftCoders-header-footer-elementor'),
                    'style1'  => esc_html__( 'Animate Border Bottom One', 'SoftCoders-header-footer-elementor'),
                    'style2'  => esc_html__( 'Animate Border Bottom Two', 'SoftCoders-header-footer-elementor'),
                    'style3'  => esc_html__( 'Animate Border Left & Right One', 'SoftCoders-header-footer-elementor'),
                    'style4'  => esc_html__( 'Animate Border Left & Right Two', 'SoftCoders-header-footer-elementor'),
                    'intro-move-x'  => esc_html__( 'intro Move-X', 'SoftCoders-header-footer-elementor'),
                ],
            ]
        );
        $this->add_control(
            'dots_show_hide',
            [
                'label' => esc_html__( 'Dot Show/Hide', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'SoftCoders-header-footer-elementor' ),
                'label_off' => esc_html__( 'Hide', 'SoftCoders-header-footer-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'dots_bg',
                'label' => esc_html__( 'Dots Bg', 'SoftCoders-header-footer-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .scelements-heading.dots_yes .title-inner .title:before',
            ]
        );
        $this->add_responsive_control(
            'dots_show_position',
            [
                'label' => esc_html__( 'Position Y', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.dots_yes .title-inner .title::before' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'animate_border_color',
            [
                'label' => esc_html__( 'Border Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .sce-heading-line' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .scelements-heading .sce-heading-line1:after' => 'background: {{VALUE}}!important;',
                ],
                'condition' => [
                    'animate_style' => ['style1', 'style2', 'style3', 'style4'],
                ],
            ]
        );
        $this->add_control(
            'animate_dot_color',
            [
                'label' => esc_html__( 'Dot Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .sce-heading-line:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .scelements-heading .sce-heading-line1:before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'animate_style' => ['style1', 'style2', 'style3', 'style4'],
                ],
            ]
        );
        $this->add_control(
            'animate_border_color_hover',
            [
                'label' => esc_html__( 'Border Color (Hover)', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .sce-heading-line1:before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'animate_style' => ['style1', 'style3'],
                ],
            ]
        );
        $this->add_control(
            'animated_border_color_hover',
            [
                'label' => esc_html__( 'Dot Color (Hover)', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .sce-heading-line1:after' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'animate_style' => ['style1', 'style3'],
                ],
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Heading Text', 'scelements' ),
                'type' => Controls_Manager::TEXTAREA,
                'description'   => esc_html__( 'Hightlight Title Settings will be worked, If you use this <span>Text</span> format', 'scelements' ),
                'default' => esc_html__( 'Heading Style', 'scelements' ),
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_tag',
            [
                'label'   => esc_html__( 'Select Heading Tag', 'scelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => esc_html__( 'H1', 'scelements'),
                    'h2' => esc_html__( 'H2', 'scelements'),
                    'h3' => esc_html__( 'H3', 'scelements' ),
                    'h4' => esc_html__( 'H4', 'scelements' ),
                    'h5' => esc_html__( 'H5', 'scelements' ),
                    'h6' => esc_html__( 'H6', 'scelements' ),
                ],
            ]
        );
        $this->add_control(
            'subtitle',
            [
                'label'     => esc_html__( 'Sub Heading Text', 'scelements' ),
                'type'      => Controls_Manager::TEXTAREA,
                'default'   => esc_html__( 'Sub Heading', 'scelements' ),
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Heading Image', 'scelements' ),
                'type'  => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => 'style9',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'image_postition',
            [
                'label'   => esc_html__( 'Select Image Position', 'scelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top' => esc_html__( 'Top', 'scelements'),
                    'bottom' => esc_html__( 'Bottom', 'scelements'),

                ],
                'condition' => [
                    'style' => 'style9',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'watermark',
            [
                'label' => esc_html__( 'Watermark Text', 'scelements' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Watermark', 'scelements' ),
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'content',
            [
                'label'   => esc_html__( 'Description', 'scelements' ),
                'type'    => Controls_Manager::WYSIWYG,
                'rows'    => 10,
            ]
        );
        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'scelements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'scelements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'scelements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'scelements' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'scelements' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'section_heading_style',
            [
                'label' => esc_html__( 'Heading Style', 'scelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title', 'scelements' ),
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'scelements' ),
                'selector' => '{{WRAPPER}} .scelements-heading .title-inner .title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'scelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_stroke_color',
            [
                'label' => esc_html__( 'Title Stroke Color', 'scelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .title' => '-webkit-text-stroke: 1px {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'heading_gradient_setting',
            [
                'label'   => esc_html__( 'Heading Gradient Color', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'subnormal_color',
                'options' => [
                    'heading_normal_color' => esc_html__( 'Normal Color', 'SoftCoders-header-footer-elementor'),
                    'heading_gradient_color' => esc_html__( 'Gradient Color', 'SoftCoders-header-footer-elementor'),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'heading_title_color_gradient',
                'label' => esc_html__( 'Gradient Color', 'SoftCoders-header-footer-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .scelements-heading.heading_gradient_color .title-inner .title',
                'condition' => [
                    'heading_gradient_setting' => 'heading_gradient_color',
                ],
            ]
        );
        $this->add_control(
            'title_fill_stroke_color',
            [
                'label' => esc_html__( 'Title Stroke Fill Color', 'scelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .title' => '-webkit-text-fill-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Title Margin', 'scelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Title Padding', 'scelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'sub_title_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Sub Title', 'scelements' ),
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => esc_html__( 'Subtitle Typography', 'scelements' ),
                'selector' => '{{WRAPPER}} .scelements-heading .title-inner .sub-text',
            ]
        );
        $this->add_control(
            'gradient_setting',
            [
                'label'   => esc_html__( 'Subtitle Gradient Color', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'subnormal_color',
                'options' => [
                    'subnormal_color' => esc_html__( 'Normal Color', 'SoftCoders-header-footer-elementor'),
                    'subgradient_color' => esc_html__( 'Gradient Color', 'SoftCoders-header-footer-elementor'),
                ],
            ]
        );
        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Subtitle Color', 'scelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .sub-text' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'gradient_setting' => 'subnormal_color',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'subtitle_color_gradient',
                'label' => esc_html__( 'Gradient Color', 'SoftCoders-header-footer-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .scelements-heading .title-inner .sub-text',
                'condition' => [
                    'gradient_setting' => 'subgradient_color',
                ],
            ]
        );
        $this->add_control(
            'subtitle_bg_color',
            [
                'label' => esc_html__( 'Subtitle background', 'scelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .sub-text' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'subtitle_margin',
            [
                'label' => esc_html__( 'Subtitle Margin', 'scelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .sub-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'subtitle_padding',
            [
                'label' => esc_html__( 'Subtitle Padding', 'scelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .sub-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sub_border_radius',
            [
                'label' => __( 'Border Radius', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .sub-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'des_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Description', 'scelements' ),
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => esc_html__( 'Description Typography', 'scelements' ),
                'selector' => '{{WRAPPER}} .scelements-heading .description p',
                'selector' => '{{WRAPPER}} .scelements-heading .description',
            ]
        );
        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__( 'Description Color', 'scelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .description' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .scelements-heading .description p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_margin',
            [
                'label' => esc_html__( 'Description Margin', 'scelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .description p, {{WRAPPER}} .scelements-heading .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_padding',
            [
                'label' => esc_html__( 'Description Padding', 'scelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'border_style_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Border Style', 'SoftCoders-header-footer-elementor' ),
                'separator' => 'before',
                'condition' => [
                    'style!' => 'style4',
                ]
            ]
        );
        $this->add_responsive_control(
            'border_position_x',
            [
                'label'      => esc_html__( 'Position X', 'SoftCoders-header-footer-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style2:after'                        => 'left: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style1 .description:after'           => 'left: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style6 .title-inner .sub-text:after' => 'left: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style2 .title-inner .title:before'   => 'left: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style7 .title-inner .sub-text:after' => 'left: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style8 .title-inner:after'           => 'left: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style8 .description:after'           => 'left: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'style!' => 'style4',
                ]
            ]
        );

        $this->add_responsive_control(
            'border_position_y',
            [
                'label'      => esc_html__( 'Position Y', 'SoftCoders-header-footer-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style2:after'                        => 'top: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style1 .description:after'           => 'top: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style6 .title-inner .sub-text:after' => 'top: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style2 .title-inner .title:before'   => 'top: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style7 .title-inner .sub-text:after' => 'top: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style8 .title-inner:after'           => 'top: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style8 .description:after'           => 'top: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'style!' => 'style4',
                ]
            ]
        );

        $this->add_responsive_control(
            'border_width',
            [
                'label'      => esc_html__( 'Width', 'SoftCoders-header-footer-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style2:after'                        => 'width: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style1 .description:after'           => 'width: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style6 .title-inner .sub-text:after' => 'width: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style2 .title-inner .title:before'   => 'width: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style7 .title-inner .sub-text:after' => 'width: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style8 .title-inner:after'           => 'width: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style8 .description:after'           => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'style!' => 'style4',
                ]
            ]
        );

        $this->add_responsive_control(
            'border_height',
            [
                'label'      => esc_html__( 'Height', 'SoftCoders-header-footer-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style2:after'                        => 'height: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style1 .description:after'           => 'height: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style6 .title-inner .sub-text:after' => 'height: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style2 .title-inner .title:before'   => 'height: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style7 .title-inner .sub-text:after' => 'height: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style8 .title-inner:after'           => 'height: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .scelements-heading.style8 .description:after'           => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'style!' => 'style4',
                ]
            ]
        );

        $this->add_responsive_control(
            'border_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style2:after'                        => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .scelements-heading.style1 .description:after'           => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .scelements-heading.style6 .title-inner .sub-text:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .scelements-heading.style2 .title-inner .title:before'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .scelements-heading.style7 .title-inner .sub-text:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .scelements-heading.style8 .title-inner:after'           => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .scelements-heading.style8 .description:after'           => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'style!' => 'style4',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'gradient_border_color',
                'label' => esc_html__( 'Border Color', 'SoftCoders-header-footer-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => ' {{WRAPPER}} .scelements-heading.style2:after, {{WRAPPER}} .scelements-heading.style1 .description:after, {{WRAPPER}} .scelements-heading.style6 .title-inner .sub-text:after, {{WRAPPER}} .scelements-heading.style4 .title-inner h2:before, {{WRAPPER}} .scelements-heading.style2 .title-inner .title:before, {{WRAPPER}} .scelements-heading.style7 .title-inner .sub-text:after, {{WRAPPER}} .scelements-heading.style8 .title-inner:after, {{WRAPPER}} .scelements-heading.style8 .description:after',
                'condition' => [
                    'style!' => 'style4',
                ]
            ]
        );

        // Controls For Style 4
        $this->add_control(
            'border_global_control_style4_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Border Style Universal', 'SoftCoders-header-footer-elementor' ),
                'separator' => 'before',
                'condition' => [
                    'style' => 'style4',
                ]
            ]
        );
        $this->add_responsive_control(
            'border_style4_width',
            [
                'label'      => esc_html__( 'Width', 'SoftCoders-header-footer-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style4 .title-inner .title:after, {{WRAPPER}} .scelements-heading.style4 .title-inner .title:before' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'style' => 'style4',
                ]
            ]
        );
        $this->add_responsive_control(
            'border_style4_height',
            [
                'label'      => esc_html__( 'Height', 'SoftCoders-header-footer-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style4 .title-inner .title:after, {{WRAPPER}} .scelements-heading.style4 .title-inner .title:before' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'style' => 'style4',
                ]
            ]
        );
        $this->add_responsive_control(
            'style4_border_position_y',
            [
                'label'      => esc_html__( 'Position Y', 'SoftCoders-header-footer-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style4 .title-inner .title:before, {{WRAPPER}} .scelements-heading.style4 .title-inner .title:after' => 'top: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'style' => 'style4',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'style4_border_background',
                'label' => esc_html__( 'Background', 'SoftCoders-header-footer-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .scelements-heading.style4 .title-inner .title:before, {{WRAPPER}} .scelements-heading.style4 .title-inner .title:after',
                'condition' => [
                    'style' => 'style4',
                ]
            ]
        );
        $this->add_responsive_control(
            'style4_border_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style4 .title-inner .title:before, {{WRAPPER}} .scelements-heading.style4 .title-inner .title:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Before
        $this->add_control(
            'border_style4_heading_before',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Border Style (Before)', 'SoftCoders-header-footer-elementor' ),
                'separator' => 'before',
                'condition' => [
                    'style' => 'style4',
                ]
            ]
        );
        $this->add_responsive_control(
            'border_style4_heading_before_show_hide',
            [
                'label' => esc_html__( 'Before (Show/Hide)', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'block' => [
                        'title' => esc_html__( 'Show', 'SoftCoders-header-footer-elementor' ),
                        'icon' => 'eicon-check',
                    ],
                    'none' => [
                        'title' => esc_html__( 'Hide', 'SoftCoders-header-footer-elementor' ),
                        'icon' => 'eicon-editor-close',
                    ],
                ],
                'default' => 'none',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style4 .title-inner .title:before' => 'display: {{VALUE}} !important;',
                ],
                'condition' => [
                    'style' => 'style4',
                ]
            ]
        );
        $this->add_responsive_control(
            'style4_border_position_left',
            [
                'label'      => esc_html__( 'Position X (Left)', 'SoftCoders-header-footer-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style4 .title-inner .title:before' => 'left: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'style' => 'style4',
                    'border_style4_heading_before_show_hide' => 'block',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'shape_border_style4_before',
                'selector' => '{{WRAPPER}} .scelements-heading.style4 .title-inner .title:before',
                'condition' => [
                    'style' => 'style4',
                    'border_style4_heading_before_show_hide' => 'block',
                ]
            ]
        );
        $this->add_responsive_control(
            'style4_border_before_z_index',
            [
                'label'      => esc_html__( 'Z-Index', 'SoftCoders-header-footer-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style4 .title-inner .title:before' => 'z-index: {{SIZE}} !important;',
                ],
                'range' => [
                    'px' => [
                        'max' => 100,
                        'min' => -100,
                    ],
                ],
                'condition' => [
                    'style' => 'style4',
                    'border_style4_heading_before_show_hide' => 'block',
                ]
            ]
        );
        // After
        $this->add_control(
            'border_style4_heading_after',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Border Style (After)', 'SoftCoders-header-footer-elementor' ),
                'separator' => 'before',
                'condition' => [
                    'style' => 'style4',
                ]
            ]
        );
        $this->add_responsive_control(
            'border_style4_heading_after_show_hide',
            [
                'label' => esc_html__( 'After (Show/Hide)', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'block' => [
                        'title' => esc_html__( 'Show', 'SoftCoders-header-footer-elementor' ),
                        'icon' => 'eicon-check',
                    ],
                    'none' => [
                        'title' => esc_html__( 'Hide', 'SoftCoders-header-footer-elementor' ),
                        'icon' => 'eicon-editor-close',
                    ],
                ],
                'default' => 'none',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style4 .title-inner .title:after' => 'display: {{VALUE}} !important;',
                ],
                'condition' => [
                    'style' => 'style4',
                ]
            ]
        );
        $this->add_responsive_control(
            'style4_border_position_right',
            [
                'label'      => esc_html__( 'Position X (Right)', 'SoftCoders-header-footer-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style4 .title-inner .title:after' => 'right: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'style' => 'style4',
                    'border_style4_heading_after_show_hide' => 'block',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'shape_border_style4_after',
                'selector' => '{{WRAPPER}} .scelements-heading.style4 .title-inner .title:after',
                'condition' => [
                    'style' => 'style4',
                    'border_style4_heading_after_show_hide' => 'block',
                ]
            ]
        );
        $this->add_responsive_control(
            'style4_border_after_z_index',
            [
                'label'      => esc_html__( 'Z-Index', 'SoftCoders-header-footer-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style4 .title-inner .title:after' => 'z-index: {{SIZE}} !important;',
                ],
                'range' => [
                    'px' => [
                        'max' => 100,
                        'min' => -100,
                    ],
                ],
                'condition' => [
                    'style' => 'style4',
                    'border_style4_heading_after_show_hide' => 'block',
                ]
            ]
        );
        // Controls For Style 4

        $this->end_controls_section();

        $this->start_controls_section(
            'title_highlight_style',
            [
                'label' => esc_html__( 'Highlight Title', 'scelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'hightlight_typography',
                'label' => esc_html__( 'Hightlight Typography', 'scelements' ),
                'selector' => '{{WRAPPER}} .scelements-heading .title-inner .title span',
            ]
        );
        $this->add_control(
            'highlight_setting',
            [
                'label'   => esc_html__( 'Select Highlight Color', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'normal_color',
                'options' => [
                    'normal_color' => esc_html__( 'Normal Color', 'SoftCoders-header-footer-elementor'),
                    'gradient_color' => esc_html__( 'Gradient Color', 'SoftCoders-header-footer-elementor'),
                    'stroke_color' => esc_html__( 'Stroke Color', 'SoftCoders-header-footer-elementor'),
                ],
            ]
        );
        $this->add_control(
            'highlight_color',
            [
                'label' => esc_html__( 'Highlight Color', 'scelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .title span' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'highlight_setting' => 'normal_color',
                ],
            ]
        );
        $this->add_control(
            'underline_color',
            [
                'label' => esc_html__( 'Underline Color', 'scelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .title span:not(.watermark):after' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'highlight_setting' => 'normal_color',
                ],
            ]
        );
        $this->add_control(
            'highlight_title_stroke_color',
            [
                'label' => esc_html__( 'Highlight Stroke Color', 'scelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .title span' => '-webkit-text-stroke: 1px {{VALUE}};',
                ],
                'condition' => [
                    'highlight_setting' => 'stroke_color',
                ],
            ]
        );
        $this->add_control(
            'hightlight_title_fill_stroke_color',
            [
                'label' => esc_html__( 'Highlight Stroke Fill Color', 'scelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .title span' => '-webkit-text-fill-color: {{VALUE}};',
                ],
                'condition' => [
                    'highlight_setting' => 'stroke_color',
                ],
            ]
        );
        $this->add_responsive_control(
            'highlight_padding',
            [
                'label' => esc_html__( 'Padding', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'highlight_margin',
            [
                'label' => esc_html__( 'Margin', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .title span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'highlight_color_gradient',
                'label' => esc_html__( 'Highlight Gradient Color', 'SoftCoders-header-footer-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .scelements-heading .title-inner .title span',
                'condition' => [
                    'highlight_setting' => 'gradient_color',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hightlight_shape_color',
                'label' => esc_html__( 'Hightlight Shape', 'SoftCoders-header-footer-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .scelements-heading .title span:nth-child(2)::after',
            ]
        );
        $this->add_responsive_control(
            'hightlight_width',
            [
                'label' => esc_html__( 'Text Width', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .title span' => 'width: {{SIZE}}{{UNIT}}; display: inline-block;',
                ],

            ]
        );
        $this->add_control(
            'hightlight_align',
            [
                'label' => esc_html__( 'Alignment', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'SoftCoders-header-footer-elementor' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'SoftCoders-header-footer-elementor' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'SoftCoders-header-footer-elementor' ),
                        'icon' => 'eicon-text-align-right',
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading .title-inner .title span' => 'text-align: {{VALUE}}'
                ],
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'title_image_style',
            [
                'label' => esc_html__( 'Image Settings', 'scelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style9',
                ],
            ]

        );
        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__( 'Width', 'scelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 65,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style9 .title-inner img' => 'width: {{SIZE}}{{UNIT}};',
                ],


            ]
        );
        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__( 'Height', 'scelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style9 .title-inner .title-img > img' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'scelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .scelements-heading.style9 .title-inner .title-img > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $this->end_controls_section();
    }


	/**
	 * Render Heading output on the frontend.
	 */
    protected function render() {

        $settings = $this->get_settings_for_display();

        $heading_gradient_setting = $settings['heading_gradient_setting'];

        $watermark_text = ($settings['watermark']) ? '<span class="watermark">'.($settings['watermark']).'</span>' : '';

        $main_title     = ($settings['title']) ? '<'.$settings['title_tag'].' class="title"><span class="watermark">'.$settings['watermark'].'</span>'.wp_kses_post($settings['title']).'</'.$settings['title_tag'].'>' : '';


        if( "style4"==  $settings['style'] || "style4 Lite"== $settings['style'] || "style6"== $settings['style'] || "style6 Lite"==$settings['style'] || "style7" == $settings['style'] || "style7 Lite"== $settings['style'] ){
            $sub_text = ($settings['subtitle']) ? '<span class="sub-text">'.($settings['subtitle']).'</span>' : '';
        }
        elseif ( "style5" == $settings['style'] ){
            $sub_text = ($settings['subtitle']) ? '<span class="sub-text title-upper">[ <span class="sub-text title-upper">'.($settings['subtitle']).'</span> ] </span>' : '';
        }
        elseif("style3" == $settings['animate_style']){
            $sub_text       = ($settings['subtitle'])  ? '<span class="sub-text"> <span class="sce-heading-line1"></span>'.($settings['subtitle']) .'</span>' : '';
        }
        elseif("style4" == $settings['animate_style']){
            $sub_text       = ($settings['subtitle'])  ? '<span class="sub-text"> <span class="sce-heading-line"></span>'.($settings['subtitle']) .'</span>' : '';
        }
        elseif ("style13" == $settings['style']){
            $right_img = '';
            if(!empty($settings['sub_right_image']['url']) ) {
                $right_img = '<img src="' . $settings['sub_right_image']['url'] . '" alt="icon">';
            }

            $sub_text = ($settings['subtitle'])  ? '<span class="sub-text">
            <img src="' . $settings['sub_left_image']['url'] . '" alt="icon"> '.($settings['subtitle']).' ' .$right_img. '</span>' : '';


        }
        else{
            $sub_text       = ($settings['subtitle'])  ? '<span class="sub-text ">'.($settings['subtitle']) .'</span>' : '';
        }


        $titleimg    = $settings['image'] ? '<img src="' . $settings['image']['url'] . '" alt="icon">' : '';

        $topimage    = $settings['image_postition'] == 'top' ? ' '.$titleimg .'' : '';

        $bottomimage = $settings['image_postition'] == 'bottom' ? '<div class="title-img bottom-img">'.$titleimg .'</div>' : "";



        if( "style9" == $settings['style'] ){
            $main_title     = ($settings['title']) ? '<'.$settings['title_tag'].' class="title" ><span class="watermark">'.$settings['watermark'].'</span>'.($settings['title']).'</'.$settings['title_tag'].'>' : '';
        }


        // Fill $html var with data
      ?>

        <div class="scelements-heading <?php echo esc_attr($settings['style']);?> animate-<?php echo esc_attr($settings['animate_style']);?> <?php echo esc_attr($settings['align']);?> <?php echo esc_attr($settings['highlight_setting']);?>  <?php echo esc_attr($settings['gradient_setting']);?> dots_<?php echo esc_attr($settings['dots_show_hide']);?> <?php echo esc_attr($heading_gradient_setting);?>">
            <div class="title-inner">
                <?php

                    if ( "style9" == $settings['style'] && !empty( $settings['image']['url'] ) ) {
                        echo wp_kses_post($topimage) ;
                    }
                    if ( "style13" == $settings['style'] && !empty( $settings['sub_left_image']['url'] || $settings['sub_right_image']['url'] ) ) {
                        echo wp_kses_post($sub_text) ;
                    }
                    if( ("style4"  != $settings['style']) && ("style13"  != $settings['style'])){
                        echo wp_kses_post($sub_text);
                    }
                    // default style
                    echo wp_kses_post($main_title);

                    if (!empty("style9" == $settings['style']) && !empty($bottomimage)) {
                        echo wp_kses_post($bottomimage) ;
                    }

                ?>
                <?php if( "style1" == $settings['animate_style'] ){?>
                    <div class="sce-heading-line1"></div>
                <?php } ?>

                <?php if( "style2" == $settings['animate_style'] ){?>
                    <div class="sce-heading-line"></div>
                <?php } ?>
            </div>
            <?php if ($settings['content']) { ?>
                <div class="description">
                    <?php if( "style12" == $settings['style'] ){ ?>
                        <div class="draw-line start-draw"></div>
                    <?php } ?>
                    <?php echo wp_kses_post($settings['content']);?>
                </div>
            <?php } ?>
        </div>
        <?php
    }




}
