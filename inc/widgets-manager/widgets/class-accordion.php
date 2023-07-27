<?php
/**
 * Accordion class
 *
 */

namespace softcoderselements\WidgetsManager\Widgets;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\render_icon;
use Elementor\Icons_Manager;
use Elementor\is_migration_allowed;
use Elementor\Global_Colors;
use Elementor\Global_Typography;
use Elementor\Widget_Base;



defined( 'ABSPATH' ) || die();

class Accordion extends Widget_Base {
    /**
     * Get widget name.
     *
     * Retrieve scgallery widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'accordion';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return esc_html__( 'Accordion', 'SoftCoders-header-footer-elementor' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-elementor-circle';
    }


    protected function register_controls() {       

        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__( 'Accordion Item', 'SoftCoders-header-footer-elementor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();  


        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Title', 'SoftCoders-header-footer-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'SoftCoders-header-footer-elementor'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Name', 'SoftCoders-header-footer-elementor' ),
                'separator'   => 'before',
            ]
        );       

        $repeater->add_control(
            'description',
            [
                'label' => __( 'Content', 'elementor' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Accordion Content', 'elementor' ),
                'show_label' => false,
            ]
        );  
        $repeater->add_control(
            'selected_image',
            [
                'label'       => esc_html__( 'Icon image', 'SoftCoders-header-footer-elementor' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $repeater->add_responsive_control(
            'accordion_open_closed',
            [
                'label' => esc_html__( 'Accordion Open/Closed?', 'SoftCoders-header-footer-elementor' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'SoftCoders-header-footer-elementor' ),
                'label_off' => esc_html__( 'Hide', 'SoftCoders-header-footer-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );   
        $this->add_control(
            'accordion_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                ]
            ]
        );
        $this->add_control(
            'accord_style',
            [
                'label'   => esc_html__( 'Select Accordion Style', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [                  
                    'style1' => esc_html__( 'Style 1', 'SoftCoders-header-footer-elementor'),
                    'style2' => esc_html__( 'Style 2', 'SoftCoders-header-footer-elementor'),
                ],
            ]
        );
        $this->add_control(
            'selected_active_icon',
            [
                'label' => __( 'Icon', 'elementor' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon_active',
                'default' => [
                    'value' => 'fas fa-minus',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'chevron-up',
                        'angle-up',
                        'angle-double-up',
                        'caret-up',
                        'caret-square-up',
                    ],
                    'fa-regular' => [
                        'caret-square-up',
                    ],
                ],
                'skin' => 'inline',
                'label_block' => false,
            ]
        );
        $this->add_control(
            'selected_icon',
            [
                'label' => __( 'Active Icon', 'elementor' ),
                'type' => Controls_Manager::ICONS,
                'separator' => 'before',
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-plus',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'chevron-down',
                        'angle-down',
                        'angle-double-down',
                        'caret-down',
                        'caret-square-down',
                    ],
                    'fa-regular' => [
                        'caret-square-down',
                    ],
                ],
                'skin' => 'inline',
                'label_block' => false,
            ]
        );
        $this->add_control(
            'title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                ],
                'default' => 'div',
                'separator' => 'before',
            ]
        ); 
        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __( 'Accordion', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'margin_acc',
            [
                'label' => esc_html__( 'Margin', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .sc-accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_acc',
            [
                'label' => esc_html__( 'Padding', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .sc-accordion-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
           Group_Control_Box_Shadow::get_type(),
           [
               'name' => 'box_shadow',
               'selector' => '{{WRAPPER}} .sc-accordion-area .sc-accordion-item',
           ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .sc-accordion-area .sc-accordion-item',
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .sc-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_area',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .sc-accordion-area .sc-accordion-item',
            ]
        );

        $this->add_control(
            'active_item_heading',
            [
                'label' => esc_html__( 'Active Item Style', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_area_current',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .sc-accordion-area .sc-accordion-item.current',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border_current',
                'selector' => '{{WRAPPER}} .sc-accordion-area .sc-accordion-item.current',
            ]
        );

        $this->add_group_control(
           Group_Control_Box_Shadow::get_type(),
           [
               'name' => 'box_shadow_current',
               'selector' => '{{WRAPPER}} .sc-accordion-area .sc-accordion-item.current',
           ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_title',
            [
                'label' => __( 'Title', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .accordion-button.collapsed .tab-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_active_color',
            [
                'label' => __( 'Active Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .accordion-button:not(.collapsed) .tab-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_active_bg',
            [
                'label' => esc_html__( 'Title Active Background', 'SoftCoders-header-footer-elementor' ),
                'type'  => Controls_Manager::HEADING,              
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'title_active_background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .sc-accordion-area .sc-accordion-item .accordion-button:not(.collapsed) .tab-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .sc-accordion-area .accordion-button .tab-title',
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .accordion-button.collapsed .tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding_active',
            [
                'label' => __( 'Active Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .accordion-button:not(.collapsed) .tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .accordion-button.collapsed .tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'active_title_border_radius',
            [
                'label' => esc_html__( 'Active Border Radius', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .accordion-button:not(.collapsed) .tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_image',
            [
                'label' => __( 'Image', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'selected_icon[value]!' => '',
                ],
            ]
        );
        $this->add_control(
            'image_align',
            [
                'label' => __( 'Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Start', 'elementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __( 'End', 'elementor' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => is_rtl() ? 'right' : 'left',
                'toggle' => false,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'img_background1',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .sc-accordion-area .accordion-button.collapsed .icon_image',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'img_background2',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .sc-accordion-area .accordion-button:not(.collapsed) .icon_image',
            ]
        );
        $this->add_responsive_control(
            'img_space',
            [
                'label' => __( 'Spacing', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .icon_image' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'img_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} div.sc-accordion-area .icon_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_icon',
            [
                'label' => __( 'Icon', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'selected_icon[value]!' => '',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_align',
            [
                'label' => __( 'Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Start', 'elementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __( 'End', 'elementor' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => is_rtl() ? 'right' : 'left',
                'toggle' => false,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background1',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .accordion-button.collapsed .elementor-accordion-icon',
            ]
        );
        $this->add_control(
            'active_bg',
            [
                'label' => esc_html__( 'Active Background', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background2',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .accordion-button:not(.collapsed) .elementor-accordion-icon',
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-button.collapsed i:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .accordion-button.collapsed svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_active_color',
            [
                'label' => __( 'Active Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-button:not(.collapsed) i:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .accordion-button:not(.collapsed) svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_space',
            [
                'label' => esc_html__( 'Spacing', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-header .elementor-accordion-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'open_icon_margin',
            [
                'label' => esc_html__( 'Open Icon Margin', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-header .elementor-accordion-icon .elementor-accordion-icon-opened' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_left_position',
            [
                'label'      => esc_html__( 'Icon Right to Left Position', 'SoftCoders-header-footer-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .sc-accordion-header .elementor-accordion-icon' => 'right: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_top_position',
            [
                'label' => esc_html__( 'Icon Top to Bottom Position', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .sc-accordion-header .elementor-accordion-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}  !important;',
                ],
            ]
        );
       
        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .sc-accordion-header .elementor-accordion-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_width',
            [
                'label' => __( 'Width', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .sc-accordion-header .elementor-accordion-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_height',
            [
                'label' => __( 'Height', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .sc-accordion-header .elementor-accordion-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'line_height',
            [
                'label' => __( 'Line Height', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .sc-accordion-header .elementor-accordion-icon' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_alignment',
            [
                'label' => esc_html__( 'Alignment', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'SoftCoders-header-footer-elementor' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'SoftCoders-header-footer-elementor' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'SoftCoders-header-footer-elementor' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'SoftCoders-header-footer-elementor' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .sc-accordion-header .elementor-accordion-icon' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
        	'icon_font_size',
        	[
        		'label' => __( 'Font Size', 'SoftCoders-header-footer-elementor' ),
        		'type' => Controls_Manager::SLIDER,
        		'range' => [
        			'px' => [
        				'min' => 0,
        				'max' => 100,
        			],
        		],
        		'selectors' => [
        			'{{WRAPPER}} div.sc-accordion-area .accordion-button .elementor-accordion-icon-closed' => 'font-size: {{SIZE}}{{UNIT}};',
        			'{{WRAPPER}} div.sc-accordion-area .accordion-button .elementor-accordion-icon-opened' => 'font-size: {{SIZE}}{{UNIT}};',
        			'{{WRAPPER}} div.sc-accordion-area .accordion-button .elementor-accordion-icon-opened svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} div.sc-accordion-area .accordion-button .elementor-accordion-icon-closed svg' => 'width: {{SIZE}}{{UNIT}};',
        		],
        	]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_content',
            [
                'label' => __( 'Content', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'backgrounds',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .sc-accordion-area .accordion-body',
            ]
        );

        $this->add_control(
            'content_active_bg',
            [
                'label' => esc_html__( 'Content Active Background', 'SoftCoders-header-footer-elementor' ),
                'type'  => Controls_Manager::HEADING,              
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_active_background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .sc-accordion-area .sc-accordion-item .accordion-collapse.show .accordion-body',
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label' => __( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .accordion-body' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .sc-accordion-area .accordion-body',
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .accordion-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin_cons',
            [
                'label' => esc_html__( 'Content Margin', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .accordion-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin_cons_active',
            [
                'label' => esc_html__( 'Active Content Margin', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .accordion-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-accordion-area .accordion-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'selector' => '{{WRAPPER}} .sc-accordion-area .accordion-collapse',
            ]
        );

        $this->add_group_control(
           Group_Control_Box_Shadow::get_type(),
           [
               'name' => 'content_shadow',
               'selector' => '{{WRAPPER}} .sc-accordion-area .accordion-body',
           ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        
        $settings = $this->get_settings_for_display();
        $unique = rand(2012,35120);
        if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
            // @todo: remove when deprecated
            // added as bc in 2.6
            // add old default
            $settings['icon'] = 'fa fa-plus';
            $settings['icon_active'] = 'fa fa-minus';
            $settings['icon_align'] = $this->get_settings( 'icon_align' );
        }

        $is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
        $has_icon = ( ! $is_new || ! empty( $settings['selected_icon']['value'] ) );
        $id_int = substr( $this->get_id_int(), 0, 3 );
      
        if ( empty($settings['accordion_list'] ) ) {
            return;
        }

        ?>

            <div class="sc-accordion-area accordion" id="sc-accordion-inner">
              <?php
                $i = 1;
                foreach ( $settings['accordion_list'] as $index => $item ) :
                $title        = !empty($item['name']) ? $item['name'] : '';
                $description  = !empty($item['description']) ? $item['description'] : '';


                $accordion_open_closed = $item['accordion_open_closed'];
                $active = '';
                $collapsed = 'collapsed';
                $current='';
                if($accordion_open_closed == 'yes' ) {
                    $collapsed = '';
                    $active = 'show';
                    $current = 'current';
                }
                
                $selected_image    = !empty($item['selected_image']['url']) ? '<div class="icon_image"><img class="icon_img" src="'. $item['selected_image']['url']. '" alt="icon-image" /></div>' : '';
            ?>  
                <div class="sc-accordion-item <?php echo esc_attr( $current); ?>">
                    <div class="sc-accordion-header" id="heading<?php echo $i;?>">
                        <div class="accordion-button <?php echo esc_attr($collapsed);?>" data-bs-toggle="collapse" data-bs-target="#collapse_<?php echo $i;?>" aria-controls="collapse_<?php echo $i;?>">
                            <?php if ( $has_icon ) : ?>
                                <span class="elementor-accordion-icon elementor-accordion-icon-<?php echo esc_attr( $settings['icon_align'] ); ?>" aria-hidden="true">
                                    <?php
                                    if ( $is_new ) { ?>
                                        <span class="elementor-accordion-icon-closed"><?php Icons_Manager::render_icon( $settings['selected_icon'] ); ?></span>
                                        <span class="elementor-accordion-icon-opened"><?php Icons_Manager::render_icon( $settings['selected_active_icon'] ); ?></span>
                                    <?php } else { ?>
                                        <i class="elementor-accordion-icon-closed <?php echo esc_attr( $settings['icon'] ); ?>"></i>
                                        <i class="elementor-accordion-icon-opened <?php echo esc_attr( $settings['icon_active'] ); ?>"></i>
                                    <?php } ?>
                                </span>
                            <?php endif; ?>                        

                            <?php if('left' == $settings['image_align']){ ?>
                                <?php echo $selected_image; ?>
                            <?php } ?>

                            <?php if(!empty($title)):?>
                            <<?php echo $settings['title_html_tag']; ?> class="tab-title"><?php echo esc_attr ($title);?></<?php echo $settings['title_html_tag']; ?>>
                            <?php endif; ?>

                            <?php if('right' == $settings['image_align']){ ?>
                                <?php echo $selected_image; ?>
                            <?php } ?>

                            
                        </div>
                    </div>

                    <?php if(!empty($item['description'])):?>
                    <div id="collapse_<?php echo $i;?>" class="accordion-collapse collapse <?php echo esc_attr( $active); ?>" aria-labelledby="heading<?php echo $i;?>" data-bs-parent="#sc-accordion-inner">
                        <div class="accordion-body">
                            <?php echo $this->parse_text_editor( $item['description'] ); ?>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
                <?php $i++; endforeach; ?>
            </div>
        <?php
    }
}
