<?php
namespace softcoderselements\WidgetsManager\Widgets;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use softcoderselements\WidgetsManager\Widgets_Loader;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class ServiceSlider extends Widget_Base {
	public function get_name() {
		return 'service-slider';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Softcoders Service Slider', 'SoftCoders-header-footer-elementor' );
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
			'team_slider_style',
			[
				'label'   => esc_html__( 'Select Style', 'SoftCoders-header-footer-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',				
				'options' => [
					'style1' => 'Style 1',
					'style2' => 'Style 2',
					'style3' => 'Style 3',
					'style4' => 'Style 4',
					'style5' => 'Style 5'
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
                        'default' => 3,
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
                        'default' => 3,
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
                        'default' => 3,         
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
                        'default' => 2,         
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

        $this->add_control(
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

		$this->start_controls_section(
            'team_member_list',
            [
                'label' => __('Service List', 'scaddon'),
            ]
        );
        $repeater = new Repeater();
         $repeater->add_control(
			'icon',
			[
				'label'       => __( 'Icon', 'SoftCoders-header-footer-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => 'true',
			]
		);
        $repeater->add_control(
            'title',
            [
                'label' => __('Service Title', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Lucinda Banfield', 'scaddon'),
            ]
        );
        $repeater->add_control(
            'description',
            [
                'label' => __('Description', 'scaddon'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
         $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'scaddon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],

            ]
        );
        $repeater->add_control(
            'service_single_link',
            [
                'label' => __('Service Single Link', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('#', 'scaddon'),
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
                        'list_content' => __('Item content. Click the edit button to change this text.', 'scaddon'),
                    ],
                    [
                        'list_title' => __('Title #2', 'scaddon'),
                        'list_content' => __('Item content. Click the edit button to change this text.', 'scaddon'),
                    ],
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
				'label' => esc_html__( 'Icon Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
		$this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-service-style-four .icomoon path' => 'fill: {{VALUE}};',
                ],
                'separator' => 'before',                
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label' => esc_html__( 'Icon Hover Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-service-style-four:hover .icomoon path' => 'fill: {{VALUE}};',
                ],
                'separator' => 'before',                
            ]

            
        );
        
        $this->add_control(
			'icon_bg_color',
			[
				'label'     => __( 'Icon Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
                    '{{WRAPPER}} .sc-service-style-four .icomoon' => 'background: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'icon_hover_bg_color',
			[
				'label'     => __( 'Icon Hover Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
                    '{{WRAPPER}} .sc-service-style-four:hover .icomoon' => 'background: {{VALUE}};',
				],
			]
		);
        $this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => esc_html__( 'Icon Border Radius', 'SoftCoders-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sc-service-style-four .icomoon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'section_Title_style',
			[
				'label' => esc_html__( 'Title Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-service-style-four .title' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-service-style-four .title:hover' => 'color: {{VALUE}};',
                ],                
            ]   
        );
        
        $this->add_control(
            'designation_color',
            [
                'label' => esc_html__( 'Designation Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-service-style-four .des' => 'color: {{VALUE}};',

                ],                
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Global Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'content_item_bg',
            [
                'label' => esc_html__( 'Content Background', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-service-style-four' => 'background: {{VALUE}};',
                ],                
            ]
        );

        $this->add_responsive_control(
			'content_padding',
			[
				'label'              => __( 'Area Padding', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-service-style-four' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 
                    {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

        $this->add_control(
			'scrollbar_border_color',
			[
				'label'     => __( 'Scrollbar Border Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-progressbar-fill::after' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .swiper-pagination .swiper-pagination-progressbar-fill' => 'background: {{VALUE}};',
					'{{WRAPPER}} .services_scroll_slider .swiper-pagination' => 'border-color: {{VALUE}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'arrow_style',
			[
				'label' => esc_html__( 'Arrow Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'navigation_arrow_background',
            [
                'label' => esc_html__( 'Navigation Arrow Background', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next:after' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .swiper-button-prev:after' => 'background: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'navigation_arrow_hover_background',
            [
                'label' => esc_html__( 'Navigation Arrow Hover Background', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next:hover:after' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .swiper-button-prev:hover:after' => 'background: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'navigation_arrow_icon_color',
            [
                'label' => esc_html__( 'Navigation Arrow Icon Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next:after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .swiper-button-prev:after' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'navigation_arrow_hover_icon_color',
            [
                'label' => esc_html__( 'Navigation Arrow Hover Icon Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next:hover:after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .swiper-button-prev:hover:after' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'navigation_arrow_icon_color22',
            [
                'label' => esc_html__( 'Navigation Arrow Icon Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next:hover:after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .swiper-button-prev:hover:after' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'navigation_dot_border_color',
            [
                'label' => esc_html__( 'Navigation Dot Icon Border Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next:after' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .swiper-button-prev:after' => 'border-color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'navigation_dot_icon_background',
            [
                'label' => esc_html__( 'Navigation Dot Icon Background', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'background: {{VALUE}};',

                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'SoftCoders-header-footer-elementor' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .team-content',
				
			]
		);

         $this->add_responsive_control(
			'content_padding22',
			[
				'label'              => __( 'Area Padding', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-team-item' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 
                    {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'SoftCoders-header-footer-elementor' ),
				'selector' => '{{WRAPPER}} .sc-team-item',
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
					'{{WRAPPER}} .sc-team-item' => 'text-align: {{VALUE}};',
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
        $unique = rand(2012,35120);
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
        <div class="swiper services_scroll_slider sc-pagination-active sc-swiper-slider-<?php echo esc_attr($unique); ?> nav_<?php echo $settings['slider_nav']; ?>">

        
            <?php
                if( $sliderNav == 'true' ){
                    echo ' <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>';
                }
            ?>
            <?php
                if( $sliderDots == 'true' ) echo '<div class="swiper-pagination"></div>';
            ?>

            <div id="sc-slick-slider-<?php echo esc_attr($unique); ?>" class="sc-addon-slider swiper-wrapper">


				<?php if ('style1' == $settings['team_slider_style']) {  ?> 
				<?php foreach ($settings["items1"] as $item) {
                    $title = $item["title"];
                    $link = $item["service_single_link"];
                    $description = $item["description"];
                    $image = wp_get_attachment_image_url($item["image"]["id"], 'full'); ?>	


                    <div class="swiper-slide">
                        <div class="sc-service-style-four sc-mb-25 text-center">
                            <?php if ( '' !== $item['icon']['value'] ) { ?>
                            <i class="p-z-idex position-relative icomoon">
                                <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?></i>			
                            <?php } ?> 
                            <h4 class="title p-z-idex position-relative">
                                <a class="title" href="<?php echo $link; ?>"><?php echo $title; ?></a>
                            </h4>
                            <p class="des p-z-idex position-relative">
                               <?php echo $description; ?>
                            </p>
                            <div class="sc-service-button">
                                <img src="<?php echo $image; ?>" alt="Service" />
                                <?php if (!empty($link)) { ?>
                                <div class="service-btn">
                                    <a class="sc-service-btn" href="<?php echo $link; ?>"><i class="icon-sliuder-arrow2"></i></a>
                                </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>


			<?php } } ?>
                
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
				type: "progressbar",
				},
				navigation: {
					nextEl: ".swiper-button-next",
					prevEl: ".swiper-button-prev",
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
	}
		/**
		 * Render site title output in the editor.
		 */
	
}
