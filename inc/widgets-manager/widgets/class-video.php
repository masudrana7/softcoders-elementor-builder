<?php
/**
 * Elementor SC video Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
namespace softcoderselements\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Widget_Base;


defined( 'ABSPATH' ) || die();

class Video extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'video';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'SC Video', 'SoftCoders-header-footer-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
        return 'eicon-elementor-circle';
    }

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_categories() {
        return [ 'sce-widgets' ];
    }


	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_counter',
			[
				'label' => esc_html__( 'Content', 'SoftCoders-header-footer-elementor' ),
			]
		);
		$this->add_control(
			'video_link',
			[
				'label' => esc_html__( 'Enter Link Here', 'SoftCoders-header-footer-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default'     => '#',
				'placeholder' => esc_html__( 'Video link here', 'SoftCoders-header-footer-elementor' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Video Description', 'SoftCoders-header-footer-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,	
				'default'     => 'Add your video description here',
				'placeholder' => esc_html__( 'Add your video description here..', 'SoftCoders-header-footer-elementor' ),
				'separator' => 'before',
			]
			
		);
		
		$this->end_controls_section();

				
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Content', 'SoftCoders-header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Content Text Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-banner-section-area a.popup-video' => 'color: {{VALUE}};',
                ],


            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Content Text Hover Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-banner-section-area a.popup-video:hover' => 'color: {{VALUE}};',
            		'{{WRAPPER}} .sc-banner-section-area a.popup-video:hover span:before' => 'background-color: {{VALUE}};',
                ],


            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_text',
                'selector' => '{{WRAPPER}} .sc-banner-section-area a.popup-video',

            ]
        );
        $this->add_responsive_control(
		    'video_full_area_margin',
		    [
		        'label' => esc_html__( 'Margin', 'SoftCoders-header-footer-elementor' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .sc-banner-section-area a.popup-video' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
		    'video_inner_area_padding',
		    [
		        'label' => esc_html__( 'Padding', 'SoftCoders-header-footer-elementor' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .sc-banner-section-area a.popup-video' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_gradient_border',
                'label' => esc_html__( 'Border Color', 'SoftCoders-header-footer-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .sc-banner-section-area',
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-banner-section-area a.popup-video i' => 'color: {{VALUE}}; border: 1px solid {{VALUE}};',

                ],

            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label' => esc_html__( 'Icon Hover Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sc-banner-section-area a.popup-video:hover i' => 'color: {{VALUE}}; border: 1px solid {{VALUE}};',
                ],

            ]
        );
        $this->add_responsive_control(
		    'icon__margin',
		    [
		        'label' => esc_html__( 'Icon Margin', 'SoftCoders-header-footer-elementor' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .sc-banner-section-area a.popup-video i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->end_controls_section();

	}

	/**
	 * Render counter widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {	
	
		$settings = $this->get_settings_for_display();	
		$rand = rand(12, 3330);

		$this->add_inline_editing_attributes( 'description', 'basic' );
        $this->add_render_attribute( 'description', 'class', 'video-desc' ); 

		?>
        <div class="sc-banner-section-area">
            <a class="popup-video" href="<?php echo esc_url($settings['video_link']);?>">
                <i class="ri-play-fill"></i>
                <?php if( !empty( $settings['description'])) : ?>
                    <span><?php echo wp_kses_post($settings['description']); ?></span>
                <?php endif; ?>
            </a>
        </div>
		<script type="text/javascript">			
			jQuery(document).ready(function(){
				jQuery('.popup-video').magnificPopup({
			        disableOn: 10,
			        type: 'iframe',
			        mainClass: 'mfp-fade',
			        removalDelay: 160,
			        preloader: false,
			        fixedContentPos: false
			    });
			});
		</script>
    <?php
	}
}