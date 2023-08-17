<?php
namespace softcoderselements\WidgetsManager\Widgets;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Border;
if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class TestimonialSlider extends Widget_Base {
	public function get_name() {
		return 'testimonial-slider';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Softcoders Testimonial Slider', 'SoftCoders-header-footer-elementor' );
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
            'testimonial_list',
            [
                'label' => __('Testimonial List', 'scaddon'),
            ]
        );
        $this->add_control(
            'arrow_icon',
            [
                'label' => __('Arrow Icon', 'scaddon'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'descrition',
            [
                'label' => __('Descrition', 'scaddon'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Lucinda Banfield', 'scaddon'),
            ]
        );
        $repeater->add_control(
            'image',
            [
                'label' => __('Author Image', 'scaddon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],

            ]
        );
        $repeater->add_control(
            'rating_icon',
            [
                'label' => __('Rating Icon', 'scaddon'),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        
        $repeater->add_control(
            'author',
            [
                'label' => __('Author Name', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Repair Technician', 'scaddon'),
            ]
        );

        $repeater->add_control(
            'degination',
            [
                'label' => __('Degination', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Repair Technician', 'scaddon'),
            ]
        );

        $this->add_control(
            'items1',
            [
                'label' => __('Repeater List', 'scaddon'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __('Title #1', 'scaddon'),
                        'list_content' => __('
                                                Beginning beast alrigh airot you ando divide subdue Open gathering they
                                                are not nights multiple brings living abundantly centise that may be
                                                wonora created sheller first two one margin herb light
                                            ', 'scaddon'),
                    ],
                    [
                        'list_title' => __('Title #2', 'scaddon'),
                        'list_content' => __('
                                                Beginning beast alrigh airot you ando divide subdue Open gathering they
                                                are not nights multiple brings living abundantly centise that may be
                                                wonora created sheller first two one margin herb light
                                            ', 'scaddon'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_general_fields',
			[
				'label' => __( 'General Settings', 'SoftCoders-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'project_slider_style',
			[
				'label'   => esc_html__( 'Select Style', 'SoftCoders-header-footer-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',				
				'options' => [
					'style1' => 'Style 1',
					'style2' => 'Style 2',
				],											
			]
		);

		$this->add_control(
            'rt_pslider_effect',
            [
                'label' => esc_html__('Slider Effect', 'rtelements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
					'default' => esc_html__('Default', 'rtelements'),					
					'fade' => esc_html__('Fade', 'rtelements'),
					'flip' => esc_html__('Flip', 'rtelements'),
					'cube' => esc_html__('Cube', 'rtelements'),
					'coverflow' => esc_html__('Coverflow', 'rtelements'),
					'creative' => esc_html__('Creative', 'rtelements'),
					'cards' => esc_html__('Cards', 'rtelements'),
                ],
            ]
        );
	
		$this->add_control(
            'col_xl',
            [
                'label'   => esc_html__( 'Wide Screen > 1399px', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,
                'options' => [
                    '1' => esc_html__( '1 Column', 'rtelements' ), 
                    '2' => esc_html__( '2 Column', 'rtelements' ),
                    '3' => esc_html__( '3 Column', 'rtelements' ),
                    '4' => esc_html__( '4 Column', 'rtelements' ),
                    '4.5' => esc_html__( '4.5 Column', 'rtelements' ),
                    '5' => esc_html__( '5 Column', 'rtelements' ),
                    '5.5' => esc_html__( '5.5 Column', 'rtelements' ),
                    '6' => esc_html__( '6 Column', 'rtelements' ),                 
                ],
                'separator' => 'before',
            ]
            
        );
    
        $this->add_control(
            'col_lg',
            [
                'label'   => esc_html__( 'Desktops > 1199px', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,
                'options' => [
                    '1' => esc_html__( '1 Column', 'rtelements' ), 
                    '2' => esc_html__( '2 Column', 'rtelements' ),
                    '3' => esc_html__( '3 Column', 'rtelements' ),
                    '4' => esc_html__( '4 Column', 'rtelements' ),
                    '6' => esc_html__( '6 Column', 'rtelements' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__( 'Desktops > 991px', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'rtelements' ), 
                    '2' => esc_html__( '2 Column', 'rtelements' ),
                    '3' => esc_html__( '3 Column', 'rtelements' ),
                    '4' => esc_html__( '4 Column', 'rtelements' ),
                    '6' => esc_html__( '6 Column', 'rtelements' ),                     
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__( 'Tablets > 767px', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'rtelements' ), 
                    '2' => esc_html__( '2 Column', 'rtelements' ),
                    '3' => esc_html__( '3 Column', 'rtelements' ),
                    '4' => esc_html__( '4 Column', 'rtelements' ),
                    '6' => esc_html__( '6 Column', 'rtelements' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_xs',
            [
                'label'   => esc_html__( 'Tablets < 768px', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'rtelements' ), 
                    '2' => esc_html__( '2 Column', 'rtelements' ),
                    '3' => esc_html__( '3 Column', 'rtelements' ),
                    '4' => esc_html__( '4 Column', 'rtelements' ),
                    '6' => esc_html__( '6 Column', 'rtelements' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slides_ToScroll',
            [
                'label'   => esc_html__( 'Slide To Scroll', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 2,         
                'options' => [
                    '1' => esc_html__( '1 Item', 'rtelements' ),
                    '2' => esc_html__( '2 Item', 'rtelements' ),
                    '3' => esc_html__( '3 Item', 'rtelements' ),
                    '4' => esc_html__( '4 Item', 'rtelements' ),                   
                ],
                'separator' => 'before',
                            
            ]
            
        );      

        $this->add_control(
            'slider_dots',
            [
                'label'   => esc_html__( 'Navigation Dots', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_nav',
            [
                'label'   => esc_html__( 'Navigation Nav', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'pcat_prev_text',
            [
                'label' => esc_html__( 'Previous Text', 'rtelements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Previous', 'rtelements' ),
                'placeholder' => esc_html__( 'Type your title here', 'rtelements' ),
                'condition' => [
                    'slider_nav' => 'true',
                ],
            ]
        );

        $this->add_control(
            'pcat_next_text',
            [
                'label' => esc_html__( 'Next Text', 'rtelements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Next', 'rtelements' ),
                'placeholder' => esc_html__( 'Type your title here', 'rtelements' ),
                'condition' => [
                    'slider_nav' => 'true',
                ],

            ]
        );
        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__( 'Autoplay', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => esc_html__( 'Autoplay Slide Speed', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '1000' => esc_html__( '1 Seconds', 'rtelements' ),
                    '2000' => esc_html__( '2 Seconds', 'rtelements' ), 
                    '3000' => esc_html__( '3 Seconds', 'rtelements' ), 
                    '4000' => esc_html__( '4 Seconds', 'rtelements' ), 
                    '5000' => esc_html__( '5 Seconds', 'rtelements' ), 
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],                          
            ]
            
        );

        $this->add_control(
            'slider_interval',
            [
                'label'   => esc_html__( 'Autoplay Interval', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '5000' => esc_html__( '5 Seconds', 'rtelements' ), 
                    '4000' => esc_html__( '4 Seconds', 'rtelements' ), 
                    '3000' => esc_html__( '3 Seconds', 'rtelements' ), 
                    '2000' => esc_html__( '2 Seconds', 'rtelements' ), 
                    '1000' => esc_html__( '1 Seconds', 'rtelements' ),     
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],                                                      
            ]
            
        );

        $this->add_control(
            'slider_stop_on_interaction',
            [
                'label'   => esc_html__( 'Stop On Interaction', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),              
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],                                                      
            ]
            
        );

        $this->add_control(
            'slider_stop_on_hover',
            [
                'label'   => esc_html__( 'Stop on Hover', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),              
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],                                                      
            ]
            
        );

        $this->add_control(
            'slider_loop',
            [
                'label'   => esc_html__( 'Loop', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_centerMode',
            [
                'label'   => esc_html__( 'Center Mode', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_responsive_control(
            'item_gap_custom',
            [
                'label' => esc_html__( 'Item Gap', 'rtelements' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
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
			'section_slider_style',
			[
				'label' => esc_html__( 'Testimonials Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'descrition_color',
            [
                'label' => esc_html__( 'Descrition Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-content-area .sc-testimonial-content .des' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sc-test-item .sc-testimonial-text .des' => 'color: {{VALUE}};',
                ],                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .sc-slider-content-area .sc-testimonial-content .des, {{WRAPPER}} .sc-test-item .sc-testimonial-text .des ',
            ]
        );
        $this->add_responsive_control(
            'descrition_margin',
            [
                'label'              => __( 'Description Margin', 'SoftCoders-header-footer-elementor' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => ['px', '%'],
                'selectors'          => [
                    '{{WRAPPER}} .sc-slider-content-area .sc-testimonial-content .des, {{WRAPPER}} .sc-test-item .sc-testimonial-text .des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'descrition_padding',
            [
                'label'              => __( 'Description Padding', 'SoftCoders-header-footer-elementor' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => ['px', '%'],
                'selectors'          => [
                    '{{WRAPPER}} .sc-slider-content-area .sc-testimonial-content .des, {{WRAPPER}} .sc-test-item .sc-testimonial-text .des' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'author_color',
            [
                'label' => esc_html__( 'Author Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-auother-texty .title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sc-auother-texty h5' => 'color: {{VALUE}};',

                ],                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'author_typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .sc-auother-texty .title, {{WRAPPER}} .sc-test-item .sc-auother-text .sc-auother-texty h5',
            ]
        );
        $this->add_responsive_control(
            'author_margin',
            [
                'label'              => __( 'Author Margin', 'SoftCoders-header-footer-elementor' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => ['px', '%'],
                'selectors'          => [
                    '{{WRAPPER}} .sc-auother-texty .title, {{WRAPPER}} .sc-test-item .sc-auother-text .sc-auother-texty h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'author_padding',
            [
                'label'              => __( 'Author Padding', 'SoftCoders-header-footer-elementor' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => ['px', '%'],
                'selectors'          => [
                    '{{WRAPPER}} .sc-auother-texty .title, {{WRAPPER}} .sc-test-item .sc-auother-text .sc-auother-texty h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_control(
            'degination_color',
            [
                'label' => esc_html__( 'Degination Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-auother-texty span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sc-auother-texty .sub-title' => 'color: {{VALUE}};',

                ],                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'designation_typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .sc-auother-texty span.sub-title',
            ]
        );
        $this->add_responsive_control(
            'designation_margin',
            [
                'label'              => __( 'Designation Margin', 'SoftCoders-header-footer-elementor' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => ['px', '%'],
                'selectors'          => [
                    '{{WRAPPER}} .sc-auother-texty span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'designation_padding',
            [
                'label'              => __( 'Designation Padding', 'SoftCoders-header-footer-elementor' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => ['px', '%'],
                'selectors'          => [
                    '{{WRAPPER}} .sc-auother-texty span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .sc-services-style3 .service-title a, {{WRAPPER}} .sc-service-content-box .sc-service-text .title, {{WRAPPER}} .sc-about-item .sc-process-content .title',
			]
		);

         $this->add_responsive_control(
			'content_padding',
			[
				'label'              => __( 'Area Padding', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .sc-test-item , {{WRAPPER}} .sc-project-item' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

        $this->add_responsive_control(
			'section_margin',
			[
				'label'              => __( 'Area Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .sc-test-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

        $this->add_control(
            'image_overlay',
            [
                'label' => esc_html__( 'Image Hover Overlay', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'project_slider_style' => 'style3',
                ],
                'selectors' => [
                    '{{WRAPPER}} .project-slider-style3 .project-img .project-img-sec::before' => 'background: {{VALUE}};',

                ],                
            ]
        );
        $this->add_responsive_control(
			'text_align',
			[
				'label'              => __( 'Alignment', 'SoftCoders-header-footer-elementor' ),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
					'left'    => [
						'title' => __( 'Left', 'SoftCoders-header-footer-elementor' ),
						'icon'  => 'fa-solid fa-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'SoftCoders-header-footer-elementor' ),
						'icon'  => 'fa-solid fa-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'SoftCoders-header-footer-elementor' ),
						'icon'  => 'fa-solid fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justify', 'SoftCoders-header-footer-elementor' ),
						'icon'  => 'fa-solid fa-align-justify',
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .sc-testimonial-content' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .sc-test-item' => 'text-align: {{VALUE}};',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'section_navigation_arrow',
			[
				'label' => __( 'Navigation Arrow Style', 'SoftCoders-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_nav' => 'true',
                ],
			]
		);

        $this->add_control(
            'navigation_arrow_color',
            [
                'label' => esc_html__( 'Arrow Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-prev i, {{WRAPPER}} .swiper-button-next i' => 'color: {{VALUE}};',

                ],  
                
            ]
        );

        $this->add_control(
            'navigation_arrow_hover_color',
            [
                'label' => esc_html__( 'Arrow Hover Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-prev:hover i, {{WRAPPER}} .swiper-button-next:hover i' => 'color: {{VALUE}};',

                ],   
                
            ]
        );

        $this->add_control(
            'navigation_arrow_bg_color',
            [
                'label' => esc_html__( 'Arrow Background Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => 'background: {{VALUE}};',

                ],   
                
            ]
        );

        $this->add_control(
            'navigation_arrow_hover_bg',
            [
                'label' => esc_html__( 'Arrow Hover Background', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-prev:hover, {{WRAPPER}} .swiper-button-next:hover' => 'background: {{VALUE}};',

                ],
                
            ]
        );
        $this->add_responsive_control(
			'shape_left_prev_position',
			[
				'label' => esc_html__('Arrow Prev Right Position', 'scaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
					'{{WRAPPER}} .swiper-button-prev' => 'right: {{SIZE}}{{UNIT}}; left:unset;',
				],
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
			'shape_left_next_position',
			[
				'label' => esc_html__('Arrow Next Left Position', 'scaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
					'{{WRAPPER}} .swiper-button-next' => 'left: {{SIZE}}{{UNIT}}; right:unset;',
				],
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
			'shape_bottom_prev_position',
			[
				'label' => esc_html__('Arrow Prev Bottom Position', 'scaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
					'{{WRAPPER}} .swiper-button-prev' => 'bottom: {{SIZE}}{{UNIT}}; top: auto; transform: inherit;',
				],
				'separator' => 'before',
			]
		);


        $this->add_responsive_control(
			'shape_bottom_next_position',
			[
				'label' => esc_html__('Arrow Next Bottom Position', 'scaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
					'{{WRAPPER}} .swiper-button-next' => 'bottom: {{SIZE}}{{UNIT}}; top: auto; transform: inherit;',
				],
				'separator' => 'before',
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'process_border',
                'selector' => '{{WRAPPER}} .swiper-button-prev:after, {{WRAPPER}} .swiper-button-next:after',
            ]
        );

        $this->add_responsive_control(
			'arrow_border_color',
			[
				'label' => esc_html__( 'Arrow Border Color', 'SoftCoders-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-prev:after, {{WRAPPER}} .swiper-button-next:after' => 'border-color: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'arrow_icon_width_height',
			[
				'label' => esc_html__('Arrow Width & Height', 'scaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sc-testimonial-area.sc-arrow-btn .swiper-button-prev,
                    {{WRAPPER}} .sc-testimonial-area.sc-arrow-btn .swiper-button-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                    
				],
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
			'arrow_border_radious_color',
			[
				'label' => esc_html__( 'Arrow Border Radius', 'SoftCoders-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

        $this->start_controls_section(
			'navigation_dotts_settings',
			[
				'label' => esc_html__( 'Dots Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'navigation_dot_border_color',
            [
                'label' => esc_html__( 'Dot Icon Border Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'border-color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'navigation_dot_icon_background',
            [
                'label' => esc_html__( 'Dot Icon Background', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'background: {{VALUE}};',

                ],                
            ]
        );        
		$this->end_controls_section();

        $this->start_controls_section(
			'section_content_style',
			[
				'label'     => __( 'Global Style', 'SoftCoders-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'box_bg',
            [
                'label' => esc_html__( 'Background', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-testimonial-content' => 'background: {{VALUE}};',

                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'test_border',
                'selector' => '{{WRAPPER}} .sc-testimonial-content',
            ]
        );
        $this->add_responsive_control(
			'area_padding',
			[
				'label'              => __( 'Area Padding', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        $this->add_responsive_control(
            'area_margin',
            [
                'label'              => __( 'Area Margin', 'staco-core' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px' ],
                'selectors'          => [
                    '{{WRAPPER}} .sc-testimonial-content' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'SoftCoders-header-footer-elementor' ),
				'selector' => '{{WRAPPER}} .sc-testimonial-content',
			]
		);
        $this->add_responsive_control(
			'area_border_radius',
			[
				'label' => esc_html__( 'Area Border Radius', 'SoftCoders-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sc-testimonial-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
            'rating_and_arrow_icon',
            [
                'label'     => __( 'Rating , Arrow &  Author Image Style', 'SoftCoders-header-footer-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'rating_image_width',
            [
                'label' => esc_html__( 'Rating Image Width', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 65,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-content-area .sc-testimonial-content .testimonial-rating img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'rating_margin_img',
            [
                'label' => esc_html__( 'Rating Margin', 'SoftCoders-header-footer-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-content-area .sc-testimonial-content .testimonial-rating ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'rating_padding_img',
            [
                'label' => esc_html__( 'Rating Padding', 'SoftCoders-header-footer-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-content-area .sc-testimonial-content .testimonial-rating' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // arrow img
        $this->add_responsive_control(
            'arrow_image_width',
            [
                'label' => esc_html__( 'Arrow Image Width', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 65,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-content-area .sc-testimonial-content .arrow-icon img, {{WRAPPER}} .sc-test-item .sc-testimonial-text img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_margin_img',
            [
                'label' => esc_html__( 'Arrow Margin', 'SoftCoders-header-footer-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-content-area .sc-testimonial-content .arrow-icon, {{WRAPPER}} .sc-test-item .sc-testimonial-text img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_padding_img',
            [
                'label' => esc_html__( 'Arrow Padding', 'SoftCoders-header-footer-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-content-area .sc-testimonial-content .arrow-icon, {{WRAPPER}} .sc-test-item .sc-testimonial-text img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'author_image_width',
            [
                'label' => esc_html__( 'Author Image Width', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 65,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-content-area .sc-testimonial-content .sc-slider-auother .auother-image img, {{WRAPPER}} .sc-test-item .sc-auother-text .sc-auother-image img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );



        $this->end_controls_section();
	}

	/**
	 * Render Heading output on the frontend.
	 */
	protected function render() {
		$settings = $this->get_settings();
		$col_xl          = $settings['col_xl'];
        $col_xl          = !empty($col_xl) ? $col_xl : 3;
        $slidesToShow    = $col_xl;
        $autoplaySpeed   = $settings['slider_autoplay_speed'];
        $autoplaySpeed   = !empty($autoplaySpeed) ? $autoplaySpeed : '1000';
        $interval        = $settings['slider_interval'];
        $interval        = !empty($interval) ? $interval : '3000';
        $slidesToScroll  = $settings['slides_ToScroll'];
        $slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
        $pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
        $pauseOnInter    = $settings['slider_stop_on_interaction'] === 'true' ? 'true' : 'false';
        $sliderDots      = $settings['slider_dots'] == 'true' ? 'true' : 'false';
        $sliderNav       = $settings['slider_nav'] == 'true' ? 'true' : 'false';        
        $infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
        $centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
        $col_lg          = $settings['col_lg'];
        $col_md          = $settings['col_md'];
        $col_sm          = $settings['col_sm'];
        $col_xs          = $settings['col_xs']; 
        $item_gap = $settings['item_gap_custom']['size'];
        $item_gap = !empty($item_gap) ? $item_gap : '25';
        $prev_text = $settings['pcat_prev_text'];
        $prev_text = !empty($prev_text) ? $prev_text : '';
        $next_text = $settings['pcat_next_text'];
        $next_text = !empty($next_text) ? $next_text : '';
        $unique = rand(2023,741258);

        if( $slider_autoplay =='true' ){
            $slider_autoplay = 'autoplay: { ' ;
            $slider_autoplay .= 'delay: '.$interval;
            if(  $pauseOnHover =='true'  ){
                $slider_autoplay .= ', pauseOnMouseEnter: true';
            }else{
                $slider_autoplay .= ', pauseOnMouseEnter: false';
            }
            if(  $pauseOnInter =='true'  ){
                $slider_autoplay .= ', disableOnInteraction: true';
            }else{
                $slider_autoplay .= ', disableOnInteraction: false';
            }
            $slider_autoplay .= ' }';
        }else{
            $slider_autoplay = 'autoplay: false' ;
        }


        $effect = $settings['rt_pslider_effect'];
        if($effect== 'fade'){
            $seffect = "effect: 'fade', fadeEffect: { crossFade: true, },";
        }elseif($effect== 'cube'){
            $seffect = "effect: 'cube',";
        }elseif($effect== 'flip'){
            $seffect = "effect: 'flip',";
        }elseif($effect== 'coverflow'){
            $seffect = "effect: 'coverflow',";
        }elseif($effect== 'creative'){
            $seffect = "effect: 'creative', creativeEffect: { prev: { translate: [0, 0, -400], }, next: { translate: ['100%', 0, 0], }, },";
        }elseif($effect== 'cards'){
            $seffect = "effect: 'cards',";
        }else{
            $seffect = '';
        }

        ?>
        <div class="sc-testimonial-area sc-arrow-btn <?php if ('style2' == $settings['project_slider_style']) {  ?>sc-testimonial-section-three <?php } ?> ">

        <?php
                    if( $sliderNav == 'true' ){
                        echo ' <div class="swiper-button-prev"><i class="ri-arrow-right-line"></i></div>
                        <div class="swiper-button-next"><i class="ri-arrow-left-line"></i></i></div>';
                    }
                ?>
            <div class="swiper sc-pagination-active sc-swiper-slider-<?php echo esc_attr($unique); ?> nav_<?php echo $settings['slider_nav']; ?>">
                
                <?php
                    if( $sliderDots == 'true' ) echo '<div class="swiper-pagination"></div>';
                ?>
                <div id="sc-slick-slider-<?php echo esc_attr($unique); ?>" class="sc-addon-slider swiper-wrapper sc-slider-content-area">
                <?php foreach ($settings["items1"] as $item) {
                    $descrition = $item["descrition"];
                    $author = $item["author"];
                    $degination = $item["degination"];
                    $image = wp_get_attachment_image_url($item["image"]["id"], 'full');?>	
                        <div class="swiper-slide">
                            <?php if ('style1' == $settings['project_slider_style']) {  ?>   
                            <div class="sc-testimonial-content">
                                <?php if (!empty($settings['arrow_icon']['url'])) {  ?>
                                    <div class="arrow-icon">
                                        <img src="<?php echo esc_url($settings['arrow_icon']['url']); ?>" alt="Arrow">
                                    </div>
                                    <?php } ?>

                                <p class="des sc-mb-40"><?php echo $descrition; ?></p>
                                <?php if (!empty($item['rating_icon']['url'])) {  ?>
                                    <div class="testimonial-rating">
                                        <img src="<?php echo esc_url($item['rating_icon']['url']); ?>" alt="rating">
                                    </div>
                                <?php } ?>
                                <div class="sc-slider-auother d-flex align-items-center">
                                    <?php if (!empty($image)) {  ?> 
                                    <div class="auother-image sc-mr-15">
                                    <img src="<?php echo $image; ?>" alt="image">
                                    </div>
                                    <?php } ?>
                                    <div class="sc-auother-texty">
                                        <h5 class="title"><?php echo $author; ?></h5>
                                        <span><?php echo $degination; ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php } ?> 
                            
                            <?php if ('style2' == $settings['project_slider_style']) {  ?>
                            <div class="sc-test-item">
                                <div class="sc-testimonial-text">
                                    <?php if (!empty($settings['arrow_icon']['url'])) {  ?> 
                                    <img src="<?php echo esc_url($settings['arrow_icon']['url']); ?>" alt="Arrow">
                                    <?php } ?>    
                                    <p class="des"><?php echo $descrition; ?></p> 
                                </div>
                                <div class="sc-auother-text d-flex align-items-center flex-column">
                                    <div class="sc-auother-image sc-mr-15">
                                        <img src="<?php echo $image; ?>" alt="image">
                                    </div>
                                    <div class="sc-auother-texty">
                                        <h5 class="title"><?php echo $author; ?></h5>
                                        <span class="sub-title"><?php echo $degination; ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php } ?> 
                        </div>
                                
                                                                     
                    <?php } ?>
                </div>                  
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function(){

                var swiper = new Swiper(".sc-swiper-slider-<?php echo esc_attr($unique); ?>", {


                    slidesPerView: 1,
                    <?php echo $seffect; ?>
                    speed: <?php echo esc_attr($autoplaySpeed); ?>,
                    loop:  <?php echo esc_attr($infinite ); ?>,
                    <?php echo esc_attr($slider_autoplay); ?>,
                        centeredSlides: <?php echo esc_attr($centerMode); ?>,
                        spaceBetween:  <?php echo esc_attr($item_gap); ?>,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    autoplay: {
                            disableOnInteraction: false,
                            pauseOnMouseEnter: true,
                    },
                    breakpoints: {
                                
                        <?php
                            echo (!empty($col_xs)) ?  '575: { slidesPerView: '. $col_xs .' },' : '';
                            echo (!empty($col_sm)) ?  '767: { slidesPerView: '. $col_sm .' },' : '';
                            echo (!empty($col_md)) ?  '991: { slidesPerView: '. $col_md .' },' : '';
                            echo (!empty($col_lg)) ?  '1199: { slidesPerView: '. $col_lg .' },' : '';
                        ?>
                        1399: {
                            slidesPerView: <?php echo esc_attr($col_xl); ?>,
                            spaceBetween:  <?php echo esc_attr($item_gap); ?>
                        }
                    }      
                });
            });
        </script>
	    <?php
	}	/**	 * Render site title output in the editor.	 */
}