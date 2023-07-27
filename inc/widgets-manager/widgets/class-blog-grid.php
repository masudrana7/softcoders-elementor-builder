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

class BlogGrid extends Widget_Base {
	public function get_name() {
		return 'blog-grid';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Softcoders Blog Grid', 'SoftCoders-header-footer-elementor' );
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
            'blog_style',
            [
                'label'   => esc_html__('Select Blog Style', 'scaddons'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Grid Style', 'scaddons'),
                    'style2' => esc_html__('List Style', 'scaddons'),
                ],
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
        $this->add_responsive_control(
            'image_width',
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
                    '{{WRAPPER}} .sc-recent-post .recent-image img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );
        $this->add_responsive_control(
            'image_height',
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
                    '{{WRAPPER}} .sc-recent-post .recent-image img' => 'height: {{SIZE}}{{UNIT}};',
                ],                
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
			'section_general22_fields',
			[
				'label' => __( 'General ', 'softcoders-elements' ),
			]
		);
	
		$this->add_control(
			'grid_columns',
			[
				'label'   => esc_html__('Desktops > 991px', 'prelements'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'12' => esc_html__('1 Column', 'prelements'),
					'6' => esc_html__('2 Column', 'prelements'),
					'4' => esc_html__('3 Column', 'prelements'),
					'3' => esc_html__('4 Column', 'prelements'),
					'2' => esc_html__('6 Column', 'prelements'),
				],
				'default' => '4',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'md_columns',
			[
				'label'   => esc_html__('Tablets > 767px', 'prelements'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'12' => esc_html__('1 Column', 'prelements'),
					'6' => esc_html__('2 Column', 'prelements'),
					'4' => esc_html__('3 Column', 'prelements'),
					'3' => esc_html__('4 Column', 'prelements'),
					'2' => esc_html__('6 Column', 'prelements'),
				],
				'default' => '4',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sm_columns',
			[
				'label'   => esc_html__('Tablets > 575px', 'prelements'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'12' => esc_html__('1 Column', 'prelements'),
					'6' => esc_html__('2 Column', 'prelements'),
					'4' => esc_html__('3 Column', 'prelements'),
					'3' => esc_html__('4 Column', 'prelements'),
					'2' => esc_html__('6 Column', 'prelements'),
				],
				'default' => '4',
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
                    '{{WRAPPER}} .sc-blog-date-box .sc-date-box .title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sc-blog-date-box .sc-date-box .sub-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sc-recent-post .post-date' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .sc-blog-style2 .sc-blog-date-box .sc-blog-social a:hover' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .sc-recent-post .post-date, {{WRAPPER}} .sc-blog-date-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control( 
            'meta_icon_padding',
            [
                'label' => esc_html__('Meta Icon Padding', 'rsaddon'),
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
                    '{{WRAPPER}} .sc-recent-post .post-date, {{WRAPPER}} .sc-blog-date-box .sc-blog-social' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} .sc-recent-post .recent-text a' => 'color: {{VALUE}};',

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
                    '{{WRAPPER}} .sc-recent-post .recent-text a:hover' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .sc-recent-post .title, {{WRAPPER}} .sc-blog-text .title',
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
                    '{{WRAPPER}} .sc-recent-post .title, {{WRAPPER}} .sc-blog-text h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} sc-recent-post, {{WRAPPER}} .sc-blog-style2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_area_content_margin',
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
                    '{{WRAPPER}} sc-recent-post, {{WRAPPER}} .sc-blog-style2' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $pg_num = get_query_var('paged') ? get_query_var('paged') : 1;
        $posts_per_page = $settings['number'];
        $order_by = $settings['order_by'];
        $order = $settings['order'];
        $read_more = $settings['read_more_text'];

        ?>
        <div class="row">
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

                    $full_date      = get_the_date();
                    $blog_date      = get_the_date('d F Y');	
                    $post_admin     = get_the_author();	
                    $date_day      = get_the_date('d');
                    $date_month      = get_the_date('M');
            ?>


            <?php if ('style1' == $settings['blog_style']) {  ?>        
            <div class="col-lg-<?php echo esc_html($settings['grid_columns']); ?> col-md-<?php echo esc_html($settings['md_columns']); ?> col-sm-<?php echo esc_html($settings['sm_columns']); ?>">
                <div class="sc-blog-style2">
                    <?php if(!empty($settings['thumbnail_size'])){?>
                    <div class="blog-img">
                        <a href="<?php the_permalink(); ?>" >
                            <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                        </a>
                    </div>
                    <?php } ?>

                    <div class="sc-blog-date-box">
                        <?php if(!empty($date_day || $date_month) ){ ?>
                            <div class="sc-date-box">
                                <h4 class="title"><?php echo esc_html($date_day);?></h4>
                                <span class="sub-title"><?php echo esc_html($date_month);?></span>
                            </div>
                        <?php } ?>                               
                        <div class="sc-blog-social text-center">
                            <ul class="list-gap">
                                <li><i class="icon-david2"></i> <?php echo esc_html($post_admin); ?></li>
                                <li>
                                    <i class="icon-consoltancy"></i> <?php echo wp_kses_post($cats_show); ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="sc-blog-text">
                        <h4>
                            <a class="title" href="<?php the_permalink(); ?>"
                                ><?php the_title(); ?></a
                            >
                        </h4>
                        
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
            <?php } ?> 

            <?php if ('style2' == $settings['blog_style']) {  ?> 
            <div class="col-lg-<?php echo esc_html($settings['grid_columns']); ?> col-md-<?php echo esc_html($settings['md_columns']); ?> col-sm-<?php echo esc_html($settings['sm_columns']); ?>">
                    <div class="sc-recent-post d-flex sc-mb-25">
                        <?php if(!empty($settings['thumbnail_size'])){?>
                        <div class="recent-image">
                            <a href="<?php the_permalink(); ?>" >
                                <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                            </a>
                        </div>
                        <?php } ?>

                        <div class="recent-text">
                            <div class="calender-item">
                                <span class="post-date"><?php echo esc_html($blog_date);?></span>
                            </div>
                             <h5 class="title mb-0">
                                <a href="<?php the_permalink(); ?>"
                                    ><?php the_title(); ?></a
                                >
                            </h5>
                        </div>
                    </div>
            </div>
            <?php } ?>    



            <?php }
                wp_reset_postdata();
            } ?>    
        </div>
		<?php
	}
		/**
		 * Render site title output in the editor.
		 */
	
}
