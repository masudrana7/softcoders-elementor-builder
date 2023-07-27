<?php
namespace softcoderselements\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use softcoderselements\WidgetsManager\Widgets_Loader;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Page_Title extends Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'page-title';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'SoftCoders Page Title', 'SoftCoders-header-footer-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-elementor-circle';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'sce-widgets' ];
	}

	/**
	 * Register Page Title controls.
	 */
	protected function register_controls() {
		$this->register_content_page_title_controls();
		$this->register_page_title_style_controls();
	}

	/**
	 * Register Page Title General Controls.
	 */
	protected function register_content_page_title_controls() {
		$this->start_controls_section(
			'section_general_fields',
			[
				'label' => __( 'Title', 'SoftCoders-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'archive_title_note',
			[
				'type'            => Controls_Manager::RAW_HTML,
				/* translators: %1$s doc link */
				'raw'             => sprintf( __( '<b>Note:</b> Archive page title will be visible on frontend.', 'SoftCoders-header-footer-elementor' ) ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);

		//
		$this->add_control(
			'custom_page',
			[
				'label' => esc_html__( 'Custom Page Title', 'SoftCoders-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'custom_page_title',
			[
				'label' => esc_html__( 'Title', 'SoftCoders-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'SoftCoders-header-footer-elementor' ),
				'condition' => [
					'custom_page' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_tag',
			[
				'label'   => __( 'HTML Tag', 'SoftCoders-header-footer-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1' => __( 'H1', 'SoftCoders-header-footer-elementor' ),
					'h2' => __( 'H2', 'SoftCoders-header-footer-elementor' ),
					'h3' => __( 'H3', 'SoftCoders-header-footer-elementor' ),
					'h4' => __( 'H4', 'SoftCoders-header-footer-elementor' ),
					'h5' => __( 'H5', 'SoftCoders-header-footer-elementor' ),
					'h6' => __( 'H6', 'SoftCoders-header-footer-elementor' ),
				],
				'default' => 'h2',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'              => __( 'Alignment', 'SoftCoders-header-footer-elementor' ),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
					'left'    => [
						'title' => __( 'Left', 'SoftCoders-header-footer-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'SoftCoders-header-footer-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'SoftCoders-header-footer-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'SoftCoders-header-footer-elementor' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'default'            => '',
				'selectors'          => [
					'{{WRAPPER}} .sce-page-title-wrapper' => 'text-align: {{VALUE}};',
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();
	}
	/**
	 * Register Page Title Style Controls.
	 */
	protected function register_page_title_style_controls() {
		$this->start_controls_section(
			'section_title_typography',
			[
				'label' => __( 'Title', 'SoftCoders-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'title_typography',
					'global'   => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' => '{{WRAPPER}} .elementor-heading-title, {{WRAPPER}} .sce-page-title a',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label'     => __( 'Color', 'SoftCoders-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'global'    => [
						'default' => Global_Colors::COLOR_PRIMARY,
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-heading-title, {{WRAPPER}} .sce-page-title a' => 'color: {{VALUE}};',
						'{{WRAPPER}} .sce-page-title-icon i'   => 'color: {{VALUE}};',
						'{{WRAPPER}} .sce-page-title-icon svg' => 'fill: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name'     => 'title_shadow',
					'selector' => '{{WRAPPER}} .elementor-heading-title',
				]
			);

			$this->add_control(
				'blend_mode',
				[
					'label'     => __( 'Blend Mode', 'SoftCoders-header-footer-elementor' ),
					'type'      => Controls_Manager::SELECT,
					'options'   => [
						''            => __( 'Normal', 'SoftCoders-header-footer-elementor' ),
						'multiply'    => __('Multiply', 'SoftCoders-header-footer-elementor'),
						'screen'      => __('Screen', 'SoftCoders-header-footer-elementor'),
						'overlay'     => __('Overlay', 'SoftCoders-header-footer-elementor'),
						'darken'      => __('Darken', 'SoftCoders-header-footer-elementor'),
						'lighten'     => __('Lighten', 'SoftCoders-header-footer-elementor'),
						'color-dodge' => __('Color Dodge', 'SoftCoders-header-footer-elementor'),
						'saturation'  => __('Saturation', 'SoftCoders-header-footer-elementor'),
						'color'       => __('Color', 'SoftCoders-header-footer-elementor'),
						'difference'  => __('Difference', 'SoftCoders-header-footer-elementor'),
						'exclusion'   => __('Exclusion', 'SoftCoders-header-footer-elementor'),
						'hue'         => __('Hue', 'SoftCoders-header-footer-elementor'),
						'luminosity'  => __('Luminosity', 'SoftCoders-header-footer-elementor'),
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-heading-title' => 'mix-blend-mode: {{VALUE}}',
					],
				]
			);
			$this->add_control(
			'highlight_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Highlight Title Color', 'staco-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title span, {{WRAPPER}} .sc-about-content-style .sc-auother-text span' => 'color: {{VALUE}}',  
				],
			]
		);

		$this->add_control(
			'highlight_color_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Highlight Title Background', 'staco-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title span' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'highlight_title_typo',
				'label'    => esc_html__( 'Highlight Typography', 'staco-core' ),
				'selector' => '{{WRAPPER}} .section-title span',
			]
		);

		$this->add_control(
			'highlight_border_radius',
			[
				'label' => esc_html__('Highlight Border Radius', 'scaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .section-title  span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'highlight_title_margin',
			[
				'label'              => __( 'Highlight Padding', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .section-title  span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'highlight_title_pading',
			[
				'label'              => __( 'Highlight Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .section-title  span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label'     => __( 'Icon', 'SoftCoders-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'new_page_title_select_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'page_title_icon_color',
			[
				'label'     => __( 'Icon Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'new_page_title_select_icon[value]!' => '',
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .sce-page-title-icon i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .sce-page-title-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'page_title_icons_hover_color',
			[
				'label'     => __( 'Icon Hover Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'new_page_title_select_icon[value]!' => '',
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .sce-page-title-icon:hover i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .sce-page-title-icon:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);
		

		$this->end_controls_section();
	}

	/**
	 * Render page title widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes( 'page_title', 'basic' );
		$heading_size_tag = Widgets_Loader::validate_html_tag( $settings['heading_tag'] );
		?>		
		<div class="section-title sce-page-title sce-page-title-wrapper elementor-widget-heading">
			
			<<?php echo $heading_size_tag; ?> class="elementor-heading-title elementor-size">
				<?php
				if( 'yes' != $settings['custom_page'] ){
					if ( is_archive() ) {
						echo wp_kses_post( get_the_archive_title() );
					} elseif(is_search() ){
						printf( __( 'Search Results for: %s', 'spria' ), '<span>' . get_search_query() . '</span>' );
					} elseif( !is_front_page() && is_home() ){
						printf( __( 'Blog ', 'spria' ));
					}
					else {
						echo wp_kses_post( get_the_title() );
					}
				} else {
					echo wp_kses_post( $settings['custom_page_title'] );
				}
				?>			 
			</<?php echo $heading_size_tag; ?> > 
		</div>
		<?php

	}
}
