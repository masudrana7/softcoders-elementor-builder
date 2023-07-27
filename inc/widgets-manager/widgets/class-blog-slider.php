<?php
namespace softcoderselements\WidgetsManager\Widgets;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class BlogSlider extends Widget_Base {
	public function get_name() {
		return 'blog-slider';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Softcoders Blog Slider', 'SoftCoders-header-footer-elementor' );
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

    private function get_blog_categories()
    {
        $options = array();
        $taxonomy = 'category';
        if (!empty($taxonomy)) {
            $terms = get_terms(
                array(
                    'parent' => 0,
                    'taxonomy' => $taxonomy,
                    'hide_empty' => false,
                )
            );
            if (!empty($terms)) {
                foreach ($terms as $term) {
                    if (isset($term)) {
                        $options[''] = 'Select';
                        if (isset($term->slug) && isset($term->name)) {
                            $options[$term->slug] = $term->name;
                        }
                    }
                }
            }
        }
        return $options;
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
				'label' => __( 'Blog Settings', 'SoftCoders-header-footer-elementor' ),
			]
		);

        $this->add_control(
            'category_id',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Category', 'scaddon'),
                'options' => $this->get_blog_categories()
            ]
        );

        $this->add_control(
            'desc_show',
            [
                'label'   => esc_html__('Description Show/Hide', 'scaddons'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'hide',
                'options' => [
                    'show' => esc_html__('Show', 'scaddons'),
                    'hide' => esc_html__('Hide', 'scaddons'),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'blog_word_show',
            [
                'label' => esc_html__('Content Limit', 'sc'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('20', 'sc'),
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => esc_html__('Number of Post', 'scaddon'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3
            ]
        );
        $this->add_control(
            'read_more_text',
            [
                'label' => esc_html__( 'Read More', 'scaddon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Read Article', 'scaddon' ),

            ]
        );
        $this->add_control(
            'order_by',
            [
                'label' => esc_html__('Order By', 'scaddon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => esc_html__('Date', 'scaddon'),
                    'ID' => esc_html__('ID', 'scaddon'),
                    'author' => esc_html__('Author', 'scaddon'),
                    'title' => esc_html__('Title', 'scaddon'),
                    'modified' => esc_html__('Modified', 'scaddon'),
                    'rand' => esc_html__('Random', 'scaddon'),
                    'comment_count' => esc_html__('Comment count', 'scaddon'),
                    'menu_order' => esc_html__('Menu order', 'scaddon')
                ]
            ]
        );
        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'scaddon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'desc' => esc_html__('DESC', 'scaddon'),
                    'asc' => esc_html__('ASC', 'scaddon')
                ]
            ]
        );		
        $this->end_controls_section();

        $this->start_controls_section(
			'section_general_settings',
			[
				'label' => __( 'General Settings', 'SoftCoders-header-footer-elementor' ),
			]
		);
        $this->add_control(
            'slides_ToScroll',
            [
                'label'   => esc_html__( 'Slide To Scroll', 'scaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 2,         
                'options' => [
                    '1' => esc_html__( '1 Item', 'scaddon' ),
                    '2' => esc_html__( '2 Item', 'scaddon' ),
                    '3' => esc_html__( '3 Item', 'scaddon' ),
                    '4' => esc_html__( '4 Item', 'scaddon' ),                   
                ],
                'separator' => 'before',
                            
            ]
            
        );
         $this->add_control(
            'sc_pslider_effect',
            [
                'label' => esc_html__('Slider Effect', 'scaddon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
					'default' => esc_html__('Default', 'scaddon'),					
					'fade' => esc_html__('Fade', 'scaddon'),
					'flip' => esc_html__('Flip', 'scaddon'),
					'cube' => esc_html__('Cube', 'scaddon'),
					'coverflow' => esc_html__('Coverflow', 'scaddon'),
					'creative' => esc_html__('Creative', 'scaddon'),
					'cards' => esc_html__('Cards', 'scaddon'),
                ],
            ]
        );
	
		$this->add_control(
            'col_xl',
            [
                'label'   => esc_html__( 'Wide Screen > 1399px', 'scaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,
                'options' => [
                    '1' => esc_html__( '1 Column', 'scaddon' ), 
                    '2' => esc_html__( '2 Column', 'scaddon' ),
                    '3' => esc_html__( '3 Column', 'scaddon' ),
                    '4' => esc_html__( '4 Column', 'scaddon' ),
                    '4.5' => esc_html__( '4.5 Column', 'scaddon' ),
                    '5' => esc_html__( '5 Column', 'scaddon' ),
                    '5.5' => esc_html__( '5.5 Column', 'scaddon' ),
                    '6' => esc_html__( '6 Column', 'scaddon' ),                 
                ],
                'separator' => 'before',
            ]
            
        );
    
        $this->add_control(
            'col_lg',
            [
                'label'   => esc_html__( 'Desktops > 1199px', 'scaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,
                'options' => [
                    '1' => esc_html__( '1 Column', 'scaddon' ), 
                    '2' => esc_html__( '2 Column', 'scaddon' ),
                    '3' => esc_html__( '3 Column', 'scaddon' ),
                    '4' => esc_html__( '4 Column', 'scaddon' ),
                    '6' => esc_html__( '6 Column', 'scaddon' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__( 'Desktops > 991px', 'scaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'scaddon' ), 
                    '2' => esc_html__( '2 Column', 'scaddon' ),
                    '3' => esc_html__( '3 Column', 'scaddon' ),
                    '4' => esc_html__( '4 Column', 'scaddon' ),
                    '6' => esc_html__( '6 Column', 'scaddon' ),                     
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__( 'Tablets > 767px', 'scaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 2,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'scaddon' ), 
                    '2' => esc_html__( '2 Column', 'scaddon' ),
                    '3' => esc_html__( '3 Column', 'scaddon' ),
                    '4' => esc_html__( '4 Column', 'scaddon' ),
                    '6' => esc_html__( '6 Column', 'scaddon' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_xs',
            [
                'label'   => esc_html__( 'Tablets < 768px', 'scaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'scaddon' ), 
                    '2' => esc_html__( '2 Column', 'scaddon' ),
                    '3' => esc_html__( '3 Column', 'scaddon' ),
                    '4' => esc_html__( '4 Column', 'scaddon' ),
                    '6' => esc_html__( '6 Column', 'scaddon' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_dots',
            [
                'label'   => esc_html__( 'Navigation Dots', 'scaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'scaddon' ),
                    'false' => esc_html__( 'Disable', 'scaddon' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_nav',
            [
                'label'   => esc_html__( 'Navigation Nav', 'scaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'scaddon' ),
                    'false' => esc_html__( 'Disable', 'scaddon' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'pcat_prev_text',
            [
                'label' => esc_html__( 'Previous Text', 'scaddon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Previous', 'scaddon' ),
                'placeholder' => esc_html__( 'Type your title here', 'scaddon' ),
                'condition' => [
                    'slider_nav' => 'true',
                ],
            ]
        );

        $this->add_control(
            'pcat_next_text',
            [
                'label' => esc_html__( 'Next Text', 'scaddon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Next', 'scaddon' ),
                'placeholder' => esc_html__( 'Type your title here', 'scaddon' ),
                'condition' => [
                    'slider_nav' => 'true',
                ],

            ]
        );
        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__( 'Autoplay', 'scaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'scaddon' ),
                    'false' => esc_html__( 'Disable', 'scaddon' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => esc_html__( 'Autoplay Slide Speed', 'scaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '1000' => esc_html__( '1 Seconds', 'scaddon' ),
                    '2000' => esc_html__( '2 Seconds', 'scaddon' ), 
                    '3000' => esc_html__( '3 Seconds', 'scaddon' ), 
                    '4000' => esc_html__( '4 Seconds', 'scaddon' ), 
                    '5000' => esc_html__( '5 Seconds', 'scaddon' ), 
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
                'label'   => esc_html__( 'Autoplay Interval', 'scaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '5000' => esc_html__( '5 Seconds', 'scaddon' ), 
                    '4000' => esc_html__( '4 Seconds', 'scaddon' ), 
                    '3000' => esc_html__( '3 Seconds', 'scaddon' ), 
                    '2000' => esc_html__( '2 Seconds', 'scaddon' ), 
                    '1000' => esc_html__( '1 Seconds', 'scaddon' ),     
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
                'label'   => esc_html__( 'Stop On Interaction', 'scaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'scaddon' ),
                    'false' => esc_html__( 'Disable', 'scaddon' ),              
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
                'label'   => esc_html__( 'Stop on Hover', 'scaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'scaddon' ),
                    'false' => esc_html__( 'Disable', 'scaddon' ),              
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
                'label'   => esc_html__( 'Loop', 'scaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'scaddon' ),
                    'false' => esc_html__( 'Disable', 'scaddon' ),
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_centerMode',
            [
                'label'   => esc_html__( 'Center Mode', 'scaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'scaddon' ),
                    'false' => esc_html__( 'Disable', 'scaddon' ),
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'item_gap_custom',
            [
                'label' => esc_html__( 'Item Gap', 'scaddon' ),
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
            'section_meta_style',
            [
                'label' => esc_html__('Meta Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control( 
            'meta_date_color',
            [
                'label' => esc_html__('Meta Date Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-date-box .sc-date-box a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control( 
            'meta_date_border',
            [
                'label' => esc_html__('Meta Date Border', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-date-box .sc-date-box::before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control( 
            'meta_date_background',
            [
                'label' => esc_html__('Meta Date Background', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-date-box .sc-date-box' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control( 
            'meta_social_background',
            [
                'label' => esc_html__('Meta Background', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-date-box .sc-blog-social' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control( 
            'meta_color',
            [
                'label' => esc_html__('Meta Text Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-style2 .sc-blog-date-box .sc-blog-social a, {{WRAPPER}} .sc-blog-date-box .sc-blog-social ul li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control( 
            'meta_link_hover_color',
            [
                'label' => esc_html__('Text Hover Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-style2 .sc-blog-date-box .sc-blog-social a:hover, {{WRAPPER}} .sc-blog-style2 .sc-blog-date-box .sc-date-box a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'meta_icon_color',
            [
                'label' => esc_html__('Meta Icon Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-date-box .sc-blog-social ul li i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'meta_all_bg_color',
            [
                'label' => esc_html__('Meta Area Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-date-box' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'blog_date_margin',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-date-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'blog_date_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-date-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'meta_social_padding',
            [
                'label' => esc_html__('Meta Social Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-date-box .sc-blog-social' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'meta_align',
            [
                'label'              => __( 'Alignment', 'SoftCoders-header-footer-elementor' ),
                'type'               => Controls_Manager::CHOOSE,
                'options'            => [
                    'space-between'   => [
                        'title' => __( 'Left', 'SoftCoders-header-footer-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'SoftCoders-header-footer-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'space-around'  => [
                        'title' => __( 'Right', 'SoftCoders-header-footer-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'selectors'          => [
                    '{{WRAPPER}} .sc-blog-style2 .sc-blog-date-box' => 'justify-content: {{VALUE}};',
                ],
                'frontend_available' => true,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'blog_title_style',
            [
                'label' => esc_html__('Title Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-text .title' => 'color: {{VALUE}};',

                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__('Title Hover Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-text .title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
                'label' => esc_html__('Title Typography', 'rsaddon'),
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .sc-blog-text .title',
			]
		);

        $this->add_responsive_control(
            'blog_title_margin',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-text h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'blog_desc_style',
            [
                'label' => esc_html__('Description Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__('Content Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-text .des' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'content_margin',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        //Read More Style
        $this->start_controls_section(
			'section_readmore',
			[
				'label' => __( 'Read More', 'SoftCoders-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->start_controls_tabs('_tabs_button');

        $this->start_controls_tab(
            '_blog_btn_normal',
            [
                'label' => esc_html__('Normal', 'rsaddon'),
            ]
        );

        $this->add_control(
			'readmore_color',
			[
				'label'     => __( 'Readmore Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-transparent-btn' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            'readmore_color_bg',
            [
                'label' => esc_html__('Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sc-transparent-btn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'readmore_color_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sc-transparent-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'readmore_margin',
            [
                'label' => esc_html__('Readmore Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sc-transparent-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'readmore_border_color',
			[
				'label'     => __( 'Border Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-transparent-btn' => 'border-color: {{VALUE}};',
				],
			]
		);
        $this->end_controls_tab();

         $this->start_controls_tab(
            '_blog_btn_hover',
            [
                'label' => esc_html__('Hover', 'rsaddon'),
            ]
        );

        $this->add_control(
			'readmore_hover_color',
			[
				'label'     => __( 'Readmore Hover Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-transparent-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            'readmore_color_bg_hover',
            [
                'label' => esc_html__('Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sc-transparent-btn:before' => 'background: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
			'readmore_border_color_hover',
			[
				'label'     => __( 'Border Hover Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-transparent-btn' => 'border-color: {{VALUE}};',
				],
			]
		);
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'blog_content_style',
            [
                'label' => esc_html__('Blog Content Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'blog_content_padding',
            [
                'label' => esc_html__('Content Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_content_bg',
            [
                'label' => esc_html__('Content Background', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-style2 .sc-blog-text, {{WRAPPER}} .sc-blog-text' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'blog_text_border',
                'selector' => '{{WRAPPER}} .sc-blog-text',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'blog_content_shadow',
                'selector' => '{{WRAPPER}} .sc-blog-text',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'blog_global_style',
            [
                'label' => esc_html__('Global Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'meta_box_alignment',
            [
                'label'              => __( 'Alignment', 'SoftCoders-header-footer-elementor' ),
                'type'               => Controls_Manager::CHOOSE,
                'options'            => [
                    'left'   => [
                        'title' => __( 'Left', 'SoftCoders-header-footer-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'SoftCoders-header-footer-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'SoftCoders-header-footer-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'selectors'          => [
                    '{{WRAPPER}} .sc-blog-style2' => 'text-align: {{VALUE}};',
                ],
                'frontend_available' => true,
            ]
        );
        

        $this->add_responsive_control(
            'blog_area_content_bg',
            [
                'label' => esc_html__('Blog Area Background', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-blog .blog-item' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'blog_area_box_shadow',
                'selector' => '{{WRAPPER}} .sc-blog .blog-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'media_border',
                'selector' => '{{WRAPPER}} .sc-blog .blog-item',
            ]
        );

        $this->add_responsive_control(
            'blog_area_content_padding',
            [
                'label' => esc_html__('Full Area Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-style2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'blog_area_content_Margin',
            [
                'label' => esc_html__('Full Area Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-style2' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'blog_img_border_radius',
            [
                'label' => esc_html__('Image Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-blog-style2 .blog-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $pg_num = get_query_var('paged') ? get_query_var('paged') : 1;
        $posts_per_page = $settings['number'];
        $order_by = $settings['order_by'];
        $order = $settings['order'];
        $unique = rand(2023,98748);
        $read_more = $settings['read_more_text'];
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
        <div class="swiper sc-swiper-slider-<?php echo esc_attr($unique); ?> nav_<?php echo $settings['slider_nav']; ?>">
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

                    <?php

                    $args = array(
                        'post_type' => array('post'),
                        'post_status' => array('publish'),
                        'nopaging' => false,
                        'paged' => $pg_num,
                        'posts_per_page' => $posts_per_page,
                        'category_name' => $settings['category_id'],
                        'orderby' => $order_by,
                        'order' => $order,
                    );
                   $query = new \WP_Query($args);                   
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            $thumbnail_src = get_the_post_thumbnail_url();
                            $post_admin     = get_the_author();
                            $cats_show = get_the_term_list( $query->ID, 'category', ' ', '<span class="separator">,</span> ');	

                            if (!empty($settings['blog_word_show'])) {
                                $limit = $settings['blog_word_show'];
                            } else {
                                $limit = 20;
                            }


                            $blog_date      = get_the_date("d M y");
                            $post_admin     = ucwords(get_the_author());

                    ?>
                    <div class="swiper-slide">
                        <div class="sc-blog-style2">
                            <div class="blog-img">
                                <a href="<?php the_permalink(); ?>" >
                                    <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                                </a>
                            </div>
                            <div class="sc-blog-date-box">
                                <?php if(!empty($blog_date) ){ ?>
                                    <div class="sc-date-box">
                                        <a><i class="ri-calendar-line"></i><?php echo esc_html($blog_date);?></a>

                                    </div>
                                <?php } ?>                               
                                <div class="sc-blog-social">
                                        <a><i class="ri-user-6-line"></i> <?php echo esc_html($post_admin); ?></a>
                                </div>
                            </div>
                            <div class="sc-blog-text">
                                <h3>
                                    <a class="title" href="<?php the_permalink(); ?>"
                                        ><?php the_title(); ?></a
                                    >
                                </h3>
                                
                                <?php if ('show' == $settings['desc_show']) {  ?>
                                <p class="des"><?php echo wp_trim_words(get_the_content(), $limit, '...'); ?></p>
                                <?php } ?>

                                <?php if(!empty($read_more) ){ ?>    
                                <div class="sc-blog-btn">
                                    <a class="sc-transparent-btn" href="<?php the_permalink(); ?>"><?php echo wp_kses_post($read_more); ?></a>
                                </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>  
                    <?php }
                        wp_reset_postdata();
                    } ?> 
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
