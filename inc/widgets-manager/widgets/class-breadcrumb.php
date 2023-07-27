<?php
namespace softcoderselements\WidgetsManager\Widgets;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use softcoderselements\WidgetsManager\Widgets_Loader;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class SC_Breadcrumb extends Widget_Base {
	public function get_name() {
		return 'sc-breadcrumb';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Softcoders Breadcrumb', 'SoftCoders-header-footer-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-elementor-circle';
	}

	/**
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'sce-widgets' ];
	}

	/**
	 * Register site title controls.
	 */
	protected function register_controls() {

		$this->register_general_content_controls();
		$this->register_heading_typo_content_controls();
	}

	/**
	 * Register Advanced Heading General Controls.
	 */
	protected function register_general_content_controls() {

		$this->start_controls_section(
			'section_general_fields',
			[
				'label' => __( 'Breadcrumb', 'SoftCoders-header-footer-elementor' ),
			]
		);

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::CHOOSE,
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
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'SoftCoders-header-footer-elementor' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .sc-breadcrumb-style' => 'text-align: {{VALUE}}'
                ],
                'separator' => 'before',
            ]
        );

		$this->end_controls_section();
	}


	/**
	 * Register Advanced Heading Typography Controls.
	 */
	protected function register_heading_typo_content_controls() {

        $this->start_controls_section(
			'breadcrumb_style_area',
			[
				'label' => __( 'Breadcrumb Style', 'SoftCoders-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'breadcrumb-color',
            [
                'label' => esc_html__( 'Breadcrumb Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-breadcrumb-style span > a, {{WRAPPER}} .sc-breadcrumb-style span > a span, {{WRAPPER}} .sc-breadcrumb-style span > span' => 'color: {{VALUE}};',
                ],
            ]
        );  

        $this->add_control(
            'breadcrumb_link_color',
            [
                'label' => esc_html__( 'Link Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-breadcrumb-style span > a, {{WRAPPER}} .sc-breadcrumb-style span > a span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'breadcrumb_link_hover_color',
            [
                'label' => esc_html__( 'Link Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-breadcrumb-style span > a:hover,{{WRAPPER}} .sc-breadcrumb-style span > a:hover span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'breadcrumb_link_Separator',
            [
                'label' => esc_html__( 'Breadcrumb Separator', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .breadcrumbs-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'breadcrumb_link_bg',
            [
                'label' => esc_html__( 'Breadcrumb Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-breadcrumb-style .breadcrumbs-content' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'breadcrumb_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .sc-breadcrumb-style span > a, {{WRAPPER}} .sc-breadcrumb-style span > a span, {{WRAPPER}} .sc-breadcrumb-style span > span',
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'area_border',
                'selector' => '{{WRAPPER}} .sc-breadcrumb-style .breadcrumbs-content',
            ]
        );

        $this->add_responsive_control(
            'breadcrumb-padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-breadcrumb-style .breadcrumbs-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'breadcrumb-margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .breadcrumbs-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();
	}

	/**
	 * Render Heading output on the frontend.
	 */
	protected function render() {
		$settings = $this->get_settings();?>

        <?php 
        if(function_exists('bcn_display')){?>
            <div class="sc-breadcrumb-style"> 
                <div class="breadcrumbs-content"> <?php bcn_display();?></div>
            </div> 
        <?php } 
	}
		/**
		 * Render site title output in the editor.
		 */
	
}