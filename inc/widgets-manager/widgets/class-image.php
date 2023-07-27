<?php
/**
 * Elementor Classes.
 *
 */

namespace softcoderselements\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Widget_Base;
use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Image extends Widget_Base {

	public function get_name() {
		return 'image';
	}
	/**
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'SoftCoders Image', 'SoftCoders-header-footer-elementor' );
	}
	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.2.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-elementor-circle';
	}
	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.2.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'sce-widgets' ];
	}

	/**
	 * Register image controls.
	 *
	 * @since 1.5.7
	 * @access protected
	 */
	protected function register_controls() {
		$this->register_content_image_controls();
	}
	/**
	 * Register image General Controls.
	 *
	 * @since 1.2.0
	 * @access protected
	 */
    protected function register_content_image_controls() {
        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__( 'Image Settings', 'SoftCoders-header-footer-elementor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'first_image',
            [
                'label' => esc_html__( 'Choose Image', 'SoftCoders-header-footer-elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'align',
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
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .sc-image' => 'text-align: {{VALUE}}'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'popup_animation',
            [
                'label' => esc_html__( 'Popup Effect', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'SoftCoders-header-footer-elementor' ),
                'label_off' => esc_html__( 'Hide', 'SoftCoders-header-footer-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'image_animation',
            [
                'label' => esc_html__( 'Animation', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'SoftCoders-header-footer-elementor' ),
                'label_off' => esc_html__( 'Hide', 'SoftCoders-header-footer-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'images_translate',
            [
                'label'   => esc_html__( 'Translate Position', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'veritcal',
                'options' => [
                    'veritcal' => esc_html__( 'Veritcal', 'SoftCoders-header-footer-elementor'),
                    'veritcal2' => esc_html__( 'Veritcal 2', 'SoftCoders-header-footer-elementor'),
                    'horizontal' => esc_html__( 'Horizontal', 'SoftCoders-header-footer-elementor'),
                    'horizontal2' => esc_html__( 'Horizontal 2', 'SoftCoders-header-footer-elementor'),
                    'rotated_style' => esc_html__( 'Rotated', 'SoftCoders-header-footer-elementor'),
                    'spin_style' => esc_html__( 'Spin', 'SoftCoders-header-footer-elementor'),
                    'scale_style' => esc_html__( 'Scale', 'SoftCoders-header-footer-elementor'),
                    'scale_style2' => esc_html__( 'Scale2', 'SoftCoders-header-footer-elementor'),
                    'move_leftright' => esc_html__( 'Move Left & Right', 'SoftCoders-header-footer-elementor'),
                ],
                'condition' => [
                    'image_animation' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'animation_start_from',
            [
                'label'   => esc_html__( 'Start From Reverse', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'disable',
                'options' => [
                    'enable' => esc_html__( 'Enable', 'SoftCoders-header-footer-elementor'),
                    'disable' => esc_html__( 'Disable', 'SoftCoders-header-footer-elementor'),
                ],
                'condition' => [
                    'image_animation' => 'yes',
                    'images_translate' => 'spin_style',
                    'images_translate' => 'veritcal2',
                ],
            ]
        );

        $this->add_responsive_control(
            'rs_image_duration',
            [

                'label' => esc_html__( 'Animation Duration', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .sc-image .sc-multi-image' => 'animation-duration: {{SIZE}}s;',
                ],
                'condition' => [
                    'image_animation' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'rs_image_delay',
            [

                'label' => esc_html__( 'Animation Delay', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .sc-image .sc-multi-image' => 'animation-delay: {{SIZE}}s;',
                ],
                'condition' => [
                    'image_animation' => 'yes',
                ],
            ]
        );


        $this->add_control(
            'popup_animation_bg_heading',
            [
                'label' => esc_html__( 'Popup Effect Background', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'popup_animation' => 'yes',
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .sc-image .pop-wrap .pop' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_title_style',
            [
                'label' => esc_html__( 'Gobal Style', 'SoftCoders-header-footer-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
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
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sc-image img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sc-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'opacity',
            [
                'label' => esc_html__( 'Opacity', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .sc-image img' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'img__box_shadow',
                'selector' => '{{WRAPPER}} .sc-image img',
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters',
                'selector' => '{{WRAPPER}} .sc-image img',
            ]
        );

        $this->add_control(
            'mix_blend_mode',
            [
                'label'   => esc_html__( 'Blend Mode', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'unset',
                'options' => [
                    'unset'         => esc_html__( 'Unset', 'SoftCoders-header-footer-elementor'),
                    'multiply'      => esc_html__( 'Multiply', 'SoftCoders-header-footer-elementor'),
                    'screen'        => esc_html__( 'Screen', 'SoftCoders-header-footer-elementor'),
                    'overlay'       => esc_html__( 'Overlay', 'SoftCoders-header-footer-elementor'),
                    'darken'        => esc_html__( 'Darken', 'SoftCoders-header-footer-elementor'),
                    'lighten'       => esc_html__( 'Lighten', 'SoftCoders-header-footer-elementor'),
                    'color_dodge'   => esc_html__( 'Color Dodge', 'SoftCoders-header-footer-elementor'),
                    'color_burn'    => esc_html__( 'Color Burn', 'SoftCoders-header-footer-elementor'),
                    'difference'    => esc_html__( 'Difference', 'SoftCoders-header-footer-elementor'),
                    'exclusion'     => esc_html__( 'Exclusion', 'SoftCoders-header-footer-elementor'),
                    'hue'           => esc_html__( 'Hue', 'SoftCoders-header-footer-elementor'),
                    'saturation'    => esc_html__( 'Saturation', 'SoftCoders-header-footer-elementor'),
                    'color'         => esc_html__( 'Color', 'SoftCoders-header-footer-elementor'),
                    'luminosity'    => esc_html__( 'Luminosity', 'SoftCoders-header-footer-elementor'),
                    'normal'        => esc_html__( 'Normal', 'SoftCoders-header-footer-elementor'),
                ],
            ]
        );

        $this->end_controls_section();
    }

	/**
	 * Render image output on the frontend.
	 */

     protected function render() {
        $settings = $this->get_settings_for_display(); ?>

        <div class="sc-image <?php echo esc_attr($settings['image_animation']); ?>">
            <?php if(!empty($settings['first_image']['url'])) : ?>
                <img class="sc-multi-image <?php echo esc_attr($settings['images_translate']); ?> reverse-<?php echo esc_attr($settings['animation_start_from']); ?> blend_<?php echo esc_attr($settings['mix_blend_mode']); ?>" src="<?php echo esc_url($settings['first_image']['url']);?>" alt="image"/>
                <?php if('yes' == $settings['popup_animation']){?>
                <div class="pop-wrap">
                    <div class="pop"></div>
                    <div class="pop"></div>
                    <div class="pop"></div>
                </div>
                <?php } ?>
            <?php endif; ?>
        </div>
    <?php
    }




}
