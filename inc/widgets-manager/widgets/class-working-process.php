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

class WorkingProcess extends Widget_Base {
	public function get_name() {
		return 'workingprocess';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'SoftCoders Working Process', 'SoftCoders-header-footer-elementor' );
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
			'process_style',
			[
				'label'   => esc_html__('Process Style', 'scaddons'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__('Style 1', 'scaddons'),
					'style2' => esc_html__('Style 2', 'scaddons'),
				],
			]
		);
        
        $this->add_control(
			'reverse_style',
			[
				'label'   => esc_html__('Reverse Process', 'scaddons'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => esc_html__('Yes', 'scaddons'),
					'no' => esc_html__('No', 'scaddons'),
				],
				'condition' => [
					'process_style' => 'style2',
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
			'title',
			[
				'label'   => __( 'Title', 'SoftCoders-header-footer-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Process Title', 'SoftCoders-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'process_desc',
			[
				'label'   => __( 'Description', 'SoftCoders-header-footer-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Busto auctor lectus better best conbia euismot rhoncus dolora gorgeous system nicest does had blessed face winged female', 'SoftCoders-header-footer-elementor' ),
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
					'{{WRAPPER}} .sc-business-item' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}


	/**
	 * Register Advanced Heading Typography Controls.
	 */
	protected function register_heading_typo_content_controls() {

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
					'{{WRAPPER}} .sc-business-text .title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sc-process-system .process-content .process-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_hover_color',
			[
				'label'     => __( 'Hover Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .sc-business-item:hover .sc-business-text .title' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'title_margin',
			[
				'label'              => __( 'Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'condition' => [
					'icon[value]!' => '',
				],
				'selectors'          => [
					'{{WRAPPER}} .sc-business-text .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
				'selector' => '{{WRAPPER}} .sc-business-text .title',
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
				'label'     => __( 'Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .sc-business-text .des' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sc-process-system .desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'desc_hover_color',
			[
				'label'     => __( 'Hover Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .sc-business-item:hover .sc-business-text .des' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .sc-business-text .des',
			]
		);
		$this->add_responsive_control(
			'desc_margin',
			[
				'label'              => __( 'Descriptiontle Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'condition' => [
					'icon[value]!' => '',
				],
				'selectors'          => [
					'{{WRAPPER}} .sc-business-text .des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'icon[value]!' => '',
				],
			]
		);

		$this->add_control( 
			'icon_color',
			[
				'label'     => __( 'Icon Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'icon[value]!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sc-business-item .sc-icon i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .sc-business-item .sc-icon path'   => 'fill: {{VALUE}};',
					'{{WRAPPER}} .sc-process-system .process-icon i path'   => 'fill: {{VALUE}};',

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
				'condition' => [
					'icon[value]!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sc-business-item .sc-icon i'  => 'background: {{VALUE}};',
					'{{WRAPPER}} .sc-process-system .process-icon i'  => 'background: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'process_border',
                'selector' => '{{WRAPPER}} .sc-process-system .process-icon i',
            ]
        );

		$this->add_control(
			'icon_bg_shape',
			[
				'label'     => __( 'Icon Shape Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .sc-business-item .sc-icon .triangle-down'  => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .sc-process-system:nth-child(odd) .process-content::before'  => 'border-right-color: {{VALUE}};',
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

		$this->add_responsive_control(
			'section_margin',
			[
				'label'              => __( 'Area Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-business-item .sc-business-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .sc-process-system .process-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'selector' => '{{WRAPPER}} .sc-process-system .process-content',
            ]
        );

		$this->add_responsive_control(
			'section_padding',
			[
				'label'              => __( 'Area Padding', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-business-item .sc-business-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .sc-process-system .process-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_global_style' );

		$this->start_controls_tab(
			'tab_globa_normal',
			[
				'label' => __( 'Normal', 'SoftCoders-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'service_bg',
			[
				'label'     => __( 'Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-business-item .sc-business-text'   => 'background: {{VALUE}};',
					'{{WRAPPER}} .sc-about-content-style .sc-auother-style-box'   => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_globa_hover',
			[
				'label' => __( 'Hover', 'SoftCoders-header-footer-elementor' ),
			]
		);
		$this->add_control(
			'service_hover_bg',
			[
				'label'     => __( 'Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-business-item:hover .sc-business-text'   => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Render Heading output on the frontend.
	 */
	protected function render() {
		$settings = $this->get_settings();?>
			<?php if ('style1' == $settings['process_style']) {  ?>
				<div class="sc-business-item">
					<?php if ( '' !== $settings['icon']['value'] ) { ?>
					<div class="sc-icon">
						<i><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></i>	
						<div class="triangle-down"></div>
					</div>
					<?php } ?> 
					<div class="sc-business-text">
						<?php if (!empty($settings['title'])) { ?>
							<h4 class="title white-color"><?php echo wp_kses_post( $settings['title'] ); ?></h4>
							<?php } ?> 
						<?php if (!empty($settings['process_desc'])) { ?>
							<p class="des"><?php  echo wp_kses_post( $settings['process_desc'] ); ?></p>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

            <?php if ('style2' == $settings['process_style']) {  ?>
                <div class="sc-process-system d-flex align-items-center reverse_style_<?php echo $settings['reverse_style']; ?>">
					<?php if ( '' !== $settings['icon']['value'] ) { ?>
						<div class="process-icon">
							<i><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></i>	
						</div>
					<?php } ?> 
					<div class="process-content">
						<?php if (!empty($settings['title'])) { ?>
							<h4 class="process-title"><?php echo wp_kses_post( $settings['title'] ); ?></h4>
						<?php } ?> 
						<?php if (!empty($settings['process_desc'])) { ?>
							<div class="desc"><?php  echo wp_kses_post( $settings['process_desc'] ); ?></div>
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
