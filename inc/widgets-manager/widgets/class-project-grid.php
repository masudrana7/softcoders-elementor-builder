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

class ProjectGrid extends Widget_Base {
	public function get_name() {
		return 'project-grid';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Softcoders Project Grid', 'softcoders-elements' );
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
            'project_member_list',
            [
                'label' => __('Project List', 'scaddon'),
            ]
        );

        $this->add_control(
			'filter',
			[
				'label' => __('Filter', 'softcoders-elements-core'),
				'type' => Controls_Manager::SWITCHER,
				'default' => false
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
            'title',
            [
                'label' => __('Title', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Lucinda Banfield', 'scaddon'),
            ]
        );
        $repeater->add_control(
            'item_category',
            [
                'label' => __('Category', 'scaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Repair Technician', 'scaddon'),
            ]
        );
        $repeater->add_control(
            'project_single_link',
            [
                'label' => __('Project Single Link', 'scaddon'),
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
                        'list_content' => __('Marketing', 'scaddon'),
                    ],
                    [
                        'list_title' => __('Title #2', 'scaddon'),
                        'list_content' => __('Strategy', 'scaddon'),
                    ],
                ],
            ]
        );
        $this->end_controls_section();


		$this->start_controls_section(
			'section_general_fields',
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
			'grid_menu_style',
			[
				'label' => esc_html__( 'Menu Style', 'softcoders-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'menu_color',
            [
                'label' => esc_html__( 'Menu Color', 'softcoders-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-project-filter button' => 'color: {{VALUE}};',

                ],                
            ]
        );
		$this->add_control(
            'menu_active_color',
            [
                'label' => esc_html__( 'Menu Active Color', 'softcoders-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-project-filter button.active, {{WRAPPER}} .sc-project-filter button:hover' => 'color: {{VALUE}};',

                ],                
            ]
        );
		$this->add_control(
            'menu_background_color',
            [
                'label' => esc_html__( 'Menu Background Color', 'softcoders-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-project-filter button' => 'background: {{VALUE}};',

                ],                
            ]
        );
		$this->add_control(
            'menu_background_before_color',
            [
                'label' => esc_html__( 'Menu Background Before Color', 'softcoders-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-project-filter button::before' => 'background: {{VALUE}};',

                ],                
            ]
        );
		$this->add_responsive_control(
			'menu_padding',
			[
				'label'              => __( 'Area Padding', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-project-filter button' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 
                    {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon Style', 'softcoders-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'icon_switcher',
			[
				'label' => __('Filter', 'softcoders-elements-core'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'softcoders-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-project-item .sc-project-content-box .sc-project-icon i' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',                
            ]
        );

        $this->add_control(
            'icon_section_bg',
            [
                'label' => esc_html__( 'Icon Section Background', 'softcoders-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-project-content-box .sc-project-icon i'   => 'background: {{VALUE}};',
                ],
                'separator' => 'before',                
            ]
        );
		$this->add_control(
			'border_radius',
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
					'{{WRAPPER}} .sc-project-content-box .sc-project-icon i' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title Style', 'softcoders-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

         $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'softcoders-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-project-item .sc-project-content-box .sc-project-text a' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .sc-project-text h4',
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'section_cat_style',
			[
				'label' => esc_html__( 'Category Style', 'softcoders-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'category_color',
            [
                'label' => esc_html__( 'Category Color', 'softcoders-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-project-item .sc-project-content-box .sc-project-text .sub-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sc-project-item .sc-project-content-box .sc-project-text .sub-title::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .sc-project-item .sc-project-content-box .sc-project-text .sub-title::after' => 'background: {{VALUE}};',
                ],                
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cat_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .sc-project-text .sub-title',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'section_global_style',
			[
				'label' => esc_html__( 'Global Style', 'softcoders-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


        $this->add_control(
            'project_item_bg',
            [
                'label' => esc_html__( 'Project Overlay', 'softcoders-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-project-item::before' => 'background: {{VALUE}};',
                ],                
            ]
        );

        $this->add_responsive_control(
			'project_border_radious',
			[
				'label' => esc_html__( 'Project Border Radious', 'softcoders-elements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sc-project-item:hover::before, {{WRAPPER}} .sc-project-item img, {{WRAPPER}} .sc-project-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'project_border',
                'selector' => '{{WRAPPER}} .sc-project-item',
            ]
        );

        $this->add_control(
            'project_img_background',
            [
                'label' => esc_html__( 'Project Background', 'softcoders-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-project-item' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .sc-project-item' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 
                    {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

        $this->add_control(
            'image_overlay',
            [
                'label' => esc_html__( 'Image Hover Overlay', 'softcoders-elements' ),
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
				'label'              => __( 'Alignment', 'softcoders-elements' ),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
					'left'    => [
						'title' => __( 'Left', 'softcoders-elements' ),
						'icon'  => 'fa fa-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'softcoders-elements' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'softcoders-elements' ),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justify', 'softcoders-elements' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .sc-project-item' => 'text-align: {{VALUE}};',
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
        $filter = $settings['filter']; ?>
        <?php if ($filter) {
		 $category_arr       = array();
			$category_arr_class = array();
			foreach ($settings["items1"] as $key => $item) {
				$cat                        = $item['item_category'];
				$child_categories_ex        = explode(',', $cat);
				$child_categories           = str_replace(',', ' ', $cat);
				$category_arr_class[$key] = strtolower($child_categories);
				foreach ($child_categories_ex as $child_category) {
					$category_arr[] = strtolower($child_category);
				}
			}
		?>

        <div class="sc-project-filter gridFilter text-center mb-70 md-mb-50">
				<button class="active" data-filter="*"><?php esc_html_e('Show All', 'softcoders-elements'); ?></button>
				<?php
				$category_arr = array_unique($category_arr);
				foreach ($category_arr as $category) {
					echo '<button data-filter=".' . $category . '">' . $category . '</button>';
				}
				?>
			</div>
            <div class="row grid gx-3">
                <?php foreach ($settings["items1"] as $key => $item) {
                    $title = $item["title"];
                    $link = $item["project_single_link"];
                    $item_category = $item["item_category"];
                    $image = wp_get_attachment_image_url($item["image"]["id"], 'full');?>
                        <div class="col-lg-<?php echo esc_html($settings['grid_columns']); ?> col-md-<?php echo esc_html($settings['md_columns']); ?> col-sm-<?php echo esc_html($settings['sm_columns']); ?> grid-item <?php echo esc_attr($category_arr_class[$key]); ?>">
                            <div class="sc-project-item">
                                <?php if(!empty($image)){?>    
                                <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
                                <?php } ?>   
                                <div class="sc-project-content-box">
                                    <?php if( $settings['icon_switcher']){?> 
                                    <div class="sc-project-icon">
                                        <a href="<?php echo $link; ?>"><i class="icon-sliuder-arrow2"></i></a>
                                    </div>
                                    <?php } ?> 
                                    <div class="sc-project-text">
                                        <span class="sub-title"><?php echo $item_category; ?></span>
                                        <h4><a class="title" href="<?php echo $link; ?>"><?php echo $title; ?></a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php } ?>
            </div>
            <?php } else { ?>
                <div class="row grid gx-3">
                    <?php foreach ($settings["items1"] as $item) {
                        $title = $item["title"];
                        $link = $item["project_single_link"];
                        $item_category = $item["item_category"];
                        $image = wp_get_attachment_image_url($item["image"]["id"], 'full');?>
                        <div class="col-lg-<?php echo esc_html($settings['grid_columns']); ?> col-md-<?php echo esc_html($settings['md_columns']); ?> col-sm-<?php echo esc_html($settings['sm_columns']); ?>">
                            <div class="sc-project-item">
                                <?php if(!empty($image)){?>    
                                <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
                                <?php } ?>   
                                <div class="sc-project-content-box">

                                    <?php if( $settings['icon_switcher']){?> 
                                    <div class="sc-project-icon">
                                        <a href="<?php echo $link; ?>"><i class="icon-sliuder-arrow2"></i></a>
                                    </div>
                                    <?php } ?> 

                                    <div class="sc-project-text">
                                        <span class="sub-title"><?php echo $item_category; ?></span>
                                        <h4><a class="title" href="<?php echo $link; ?>"><?php echo $title; ?></a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>    

	    <?php
	}	/**	 * Render site title output in the editor.	 */
} ?>
