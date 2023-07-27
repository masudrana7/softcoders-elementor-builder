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

class TeamGrid extends Widget_Base {
	public function get_name() {
		return 'team-grid';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Softcoders Team Grid', 'SoftCoders-header-footer-elementor' );
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
            'team_member_list',
            [
                'label' => __('Team Member List', 'scaddon'),
            ]
        );
        $this->add_control(
			'team_grid_style',
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

		$this->start_controls_section(
			'section_general_fields',
			[
				'label' => __( 'General Settings', 'SoftCoders-header-footer-elementor' ),
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
			'section_title_style',
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
                    '{{WRAPPER}} .sc-team-slider .sc-slider-item .sc-slider-text .title:hover' => 'color: {{VALUE}};',
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
				'selector' => '',
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'section_degination_style',
			[
				'label' => esc_html__( 'Degination Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


        $this->add_control(
            'span_color',
            [
                'label' => esc_html__( 'Degination Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-slider-text span, {{WRAPPER}} .sc-team-content span' => 'color: {{VALUE}};',

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
        $this->add_responsive_control(
			'designation_margin',
			[
				'label'              => __( 'Designation Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-slider-text span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 
                    {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'section_email_style',
			[
				'label' => esc_html__( 'E-mail Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                	'team_grid_style' => 'style2',
                ],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'email_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .sc-team-slider .sc-slider-btn .sc-white-btn-two',
			]
		);        
        $this->add_control(
			'email_color',
			[
				'label'     => __( 'Email Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-team-slider .sc-slider-btn .sc-white-btn-two' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .sc-team-slider:hover .sc-slider-btn .sc-white-btn-two' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .sc-team-slider .sc-slider-btn .sc-white-btn-two:after' => 'background: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'email_bg_hover_color',
			[
				'label'     => __( 'Email Hover Background Color', 'SoftCoders-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sc-team-slider:hover .sc-slider-item .sc-white-btn-two:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .sc-team-slider:hover .sc-slider-btn .sc-white-btn-two:before' => 'background-color: {{VALUE}};',
				],
			]
		);
        $this->add_control(
            'email_border_radius',
            [
                'label' => esc_html__('E-mail Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sc-team-slider .sc-slider-btn .sc-white-btn-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_responsive_control(
			'email_padding',
			[
				'label'              => __( 'E-mail Padding', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-team-slider .sc-slider-btn .sc-white-btn-two' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 
                    {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadowbt',
				'label' => esc_html__( 'Box Shadow', 'SoftCoders-header-footer-elementor' ),
				'selector' => '{{WRAPPER}} .sc-team-slider .sc-slider-btn .sc-white-btn-two',

			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'border_image_style',
			[
				'label' => esc_html__( 'Image Border', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
        $this->add_responsive_control(
			'image_margin',
			[
				'label'              => __( 'Image Area Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-team-slider .sc-slider-item img' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 
                    {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'section_social_style',
			[
				'label' => esc_html__( 'Social Icon Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                	'team_grid_style' => 'style1',
                ],
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
			'section_global_style',
			[
				'label' => esc_html__( 'Global Style', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		); 
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'SoftCoders-header-footer-elementor' ),
				'selector' => '{{WRAPPER}} .sc-team-slider .sc-slider-btn .sc-white-btn-two',
				'selector' => '{{WRAPPER}} .elementor-widget-wrap',
                
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
			'content_padding7',
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

        $this->add_responsive_control(
			'content_margin',
			[
				'label'              => __( 'Area Margin', 'staco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .sc-team-content-area .sc-team-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 
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
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow22',
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
			'content_padding',
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
        ?>

            <?php if ('style1' == $settings['team_grid_style']) {  ?> 
            <div class="row">
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

                
                 <div class="col-lg-<?php echo esc_html($settings['grid_columns']); ?> col-md-<?php echo esc_html($settings['md_columns']); ?> col-sm-<?php echo esc_html($settings['sm_columns']); ?>">
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
                <?php } ?>
                </div>
                <?php } ?>

                <?php if ('style2' == $settings['team_grid_style']) {  ?> 
                    <div class="sc-team-content-area">
                         <div class="sc-team-slider-area">
                            <div class="row">
                            <?php foreach ($settings["items1"] as $item) {
                            $name = $item["name"];
                            $link = $item["team_single_link"];
                            $designation = $item["designation"];
                            $button_email = $item["button_email"];
                            $image = wp_get_attachment_image_url($item["image"]["id"], 'full');?>	
                                <div class="col-lg-<?php echo esc_html($settings['grid_columns']); ?> col-md-<?php echo esc_html($settings['md_columns']); ?> col-sm-<?php echo esc_html($settings['sm_columns']); ?>">

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
                                            <div class="sc-slider-btn text-center">    
                                                <?php if (!empty($button_email)) { ?>                          
                                                <a class="sc-white-btn-two" href="mailto:<?php echo $button_email; ?>"
                                                    ><?php echo $button_email; ?></a
                                                >
                                                <?php } ?>
                                            </div>
                                    </div>
                            </div>
                                
                            <?php }  ?>
                        </div>
                    </div>
                </div>
                <?php }  ?>
		<?php
	}
		/**
		 * Render site title output in the editor.
		 */
	
}