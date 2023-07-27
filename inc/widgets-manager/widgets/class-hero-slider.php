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

class HeroSlider extends Widget_Base {
	public function get_name() {
		return 'hero-slider';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Softcoders Hero Slider', 'SoftCoders-header-footer-elementor' );
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
            'hero_member_list',
            [
                'label' => __('Slider Content', 'scaddon'),
            ]
        );
        $repeater = new Repeater();
        
        $repeater->add_control(
            'subtitle',
            [
                'label' => __('Sub Title ', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Empowering businesses', 'scaddon'),
            ]
        );
        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Planning Future Evovate the Present', 'scaddon'),
            ]
        );
        $repeater->add_control(
            'description',
            [
                'label' => __('Description', 'scaddon'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Busto auctor lectus conubia euismod nicest rhoncus replenish sixth signs over behold creeping creature bustro.', 'scaddon'),
            ]
        );
        $repeater->add_control(
            'btn_text',
            [
                'label' => __('Button Text', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Get Started', 'scaddon'),
            ]
        );
        $repeater->add_control(
            'btn_link',
            [
                'label' => __('Button link', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('#', 'scaddon'),
            ]
        );

        $repeater->add_control(
            'btn_text2',
            [
                'label' => __('Button Text 2', 'scaddon'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'btn_link2',
            [
                'label' => __('Button link 2', 'scaddon'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
			'icon',
			[
				'label'       => __( 'Video Icon', 'SoftCoders-header-footer-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => 'true',
			]
		);
        $repeater->add_control(
            'video_link',
            [
                'label' => __('Video link', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('#', 'scaddon'),
            ]
        );

        $repeater->add_control(
            'intro_text',
            [
                'label' => __('Intro Text', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Intro Video', 'scaddon'),
            ]
        );

        $repeater->add_control(
            'background_image',
            [
                'label' => __('Background Image', 'scaddon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],

            ]
        );

         $repeater->add_control(
            'shape_show',
            [
                'label' => esc_html__( 'Shape Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rsaddon' ),
                    'no' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
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

        $this->start_controls_section(
			'section_general_fields',
			[
				'label' => __( 'General Settings', 'SoftCoders-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'hero_slider_style',
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
            'sc_pslider_effect',
            [
                'label' => esc_html__('Slider Effect', 'SoftCoders-header-footer-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'fade',
                'options' => [
					'default' => esc_html__('Default', 'SoftCoders-header-footer-elementor'),					
					'fade' => esc_html__('Fade', 'SoftCoders-header-footer-elementor'),
					'flip' => esc_html__('Flip', 'SoftCoders-header-footer-elementor'),
					'cube' => esc_html__('Cube', 'SoftCoders-header-footer-elementor'),
					'coverflow' => esc_html__('Coverflow', 'SoftCoders-header-footer-elementor'),
					'creative' => esc_html__('Creative', 'SoftCoders-header-footer-elementor'),
					'cards' => esc_html__('Cards', 'SoftCoders-header-footer-elementor'),
                ],
            ]
        );
	
		$this->add_control(
            'col_xl',
            [
                'label'   => esc_html__( 'Wide Screen > 1399px', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,
                'options' => [
                    '1' => esc_html__( '1 Column', 'SoftCoders-header-footer-elementor' ), 
                    '2' => esc_html__( '2 Column', 'SoftCoders-header-footer-elementor' ),
                    '3' => esc_html__( '3 Column', 'SoftCoders-header-footer-elementor' ),
                    '4' => esc_html__( '4 Column', 'SoftCoders-header-footer-elementor' ),
                    '4.5' => esc_html__( '4.5 Column', 'SoftCoders-header-footer-elementor' ),
                    '5' => esc_html__( '5 Column', 'SoftCoders-header-footer-elementor' ),
                    '5.5' => esc_html__( '5.5 Column', 'SoftCoders-header-footer-elementor' ),
                    '6' => esc_html__( '6 Column', 'SoftCoders-header-footer-elementor' ),                 
                ],
                'separator' => 'before',
            ]
            
        );
    
        $this->add_control(
            'col_lg',
            [
                'label'   => esc_html__( 'Desktops > 1199px', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,
                'options' => [
                    '1' => esc_html__( '1 Column', 'SoftCoders-header-footer-elementor' ), 
                    '2' => esc_html__( '2 Column', 'SoftCoders-header-footer-elementor' ),
                    '3' => esc_html__( '3 Column', 'SoftCoders-header-footer-elementor' ),
                    '4' => esc_html__( '4 Column', 'SoftCoders-header-footer-elementor' ),
                    '6' => esc_html__( '6 Column', 'SoftCoders-header-footer-elementor' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__( 'Desktops > 991px', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'SoftCoders-header-footer-elementor' ), 
                    '2' => esc_html__( '2 Column', 'SoftCoders-header-footer-elementor' ),
                    '3' => esc_html__( '3 Column', 'SoftCoders-header-footer-elementor' ),
                    '4' => esc_html__( '4 Column', 'SoftCoders-header-footer-elementor' ),
                    '6' => esc_html__( '6 Column', 'SoftCoders-header-footer-elementor' ),                     
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__( 'Tablets > 767px', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'SoftCoders-header-footer-elementor' ), 
                    '2' => esc_html__( '2 Column', 'SoftCoders-header-footer-elementor' ),
                    '3' => esc_html__( '3 Column', 'SoftCoders-header-footer-elementor' ),
                    '4' => esc_html__( '4 Column', 'SoftCoders-header-footer-elementor' ),
                    '6' => esc_html__( '6 Column', 'SoftCoders-header-footer-elementor' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_xs',
            [
                'label'   => esc_html__( 'Tablets < 768px', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'SoftCoders-header-footer-elementor' ), 
                    '2' => esc_html__( '2 Column', 'SoftCoders-header-footer-elementor' ),
                    '3' => esc_html__( '3 Column', 'SoftCoders-header-footer-elementor' ),
                    '4' => esc_html__( '4 Column', 'SoftCoders-header-footer-elementor' ),
                    '6' => esc_html__( '6 Column', 'SoftCoders-header-footer-elementor' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slides_ToScroll',
            [
                'label'   => esc_html__( 'Slide To Scroll', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,         
                'options' => [
                    '1' => esc_html__( '1 Item', 'SoftCoders-header-footer-elementor' ),
                    '2' => esc_html__( '2 Item', 'SoftCoders-header-footer-elementor' ),
                    '3' => esc_html__( '3 Item', 'SoftCoders-header-footer-elementor' ),
                    '4' => esc_html__( '4 Item', 'SoftCoders-header-footer-elementor' ),                   
                ],
                'separator' => 'before',
                            
            ]
            
        );      

        $this->add_control(
            'slider_dots',
            [
                'label'   => esc_html__( 'Navigation Dots', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'SoftCoders-header-footer-elementor' ),
                    'false' => esc_html__( 'Disable', 'SoftCoders-header-footer-elementor' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_nav',
            [
                'label'   => esc_html__( 'Navigation Nav', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'SoftCoders-header-footer-elementor' ),
                    'false' => esc_html__( 'Disable', 'SoftCoders-header-footer-elementor' ),              
                ],
                'separator' => 'before',            
            ]
            
        );

        $this->add_control(
            'slider_nav_show',
            [
                'label'   => esc_html__( 'Navigation Visible', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'hover_visible',           
                'options' => [
                    'hover_visible' => esc_html__( 'Hover Visible', 'SoftCoders-header-footer-elementor' ),
                    'hover_always' => esc_html__( 'Always Visible', 'SoftCoders-header-footer-elementor' ),              
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_nav' => 'true',
                ],  
                            
            ]
            
        );

   

        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__( 'Autoplay', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'SoftCoders-header-footer-elementor' ),
                    'false' => esc_html__( 'Disable', 'SoftCoders-header-footer-elementor' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => esc_html__( 'Autoplay Slide Speed', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '1000' => esc_html__( '1 Seconds', 'SoftCoders-header-footer-elementor' ),
                    '2000' => esc_html__( '2 Seconds', 'SoftCoders-header-footer-elementor' ), 
                    '3000' => esc_html__( '3 Seconds', 'SoftCoders-header-footer-elementor' ), 
                    '4000' => esc_html__( '4 Seconds', 'SoftCoders-header-footer-elementor' ), 
                    '5000' => esc_html__( '5 Seconds', 'SoftCoders-header-footer-elementor' ), 
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
                'label'   => esc_html__( 'Autoplay Interval', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '5000' => esc_html__( '5 Seconds', 'SoftCoders-header-footer-elementor' ), 
                    '4000' => esc_html__( '4 Seconds', 'SoftCoders-header-footer-elementor' ), 
                    '3000' => esc_html__( '3 Seconds', 'SoftCoders-header-footer-elementor' ), 
                    '2000' => esc_html__( '2 Seconds', 'SoftCoders-header-footer-elementor' ), 
                    '1000' => esc_html__( '1 Seconds', 'SoftCoders-header-footer-elementor' ),     
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
                'label'   => esc_html__( 'Stop On Interaction', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'SoftCoders-header-footer-elementor' ),
                    'false' => esc_html__( 'Disable', 'SoftCoders-header-footer-elementor' ),              
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
                'label'   => esc_html__( 'Stop on Hover', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'SoftCoders-header-footer-elementor' ),
                    'false' => esc_html__( 'Disable', 'SoftCoders-header-footer-elementor' ),              
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
                'label'   => esc_html__( 'Loop', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'SoftCoders-header-footer-elementor' ),
                    'false' => esc_html__( 'Disable', 'SoftCoders-header-footer-elementor' ),
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_centerMode',
            [
                'label'   => esc_html__( 'Center Mode', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'SoftCoders-header-footer-elementor' ),
                    'false' => esc_html__( 'Disable', 'SoftCoders-header-footer-elementor' ),
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'item_gap_custom',
            [
                'label' => esc_html__( 'Item Gap', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 0,
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
			'slider_gobel_style',
			[
				'label' => esc_html__( 'Global Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'gobel_padding',
			[
				'label'              => __( 'Padding', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-slider-section .sc-hero-slider2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

        $this->add_responsive_control(
            'content_widht',
            [
                'label' => esc_html__( 'Content Width', 'scaddon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .sc-slider-section .sc-slider-content' => 'max-width: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        $this->add_control(
            'sec_bg',
            [
                'label' => esc_html__( 'Background Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-section .sc-image-layer' => 'background: {{VALUE}};',

                ],                
            ]
        );

        
 

        $this->end_controls_section();

        $this->start_controls_section(
			'slider_title_style',
			[
				'label' => esc_html__( 'Title Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'slider_title_color',
            [
                'label' => esc_html__( 'Title Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-section .slider-title' => 'color: {{VALUE}};',

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
				'selector' => '{{WRAPPER}} .sc-slider-section .slider-title',
			]
		);

        $this->add_responsive_control(
			'title_margin',
			[
				'label'              => __( 'Title Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-slider-section .slider-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

        $this->end_controls_section();


		$this->start_controls_section(
			'slider_subt_title_style',
			[
				'label' => esc_html__( 'Subtitle Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(  
            'sub_title_color',
            [
                'label' => esc_html__( 'Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-subtitle' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(  
            'sub_title_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-subtitle' => 'background: {{VALUE}};',
                ],                
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .sc-slider-subtitle',
			]
		);
        $this->add_responsive_control(
			'subtitle_margin',
			[
				'label'              => __( 'Title Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-slider-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        $this->add_responsive_control(
			'subtitle_padding',
			[
				'label'              => __( 'Title Padding', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-slider-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'header_btn_border',
				'label' => esc_html__( 'Border', 'SoftCoders-header-footer-elementor' ),
				'selector' => '{{WRAPPER}} .sc-slider-subtitle',
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'slider_desc_style',
			[
				'label' => esc_html__( 'Description Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'slider_desc_color',
            [
                'label' => esc_html__( 'Description Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-section .slider-desc' => 'color: {{VALUE}};',

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
				'selector' => '{{WRAPPER}} .sc-slider-section .slider-desc',
			]
		);
        $this->add_responsive_control(
			'desc_margin',
			[
				'label'              => __( 'Title Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-slider-section .slider-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'video_icon_style',
			[
				'label' => esc_html__( 'Video Icon Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'video_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-section .video-area i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sc-slider-section .video-area svg path' => 'fill: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'video_icon_hover_color',
            [
                'label' => esc_html__( 'Icon Hover Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-section .video-area i:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sc-slider-section .video-area i:hover svg path' => 'fill: {{VALUE}};',

                ],                
            ]
        );
        $this->add_control(
            'txt_color',
            [
                'label' => esc_html__( 'Text Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-section .video-area .sc-text' => 'color: {{VALUE}};',

                ],                
            ]
        );


        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typography22',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .sc-slider-section .slider-desc',
			]
		);
        $this->end_controls_section();


        $this->start_controls_section(
			'section_readmore',
			[
				'label' => __( 'Button Style One', 'SoftCoders-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'btn_border_radius',
				'label' => esc_html__( 'Border', 'SoftCoders-header-footer-elementor' ),
				'selector' => '{{WRAPPER}} .sc-primary-btn',
			]
		);
        $this->add_responsive_control(
			'btn_padding',
			[
				'label'              => __( 'Button Padding', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-primary-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        $this->add_responsive_control(
			'btn_border_radious_color',
			[
				'label' => esc_html__( 'Shape Border Radius', 'SoftCoders-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sc-primary-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_toggle_color3' );
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
					'{{WRAPPER}} .sc-primary-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'readmore_bg_color',
			[
				'label'     => __( 'Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-primary-btn:after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'readmore_border_color',
			[
				'label'     => __( 'Border Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-primary-btn' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .sc-primary-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'readmore_hover_bg_color',
			[
				'label'     => __( 'Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-primary-btn:before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'readmore_hover_border_color',
			[
				'label'     => __( 'Border Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-primary-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


        $this->start_controls_section(
			'section_readmore_two',
			[
				'label' => __( 'Button Style Two', 'SoftCoders-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'btn_border_radius3',
				'label' => esc_html__( 'Border', 'SoftCoders-header-footer-elementor' ),
				'selector' => '{{WRAPPER}} .sc-slider-btn2 .sc-transparent-btn',
			]
		);
        $this->add_responsive_control(
			'btn_padding2',
			[
				'label'              => __( 'Button Padding', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-slider-btn2 .sc-transparent-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        $this->add_responsive_control(
			'btn_margin2',
			[
				'label'              => __( 'Button Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-slider-btn2 .sc-transparent-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        $this->add_responsive_control(
			'ntn_border_radious_color2',
			[
				'label' => esc_html__( 'Shape Border Radius', 'SoftCoders-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sc-slider-btn2 .sc-transparent-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_toggle_color' );
		$this->start_controls_tab(
			'tab_toggle_normal_2',
			[
				'label' => __( 'Normal', 'SoftCoders-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'readmore_color2',
			[
				'label'     => __( 'Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-slider-btn2 .sc-transparent-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'readmore_bg_color2',
			[
				'label'     => __( 'Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-slider-btn2 .sc-transparent-btn:after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'readmore_border_color2',
			[
				'label'     => __( 'Border Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-slider-btn2 .sc-transparent-btn' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'readmore_hover_border_color3',
			[
				'label'     => __( 'Border Hover Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-slider-btn2 .sc-transparent-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_toggle_hover3',
			[
				'label' => __( 'Hover', 'SoftCoders-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'readmore_hover_color2',
			[
				'label'     => __( 'Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-slider-btn2 .sc-transparent-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'readmore_hover_bg_color2',
			[
				'label'     => __( 'Background', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-slider-btn2 .sc-transparent-btn:before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'readmore_hover_border_color2',
			[
				'label'     => __( 'Border Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-slider-btn2 .sc-transparent-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


        $this->start_controls_section(
			'shape_style',
			[
				'label' => __( 'Shape Style', 'SoftCoders-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'shape_bg_color',
            [
                'label' => esc_html__( 'Shape Background Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-section .swiper-slide .shape-overly-one' => 'background: {{VALUE}};',

                ],                
            ]
        );
        
        $this->add_responsive_control(
			'shape_border_radious_color',
			[
				'label' => esc_html__( 'Shape Border Radius', 'SoftCoders-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sc-slider-section .swiper-slide .shape-overly-one' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
		    'shape_width',
		    [
		        'label' => esc_html__( 'Width Shape', 'rsaddon' ),
		        'type' => Controls_Manager::TEXT,
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .sc-slider-section .swiper-slide .shape-overly-one' => 'width: {{SIZE}}px;',
		        ],
		        'separator' => 'before',
		    ]
		);

        $this->add_responsive_control(
		    'shape_height',
		    [
		        'label' => esc_html__( 'Height Shape', 'rsaddon' ),
		        'type' => Controls_Manager::TEXT,
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .sc-slider-section .swiper-slide .shape-overly-one' => 'height: {{SIZE}}px;',
		        ],
		        'separator' => 'before',
		    ]
		);

        $this->add_responsive_control(
		    'shape_left-position',
		    [
		        'label' => esc_html__( 'Left Shape Position', 'rsaddon' ),
		        'type' => Controls_Manager::TEXT,
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .sc-slider-section .swiper-slide .shape-overly-one' => 'left: {{SIZE}}px;',
		        ],
		        'separator' => 'before',
		    ]
		);

        $this->add_responsive_control(
		    'shape_bottom-position',
		    [
		        'label' => esc_html__( 'Bottom Shape Position', 'rsaddon' ),
		        'type' => Controls_Manager::TEXT,
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .sc-slider-section .swiper-slide .shape-overly-one' => 'bottom: {{SIZE}}px;',
		        ],
		        'separator' => 'before',
		    ]
		);

        $this->add_responsive_control(
		    'shape_bottom_tranform',
		    [
		        'label' => esc_html__( 'Shape Transform', 'rsaddon' ),
		        'type' => Controls_Manager::TEXT,
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .swiper-slide.swiper-slide-active .shape-overly-one' => 'transform: rotate({{SIZE}}deg) translateY({{SIZE}});',
		        ],
		        'separator' => 'before',
		    ]
		);


		$this->end_controls_section();

        $this->start_controls_section(
			'section_navigation_dots',
			[
				'label' => __( 'Navigation Dots Style', 'SoftCoders-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_dots' => 'true',
                ],
			]
		);

        $this->add_control(
            'navigation_dots_color',
            [
                'label' => esc_html__( 'Border Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'border-color: {{VALUE}};',

                ],                
            ]
        );
        $this->add_control(
            'navigation_dots_active_ecolor',
            [
                'label' => esc_html__( 'Active Background Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'border-color: {{VALUE}};',

                ],                
            ]
        );

         $this->add_control(
            'dots_position',
            [
                'label'   => esc_html__( 'Dots Position', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'dots_left',         
                'options' => [
                    'dots_left' => esc_html__( 'Left', 'SoftCoders-header-footer-elementor' ), 
                    'dots_right' => esc_html__( 'Right', 'SoftCoders-header-footer-elementor' ),
                    'dots_bottom' => esc_html__( 'Bottom', 'SoftCoders-header-footer-elementor' ),              
                ],
                'separator' => 'before',
                            
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
                    '{{WRAPPER}} .swiper-button-prev:after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .swiper-button-next:after' => 'color: {{VALUE}};',

                ],   
                
            ]
        );

        $this->add_control(
            'navigation_arrow_hover_color',
            [
                'label' => esc_html__( 'Arrow Hover Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next:hover:after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .swiper-button-prev:hover:after' => 'color: {{VALUE}};',

                ],   
                
            ]
        );

        $this->add_control(
            'navigation_arrow_bg_color',
            [
                'label' => esc_html__( 'Arrow Background Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next:after' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .swiper-button-prev:after' => 'background: {{VALUE}};',

                ],   
                
            ]
        );

        $this->add_control(
            'navigation_arrow_hover_bg',
            [
                'label' => esc_html__( 'Arrow Hover Background', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next:hover:after' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .swiper-button-prev:hover:after' => 'background: {{VALUE}};',

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
					'{{WRAPPER}} .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .swiper-button-prev' => 'bottom: {{SIZE}}{{UNIT}}; top: auto; transform: inherit',
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
					'{{WRAPPER}} .swiper-button-next' => 'bottom: {{SIZE}}{{UNIT}}; top: auto; transform: inherit',
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
					'{{WRAPPER}} .swiper-button-prev:after, {{WRAPPER}} .swiper-button-next:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $autoplaySpeed   = !empty($autoplaySpeed) ? $autoplaySpeed : '5000';
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
        $unique = rand(2023,753951);



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


        $effect = $settings['sc_pslider_effect'];
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
        <div class="sc-slider-section sc-slider-style2 navigation_<?php echo $settings['dots_position']; ?> nav_<?php echo $settings['slider_nav_show']; ?> nav_<?php echo $settings['slider_nav']; ?>">
            <div class="swiper sc-swiper-slider-<?php echo esc_attr($unique); ?>">
                <?php
                    if( $sliderNav == 'true' ){
                        echo ' <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>';
                    }
                ?>
                
                <div id="sc-slick-slider-<?php echo esc_attr($unique); ?>" class="sc-addon-slider swiper-wrapper">
                    <?php if ('style1' == $settings['hero_slider_style']) {  ?> 
                    <?php foreach ($settings["items1"] as $item) {
                        $subtitle = $item["subtitle"];
                        $title = $item["title"];
                        $description = $item["description"];
                        $video_link = $item["video_link"];
                        $btn_text = $item["btn_text"];
                        $btn_link = $item["btn_link"];
                        $btn_text2 = $item["btn_text2"];
                        $btn_link2 = $item["btn_link2"];
                        $intro_text = $item["intro_text"];
                        $background_image = wp_get_attachment_image_url($item["background_image"]["id"], 'full'); ?>	
                        <!-- Slide One -->
                        <div class="swiper-slide">
                            
                            <div class="sc-image-layer" <?php if(!empty($background_image)){ ?> style="background:url(<?php echo $background_image; ?>);" <?php } ?>
                            ></div>

                            <div class="container position-relative sc-hero-slider2">
                                <div class="sc-slider-content p-z-idex">
                                    <?php if(!empty($subtitle)){ ?>
                                        <div class="sc-slider-subtitle"><?php echo $subtitle; ?></div>
                                    <?php } ?>  

                                    <?php if(!empty($title)){ ?>
                                    <h1 class="slider-title white-color sc-mb-25 sc-sm-mb-15">
                                        <?php echo $title; ?>
                                    </h1>
                                    <?php } ?>  

                                    <?php if(!empty($description)){ ?>
                                    <div class="slider-desc white-dark-color sc-mb-40 sc-sm-mb-25">
                                       <?php echo $description; ?>
                                    </div>
                                    <?php } ?>  


                                    <?php if(!empty($video_link || $btn_text || $btn_text2) ){ ?>
                                    <div class="slider-btn-area d-flex align-items-center">

                                        <?php if(!empty($btn_text)){ ?>
                                        <div class="sc-slider-btn">
                                            <a class="sc-primary-btn p-z-idex2" href="<?php echo $btn_link; ?>"> <?php echo $btn_text; ?></a>
                                        </div>
                                        <?php } ?> 

                                        <?php if(!empty($btn_text2)){ ?>    
                                        <div class="sc-slider-btn sc-slider-btn2">
                                            <a class="sc-transparent-btn p-z-idex2" href="<?php echo $btn_link2; ?>"><?php echo $btn_text2; ?></a>
                                        </div>
                                        <?php } ?> 

                                        <?php if (!empty($item['icon']['value'])) { ?>
                                        <div class="video-area">
                                            <a
                                                class="venobox popup-videos-button"
                                                data-autoplay="true"
                                                data-vbtype="video"
                                                href="<?php echo $video_link; ?>"
                                            >
                                            
                                                <i><?php \Elementor\Icons_Manager::render_icon($item["icon"], ['aria-hidden' => 'true']); ?></i>
                                            </a>
                                            <a class="sc-text" href="<?php echo $video_link; ?>"><?php echo $intro_text; ?></a>
                                        </div>
                                        <?php } ?> 
                                    </div>
                                    <?php } ?>  
                                </div>
                                <?php if ('yes' == $item['shape_show']) {  ?>
                                <div class="shape-overly-one"></div>
                                <?php } ?> 
                            </div>
                        </div>
                <?php } } ?>
                </div>
                <?php
                    if( $sliderDots == 'true' ) echo '<div class="swiper-pagination"></div>';
                ?>    
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
