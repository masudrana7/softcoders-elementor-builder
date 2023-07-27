<?php
namespace softcoderselements\WidgetsManager\Widgets;

// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * Class Nav Menu.
 */
class Navigation_Menu extends Widget_Base {
	/**
	 * Menu index.
	 *
	 * @access protected
	 * @var $nav_menu_index
	 */
	protected $nav_menu_index = 1;

	/**
	 * Retrieve the widget name.
	 *
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'navigation-menu';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'SoftCoders Navigation Menu', 'SoftCoders-header-footer-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-elementor-circle';
	}

	public function get_categories() {
		return [ 'sce-widgets' ];
	}

	public function get_script_depends() {
		return [ 'sce-frontend-js' ];
	}

	/**
	 * Retrieve the menu index.
	 *
	 * Used to get index of nav menu.
	 *
	 * @return string nav index.
	 */
	protected function get_nav_menu_index() {
		return $this->nav_menu_index++;
	}
	/**
	 * Retrieve the list of available menus.
	 *
	 * Used to get the list of available menus.
	 *
	 * @return array get WordPress menus list.
	 */
	private function get_available_menus() {

		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

	/**
	 * Check if the Elementor is updated.
	 */
	public static function is_elementor_updated() {
		if ( class_exists( 'Elementor\Icons_Manager' ) ) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * Register Nav Menu controls.
	 */
	protected function register_controls() {

		$this->register_general_content_controls();
		$this->register_style_content_controls();
		$this->register_dropdown_content_controls();
	}

	/**
	 * Register Nav Menu General Controls.
	 */
	protected function register_general_content_controls() {

		$this->start_controls_section(
			'section_menu',
			[
				'label' => __( 'Menu', 'SoftCoders-header-footer-elementor' ),
			]
		);

		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label'        => __( 'Menu', 'SoftCoders-header-footer-elementor' ),
					'type'         => Controls_Manager::SELECT,
					'options'      => $menus,
					'default'      => array_keys( $menus )[0],
					'save_default' => true,
					/* translators: %s Nav menu URL */
					'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'SoftCoders-header-footer-elementor' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %s Nav menu URL */
					'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'SoftCoders-header-footer-elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

		$this->add_control(
			'menu_last_item',
			[
				'label'     => __( 'Last Menu Item', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'none' => __( 'Default', 'SoftCoders-header-footer-elementor' ),
					'cta'  => __( 'Button', 'SoftCoders-header-footer-elementor' ),
				],
				'default'   => 'none',
				'condition' => [
					'layout!' => 'expandible',
				],
			]
		);

		$this->add_control(
			'separator_dots',
			[
				'label'     => __( 'Select Separator', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'no-separator' 		=> __( 'Default', 'SoftCoders-header-footer-elementor' ),
					'separator-dots'  	=> __( 'Separator Dots', 'SoftCoders-header-footer-elementor' ),
				],
				'default'   => 'no-separator',
			]
		);

		$this->add_control(
			'position_header',
			[
				'label'     => __( 'Select Position', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'no-position' 		=> __( 'Default', 'SoftCoders-header-footer-elementor' ),
					'absolute-position'  	=> __( 'Transparent', 'SoftCoders-header-footer-elementor' ),
				],
				'default'   => 'no-position',
			]
		);

		$this->add_responsive_control(
			'separator_dots_color',
			[
				'label'     => __( 'Separator Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF82',
				'selectors' => [
					'{{WRAPPER}} nav.separator-dots ul.sce-nav-menu li a:before' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'separator_dots' => 'separator-dots',
				],
			]
		);

		

		$this->end_controls_section();
			$this->start_controls_section(
				'section_layout',
				[
					'label' => __( 'Layout', 'SoftCoders-header-footer-elementor' ),
				]
			);

			$this->add_control(
				'layout',
				[
					'label'   => __( 'Layout', 'SoftCoders-header-footer-elementor' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'horizontal',
					'options' => [
						'horizontal'       => __( 'Horizontal', 'SoftCoders-header-footer-elementor' ),
						'horizontal_col_2' => __( 'Horizontal Col 2', 'SoftCoders-header-footer-elementor' ),
						'vertical'         => __( 'Vertical', 'SoftCoders-header-footer-elementor' ),
						'expandible'       => __( 'Expanded', 'SoftCoders-header-footer-elementor' ),
						'flyout'           => __( 'Flyout', 'SoftCoders-header-footer-elementor' ),
					],
				]
			);

			$this->add_responsive_control(
				'navmenu_align',
				[
					'label'        => __( 'Alignment', 'SoftCoders-header-footer-elementor' ),
					'type'         => Controls_Manager::CHOOSE,
					'options'      => [
						'flex-start'    => [
							'title' => __( 'Left', 'SoftCoders-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-left',
						],
						'center'  => [
							'title' => __( 'Center', 'SoftCoders-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-center',
						],
						'flex-end'   => [
							'title' => __( 'Right', 'SoftCoders-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-right',
						],
						'justify' => [
							'title' => __( 'Justify', 'SoftCoders-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-stretch',
						],
					],
					'default'      => 'left',
					'condition'    => [
						'layout' => [ 'horizontal', 'vertical' ],
					],
					'selectors' => [
						'{{WRAPPER}} .sce-nav-menu nav' => 'justify-content: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'flyout_layout',
				[
					'label'     => __( 'Flyout Orientation', 'SoftCoders-header-footer-elementor' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'left',
					'options'   => [
						'left'  => __( 'Left', 'SoftCoders-header-footer-elementor' ),
						'right' => __( 'Right', 'SoftCoders-header-footer-elementor' ),
					],
					'condition' => [
						'layout' => 'flyout',
					],
				]
			);

			$this->add_control(
				'flyout_type',
				[
					'label'       => __( 'Appear Effect', 'SoftCoders-header-footer-elementor' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'normal',
					'label_block' => false,
					'options'     => [
						'normal' => __( 'Slide', 'SoftCoders-header-footer-elementor' ),
						'push'   => __( 'Push', 'SoftCoders-header-footer-elementor' ),
					],
					'render_type' => 'template',
					'condition'   => [
						'layout' => 'flyout',
					],
				]
			);

			$this->add_responsive_control(
				'hamburger_align',
				[
					'label'                => __( 'Hamburger Align', 'SoftCoders-header-footer-elementor' ),
					'type'                 => Controls_Manager::CHOOSE,
					'default'              => 'center',
					'options'              => [
						'left'   => [
							'title' => __( 'Left', 'SoftCoders-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'SoftCoders-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-center',
						],
						'right'  => [
							'title' => __( 'Right', 'SoftCoders-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-right',
						],
					],
					'selectors_dictionary' => [
						'left'   => 'margin-right: auto',
						'center' => 'margin: 0 auto',
						'right'  => 'margin-left: auto',
					],
					'selectors'            => [
						'{{WRAPPER}} .sce-nav-menu__toggle,
						{{WRAPPER}} .sce-nav-menu-icon' => '{{VALUE}}',
					],
					'condition'            => [
						'layout' => [ 'expandible', 'flyout' ],
					],
					'label_block'          => false,
					'frontend_available'   => true,
				]
			);

			$this->add_responsive_control(
				'hamburger_menu_align',
				[
					'label'              => __( 'Menu Items Align', 'SoftCoders-header-footer-elementor' ),
					'type'               => Controls_Manager::CHOOSE,
					'options'            => [
						'flex-start'    => [
							'title' => __( 'Left', 'SoftCoders-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-left',
						],
						'center'        => [
							'title' => __( 'Center', 'SoftCoders-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-center',
						],
						'flex-end'      => [
							'title' => __( 'Right', 'SoftCoders-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-right',
						],
						'space-between' => [
							'title' => __( 'Justify', 'SoftCoders-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-stretch',
						],
					],
					'default'            => 'space-between',
					'condition'          => [
						'layout' => [ 'expandible', 'flyout' ],
					],
					'selectors'          => [
						'{{WRAPPER}} li.menu-item a' => 'justify-content: {{VALUE}};',
						'{{WRAPPER}} li .elementor-button-wrapper' => 'text-align: {{VALUE}};',
						'{{WRAPPER}}.sce-menu-item-flex-end li .elementor-button-wrapper' => 'text-align: right;',
					],
					'prefix_class'       => 'sce-menu-item-',
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'submenu_icon',
				[
					'label'        => __( 'Submenu Icon', 'SoftCoders-header-footer-elementor' ),
					'type'         => Controls_Manager::SELECT,
					'default'      => 'arrow',
					'options'      => [
						'arrow'   => __( 'Arrows', 'SoftCoders-header-footer-elementor' ),
						'plus'    => __( 'Plus Sign', 'SoftCoders-header-footer-elementor' ),
						'classic' => __( 'Classic', 'SoftCoders-header-footer-elementor' ),
					],
					'prefix_class' => 'sce-submenu-icon-',
				]
			);

			$this->add_control(
				'submenu_animation',
				[
					'label'        => __( 'Submenu Animation', 'SoftCoders-header-footer-elementor' ),
					'type'         => Controls_Manager::SELECT,
					'default'      => 'none',
					'options'      => [
						'none'     => __( 'Default', 'SoftCoders-header-footer-elementor' ),
						'slide_up' => __( 'Slide Up', 'SoftCoders-header-footer-elementor' ),
					],
					'prefix_class' => 'sce-submenu-animation-',
					'condition'    => [
						'layout' => 'horizontal',
					],
				]
			);

			$this->add_control(
				'link_redirect',
				[
					'label'        => __( 'Action On Menu Click', 'SoftCoders-header-footer-elementor' ),
					'type'         => Controls_Manager::SELECT,
					'default'      => 'child',
					'description'  => __( 'For Horizontal layout, this will affect on the selected breakpoint', 'SoftCoders-header-footer-elementor' ),
					'options'      => [
						'child'     => __( 'Open Submenu', 'SoftCoders-header-footer-elementor' ),
						'self_link' => __( 'Redirect To Self Link', 'SoftCoders-header-footer-elementor' ),
					],
					'prefix_class' => 'sce-link-redirect-',
				]
			);

		$this->add_control(
			'heading_responsive',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Responsive', 'SoftCoders-header-footer-elementor' ),
				'separator' => 'before',
				'condition' => [
					'layout' => [ 'horizontal', 'vertical' ],
				],
			]
		);

		$this->add_control(
			'dropdown',
			[
				'label'        => __( 'Breakpoint', 'SoftCoders-header-footer-elementor' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'tablet',
				'options'      => [
					'mobile' => __( 'Mobile (768px >)', 'SoftCoders-header-footer-elementor' ),
					'landscape' => __( 'Mobile landscape (991px >)', 'SoftCoders-header-footer-elementor' ),
					'tablet' => __( 'Tablet (1025px >)', 'SoftCoders-header-footer-elementor' ),
					'none'   => __( 'None', 'SoftCoders-header-footer-elementor' ),
				],
				'prefix_class' => 'sce-nav-menu__breakpoint-',
				'condition'    => [
					'layout' => [ 'horizontal', 'vertical' ],
				],
				'render_type'  => 'template',
			]
		);

		$this->add_control(
			'resp_align',
			[
				'label'                => __( 'Alignment', 'SoftCoders-header-footer-elementor' ),
				'type'                 => Controls_Manager::CHOOSE,
				'options'              => [
					'left'   => [
						'title' => __( 'Left', 'SoftCoders-header-footer-elementor' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'SoftCoders-header-footer-elementor' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'SoftCoders-header-footer-elementor' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'              => 'center',
				'description'          => __( 'This is the alignement of menu icon on selected responsive breakpoints.', 'SoftCoders-header-footer-elementor' ),
				'condition'            => [
					'layout'    => [ 'horizontal', 'vertical' ],
					'dropdown!' => 'none',
				],
				'selectors_dictionary' => [
					'left'   => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right'  => 'margin-left: auto',
				],
				'selectors'            => [
					'{{WRAPPER}} .sce-nav-menu__toggle' => '{{VALUE}}',
				],
			]
		);


		$this->add_responsive_control(
		    'responsive_background_menu',
		    [
		        'label' => esc_html__( 'Background Color (Menu Area)', 'SoftCoders-header-footer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .sce-nav-menu nav' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'responsive_color_menu',
		    [
		        'label' => esc_html__( 'Color', 'SoftCoders-header-footer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .sce-nav-menu nav ul li a' => 'color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'responsive_color_menu_hover',
		    [
		        'label' => esc_html__( 'Color (Hover)', 'SoftCoders-header-footer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .sce-nav-menu nav ul li a:hover, {{WRAPPER}} .sce-nav-menu nav > ul > li.current_page_item > a, {{WRAPPER}} .sce-nav-menu nav > ul > li.current-menu-ancestor > a' => 'color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'responsive_padding_menu',
		    [
		        'label' => esc_html__( 'Padding (Menu Area)', 'SoftCoders-header-footer-elementor' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .sce-nav-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
            'responsive_padding_menu_item',
            [
                'label' => esc_html__( 'Margin (Menu Item)', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sce-nav-menu li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
		    'responsive_top_menu',
		    [
		        'label' => esc_html__( 'Dropdown Top Position', 'SoftCoders-header-footer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .sce-nav-menu nav' => 'top: {{SIZE}}{{UNIT}} !important;',
		        ],
		    ]
		);

		$this->add_control(
			'full_width_dropdown',
			[
				'label'        => __( 'Full Width', 'SoftCoders-header-footer-elementor' ),
				'description'  => __( 'Enable this option to stretch the Sub Menu to Full Width.', 'SoftCoders-header-footer-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'SoftCoders-header-footer-elementor' ),
				'label_off'    => __( 'No', 'SoftCoders-header-footer-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'dropdown!' => 'none',
					'layout!'   => 'flyout',
				],
				'render_type'  => 'template',
			]
		);

		if ( $this->is_elementor_updated() ) {
			$this->add_control(
				'dropdown_icon',
				[
					'label'       => __( 'Menu Icon', 'SoftCoders-header-footer-elementor' ),
					'type'        => Controls_Manager::ICONS,
					'label_block' => 'true',
					'default'     => [
						'value'   => 'fas fa-align-justify',
						'library' => 'fa-solid',
					],
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		} else {
			$this->add_control(
				'dropdown_icon',
				[
					'label'       => __( 'Icon', 'SoftCoders-header-footer-elementor' ),
					'type'        => Controls_Manager::ICON,
					'label_block' => 'true',
					'default'     => 'fa fa-align-justify',
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		}

		if ( $this->is_elementor_updated() ) {
			$this->add_control(
				'dropdown_close_icon',
				[
					'label'       => __( 'Close Icon', 'SoftCoders-header-footer-elementor' ),
					'type'        => Controls_Manager::ICONS,
					'label_block' => 'true',
					'default'     => [
						'value'   => 'far fa-window-close',
						'library' => 'fa-regular',
					],
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		} else {
			$this->add_control(
				'dropdown_close_icon',
				[
					'label'       => __( 'Close Icon', 'SoftCoders-header-footer-elementor' ),
					'type'        => Controls_Manager::ICON,
					'label_block' => 'true',
					'default'     => 'fa fa-close',
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		}
		$this->add_control(
			'mobile_menu_btn_show_hide',
			[
				'label' => esc_html__( 'Button Show / Hide', 'spria-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'spria-core' ),
				'label_off' => esc_html__( 'Hide', 'spria-core' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'btn1',
			[
				'label'       => esc_html__('Button Text', 'scaddon'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Get Consulting',
				'placeholder' => esc_html__('Get Consulting', 'scaddon'),
				'separator'   => 'before',
				'condition' => [
					'mobile_menu_btn_show_hide' => 'yes'
				],
			]
		);
		$this->add_control(
			'btn_link1',
			[
				'label'       => esc_html__('Button Link', 'scaddon'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__('#', 'scaddon'),
				'condition' => [
					'mobile_menu_btn_show_hide' => 'yes'
				],
			]
		);
		
		$this->end_controls_section();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_style_content_controls() {

		$this->start_controls_section(
			'section_style_main-menu',
			[
				'label'     => __( 'Main Menu', 'SoftCoders-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'expandible',
				],
			]
		);

		$this->add_responsive_control(
			'width_flyout_menu_item',
			[
				'label'              => __( 'Flyout Box Width', 'SoftCoders-header-footer-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'max' => 500,
						'min' => 100,
					],
				],
				'default'            => [
					'size' => 300,
					'unit' => 'px',
				],
				'selectors'          => [
					'{{WRAPPER}} .sce-flyout-wrapper .sce-side' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .sce-flyout-open.left'  => 'left: -{{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .sce-flyout-open.right' => 'right: -{{SIZE}}{{UNIT}}',
				],
				'condition'          => [
					'layout' => 'flyout',
				],
				'render_type'        => 'template',
				'frontend_available' => true,
			]
		);

			$this->add_responsive_control(
				'padding_flyout_menu_item',
				[
					'label'              => __( 'Flyout Box Padding', 'SoftCoders-header-footer-elementor' ),
					'type'               => Controls_Manager::SLIDER,
					'range'              => [
						'px' => [
							'max' => 50,
						],
					],
					'default'            => [
						'size' => 30,
						'unit' => 'px',
					],
					'selectors'          => [
						'{{WRAPPER}} .sce-flyout-content' => 'padding: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'flyout',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_horizontal_menu_item',
				[
					'label'              => __( 'Padding', 'SoftCoders-header-footer-elementor' ),
					'type'               => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .sce-nav-menu nav > ul > li > .sce-has-submenu-container > a, {{WRAPPER}} .sce-nav-menu nav > ul > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);
            $this->add_responsive_control(
                'margin_horizontal_menu_item',
                [
                    'label'              => __( 'Margin', 'SoftCoders-header-footer-elementor' ),
                    'type'               => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .sce-nav-menu nav > ul > li > .sce-has-submenu-container > a, {{WRAPPER}} .sce-nav-menu nav > ul > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'frontend_available' => true,
                ]
            );

			$this->add_responsive_control(
				'menu_row_space',
				[
					'label'              => __( 'Row Spacing', 'SoftCoders-header-footer-elementor' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'range'              => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors'          => [
						'body:not(.rtl) {{WRAPPER}} .sce-nav-menu__layout-horizontal .sce-nav-menu > li.menu-item' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'horizontal',
					],
					'frontend_available' => true,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'label'              => __( 'Menu Typography', 'SoftCoders-header-footer-elementor' ),
					'name'      => 'icon_typography',
					'global'    => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'separator' => 'before',
					'selector'  => '{{WRAPPER}} .sce-nav-menu ul li i',
				]
			);

			$this->add_responsive_control(
				'menu_top_space',
				[
					'label'              => __( 'Menu Item Top Spacing', 'SoftCoders-header-footer-elementor' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px', '%' ],
					'range'              => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors'          => [
						'{{WRAPPER}} .sce-flyout-wrapper .sce-nav-menu > li.menu-item:first-child' => 'margin-top: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'flyout',
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'bg_color_flyout',
				[
					'label'     => __( 'Background Color', 'SoftCoders-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#FFFFFF',
					'selectors' => [
						'{{WRAPPER}} .sce-flyout-content' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'layout' => 'flyout',
					],
				]
			);

			$this->add_control(
				'pointer',
				[
					'label'     => __( 'Link Hover Effect', 'SoftCoders-header-footer-elementor' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'none',
					'options'   => [
						'none'        => __( 'None', 'SoftCoders-header-footer-elementor' ),
						'underline'   => __( 'Underline', 'SoftCoders-header-footer-elementor' ),
						'overline'    => __( 'Overline', 'SoftCoders-header-footer-elementor' ),
						'double-line' => __( 'Double Line', 'SoftCoders-header-footer-elementor' ),
						'framed'      => __( 'Framed', 'SoftCoders-header-footer-elementor' ),
						'text'        => __( 'Text', 'SoftCoders-header-footer-elementor' ),
					],
					'condition' => [
						'layout' => [ 'horizontal' ],
					],
				]
			);

		$this->add_control(
			'animation_line',
			[
				'label'     => __( 'Animation', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => [
					'fade'     => __('Fade', 'SoftCoders-header-footer-elementor'),
					'slide'    => __('Slide', 'SoftCoders-header-footer-elementor'),
					'grow'     => __('Grow', 'SoftCoders-header-footer-elementor'),
					'drop-in'  => __('Drop In', 'SoftCoders-header-footer-elementor'),
					'drop-out' => __('Drop Out', 'SoftCoders-header-footer-elementor'),
					'none'     => __('None', 'SoftCoders-header-footer-elementor'),
				],
				'condition' => [
					'layout'  => [ 'horizontal' ],
					'pointer' => [ 'underline', 'overline', 'double-line' ],
				],
			]
		);

		$this->add_control(
			'animation_framed',
			[
				'label'     => __( 'Frame Animation', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => [
					'fade'     => __('Fade', 'SoftCoders-header-footer-elementor'),
					'grow'    => __('Grow', 'SoftCoders-header-footer-elementor'),
					'shrink'  => __('Shrink', 'SoftCoders-header-footer-elementor'),
					'draw'    => __('Draw', 'SoftCoders-header-footer-elementor'),
					'corners' => __('Corners', 'SoftCoders-header-footer-elementor'),
					'none'    => __('None', 'SoftCoders-header-footer-elementor'),
				],
				'condition' => [
					'layout'  => [ 'horizontal' ],
					'pointer' => 'framed',
				],
			]
		);

		$this->add_control(
			'animation_text',
			[
				'label'     => __( 'Animation', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'grow',
				'options'   => [
					'grow'   => __('Grow', 'SoftCoders-header-footer-elementor'),
					'shrink' => __('Shrink', 'SoftCoders-header-footer-elementor'),
					'sink'   => __('Sink', 'SoftCoders-header-footer-elementor'),
					'float'  => __('Float', 'SoftCoders-header-footer-elementor'),
					'skew'   => __('Skew', 'SoftCoders-header-footer-elementor'),
					'rotate' => __('Rotate', 'SoftCoders-header-footer-elementor'),
					'none'   => __('None', 'SoftCoders-header-footer-elementor'),
				],
				'condition' => [
					'layout'  => [ 'horizontal' ],
					'pointer' => 'text',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'main_boreer',
				'selector' => '{{WRAPPER}} nav > .sce-nav-menu > li',
			]
		);

        $this->add_responsive_control(
			'content_padding',
			[
				'label'              => __( 'Content Padding', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .nav > .sce-nav-menu > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'style_divider',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'menu_typography',
				'global'    => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} a.sce-menu-item, {{WRAPPER}} a.sce-sub-menu-item',
			]
		);

		$this->start_controls_tabs( 'tabs_menu_item_style' );

				$this->start_controls_tab(
					'tab_menu_item_normal',
					[
						'label' => __( 'Normal', 'SoftCoders-header-footer-elementor' ),
					]
				);

				$this->add_control(
					'color_menu_item',
					[
						'label'     => __( 'Text Color', 'SoftCoders-header-footer-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'global'    => [
							'default' => Global_Colors::COLOR_TEXT,
						],
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .menu-item a.sce-menu-item' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'bg_color_menu_item',
					[
						'label'     => __( 'Background Color', 'SoftCoders-header-footer-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .menu-item a.sce-menu-item' => 'background-color: {{VALUE}}',
						],
						'condition' => [
							'layout!' => 'flyout',
						],
					]
				);

				$this->add_control(
					'color_menu_item_sticky',
					[
						'label'     => __( 'Text Sticky Color', 'SoftCoders-header-footer-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'global'    => [
							'default' => Global_Colors::COLOR_TEXT,
						],
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .sticky .menu-item a.sce-menu-item' => 'color: {{VALUE}}',
						],
					]
				);
				

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_menu_item_hover',
					[
						'label' => __( 'Hover', 'SoftCoders-header-footer-elementor' ),
					]
				);

					$this->add_control(
						'color_menu_item_hover',
						[
							'label'     => __( 'Text Color', 'SoftCoders-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'global'    => [
								'default' => Global_Colors::COLOR_ACCENT,
							],
							'selectors' => [
								'{{WRAPPER}} .menu-item a.sce-menu-item:hover,
								{{WRAPPER}} .menu-item a.sce-menu-item:hover i,
								{{WRAPPER}} .sub-menu a.sce-sub-menu-item:hover i,
								{{WRAPPER}} .menu-item a.sce-menu-item.highlighted,
								{{WRAPPER}} .menu-item a.sce-menu-item:focus' => 'color: {{VALUE}};',
                        		'{{WRAPPER}} .sce-nav-menu li.menu-item-has-children .sub-menu::before, {{WRAPPER}} .sce-nav-menu li.menu-item-has-children:hover ul.sub-menu li a.sce-sub-menu-item::before' => 'background:{{VALUE}} !important ;',
							],
						]
					);

					$this->add_control(
						'bg_color_menu_item_hover',
						[
							'label'     => __( 'Background Color', 'SoftCoders-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .menu-item a.sce-menu-item:hover,
								{{WRAPPER}} .menu-item.current-menu-item a.sce-menu-item,
								{{WRAPPER}} .menu-item a.sce-menu-item.highlighted,
								{{WRAPPER}} .menu-item a.sce-menu-item:focus' => 'background-color: {{VALUE}}',
							],
							'condition' => [
								'layout!' => 'flyout',
							],
						]
					);

					$this->add_control(
						'pointer_color_menu_item_hover',
						[
							'label'     => __( 'Link Hover Effect Color', 'SoftCoders-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'global'    => [
								'default' => Global_Colors::COLOR_ACCENT,
							],
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .sce-nav-menu-layout:not(.sce-pointer__framed) .menu-item.parent a.sce-menu-item:before,
								{{WRAPPER}} .sce-nav-menu-layout:not(.sce-pointer__framed) .menu-item.parent a.sce-menu-item:after' => 'background-color: {{VALUE}}',
								'{{WRAPPER}} .sce-nav-menu-layout:not(.sce-pointer__framed) .menu-item.parent .sub-menu .sce-has-submenu-container a:after' => 'background-color: unset',
								'{{WRAPPER}} .sce-pointer__framed .menu-item.parent a.sce-menu-item:before,
								{{WRAPPER}} .sce-pointer__framed .menu-item.parent a.sce-menu-item:after' => 'border-color: {{VALUE}}',
							],
							'condition' => [
								'pointer!' => [ 'none', 'text' ],
								'layout!'  => 'flyout',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_menu_item_active',
					[
						'label' => __( 'Active', 'SoftCoders-header-footer-elementor' ),
					]
				);

					$this->add_control(
						'color_menu_item_active',
						[
							'label'     => __( 'Text Color', 'SoftCoders-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item.current-menu-item a.sce-menu-item,
								{{WRAPPER}} .menu-item.current-menu-ancestor a.sce-menu-item, {{WRAPPER}} .menu-item.current-menu-ancestor a.sce-menu-item i' => 'color: {{VALUE}}
								',
							],
						]
					);

					$this->add_control(
						'bg_color_menu_item_active',
						[
							'label'     => __( 'Background Color', 'SoftCoders-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item.current-menu-item a.sce-menu-item,
								{{WRAPPER}} .menu-item.current-menu-ancestor a.sce-menu-item' => 'background-color: {{VALUE}}',
							],
							'condition' => [
								'layout!' => 'flyout',
							],
						]
					);

					$this->add_control(
						'pointer_color_menu_item_active',
						[
							'label'     => __( 'Link Hover Effect Color', 'SoftCoders-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .sce-nav-menu-layout:not(.sce-pointer__framed) .menu-item.parent.current-menu-item a.sce-menu-item:before,
								{{WRAPPER}} .sce-nav-menu-layout:not(.sce-pointer__framed) .menu-item.parent.current-menu-item a.sce-menu-item:after' => 'background-color: {{VALUE}}',
								'{{WRAPPER}} .sce-nav-menu:not(.sce-pointer__framed) .menu-item.parent .sub-menu .sce-has-submenu-container a.current-menu-item:after' => 'background-color: unset',
								'{{WRAPPER}} .sce-pointer__framed .menu-item.parent.current-menu-item a.sce-menu-item:before,
								{{WRAPPER}} .sce-pointer__framed .menu-item.parent.current-menu-item a.sce-menu-item:after' => 'border-color: {{VALUE}}',
							],
							'condition' => [
								'pointer!' => [ 'none', 'text' ],
								'layout!'  => 'flyout',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_dropdown_content_controls() {

		$this->start_controls_section(
			'section_style_dropdown',
			[
				'label' => __( 'Dropdown', 'SoftCoders-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'dropdown_description',
				[
					'raw'             => __( '<b>Note:</b> On desktop, below style options will apply to the submenu. On mobile, this will apply to the entire menu.', 'SoftCoders-header-footer-elementor' ),
					'type'            => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-descriptor',
					'condition'       => [
						'layout!' => [
							'expandible',
							'flyout',
						],
					],
				]
			);

			$this->add_responsive_control(
			'padding_vertical_dropdown_item_padding',
				[
					'label'              => __( 'Area Padding', 'SoftCoders-header-footer-elementor' ),
					'type'               => Controls_Manager::DIMENSIONS,
					'size_units'         => [ 'px', 'em', '%' ],
					'selectors'          => [
						'{{WRAPPER}} .sce-nav-menu .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
			'margin_vertical_dropdown_item_padding',
				[
					'label'              => __( 'Area Margin', 'SoftCoders-header-footer-elementor' ),
					'type'               => Controls_Manager::DIMENSIONS,
					'size_units'         => [ 'px', 'em', '%' ],
					'selectors'          => [
						'{{WRAPPER}} .sce-nav-menu .sub-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			

			$this->start_controls_tabs( 'tabs_dropdown_item_style' );

				$this->start_controls_tab(
					'tab_dropdown_item_normal',
					[
						'label' => __( 'Normal', 'SoftCoders-header-footer-elementor' ),
					]
				);

					$this->add_control(
						'color_dropdown_item',
						[
							'label'     => __( 'Text Color', 'SoftCoders-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .sub-menu a.sce-sub-menu-item, 
								{{WRAPPER}} .elementor-menu-toggle,
								{{WRAPPER}} nav.sce-dropdown li a.sce-menu-item,
								{{WRAPPER}} nav.sce-dropdown li a.sce-sub-menu-item,
								{{WRAPPER}} nav.sce-dropdown-expandible li a.sce-menu-item,
								{{WRAPPER}} nav.sce-dropdown-expandible li a.sce-sub-menu-item' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'background_color_dropdown_item',
						[
							'label'     => __( 'Background Color', 'SoftCoders-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#fff',
							'selectors' => [
								'{{WRAPPER}} .sub-menu,
								{{WRAPPER}} nav.sce-dropdown,
								{{WRAPPER}} nav.sce-dropdown-expandible,
								{{WRAPPER}} nav.sce-dropdown .menu-item a.sce-menu-item,
								{{WRAPPER}} nav.sce-dropdown .menu-item a.sce-sub-menu-item' => 'background-color: {{VALUE}}',
							],
							'separator' => 'after',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_dropdown_item_hover',
					[
						'label' => __( 'Hover', 'SoftCoders-header-footer-elementor' ),
					]
				);

					$this->add_control(
						'color_dropdown_item_hover',
						[
							'label'     => __( 'Text Color', 'SoftCoders-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .sub-menu a.sce-sub-menu-item:hover, 
								{{WRAPPER}} .elementor-menu-toggle:hover,
								{{WRAPPER}} nav.sce-dropdown li a.sce-menu-item:hover,
								{{WRAPPER}} nav.sce-dropdown li a.sce-sub-menu-item:hover,
								{{WRAPPER}} nav.sce-dropdown-expandible li a.sce-menu-item:hover,
								{{WRAPPER}} nav.sce-dropdown-expandible li a.sce-sub-menu-item:hover' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'background_color_dropdown_item_hover',
						[
							'label'     => __( 'Background Color', 'SoftCoders-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .sub-menu a.sce-sub-menu-item:hover,
								{{WRAPPER}} nav.sce-dropdown li a.sce-menu-item:hover,
								{{WRAPPER}} nav.sce-dropdown li a.sce-sub-menu-item:hover,
								{{WRAPPER}} nav.sce-dropdown-expandible li a.sce-menu-item:hover,
								{{WRAPPER}} nav.sce-dropdown-expandible li a.sce-sub-menu-item:hover' => 'background-color: {{VALUE}}',
							],
							'separator' => 'after',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_dropdown_item_active',
					[
						'label' => __( 'Active', 'SoftCoders-header-footer-elementor' ),
					]
				);

				$this->add_control(
					'color_dropdown_item_active',
					[
						'label'     => __( 'Text Color', 'SoftCoders-header-footer-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .sub-menu .menu-item.current-menu-item a.sce-sub-menu-item.sce-sub-menu-item-active,	
							{{WRAPPER}} nav.sce-dropdown .menu-item.current-menu-item a.sce-menu-item,
							{{WRAPPER}} nav.sce-dropdown .menu-item.current-menu-ancestor a.sce-menu-item,
							{{WRAPPER}} nav.sce-dropdown .sub-menu .menu-item.current-menu-item a.sce-sub-menu-item.sce-sub-menu-item-active
							' => 'color: {{VALUE}}',

						],
					]
				);

				$this->add_control(
					'background_color_dropdown_item_active',
					[
						'label'     => __( 'Background Color', 'SoftCoders-header-footer-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .sub-menu .menu-item.current-menu-item a.sce-sub-menu-item.sce-sub-menu-item-active,	
							{{WRAPPER}} nav.sce-dropdown .menu-item.current-menu-item a.sce-menu-item,
							{{WRAPPER}} nav.sce-dropdown .menu-item.current-menu-ancestor a.sce-menu-item,
							{{WRAPPER}} nav.sce-dropdown .sub-menu .menu-item.current-menu-item a.sce-sub-menu-item.sce-sub-menu-item-active' => 'background-color: {{VALUE}}',
						],
						'separator' => 'after',
					]
				);

				$this->end_controls_tabs();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'dropdown_typography',
					'global'    => [
						'default' => Global_Typography::TYPOGRAPHY_ACCENT,
					],
					'separator' => 'before',
					'selector'  => '
							{{WRAPPER}} .sub-menu li a.sce-sub-menu-item,
							{{WRAPPER}} nav.sce-dropdown li a.sce-sub-menu-item,
							{{WRAPPER}} nav.sce-dropdown li a.sce-menu-item,
							{{WRAPPER}} nav.sce-dropdown-expandible li a.sce-menu-item,
							{{WRAPPER}} nav.sce-dropdown-expandible li a.sce-sub-menu-item',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'dropdown_border',
					'selector' => '{{WRAPPER}} nav.sce-nav-menu__layout-horizontal .sub-menu, 
							{{WRAPPER}} nav:not(.sce-nav-menu__layout-horizontal) .sub-menu.sub-menu-open,
							{{WRAPPER}} nav.sce-dropdown .sce-nav-menu,
						 	{{WRAPPER}} nav.sce-dropdown-expandible .sce-nav-menu',
				]
			);

			$this->add_responsive_control(
				'dropdown_border_radius',
				[
					'label'              => __( 'Border Radius', 'SoftCoders-header-footer-elementor' ),
					'type'               => Controls_Manager::DIMENSIONS,
					'size_units'         => [ 'px', '%' ],
					'selectors'          => [
						'{{WRAPPER}} .sub-menu'        => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .sub-menu li.menu-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};;',
						'{{WRAPPER}} .sub-menu li.menu-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} nav.sce-dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} nav.sce-dropdown li.menu-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};',
						'{{WRAPPER}} nav.sce-dropdown li.menu-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} nav.sce-dropdown-expandible' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} nav.sce-dropdown-expandible li.menu-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};',
						'{{WRAPPER}} nav.sce-dropdown-expandible li.menu-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'      => 'dropdown_box_shadow',
					'exclude'   => [
						'box_shadow_position',
					],
					'selector'  => '{{WRAPPER}} .sce-nav-menu .sub-menu,
								{{WRAPPER}} nav.sce-dropdown,
						 		{{WRAPPER}} nav.sce-dropdown-expandible',
					'separator' => 'after',
				]
			);

			$this->add_responsive_control(
				'width_dropdown_item',
				[
					'label'              => __( 'Dropdown Width (px)', 'SoftCoders-header-footer-elementor' ),
					'type'               => Controls_Manager::SLIDER,
					'range'              => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
					],
					'default'            => [
						'size' => '220',
						'unit' => 'px',
					],
					'selectors'          => [
						'{{WRAPPER}} ul.sub-menu' => 'width: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'horizontal',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_horizontal_dropdown_item',
				[
					'label'              => __( 'Horizontal Padding', 'SoftCoders-header-footer-elementor' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'selectors'          => [
						'{{WRAPPER}} .sub-menu li a.sce-sub-menu-item,
						{{WRAPPER}} nav.sce-dropdown li a.sce-menu-item,
						{{WRAPPER}} nav.sce-dropdown-expandible li a.sce-menu-item' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} nav.sce-dropdown-expandible a.sce-sub-menu-item,
						{{WRAPPER}} nav.sce-dropdown li a.sce-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 20px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .sce-dropdown .menu-item ul ul a.sce-sub-menu-item,
						{{WRAPPER}} .sce-dropdown-expandible .menu-item ul ul a.sce-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 40px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .sce-dropdown .menu-item ul ul ul a.sce-sub-menu-item,
						{{WRAPPER}} .sce-dropdown-expandible .menu-item ul ul ul a.sce-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 60px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .sce-dropdown .menu-item ul ul ul ul a.sce-sub-menu-item,
						{{WRAPPER}} .sce-dropdown-expandible .menu-item ul ul ul ul a.sce-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 80px );padding-right: {{SIZE}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_vertical_dropdown_item',
				[
					'label'              => __( 'Vertical Padding', 'SoftCoders-header-footer-elementor' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'default'            => [
						'size' => 15,
						'unit' => 'px',
					],
					'range'              => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors'          => [
						'{{WRAPPER}} .sub-menu a.sce-sub-menu-item,
						 {{WRAPPER}} nav.sce-dropdown li a.sce-menu-item,
						 {{WRAPPER}} nav.sce-dropdown li a.sce-sub-menu-item,
						 {{WRAPPER}} nav.sce-dropdown-expandible li a.sce-menu-item,
						 {{WRAPPER}} nav.sce-dropdown-expandible li a.sce-sub-menu-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'distance_from_menu',
				[
					'label'              => __( 'Top Distance', 'SoftCoders-header-footer-elementor' ),
					'type'               => Controls_Manager::SLIDER,
					'range'              => [
						'px' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'selectors'          => [
						'{{WRAPPER}} nav.sce-nav-menu__layout-horizontal:not(.sce-dropdown) ul.sub-menu, {{WRAPPER}} nav.sce-nav-menu__layout-expandible.menu-is-active, {{WRAPPER}} nav.sce-nav-menu__layout-vertical:not(.sce-dropdown) ul.sub-menu' => 'margin-top: {{SIZE}}px;',
						'{{WRAPPER}} .sce-dropdown.menu-is-active' => 'margin-top: {{SIZE}}px;',
					],
					'condition'          => [
						'layout' => [ 'horizontal', 'vertical', 'expandible' ],
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'distance_from_third_menu',
				[
					'label'              => __( 'Top Distance Third Menu', 'SoftCoders-header-footer-elementor' ),
					'type'               => Controls_Manager::SLIDER,
					'range'              => [
						'px' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'selectors'          => [
						'{{WRAPPER}} nav.sce-nav-menu__layout-horizontal:not(.sce-dropdown) ul.sub-menu ul.sub-menu, {{WRAPPER}} nav.sce-nav-menu__layout-vertical:not(.sce-dropdown) ul.sub-menu ul.sub-menu' => 'margin-top: {{SIZE}}px;',
						'{{WRAPPER}} .sce-dropdown.menu-is-active' => 'margin-top: {{SIZE}}px;',
					],
					'condition'          => [
						'layout' => [ 'horizontal', 'vertical', 'expandible' ],
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'heading_dropdown_divider',
				[
					'label'     => __( 'Divider', 'SoftCoders-header-footer-elementor' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'dropdown_divider_border',
				[
					'label'       => __( 'Border Style', 'SoftCoders-header-footer-elementor' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'solid',
					'label_block' => false,
					'options'     => [
						'none'   => __( 'None', 'SoftCoders-header-footer-elementor' ),
						'solid'  => __( 'Solid', 'SoftCoders-header-footer-elementor' ),
						'double' => __( 'Double', 'SoftCoders-header-footer-elementor' ),
						'dotted' => __( 'Dotted', 'SoftCoders-header-footer-elementor' ),
						'dashed' => __( 'Dashed', 'SoftCoders-header-footer-elementor' ),
					],
					'selectors'   => [
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.sce-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.sce-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-style: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'divider_border_color',
				[
					'label'     => __( 'Border Color', 'SoftCoders-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#c4c4c4',
					'selectors' => [
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.sce-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.sce-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-color: {{VALUE}};',
					],
					'condition' => [
						'dropdown_divider_border!' => 'none',
					],
				]
			);

			$this->add_control(
				'dropdown_divider_width',
				[
					'label'     => __( 'Border Width', 'SoftCoders-header-footer-elementor' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'max' => 50,
						],
					],
					'default'   => [
						'size' => '1',
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.sce-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.sce-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'dropdown_divider_border!' => 'none',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_toggle',
			[
				'label' => __( 'Menu Trigger & Close Icon', 'SoftCoders-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'toggle_style_normal',
			[
				'label' => __( 'Normal', 'SoftCoders-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'toggle_color',
			[
				'label'     => __( 'Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} div.sce-nav-menu-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} div.sce-nav-menu-icon svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} div.sce-nav-menu-icon svg rect' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_background_color',
			[
				'label'     => __( 'Background Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sce-nav-menu-icon' => 'background-color: {{VALUE}}; padding: 0.35em;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggle_hover',
			[
				'label' => __( 'Hover', 'SoftCoders-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'toggle_hover_color',
			[
				'label'     => __( 'Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} div.sce-nav-menu-icon:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} div.sce-nav-menu-icon:hover svg' => 'fill: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'toggle_hover_background_color',
			[
				'label'     => __( 'Background Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sce-nav-menu-icon:hover' => 'background-color: {{VALUE}}; padding: 0.35em;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'toggle_size',
			[
				'label'              => __( 'Icon Size', 'SoftCoders-header-footer-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'min' => 15,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .sce-nav-menu-icon'     => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .sce-nav-menu-icon svg' => 'font-size: {{SIZE}}px;line-height: {{SIZE}}px;height: {{SIZE}}px;width: {{SIZE}}px;',
				],
				'frontend_available' => true,
				'separator'          => 'before',
			]
		);

		$this->add_responsive_control(
			'toggle_border_width',
			[
				'label'              => __( 'Border Width', 'SoftCoders-header-footer-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'max' => 10,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .sce-nav-menu-icon' => 'border-width: {{SIZE}}{{UNIT}}; padding: 0.35em;',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'toggle_border_radius',
			[
				'label'              => __( 'Border Radius', 'SoftCoders-header-footer-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => [ 'px', '%' ],
				'selectors'          => [
					'{{WRAPPER}} .sce-nav-menu-icon' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'close_color_flyout',
			[
				'label'     => __( 'Close Icon Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#7A7A7A',
				'selectors' => [
					'{{WRAPPER}} .sce-flyout-close'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .sce-flyout-close svg' => 'fill: {{VALUE}}',

				],
				'condition' => [
					'layout' => 'flyout',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'close_flyout_size',
			[
				'label'              => __( 'Close Icon Size', 'SoftCoders-header-footer-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'min' => 15,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .sce-flyout-close,
					{{WRAPPER}} .sce-flyout-close svg' => 'height: {{SIZE}}px; width: {{SIZE}}px; font-size: {{SIZE}}px; line-height: {{SIZE}}px;',
				],
				'condition'          => [
					'layout' => 'flyout',
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_button',
			[
				'label'     => __( 'Button', 'SoftCoders-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'menu_last_item' => 'cta',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'all_typography',
				'label'    => __( 'Typography', 'SoftCoders-header-footer-elementor' ),
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .menu-item a.sce-menu-item.elementor-button',
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label'              => __( 'Padding', 'SoftCoders-header-footer-elementor' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', 'em', '%' ],
				'selectors'          => [
					'{{WRAPPER}} .menu-item a.sce-menu-item.elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'frontend_available' => true,
			]
		);

		$this->start_controls_tabs( '_button_style' );
			$this->start_controls_tab(
				'_button_normal',
				[
					'label' => __( 'Normal', 'SoftCoders-header-footer-elementor' ),
				]
			);
			$this->add_control(
				'all_text_color',
				[
					'label'     => __( 'Text Color', 'SoftCoders-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .menu-item a.sce-menu-item.elementor-button' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'           => 'all_background_color',
					'label'          => __( 'Background Color', 'SoftCoders-header-footer-elementor' ),
					'types'          => [ 'classic', 'gradient' ],
					'selector'       => '{{WRAPPER}} .menu-item a.sce-menu-item.elementor-button',
					'fields_options' => [
						'color' => [
							'global' => [
								'default' => Global_Colors::COLOR_ACCENT,
							],
						],
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'all_border',
					'label'    => __( 'Border', 'SoftCoders-header-footer-elementor' ),
					'selector' => '{{WRAPPER}} .menu-item a.sce-menu-item.elementor-button',
				]
			);
			$this->add_control(
				'all_border_radius',
				[
					'label'      => __( 'Border Radius', 'SoftCoders-header-footer-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .menu-item a.sce-menu-item.elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'all_button_box_shadow',
					'selector' => '{{WRAPPER}} .menu-item a.sce-menu-item.elementor-button',
				]
			);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'all_button_hover',
				[
					'label' => __( 'Hover', 'SoftCoders-header-footer-elementor' ),
				]
			);
			$this->add_control(
				'all_hover_color',
				[
					'label'     => __( 'Text Color', 'SoftCoders-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .menu-item a.sce-menu-item.elementor-button:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'           => 'all_background_hover_color',
					'label'          => __( 'Background Color', 'SoftCoders-header-footer-elementor' ),
					'types'          => [ 'classic', 'gradient' ],
					'selector'       => '{{WRAPPER}} .menu-item a.sce-menu-item.elementor-button:hover',
					'fields_options' => [
						'color' => [
							'global' => [
								'default' => Global_Colors::COLOR_ACCENT,
							],
						],
					],
				]
			);
			$this->add_control(
				'all_border_hover_color',
				[
					'label'     => __( 'Border Hover Color', 'SoftCoders-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .menu-item a.sce-menu-item.elementor-button:hover' => 'border-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'      => 'all_button_hover_box_shadow',
					'selector'  => '{{WRAPPER}} .menu-item a.sce-menu-item.elementor-button:hover',
					'separator' => 'after',
				]
			);

			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'mobile_menu_style',
			[
				'label' => __( 'Mobile Dropdown Style', 'SoftCoders-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
				'mobile_text_color',
				[
					'label'     => __( 'Text Color', 'SoftCoders-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} nav.sce-dropdown.menu-is-active li a.sce-menu-item' => 'color: {{VALUE}} !important;',
					],
				]
			);
		$this->add_control(
			'mobile_text_color_bg',
			[
				'label'     => __( 'Background Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} nav.sce-dropdown.menu-is-active li a' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} nav.sce-dropdown.menu-is-active' => 'background-color: {{VALUE}} !important;',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Add itemprop for Navigation Schema.
	 *
	 */
	public function handle_link_attrs( $atts ) {

		$atts .= ' itemprop="url"';
		return $atts;
	}

	/**
	 * Add itemprop to the li tag of Navigation Schema.
	 *
	 */
	public function handle_li_values( $value ) {

		$value .= ' itemprop="name"';
		return $value;
	}

	/**
	 * Get the menu and close icon HTML.
	 */
	public function get_menu_close_icon( $settings ) {
		$menu_icon     = '';
		$close_icon    = '';
		$icons         = [];
		$icon_settings = [
			$settings['dropdown_icon'],
			$settings['dropdown_close_icon'],
		];
		foreach ( $icon_settings as $icon ) {
			if ( $this->is_elementor_updated() ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon(
					$icon,
					[
						'aria-hidden' => 'true',
						'tabindex'    => '0',
					]
				);
				$menu_icon = ob_get_clean();
			} else {
				$menu_icon = '<i class="' . esc_attr( $icon ) . '" aria-hidden="true" tabindex="0"></i>';
			}
			array_push( $icons, $menu_icon );
		}

		return $icons;
	}

	/**
	 * Render Nav Menu output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render() {

		$menus = $this->get_available_menus();

		if ( empty( $menus ) ) {
			return false;
		}

		$settings = $this->get_settings_for_display();
		$menu_close_icons = [];
		$menu_close_icons = $this->get_menu_close_icon( $settings );

		$args = [
			'echo'        => false,
			'menu'        => $settings['menu'],
			'menu_class'  => 'sce-nav-menu',
			'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
			'fallback_cb' => '__return_empty_string',
			'container'   => '',
			'walker'      => new Menu_Walker()
		];



		$menu_html = wp_nav_menu( $args );

		if ( 'flyout' === $settings['layout'] ) {

			$this->add_render_attribute( 'sce-flyout', 'class', 'sce-flyout-wrapper' );
			if ( 'cta' === $settings['menu_last_item'] ) {

				$this->add_render_attribute( 'sce-flyout', 'data-last-item', $settings['menu_last_item'] );
			}

			?>
			<div class="sce-nav-menu__toggle elementor-clickable sce-flyout-trigger" tabindex="0">
				<div class="sce-nav-menu-icon">
					<?php echo isset( $menu_close_icons[0] ) ? $menu_close_icons[0] : ''; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> 
				</div>
			</div>
			<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'sce-flyout' ) ); ?> >
				<div class="sce-flyout-overlay elementor-clickable"></div>
				<div class="sce-flyout-container">
					<div id="sce-flyout-content-id-<?php echo esc_attr( $this->get_id() ); ?>" class="sce-side sce-flyout-<?php echo esc_attr( $settings['flyout_layout'] ); ?> sce-flyout-open" data-layout="<?php echo wp_kses_post( $settings['flyout_layout'] ); ?>" data-flyout-type="<?php echo wp_kses_post( $settings['flyout_type'] ); ?>">
						<div class="sce-flyout-content push">						
							<nav <?php echo wp_kses_post( $this->get_render_attribute_string( 'sce-nav-menu' ) ); ?>><?php echo $menu_html; ?></nav>
							<div class="elementor-clickable sce-flyout-close" tabindex="0">
								<?php echo isset( $menu_close_icons[1] ) ? $menu_close_icons[1] : ''; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
						</div>
					</div>
				</div>
			</div>				
			<?php
		} else {
			$this->add_render_attribute(
				'sce-main-menu',
				'class',
				[
					'sce-nav-menu',
					'sce-layout-' . $settings['layout'],
				]
			);
			$this->add_render_attribute( 'sce-main-menu', 'class', 'sce-nav-menu-layout' );
			$this->add_render_attribute( 'sce-main-menu', 'class', $settings['layout'] );
			$this->add_render_attribute( 'sce-main-menu', 'data-layout', $settings['layout'] );
			if ( 'cta' === $settings['menu_last_item'] ) {

				$this->add_render_attribute( 'sce-main-menu', 'data-last-item', $settings['menu_last_item'] );
			}
			if ( $settings['pointer'] ) {
				if ( 'horizontal' === $settings['layout'] || 'vertical' === $settings['layout'] ) {
					$this->add_render_attribute( 'sce-main-menu', 'class', 'sce-pointer__' . $settings['pointer'] );

					if ( in_array( $settings['pointer'], [ 'double-line', 'underline', 'overline' ], true ) ) {
						$key = 'animation_line';
						$this->add_render_attribute( 'sce-main-menu', 'class', 'sce-animation__' . $settings[ $key ] );
					} elseif ( 'framed' === $settings['pointer'] || 'text' === $settings['pointer'] ) {
						$key = 'animation_' . $settings['pointer'];
						$this->add_render_attribute( 'sce-main-menu', 'class', 'sce-animation__' . $settings[ $key ] );
					}
				}
			}
			if ( 'expandible' === $settings['layout'] ) {
				$this->add_render_attribute( 'sce-nav-menu', 'class', 'sce-dropdown-expandible' );
			}
			$this->add_render_attribute(
				'sce-nav-menu',
				'class',
				[
					'sce-nav-menu__layout-' . $settings['layout'],
					'sce-nav-menu__submenu-' . $settings['submenu_icon'],
				]
			);

			$this->add_render_attribute( 'sce-nav-menu', 'data-toggle-icon', $menu_close_icons[0] );
			$this->add_render_attribute( 'sce-nav-menu', 'data-close-icon', $menu_close_icons[1] );
			$this->add_render_attribute( 'sce-nav-menu', 'data-full-width', $settings['full_width_dropdown'] );
			$this->add_render_attribute( 'sce-nav-menu', 'class', $settings['separator_dots'] );
			$this->add_render_attribute( 'sce-nav-menu', 'class', $settings['position_header'] );
			?>
			<div <?php echo $this->get_render_attribute_string( 'sce-main-menu' ); ?> >
				<div class="sce-nav-menu__toggle elementor-clickable ">
					<div class="sce-nav-menu-icon">
						<?php echo isset( $menu_close_icons[0] ) ? $menu_close_icons[0] : ''; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				</div>
				<nav <?php echo $this->get_render_attribute_string( 'sce-nav-menu' ); ?>><?php echo $menu_html; ?>
					<?php if ( 'yes' === $settings['mobile_menu_btn_show_hide'] ){ ?>
					<ul class="spria-mobile-menu nav-buttons">
				
						<?php if ( $settings['btn1'] ){ ?>	
						<li class="hash-has-sub">
							<a href="<?php echo wp_kses_post( $settings['btn_link1'] ); ?>" class="bg-blue-btn hash">
								<span class="btn-inner">
									<span class="btn-normal-text"><?php echo wp_kses_post( $settings['btn1'] ); ?></span>
									<span class="btn-hover-text"><?php echo wp_kses_post( $settings['btn1'] ); ?></span>
								</span>
							</a>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
				</nav>              
			</div>
			<?php
		}
	}
}