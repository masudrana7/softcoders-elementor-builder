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

class TeamSlider extends Widget_Base {
	public function get_name() {
		return 'team-slider';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Softcoders Team Slider', 'SoftCoders-header-footer-elementor' );
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
			'team_slider_style',
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
            'sc_slider_effect',
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
                'label' => __('Team Member List', 'scaddon'),
            ]
        );
        $repeater = new Repeater();
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
            'name',
            [
                'label' => __('Name', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Lucinda Banfield', 'scaddon'),
            ]
        );
        $repeater->add_control(
            'designation',
            [
                'label' => __('Designation', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Repair Technician', 'scaddon'),
            ]
        );
        $repeater->add_control(
            'button_email',
            [
                'label' => __('Email', 'scaddon'),
                'type' => Controls_Manager::TEXT,
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
            'team_single_link',
            [
                'label' => __('Team Single Link', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('#', 'scaddon'),
            ]
        );
        $repeater->add_control(
            'ld_link',
            [
                'label' => __('Linkedin Link', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('#', 'scaddon'),
            ]
        ); 
        $repeater->add_control(
            'fb_link',
            [
                'label' => __('Facebook Link', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('#', 'scaddon'),
            ]
        );
        $repeater->add_control(
            'tw_link',
            [
                'label' => __('Twitter Link', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('#', 'scaddon'),
            ]
        );
        $repeater->add_control(
            'gp_link',
            [
                'label' => __('Google Pluse Link', 'scaddon'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        
        $repeater->add_control(
            'yu_link',
            [
                'label' => __('Youtube Link', 'scaddon'),
                'type' => Controls_Manager::TEXT,
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
			'team_title_style',
			[
				'label' => esc_html__( 'Title', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-team-slider .sc-slider-item .sc-slider-text .title, {{WRAPPER}} .sc-team-content a' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style1 .team-item .team-content h3.team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style2 .team-item-wrap .team-img .team-content .team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style3 .team-img .team-img-sec .team-content .team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap:hover .team-content .member-desc .team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sc-team-slider .sc-slider-item:hover .sc-slider-text .title' => 'color: {{VALUE}};',
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
        $this->end_controls_section();

        $this->start_controls_section(
			'team_designation__style',
			[
				'label' => esc_html__( 'Designation', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'span_color',
            [
                'label' => esc_html__( 'Span Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-team-content span' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'designation_color',
            [
                'label' => esc_html__( 'Designation Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-content .team-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .team-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sc-team-slider-area .sc-team-slider .sc-slider-text .sub-title' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'designation_hover_color',
            [
                'label' => esc_html__( 'Designation Hover Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-team-slider .sc-slider-item:hover .sc-slider-text .sub-title' => 'color: {{VALUE}};',
                ],                
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
			'team_icon__style',
			[
				'label' => esc_html__( 'Team Icon Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'icon_section_bg',
            [
                'label' => esc_html__( 'Icon Section Background', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-social-dropdown .social-item .social-link i'   => 'background: {{VALUE}};',
                ],
                'separator' => 'before',                
            ]
        );

        $this->add_control(
            'icon_section_hover',
            [
                'label' => esc_html__( 'Icon Section Hover', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-social-dropdown .social-item .social-link i:hover'   => 'background: {{VALUE}};',
                ],
                'separator' => 'before',                
            ]
        );

        $this->add_control(
			'icon_font_size',
			[
				'label' => esc_html__( 'Icon Font Size', 'SoftCoders-header-footer-elementor' ),
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

				'selectors' => [
                     '{{WRAPPER}} .social-icons1 a i' => 'font-size: {{SIZE}}{{UNIT}}',
                     '{{WRAPPER}} .team-social a i' => 'font-size: {{SIZE}}{{UNIT}}',
                     '{{WRAPPER}} .team-social a i' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'before',
			]
		);
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-team-item .team-social-1 .social-item .team-social-dropdown .social-item .social-link i' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .sc-team-item .team-social-1 .social-item .team-social-dropdown .social-item .social-link i:hover' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',                
            ]  
        );
        $this->end_controls_section();

        $this->start_controls_section(
			'team_email__style',
			[
				'label' => esc_html__( 'Team E-mail', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
         $this->add_control(
			'email_color',
			[
				'label'     => __( 'Email Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-white-btn-two' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'email_hover_color',
			[
				'label'     => __( 'Email Hover Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-team-slider:hover .sc-slider-item .sc-white-btn-two' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'email_bg_color',
			[
				'label'     => __( 'Email Background Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-team-slider .sc-slider-item .sc-white-btn-two:before' => 'background-color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'email_hover_bg_color',
			[
				'label'     => __( 'Email Hover Background Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-team-slider:hover .sc-slider-item .sc-white-btn-two:before' => 'background-color: {{VALUE}};',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'team_arrow__style',
			[
				'label' => esc_html__( 'Team Arrow Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'navigation_arrow_background',
            [
                'label' => esc_html__( 'Navigation Arrow Background', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next, .rs-addon-slider .slick-prev' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-next, .rs-addon-slider .slick-next' => 'background: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'navigation_arrow_icon_color',
            [
                'label' => esc_html__( 'Navigation Arrow Icon Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next::before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-prev::before' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control( 
            'navigation_dot_border_color',
            [
                'label' => esc_html__( 'Navigation Dot Icon Border Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'border-color: {{VALUE}};',

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
        $this->end_controls_section();
        
        $this->start_controls_section(
			'team_content__style',
			[
				'label' => esc_html__( 'Team Content Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'content_hover_bg',
            [
                'label' => esc_html__( 'Content Hover Background', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style5',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap:hover .team-content' => 'background: {{VALUE}};',

                ],                
            ]
        ); 

        $this->add_control(
            'content_item_bg',
            [
                'label' => esc_html__( 'Content Background', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-team-item' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .sc-team-content-area .sc-slider-item' => 'background: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'content_item_hover_bg',
            [
                'label' => esc_html__( 'Content Hover Background', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-team-content-area .sc-slider-item:hover' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .sc-team-content-area .sc-slider-item' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 
                    {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

        $this->add_control(
            'content_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sc-team-content-area .sc-slider-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'image_border_radius',
            [
                'label' => esc_html__('Image Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sc-team-slider .sc-slider-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'content_top_border_color',
            [
                'label' => esc_html__( 'Content Top Border Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style4',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .team-text::before' => 'background: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'content_bottom_border_color',
            [
                'label' => esc_html__( 'Content Bottom Border Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style5',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap .team-content::before' => 'background: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'image_overlay',
            [
                'label' => esc_html__( 'Image Overlay', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style3',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style3 .team-img .team-img-sec::before' => 'background: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'image_corner_border_color',
            [
                'label' => esc_html__( 'Image Corner Border Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style3',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style3 .team-img::before' => 'border-bottom-color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style3 .team-img::after' => 'border-top-color: {{VALUE}};',

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
			'content_padding4',
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
        $item_gap = !empty($item_gap) ? $item_gap : '30';
        $prev_text = $settings['pcat_prev_text'];
        $prev_text = !empty($prev_text) ? $prev_text : '';
        $next_text = $settings['pcat_next_text'];
        $next_text = !empty($next_text) ? $next_text : '';
        $unique = rand(2023,654123);



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


        $effect = $settings['sc_slider_effect'];
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
        <?php if ('style2' == $settings['team_slider_style']) {  ?> 
        <div class="sc-team-content-area">
            <div class="sc-team-slider-area">
        <?php } ?>
        <div class="swiper sc-pagination-active sc-swiper-slider-<?php echo esc_attr($unique); ?> nav_<?php echo $settings['slider_nav']; ?>">
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
                    $name = $item["name"];
                    $link = $item["team_single_link"];
                    $designation = $item["designation"];
                    $description = $item["description"];
                    $image = wp_get_attachment_image_url($item["image"]["id"], 'full');
                    $fb_link = $item["fb_link"];
                    $tw_link = $item["tw_link"];
                    $gp_link = $item["gp_link"];
                    $ld_link = $item["ld_link"];
                    $yu_link = $item["yu_link"]; ?>	
					<div class="swiper-slide">
						<div class="sc-team-item">
                            
							<div class="item-img">
                                 <?php if(!empty($image)){?>
								<div class="team-image">
									<a href="<?php echo $link; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $name; ?>"></a>
								</div>
                                <?php } ?>
								<ul class="team-social-1 list-gap">
									<li class="social-item">
										<a href="#" class="social-hover-icon social-link"><i>
                                        <svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 13C12.9844 13 12.0859 13.3906 11.3828 14.0547L7.55469 11.6328C7.78906 10.9297 7.78906 10.1094 7.55469 9.40625L11.3828 6.98438C12.0859 7.60938 12.9844 8 14 8C16.0703 8 17.75 6.32031 17.75 4.25C17.75 2.17969 16.0703 0.5 14 0.5C11.9297 0.5 10.25 2.17969 10.25 4.25C10.25 4.64062 10.2891 5.03125 10.4062 5.38281L6.57812 7.80469C5.875 7.14062 4.97656 6.75 4 6.75C1.92969 6.75 0.25 8.42969 0.25 10.5C0.25 12.5703 1.92969 14.25 4 14.25C4.97656 14.25 5.875 13.8594 6.57812 13.2344L10.4062 15.6562C10.2891 16.0078 10.25 16.3984 10.25 16.75C10.25 18.8203 11.9297 20.5 14 20.5C16.0703 20.5 17.75 18.8203 17.75 16.75C17.75 14.6797 16.0703 13 14 13ZM14 2.375C15.0156 2.375 15.875 3.23438 15.875 4.25C15.875 5.30469 15.0156 6.125 14 6.125C12.9453 6.125 12.125 5.30469 12.125 4.25C12.125 3.23438 12.9453 2.375 14 2.375ZM4 12.375C2.94531 12.375 2.125 11.5547 2.125 10.5C2.125 9.48438 2.94531 8.625 4 8.625C5.01562 8.625 5.875 9.48438 5.875 10.5C5.875 11.5547 5.01562 12.375 4 12.375ZM14 18.625C12.9453 18.625 12.125 17.8047 12.125 16.75C12.125 15.7344 12.9453 14.875 14 14.875C15.0156 14.875 15.875 15.7344 15.875 16.75C15.875 17.8047 15.0156 18.625 14 18.625Z" fill="#6A6C71"/>
								</svg></i></a>
										<ul class="list-gap team-social-dropdown">
											<?php if (!empty($fb_link)) { ?>
											<li class="social-item social-item1">
												<a href="<?php echo $fb_link; ?>" class="social-link">
													<i class="fab fa-facebook"></i>
												</a>
											</li>
											<?php } ?>	

											<?php if (!empty($tw_link)) { ?>	
											<li class="social-item social-item1">
												<a href="<?php echo $tw_link; ?>" class="social-link">
													<i class="fab fa-twitter"></i>
												</a>
											</li>
											<?php } ?>

											<?php if (!empty($ld_link)) { ?>
											<li class="social-item social-item1">
												<a href="<?php echo $ld_link; ?>" class="social-link">
													<i class="fab fa-linkedin"></i>
												</a>
											</li>
											<?php } ?>

											<?php if (!empty($gp_link)) { ?>
											<li class="social-item social-item1">
												<a href="<?php echo $gp_link; ?>" class="social-link">
													<i class="fab fa-google"></i>
												</a>
											</li>
											<?php } ?>

											<?php if (!empty($yu_link)) { ?>
											<li class="social-item social-item1">
												<a href="<?php echo $yu_link; ?>" class="social-link">
													<i class="fab fa-youtube"></i>
												</a>
											</li>
											<?php } ?>
										</ul>
									</li>
								</ul>
								<div class="sc-team-content">
                                    <?php if (!empty($link)) { ?>
									    <h4><a href="<?php echo $link; ?>" class="title"><?php echo $name; ?></a></h4>
                                    <?php } ?>
                                    <?php if (!empty($designation)) { ?>
									    <span><?php echo $designation; ?></span>
                                    <?php } ?>
								</div>
							</div>
						</div>
					</div>
			    <?php } } ?>

				<?php if ('style2' == $settings['team_slider_style']) {  ?> 
				<?php foreach ($settings["items1"] as $item) {
                    $name = $item["name"];
                    $link = $item["team_single_link"];
                    $designation = $item["designation"];
                    $button_email = $item["button_email"];
                    $image = wp_get_attachment_image_url($item["image"]["id"], 'full');?>	
                    <div class="swiper-slide">
                        <div class="sc-team-slider">
                            <div class="sc-slider-item text-center">
                               <?php if (!empty($image)) { ?>
                                    <a href="<?php echo $link; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $name; ?>"></a>
                                <?php } ?>
                                <div class="sc-slider-text">
                                    <?php if (!empty($link)) { ?>
                                    <h4>
                                        <a  class="title white-color" href="<?php echo $link; ?>" class="title"><?php echo $name; ?></a>
                                    </h4>
                                    <?php } ?>
                                    <?php if (!empty($designation)) { ?>
                                        <span class="sub-title white-color"><?php echo $designation; ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                              <?php if (!empty($button_email)) { ?>  
                            <div class="sc-slider-btn text-center">    
                                                       
                                <a class="sc-white-btn-two" href="mailto:<?php echo $button_email; ?>"
                                    ><?php echo $button_email; ?></a
                                >
                                
                            </div>
                            <?php } ?>
                        </div>
                    </div>
			    <?php } } ?>

            </div>     
        </div>
        <?php if ('style2' == $settings['team_slider_style']) {  ?> 
        </div>
        </div>
        <?php } ?>


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
