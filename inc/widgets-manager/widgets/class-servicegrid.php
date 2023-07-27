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

class ServiceGrid extends Widget_Base {
	public function get_name() {
		return 'servicegrid';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'SoftCoders Service Grid', 'SoftCoders-header-footer-elementor' );
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
				'label' => __( 'General Settings', 'SoftCoders-header-footer-elementor' ),
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
					'style3' => esc_html__('Style 3', 'scaddons'),
					'style4' => esc_html__('Style 4', 'scaddons'),
					'style5' => esc_html__('Style 5', 'scaddons'),
                    'style6' => esc_html__('Style 6', 'scaddons'),
                    'style7' => esc_html__('Style 7', 'scaddons'),
					'style8' => esc_html__('Style 8', 'scaddons'),
				],
			]
		);
        $this->add_control(
            'select_icon__',
            [
                'label'   => esc_html__('Select Icon', 'scaddons'),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('Default', 'scaddons'),
                    'icon' => esc_html__('Icon', 'scaddons'),
                    'img' => esc_html__('Image', 'scaddons'),
                ],
            ]
        );
        $this->add_control(
			'sevice_image',
			[
				'label' => esc_html__('Choose Image', 'scaddon'),
				'type' => Controls_Manager::MEDIA,
				'separator' => 'before',
				'condition' => [
                    'service_style' => ['style3', 'style4','style2'],
					'select_icon__' => ['img'],
				],
			]
		);
		$this->add_control(
			'icon',
			[
				'label'       => __( 'Icon', 'SoftCoders-header-footer-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => 'true',
                'condition' => [
                    'select_icon__' => ['icon'],
                ]

			]
		);
		$this->add_control(
			'title',
			[
				'label'   => __( 'Service Title', 'SoftCoders-header-footer-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Service Title', 'SoftCoders-header-footer-elementor' ),
			]
		);
        $this->add_control(
            'service_number__',
            [
                'label'   => __( 'Service Number', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( '1', 'SoftCoders-header-footer-elementor' ),
                'condition' => [
                    'service_style' => ['style8'],
                ]
            ]
        );
		$this->add_control(
			'title_link',
			[
				'label'       => __( 'Title Link', 'SoftCoders-header-footer-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'placeholder' => __( 'https://your-link.com', 'SoftCoders-header-footer-elementor' ),
                'condition' =>[
                    'service_style!'=>['style2']
                ]
			]
		);
		$this->add_control(
			'service_desc',
			[
				'label'   => __( 'Service Description', 'SoftCoders-header-footer-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Busto auctor lectus better best conbia euismot rhoncus dolora gorgeous system nicest does had blessed face winged female', 'SoftCoders-header-footer-elementor' ),
			]
		);
        $this->add_control(
            'service_eight_number__',
            [
                'label'   => __( 'Number', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( '−1,777.64 (1.28%)', 'SoftCoders-header-footer-elementor' ),
                'condition' => [
                    'service_style' => ['style2'],
                ]
            ]
        );
        $this->add_control(
            'service_eight_number_icon',
            [
                'label'       => __( 'Number Icon', 'SoftCoders-header-footer-elementor' ),
                'type'        => Controls_Manager::ICONS,
                'label_block' => 'true',
                'condition' => [
                    'service_style' => ['style2'],
                ]

            ]
        );
        $this->add_control(
            'bg_image_',
            [
                'label' => esc_html__('Background Image', 'scaddon'),
                'type' => Controls_Manager::MEDIA,
                'separator' => 'before',
                'condition' => [
                   'service_style' => ['style2'],
                ],
            ]
        );
		$this->add_control(
			'read_text',
			[
				'label'   => __( 'Read More', 'SoftCoders-header-footer-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Read More', 'SoftCoders-header-footer-elementor' ),
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'service_style' => ['style1', 'style3'],
				]
			]
		);
		$this->add_control(
			'readmore_icon',
			[
				'label'       => __( 'Read More Icon', 'SoftCoders-header-footer-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => 'true',
				'condition' => [
					'service_style' => ['style4', 'style6'],
				]
			]
		);
		$this->add_control(
			'read_link',
			[
				'label'       => __( 'Read More Link', 'SoftCoders-header-footer-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'placeholder' => __( 'https://your-link.com', 'SoftCoders-header-footer-elementor' ),
				'condition' => [
					'service_style' => ['style1', 'style3', 'style4'],
				]
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
					'{{WRAPPER}} .sc-service-content-box, {{WRAPPER}} .sc-about-item, {{WRAPPER}} .service-content-box' => 'text-align: {{VALUE}};',
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
				'selectors' => [
					'{{WRAPPER}} .sc-services-item .sc-service-content .title, {{WRAPPER}} .sc-about-service-box a.title, {{WRAPPER}} .sc-services-style3 .service-title a, {{WRAPPER}} .sc-service-style-three .title, {{WRAPPER}} .sc-service-content-box .sc-service-text .title, {{WRAPPER}} .sc-about-item .sc-process-content .title, {{Wrapper}} .sc-service-section-area .sc-service-content-box a, {{WRAPPER}} .sc-service-content h4 a,{{WRAPPER}} .sc-service-section-area3 .sc-service-content-box h4 a , {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box h4, {{WRAPPER}} .sc-service-section-area4 .sc-service-content-box h4 a , {{WRAPPER}} .sc-service-section-area4 .sc-service-content-box h4, {{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area h4, {{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-crupto-content-box .sc-content h4' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .sc-services-item .sc-service-content .title:hover, {{WRAPPER}} .sc-about-service-box:hover a.title, {{WRAPPER}} .sc-services-style3:hover .service-title a, {{WRAPPER}} .sc-service-style-three:hover .title, {{WRAPPER}} .sc-service-content-box:hover .sc-service-text .title, {{WRAPPER}} .sc-about-item:hover .sc-process-content .title , {{WRAPPER}} .sc-service-section-area .sc-service-content-box a:hover,  {{WRAPPER}} .sc-service-content h4 a:hover,{{WRAPPER}} .sc-service-section-area3 .sc-service-content-box h4:hover a,{{WRAPPER}} .sc-service-section-area3 .sc-service-content-box h4:hover,{{WRAPPER}} .sc-service-section-area4 .sc-service-content-box h4:hover a , {{WRAPPER}} .sc-service-section-area4 .sc-service-content-box h4:hover,{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area h4:hover, {{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-crupto-content-box .sc-content h4:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .sc-about-service-box a.title, {{WRAPPER}} .sc-services-style3 .service-title a, {{WRAPPER}} .sc-service-content-box .sc-service-text .title, {{WRAPPER}} .sc-about-item .sc-process-content .title, {{WRAPPER}} .sc-service-section-area .sc-service-content-box a, {{WRAPPER}} .sc-service-content > *, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box h4,{{WRAPPER}} .sc-service-section-area3 .sc-service-content-box h4 a,{{WRAPPER}} .sc-service-section-area4 .sc-service-content-box h4 a , {{WRAPPER}} .sc-service-section-area4 .sc-service-content-box h4,{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area h4, {{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-crupto-content-box .sc-content h4',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'              => __( 'Title Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-services-item .sc-service-content .title, {{WRAPPER}} .sc-about-service-box a.title, {{WRAPPER}} .sc-services-style3 .service-title a, {{WRAPPER}} .sc-service-content-box .sc-service-text .title, {{WRAPPER}} .sc-about-item .sc-process-content .title, {{WRAPPER}} .sc-service-content, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box h4, {{WRAPPER}} .sc-service-section-area4 .sc-service-content-box h4,{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area h4, {{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-crupto-content-box .sc-content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
				'label'     => __( 'Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}}.sc-services-item .des, {{WRAPPER}} .sc-about-service-box .des, {{WRAPPER}} .sc-services-style3 .des, {{WRAPPER}} .sc-service-content-box .sc-service-text p, {{WRAPPER}} .sc-service-style-three .des, {{WRAPPER}} .sc-about-item .sc-process-content p, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box .description, {{WRAPPER}} .sc-service-section-area4 .sc-service-content-box .description,{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area .description, {{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-crupto-content-box .sc-content span' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .sc-services-style3 .des, {{WRAPPER}} .sc-service-content-box .sc-service-text p, {{WRAPPER}} .sc-about-item .sc-process-content p, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box .description,{{WRAPPER}} .sc-service-section-area4 .sc-service-content-box .description,{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area .description, {{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-crupto-content-box .sc-content span',
			]
		);
		$this->add_responsive_control(
			'desc_margin',
			[
				'label'              => __( 'Descriptiontle Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}}.sc-services-item .des, {{WRAPPER}} .sc-services-style3 .des, {{WRAPPER}} .sc-service-content-box .sc-service-text p, {{WRAPPER}} .sc-about-item .sc-process-content p, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box .description,{{WRAPPER}} .sc-service-section-area4 .sc-service-content-box .description,{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area .description, {{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-crupto-content-box .sc-content span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
			'icon_bg',
			[
				'label'     => __( 'Icon Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'icon[value]!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sc-services-item .sc-service-btn, {{WRAPPER}} .sc-services-item .services-icon i, {{WRAPPER}} .sc-services-style3 .sc-services-icon i, {{WRAPPER}} .sc-service-content-box .sc-service-icon i, {{WRAPPER}} .sc-about-item .about-icon i,
					{{WRAPPER}} .sc-service-style-three .icomoon, {{WRAPPER}} .service_icon, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box .service-icon, {{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area .service-icon'  => 'background: {{VALUE}};',
				],
			]
		);
        $this->add_control(
            'icon_bg_img_gradiant_title',
            [
                'label' => esc_html__( 'Icon Background Image & Gradiant', 'SoftCoders-header-footer-elementor' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg_img_gradiant',
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sc-service-section-area4 .sc-service-content-box .service_icon:before, {{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area .service-icon',
            ]
        );
		$this->add_control(
			'icon_hover_bg',
			[
				'label'     => __( 'Icon Hover Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'icon[value]!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sc-services-item:hover .sc-service-btn, {{WRAPPER}} .sc-services-item .services-icon i, {{WRAPPER}} .sc-services-style3:hover .sc-services-icon i, {{WRAPPER}} .sc-service-content-box:hover .sc-service-icon i, {{WRAPPER}} .sc-about-item:hover .about-icon i,
					{{WRAPPER}} .sc-service-style-three:hover .icomoon, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box .service-icon:HOVER'  => 'background: {{VALUE}};',
				],
			]
		);
        $this->add_control(
            'icon_dashed_border_color',
            [
                'label'     => __( 'Icon Dashed Border Color', 'SoftCoders-header-footer-elementor' ),
                'type'      => Controls_Manager::COLOR,
               'condition' => [
                    'service_style' => ['style6'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-service-section-area2 .service-content-box:before'  => 'border-top: 1px dashed {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
			'icon_indent',
			[
				'label'              => __( 'Icon Padding', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'condition' => [
					'icon[value]!' => '',
				],
				'selectors'          => [
					'{{WRAPPER}} .sc-services-style3 .sc-services-icon i, {{WRAPPER}} .sc-service-content-box .sc-service-icon i, {{WRAPPER}} .sc-about-item .about-icon i, {{WRAPPER}} .service-icon svg, {{WRAPPER}} .service-icon i, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box .service-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label'              => __( 'Icon Wrapper Border Radius', 'staco-core' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px' ],
                'condition' => [
                    'icon[value]!' => '',
                ],
                'selectors'          => [
                    '{{WRAPPER}} .service_icon, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box .service-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .sc-services-style3 .sc-services-icon i, {{WRAPPER}} .sc-service-content-box .sc-service-icon i, {{WRAPPER}} .sc-about-item .about-icon i, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box .service-icon'
			]
		);
		$this->add_control( 
			'icon_color',
			[
				'label'     => __( 'Icon Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'icon[value]!' => '',
				],
				'selectors' => [
					'.btn-signin {{WRAPPER}} .sc-services-item .sc-service-btn i path, {{WRAPPER}} .sc-services-item .services-icon path, {{WRAPPER}} .sc-services-style3 .sc-services-icon i path, {{WRAPPER}} .sc-about-service-box i path, {{WRAPPER}} .sc-service-content-box .sc-service-icon i path, {{WRAPPER}} .sc-service-style-three .icomoon, {{WRAPPER}} .sc-about-item .about-icon i path'   => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .sc-service-style-three .icomoon path, {{WRAPPER}} .sc-service-section-area .sc-service-content-box .sc-service-icon svg'   => 'fill: {{VALUE}};',
					'{{WRAPPER}} .sc-service-section-area .sc-service-content-box .sc-service-icon i, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box .service-icon i, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box .service-icon svg path, {{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area .service-icon svg path,{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area .service-icon i'   => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control( 
			'icon_hover_color',
			[
				'label'     => __( 'Icon Hover Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'icon[value]!' => '',
				],
				'selectors' => [
					'.sc-services-item:hover .sc-service-btn i path, {{WRAPPER}} .sc-services-item .services-icon path, {{WRAPPER}} .sc-services-style3:hover .sc-services-icon i path, {{WRAPPER}} .sc-about-service-box:hover i path, {{WRAPPER}} .sc-service-style-three:hover .icomoon, {{WRAPPER}} .sc-service-content-box:hover .sc-service-icon i path, {{WRAPPER}} .sc-about-item:hover .about-icon i path'   => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .sc-service-style-three:hover i path, {{WRAPPER}} .sc-service-content-box:hover .sc-service-icon i path, {{WRAPPER}} .sc-service-section-area .sc-service-content-box:hover .sc-service-icon svg path'   => 'fill: {{VALUE}};',
					'{{WRAPPER}} .sc-service-section-area .sc-service-content-box:hover .sc-service-icon i, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box .service-icon:hover i, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box .service-icon:hover svg path'   => 'color: {{VALUE}};',
					
				],
			]
		);
		$this->add_control(
			'icon_bg_color',
			[
				'label'     => __( 'Icon Hover Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'icon[value]!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sc-services-item .services-icon path, {{WRAPPER}} .sc-service-style-three:hover i, {{WRAPPER}} .sc-about-service-box:hover i path, {{WRAPPER}} .sc-services-style3:hover .sc-services-icon i, {{WRAPPER}} .sc-service-content-box:hover .sc-service-icon i, {{WRAPPER}} .sc-about-item:hover .about-icon i'   => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'icon_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .sc-about-item .about-icon i, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box .service-icon i',
			]
		);
        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__( 'Icon Width', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-about-item .about-icon i svg, {{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area .service-icon' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sc-service-content-box .sc-service-icon i svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sc-services-style3 .sc-services-icon i svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sc-service-style-three i svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .service_icon,' => 'width: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        $this->add_responsive_control(
            'icon_height',
            [
                'label' => esc_html__( 'Icon Height', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-about-item .about-icon i svg, {{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area .service-icon' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .service_icon' => 'height: {{SIZE}}{{UNIT}};',
                ],                
            ]
        ); 
        $this->add_responsive_control(
            'icon_line_height',
            [
                'label' => esc_html__( 'Icon Line Height', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .service_icon, {{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area .service-icon' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
			'section_area_margin',
			[
				'label'              => __( 'Icon Area Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-services-image, {{WRAPPER}} .sc-service-section-area .sc-service-content-box .sc-service-icon, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box .service-icon,{{WRAPPER}} .sc-service-section-area4 .sc-service-content-box .service_icon, {{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area .service-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'selector' => '{{WRAPPER}} .sc-service-icon i, {{WRAPPER}} .sc-service-section-area3 .sc-service-content-box .service-icon,{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area .service-icon',
            ]
        );
		$this->add_control(
			'border_radiusread',
			[
				'label'     => __( 'Border Radius', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'   => [
					'size' => 3,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .sc-service-icon i,{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area .service-icon' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();

        $this->start_controls_section(
            'section_img',
            [
                'label'     => __( 'Icon Image Style', 'SoftCoders-header-footer-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'select_icon__' => ['img'],
                ],
            ]
        );
        $this->add_control(
            'img__bg',
            [
                'label'     => __( 'Image Background', 'SoftCoders-header-footer-elementor' ),
                'type'      => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-crupto-content-box .sc-crupto-icon'  => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'              => __( 'Image Border Radius', 'staco-core' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px' ],
                'selectors'          => [
                    '{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-crupto-content-box .sc-crupto-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'img__width',
            [
                'label' => esc_html__( 'Image Width', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-crupto-content-box .sc-crupto-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'img__height',
            [
                'label' => esc_html__( 'Image Height', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-crupto-content-box .sc-crupto-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'img__line_height',
            [
                'label' => esc_html__( 'Image Line Height', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-crupto-content-box .sc-crupto-icon' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'img_section_area_margin',
            [
                'label'              => __( 'Image Area Margin', 'staco-core' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px' ],
                'selectors'          => [
                    '{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-crupto-content-box .sc-crupto-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'img_area__border',
                'selector' => '{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-crupto-content-box .sc-crupto-icon',
            ]
        );
        $this->end_controls_section();

		$this->start_controls_section(
			'section_readmore',
			[
				'label' => __( 'Read More', 'SoftCoders-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'service_style' => ['style1', 'style3', 'style4', 'style6'],
				]
			]
		);
		$this->add_control(
			'border_radius2',
			[
				'label'     => __( 'Border Radius', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'   => [
					'size' => 3,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .sc-transparent-btn' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_toggle_color' );
		$this->start_controls_tab(
			'tab_toggle_normal',
			[
				'label' => __( 'Normal', 'SoftCoders-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'readmore_color',
			[
				'label'     => __( 'Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-transparent-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .service-btn path' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .sc-service-style-three .sc-service-btn' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .sc-services-item .sc-service-btn i path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'readmore_bg_color',
			[
				'label'     => __( 'Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-service-btn, {{WRAPPER}} .sc-service-style-three .sc-service-btn, {{WRAPPER}} .sc-transparent-btn:after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .sc-services-item .sc-service-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'readmore_beforebg_color',
			[
				'label'     => __( 'Before Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-services-item .sc-service-btn:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'readmore_border_color',
			[
				'label'     => __( 'Border Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-service-btn, {{WRAPPER}} .sc-service-style-three .sc-service-btn, {{WRAPPER}} .sc-transparent-btn' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_toggle_hover',
			[
				'label' => __( 'Hover', 'SoftCoders-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'readmore_hover_color',
			[
				'label'     => __( 'Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-transparent-btn:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sc-service-style-three:hover .service-btn path' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .sc-services-item:Hover .sc-service-btn i path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'readmore_hover_bg_color',
			[
				'label'     => __( 'Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-service-btn:hover, {{WRAPPER}} .sc-transparent-btn:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .sc-service-style-three:hover .service-btn:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .sc-services-item:hover .sc-service-btn:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'readmore_hover_border_color',
			[
				'label'     => __( 'Border Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-service-btn:hover, {{WRAPPER}} .sc-transparent-btn:hover' => 'border-color: {{VALUE}};',
					
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Service Content Style
        $this->start_controls_section(
			'section_content_style',
			[
				'label'     => __( 'Service Content Style', 'SoftCoders-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon[value]!' => '',
				],
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'selector' => '{{WRAPPER}} .sc-service-text',
            ]
        );
		$this->add_control(
			'content_border_radius',
			[
				'label'     => __( 'Content Border Radius', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'   => [
					'size' => 3,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .sc-service-text' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'              => __( 'Content Padding', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-service-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();

		// Service Global Style
		$this->start_controls_section(
			'section_global_style',
			[
				'label'     => __( 'Service Global Style', 'SoftCoders-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'sec_margin',
			[
				'label'              => __( 'Area Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-services-item, {{WRAPPER}} .sc-about-service-box, {{WRAPPER}} .sc-services-style3, {{WRAPPER}} .sc-service-style-three, {{WRAPPER}} .sc-about-item, {{WRAPPER}} .sc-service-content-box, {{WRAPPER}} .sc-service-section-area4 .sc-service-content-box,{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
                'condition' => [
                        'service_style!' => ['style8','style2'],
                ],

			]
		);
        $this->add_responsive_control(
            'sec_margin_style_eight',
            [
                'label'              => __( 'Area Margin', 'staco-core' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px' ],
                'selectors'          => [
                    '{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area, {{WRAPPER}} .sc-crupto-section-area .sc-crupto-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',

                ],
                'condition' => [
                        'service_style' => ['style8','style2'],
                ],
            ]
        );
		$this->add_responsive_control(
			'section_padding',
			[
				'label'              => __( 'Area Padding', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-service-style-three, {{WRAPPER}} .sc-services-item, {{WRAPPER}} .sc-about-service-box, {{WRAPPER}} .sc-services-style3, {{WRAPPER}} .sc-about-item, .sc-service-style-three, {{WRAPPER}} .sc-service-content-box, {{WRAPPER}} .sc-service-section-area4 .sc-service-content-box , {{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
                'condition' => [
                        'service_style!' => ['style8','style2'],
                ],
			]
		);
        $this->add_responsive_control(
            'sec_padding_style_eight',
            [
                'label'              => __( 'Area Padding', 'staco-core' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px' ],
                'selectors'          => [
                    '{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area, {{WRAPPER}} .sc-crupto-section-area .sc-crupto-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',

                ],
                'condition' => [
                        'service_style' => ['style8','style2'],
                ],
            ]
        );
        $this->add_responsive_control(
            'section_border_radius',
            [
                'label'              => __( 'Border Radius', 'staco-core' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px' ],
                'selectors'          => [
                    '{{WRAPPER}} .sc-service-section-area3 .sc-service-content-box,{{WRAPPER}} .sc-service-section-area4 .sc-service-content-box,{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area,{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .sc-services-item, {{WRAPPER}} .sc-about-service-box, {{WRAPPER}} .sc-service-section-area .sc-service-content-box:after, .sc-service-section-area .sc-service-content-box:before, {{WRAPPER}} .sc-services-style3, {{WRAPPER}} .sc-service-content-box, {{WRAPPER}} .sc-service-section-area4 .sc-service-content-box, {{WRAPPER}} .sc-crupto-section-area .sc-crupto-item'  => 'background: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_group',
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area, {{WRAPPER}} .sc-crupto-section-area .sc-crupto-item',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'section__box_shadow',
                'selector' => '{{WRAPPER}} .sc-service-section-area3 .sc-service-content-box, {{WRAPPER}} .sc-service-section-area4 .sc-service-content-box, {{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-area, {{WRAPPER}} .sc-crupto-section-area .sc-crupto-item',
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
					'{{WRAPPER}} .sc-services-style3:hover, {{WRAPPER}} .sc-service-content-box:hover'   => 'background: {{VALUE}};',
					'{{WRAPPER}} .sc-about-service-box::before, {{WRAPPER}} .sc-service-section-area4:hover .sc-service-content-box' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_hover_border_color',
			[
				'label'     => __( 'Border Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .sc-services-style3:hover, {{WRAPPER}} .sc-service-content-box:hover'   => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .sc-service-section-area: .sc-service-content-box'   => 'border: 1px solid {{VALUE}};',
				],
			]
		);
         $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'section_hover_box_shadow',
                'selector' => '{{WRAPPER}} .sc-service-section-area3 .sc-service-content-box:hover, {{WRAPPER}} .sc-service-section-area4:hover .sc-service-content-box',
            ]
        );
 
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
        $this->start_controls_section(
            'service_number_style',
            [
                'label'     => __( 'Service Number Style', 'SoftCoders-header-footer-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                 'condition' => [
                        'service_style' => ['style8', 'style2'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'number_bg__',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-number',
                'condition' => [
                        'service_style' => ['style8'],
                        'service_style!' => ['style2'],
                ],
            ]
        );
        $this->add_responsive_control(
            'number___width',
            [
                'label' => esc_html__( 'Width', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-number .sc-number' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                        'service_style' => ['style8'],
                        'service_style!' => ['style2'],
                ],
            ]
        );

        $this->add_responsive_control(
            'number___height',
            [
                'label' => esc_html__( 'Height', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-number .sc-number' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                        'service_style' => ['style8'],
                        'service_style!' => ['style2'],
                ],
            ]
        );
        $this->add_responsive_control(
            'number___line__height',
            [
                'label' => esc_html__( 'Line Height', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-number .sc-number' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                        'service_style' => ['style8'],
                        'service_style!' => ['style2'],
                ],
            ]
        );
        $this->add_control(
            'number___color',
            [
                'label'     => __( ' Text Color', 'SoftCoders-header-footer-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-number .sc-number, {{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-red-color'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'number___typo',
                'selector' => '{{WRAPPER}} .sc-service-section-area7 .sc-service-content-box .sc-text-number .sc-number, {{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-red-color',
            ]
        );

        $this->add_control(
            'number_icon__color',
            [
                'label'     => __( 'Icon Color', 'SoftCoders-header-footer-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-red-color i, {{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-red-color svg path'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-red-color svg path'   => 'fill: {{VALUE}};',
                ],
                'condition'=>[
                    'service_style' => ['style2'],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'number_icon__typo',
                'selector' => '{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-red-color i',
                'condition'=>[
                    'service_style' => ['style2'],
                ],
            ]
        );
        $this->add_responsive_control(
            'number_margin__',
            [
                'label'              => __( 'Text Margin', 'staco-core' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px' ],
                'selectors'          => [
                    '{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-red-color' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition'=>[
                    'service_style' => ['style2'],
                ],
            ]
        );
        $this->add_responsive_control(
            'number_padding__',
            [
                'label'              => __( 'Text Padding', 'staco-core' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px' ],
                'selectors'          => [
                    '{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-red-color' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition'=>[
                    'service_style' => ['style2'],
                ],
            ]
        );
        $this->add_responsive_control(
            'number_icon__margin__',
            [
                'label'              => __( 'Icon Margin', 'staco-core' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px' ],
                'selectors'          => [
                    '{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-red-color svg ,{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-red-color i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition'=>[
                    'service_style' => ['style2'],
                ],
            ]
        );
        $this->add_responsive_control(
            'number_icon__padding__',
            [
                'label'              => __( 'Icon Padding', 'staco-core' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px' ],
                'selectors'          => [
                    '{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-red-color svg ,{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item .sc-red-color i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition'=>[
                    'service_style' => ['style2'],
                ],
            ]
        );
        $this->add_responsive_control(
            'number___bg__width',
            [
                'label' => esc_html__( 'Background Width', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-crupto-section-area .sc-crupto-item img.sc-crupto-img' => 'width: {{SIZE}}{{UNIT}}; height:auto;',
                ],
                'condition' => [
                    'service_style' => ['style2'],
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


            <div class="sc-service-section-area3 ">
                <div class="sc-service-content-box">
                    <?php if ( '' !== $settings['icon']['value'] ) { ?>
                        <div class="service-icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
                    <?php } ?>

                    <?php if (!empty($settings['title'])) { ?>
                        <?php if (!empty($settings['title_link'])) {?>
                            <h4><a href="<?php echo wp_kses_post( $settings['title_link'] ); ?>"><?php echo wp_kses_post( $settings['title'] ); ?></a></h4>
                        <?php } ?>
                        <?php if (empty($settings['title_link'])) {?>
                            <h4><?php echo wp_kses_post( $settings['title'] ); ?></h4>
                        <?php } ?>
                     <?php } ?>

                    <?php if (!empty($settings['service_desc'])) { ?>
                        <div class="description"><?php  echo wp_kses_post( $settings['service_desc'] ); ?></div>
                    <?php } ?>

                    <?php if (!empty($settings['read_text'])) { ?>
                        <div class="sc-service-btn">
                            <a class="sc-transparent-btn" href="<?php echo wp_kses_post( $settings['read_link'] ); ?>"><?php echo wp_kses_post( $settings['read_text'] ); ?></a>
                        </div>
                    <?php } ?>

                </div>
            </div>

		<?php } ?> 

		<?php if ('style2' == $settings['service_style']) {  ?>
            <div class="sc-crupto-section-area">
                <div class="sc-crupto-item">
                    <div class="sc-crupto-content-box d-flex align-items-center">
                        <?php if ( '' !== $settings['icon']['value'] ) { ?>
                            <div class="sc-crupto-icon">
                               <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </div>
                        <?php } ?>

                        <?php if (!empty($settings['sevice_image']['url'])) : ?>
                            <div class="sc-crupto-icon">
                                <img src="<?php echo esc_url($settings['sevice_image']['url']); ?>" alt="image" />
                            </div>
                        <?php endif; ?>

                        <div class="sc-content">
                            <?php if (!empty($settings['title'])) {?>
                                <h4><?php echo wp_kses_post( $settings['title'] ); ?></h4>
                            <?php } ?>
                            <?php if (!empty($settings['service_desc'])) { ?>
                                <span><?php  echo wp_kses_post( $settings['service_desc'] ); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="sc-crupto-text sc-red-color">
                        <?php if (!empty($settings['service_eight_number__'])) { ?>
                            <?php  echo wp_kses_post( $settings['service_eight_number__'] ); ?>
                        <?php }?>
                         <?php if ( '' !== $settings['service_eight_number_icon']['value'] ) { ?>
                               <?php \Elementor\Icons_Manager::render_icon( $settings['service_eight_number_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        <?php } ?>
                    </div>

                    <?php if (!empty($settings['bg_image_']['url'])) : ?>
                        <img class="sc-crupto-img" src="<?php echo esc_url($settings['bg_image_']['url']); ?>" alt="images" />
                    <?php endif; ?>

                </div>
            </div>
		<?php } ?> 

		<?php if ('style3' == $settings['service_style']) {  ?>
			<div class="sc-services-style3 d-flex justify-content-between">
				<?php if (!empty($settings['sevice_image']['url'])) : ?>
				<div class="sc-service-image">
					<img src="<?php echo esc_url($settings['sevice_image']['url']); ?>" alt="image" />
				</div>
				<?php endif; ?>
				<div class="sc-service-text">
					<?php if ( '' !== $settings['icon']['value'] ) { ?>
					<div class="sc-services-icon">
						<i><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></i>
					</div>
					<?php } ?> 
					<?php if (!empty($settings['title'])) { ?>
					<h4 class="service-title"><a href="<?php echo wp_kses_post( $settings['title_link'] ); ?>"><?php echo wp_kses_post( $settings['title'] ); ?></a></h4>
					<?php } ?>
					<?php if (!empty($settings['service_desc'])) { ?>
						<p class="des"><?php  echo wp_kses_post( $settings['service_desc'] ); ?></p>
					<?php } ?>
					<?php if (!empty($settings['read_text'])) { ?>		
					<div class="sc-service-btn">
						<a class="sc-transparent-btn" href="<?php echo wp_kses_post( $settings['read_link'] ); ?>"><?php echo wp_kses_post( $settings['read_text'] ); ?>							</a> 
					</div>
					<?php } ?>
				</div>
			</div>
		<?php } ?>

		<?php if ('style4' == $settings['service_style']) {  ?>

            <div class="sc-service-section-area4 ">
                <div class="sc-service-content-box service_frame">

                    <?php if (!empty($settings['sevice_image']['url'])) : ?>
                        <div class="sc-service-image">
                            <img src="<?php echo esc_url($settings['sevice_image']['url']); ?>" alt="image" />
                        </div>
                    <?php endif; ?>

                    <?php if ( '' !== $settings['icon']['value'] ) { ?>
                        <div class="service_icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
                    <?php } ?>

                    <?php if (!empty($settings['title'])) { ?>
                        <?php if (!empty($settings['title_link'])) {?>
                            <h4><a href="<?php echo wp_kses_post( $settings['title_link'] ); ?>"><?php echo wp_kses_post( $settings['title'] ); ?></a></h4>
                        <?php } ?>
                        <?php if (empty($settings['title_link'])) {?>
                            <h4><?php echo wp_kses_post( $settings['title'] ); ?></h4>
                        <?php } ?>
                     <?php } ?>

                    <?php if (!empty($settings['service_desc'])) { ?>
                        <div class="description"><?php  echo wp_kses_post( $settings['service_desc'] ); ?></div>
                    <?php } ?>

                    <?php if (!empty($settings['read_text'])) { ?>
                        <div class="sc-service-btn">
                            <a class="sc-transparent-btn" href="<?php echo wp_kses_post( $settings['read_link'] ); ?>"><?php echo wp_kses_post( $settings['read_text'] ); ?></a>
                        </div>
                    <?php } ?>

                </div>
            </div>

        <?php } ?> 

		<?php if ('style5' == $settings['service_style']) {  ?>
			<div class="sc-about-service-box">
				<?php if ( '' !== $settings['icon']['value'] ) { ?>
					<i class="p-z-idex position-relative icomoon"><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></i>
				<?php } ?>
				<?php if (!empty($settings['title'])) { ?>
					<h4 class="title p-z-idex position-relative">
						<a class="title" href="<?php echo wp_kses_post( $settings['title_link'] ); ?>"><?php echo wp_kses_post( $settings['title'] ); ?></a>
					</h4>
				<?php } ?>

				<p class="des p-z-idex position-relative">
					<?php  echo wp_kses_post( $settings['service_desc'] ); ?>
				</p>

				<?php if ( '' !== $settings['icon']['value'] ) { ?>
					<div class="sc-hover-overly">
					<i class="p-z-idex position-relative"><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></i>
					</div>
				<?php } ?>
			</div>
        <?php } ?>
		<?php if ('style6' == $settings['service_style']) {  ?>
            <div class="sc-service-section-area2">
               <div class="service-content-box">
    				<?php if ( '' !== $settings['icon']['value'] ) { ?>
                        <div class="service_icon">
    					   <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
    				<?php } ?>

    				<div class="sc-service-content">
                        <?php if (!empty($settings['title'])) { ?>
    					<h4>
    						<a class="title" href="<?php echo wp_kses_post( $settings['title_link'] ); ?>"><?php echo wp_kses_post( $settings['title'] ); ?></a>
    					</h4>
    					<?php } ?>
                        <?php if (!empty($settings['service_desc'])) { ?>
    						<p class="des"><?php  echo wp_kses_post( $settings['service_desc'] ); ?></p>
    					<?php } ?>
    				</div>
    			</div>
            </div>

        <?php } ?>

        <?php if ('style7' == $settings['service_style']) {  ?>
          <div class="sc-service-section-area">
            <div class="sc-service-content-box">
                <?php if ( '' !== $settings['icon']['value'] ) { ?>
                        <div class="sc-service-icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
                <?php } ?>

                    <h4 class="sc-mb-0"><a class="sc-service-btn" href="<?php echo wp_kses_post( $settings['title_link'] ); ?>"><?php echo wp_kses_post( $settings['title'] ); ?></a>
                    </h4>
            </div>
          </div>

        <?php } ?>

         <?php if ('style8' == $settings['service_style']) {  ?>
            <div class="sc-service-section-area7 ">
                <div class="sc-service-content-box">
                    <div class="sc-text-area">
                        <?php if ( '' !== $settings['icon']['value'] ) { ?>
                            <div class="service-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </div>
                        <?php } ?>
                        <?php if (!empty($settings['title'])) { ?>
                            <?php if (!empty($settings['title_link'])) {?>
                                <h4><a href="<?php echo wp_kses_post( $settings['title_link'] ); ?>"><?php echo wp_kses_post( $settings['title'] ); ?></a></h4>
                                <?php } ?>
                            <?php if (empty($settings['title_link'])) {?>
                                <h4><?php echo wp_kses_post( $settings['title'] ); ?></h4>
                            <?php } ?>
                        <?php } ?>

                        <?php if (!empty($settings['service_desc'])) { ?>
                            <div class="description"><?php  echo wp_kses_post( $settings['service_desc'] ); ?></div>
                        <?php } ?>
                    </div>

                    <?php if (!empty($settings['service_number__'])) { ?>
                        <div class="sc-text-number">
                            <span class="sc-number"><?php echo wp_kses_post( $settings['service_number__'] ); ?></span>
                        </div>

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