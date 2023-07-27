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
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class SC_Accordion extends Widget_Base {
	public function get_name() {
		return 'sc-accordion';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Softcoders Accordion', 'SoftCoders-header-footer-elementor' );
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
				'label' => __( 'Accordion Item', 'SoftCoders-header-footer-elementor' ),
			]
		);

		$repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Item Title', 'SoftCoders-header-footer-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'SoftCoders-header-footer-elementor'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Title', 'SoftCoders-header-footer-elementor' ),
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Item Description', 'SoftCoders-header-footer-elementor'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'SoftCoders-header-footer-elementor'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Description', 'SoftCoders-header-footer-elementor' ),
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'logo_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                
            ]
        ); 
        $this->add_control(
            'accordion_style',
            [
                'label'   => esc_html__( 'Select Style', 'SoftCoders-header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',               
                'options' => [                    
                    'style1' => 'Style 1',
                    'style2' => 'Style 2',                                
                    'style3' => 'Style 3',                              
                ],                                          
            ]
        );

        $this->add_control(
            'show_title_count',
            [
                'label' => esc_html__( 'Show Title Count', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'your-plugin' ),
                'label_off' => esc_html__( 'Hide', 'your-plugin' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->end_controls_section();
			
	}


	/**
	 * Register Advanced Heading Typography Controls.
	 */
	protected function register_heading_typo_content_controls() {	

		$this->start_controls_section(
            '_accordion_style',
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
                    '{{WRAPPER}} .accordion .cart-button-rt' => 'color: {{VALUE}} !important',
                ],                
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title__typography',
				'selector' => '{{WRAPPER}} .accordion .cart-button-rt',
			]
		);


       $this->add_control(
            'title_number_color',
            [
                'label' => esc_html__( 'Title Number Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion.style2 .cart-button-rt span' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .cart-button-rt span' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'desc__color',
            [
                'label' => esc_html__( 'Desccription Color', 'SoftCoders-header-footer-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion .card-body' => 'color: {{VALUE}} !important',
                ],                
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc__typography',
				'selector' => '{{WRAPPER}} .accordion .card-body',
			]
		);
	}

	/**
	 * Render Heading output on the frontend.
	 */
	protected function render() {
		$settings = $this->get_settings();
		$unique = rand(2012,35120); ?>
        <div class="accordion <?php echo $settings['accordion_style'];?>" id="accordionExample<?php echo $unique;?>">
            <?php $x =0; 
            foreach ( $settings['logo_list'] as $index => $item ) :
                $title = !empty($item['name']) ? $item['name'] : '';
                $description = !empty($item['description']) ? $item['description'] : '';
            $x++;
            if($x== 1){
                $col = '';
            }
            else{
                $col = 'collapsed';
            }
            ?>                        
            <div class="rt-cart">
              <div class="rt-card-header">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block cart-button-rt text-left <?php echo $col; ?>" aria-expanded="true" aria-controls="collapse<?php echo $x; ?>" type="button" data-toggle="collapse" data-target="#collapse<?php echo $x.$unique; ?>">
                    <?php if($settings['show_title_count'] == 'yes'){ ?>
                        <span> <?php echo '0'. $x.'.'?></span> <?php }?> <?php echo wp_kses_post ($title);?>
                  </button>
                </h2>
              </div>

              <div id="collapse<?php echo $x.$unique; ?>" class="collapse"  data-parent="#accordionExample<?php echo $unique;?>">
                <div class="card-body">
                <?php echo esc_attr ($description);?>
                </div>
              </div>
            </div>                 
            <?php endforeach; ?>                  
                  
            </div>
            <script>
            jQuery( function($) {            	
              	jQuery("#collapse1").addClass("show");     
            	} );         
            </script>
        <?php
	}
		/**
		 * Render site title output in the editor.
		 */
	
}
