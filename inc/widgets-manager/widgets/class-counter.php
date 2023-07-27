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

class scCounter extends Widget_Base {
	public function get_name() {
		return 'sccounter';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Softcoders Counter', 'SoftCoders-header-footer-elementor' );
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
				'label' => __( 'General', 'SoftCoders-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'service_style',
			[
				'label'   => esc_html__('Select Services Style', 'scaddons'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__('Style 1', 'scaddons'),
					'style2' => esc_html__('Style 2', 'scaddons'),
				],
			]
		);
		$this->add_control(
			'icon',
			[
				'label'       => __( 'Icon', 'SoftCoders-header-footer-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => 'true',
			]
		);

		$this->add_control(
			'before_number',
			[
				'label'   => __( 'Number Before Text', 'SoftCoders-header-footer-elementor' ),
				'type'    => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'counter_number',
			[
				'label'   => __( 'Number', 'SoftCoders-header-footer-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '550' ),
			]
		);

		$this->add_control(
			'after_number',
			[
				'label'   => __( 'Number After Text', 'SoftCoders-header-footer-elementor' ),
				'type'    => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'title',
			[
				'label'   => __( 'Title', 'SoftCoders-header-footer-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Happy Customer', 'SoftCoders-header-footer-elementor' ),
			]
		);

		$this->add_responsive_control(
			'heading_text_align',
			[
				'label'              => __( 'Alignment', 'SoftCoders-header-footer-elementor' ),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
					'left'    => [
						'title' => __( 'Left', 'SoftCoders-header-footer-elementor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'SoftCoders-header-footer-elementor' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'SoftCoders-header-footer-elementor' ),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justify', 'SoftCoders-header-footer-elementor' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .sc-statistics-service-box' => 'text-align: {{VALUE}};',
				],
				'prefix_class'       => 'hfe%s-heading-align-',
				'frontend_available' => true,
			]
		);
		$this->end_controls_section();
	}


	/**
	 * Register Advanced Heading Typography Controls.
	 */
	protected function register_heading_typo_content_controls() {

		$this->start_controls_section(
			'section_icon',
			[
				'label'     => __( 'Icon', 'SoftCoders-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon[value]!' => '',
				],
			]
		);
		$this->add_control(
			'icon_bg',
			[
				'label'     => __( 'Icon Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .counter-style-box-two .sc-counter-icon i, {{WRAPPER}} .counter-style-box-two i, {{WRAPPER}} .sc-statistics-service-box i'   => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_indent',
			[
				'label'              => __( 'Icon Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} counter-style-box-two i, {{WRAPPER}} .sc-statistics-service-box i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'scaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} counter-style-box-two i, {{WRAPPER}} .sc-statistics-service-box i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'selector' => '{{WRAPPER}} .counter-style-box-two i',
            ]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .sc-statistics-service-box i'
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'number_typography',
			[
				'label' => __( 'Number', 'SoftCoders-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'number_color',
			[
				'label'     => __( 'Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .sc-count' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'number_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .sc-count',
			]
		);
		$this->add_responsive_control(
			'numer_margin',
			[
				'label'              => __( 'Number Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .counter-style-box-two .sc-counter-icon, {{WRAPPER}} .sc-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_heading_typography',
			[
				'label' => __( 'Title', 'SoftCoders-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'heading_color',
			[
				'label'     => __( 'Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .sc-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '.sc-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'              => __( 'Title Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .counter-style-box-two .sc-count, {{WRAPPER}} .sc-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_typography',
			[
				'label' => __( 'Description', 'SoftCoders-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'desc_color',
			[
				'label'     => __( 'Description Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .counter-style-box-two .des' => 'color: {{VALUE}};',
				],
			]
		);
        $this->end_controls_section();
		
		// Service Global Style
		$this->start_controls_section(
			'section_global_style',
			[
				'label'     => __( 'Global Style', 'SoftCoders-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'service_bg',
			[
				'label'     => __( 'Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter-style-box-two, {{WRAPPER}} .sc-statistics-service-box'   => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'section_padding',
			[
				'label'              => __( 'Area Padding', 'SoftCoders-header-footer-elementor' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .counter-style-box-two, {{WRAPPER}} .sc-statistics-service-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'section_margin',
			[
				'label'              => __( 'Area Margin', 'SoftCoders-header-footer-elementor' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .counter-style-box-two, {{WRAPPER}} .sc-statistics-service-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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

        <?php if ('style1' == $settings['service_style']) {  ?>
			<div class="sc-statistics-service-box">
				<?php if ( '' !== $settings['icon']['value'] ) { ?>
				<i class="p-z-idex position-relative icomoon">
					<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</i>
				<?php } ?> 

				<div class="sc-counter-number">
					<?php if (!empty($settings['counter_number'])) { ?>
					<div class="sc-count">
						<?php echo wp_kses_post( $settings['before_number'] ); ?><span class="odometer" data-count="<?php echo wp_kses_post( $settings['counter_number'] ); ?>">0</span><?php echo wp_kses_post( $settings['after_number'] ); ?>
					</div>
					<?php } ?> 

					<?php if (!empty($settings['title'])) { ?>
						<span class="sc-title p-z-idex position-relative"><?php echo wp_kses_post( $settings['title'] ); ?></span>
					<?php } ?> 
				</div>
			</div>
		<?php } ?> 	

		<?php if ('style2' == $settings['service_style']) {  ?>
			  <div class="counter-style-box-two d-flex align-items-center">
				<?php if ( '' !== $settings['icon']['value'] ) { ?>
				<div class="sc-counter-icon">	
					<i class="p-z-idex position-relative icomoon">
						<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</i>
				</div>
				<?php } ?>
				<div class="sc-counter-number">
					<?php if (!empty($settings['counter_number'])) { ?>
					<div class="sc-count">
						<?php echo wp_kses_post( $settings['before_number'] ); ?><span class="odometer" data-count="<?php echo wp_kses_post( $settings['counter_number'] ); ?>">0</span><?php echo wp_kses_post( $settings['after_number'] ); ?>
					</div>
					<?php } ?> 
					<?php if (!empty($settings['title'])) { ?>
						<p class="des"><?php echo wp_kses_post( $settings['title'] ); ?></P>
					<?php } ?> 
				</div>
			</div>
		<?php } ?> 

		<?php
	}
		/**
		 * Render site title output in the editor.
		 */
	
}
