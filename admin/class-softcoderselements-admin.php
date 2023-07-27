<?php
use HFE\Lib\softcoderselements_Target_Rules_Fields;

defined( 'ABSPATH' ) or exit;

/**
 * socoders_elements_Admin setup
 *
 * @since 1.0.0
 */
class socoders_elements_Admin {

	/**
	 * Instance of socoders_elements_Admin
	 */
	private static $_instance = null;

	/**
	 * Instance of socoders_elements_Admin
	 */
	public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new self();
		}

		add_action( 'elementor/init', __CLASS__ . '::load_admin', 0 );

		return self::$_instance;
	}

	/**
	 * Load the icons style in editor.
	 *
	 * @since 1.3.0
	 */
	public static function load_admin() {
		add_action( 'elementor/editor/after_enqueue_styles', __CLASS__ . '::socoders_elements_admin_enqueue_scripts' );
	}

	/**
	 * Enqueue admin scripts
	 *
	 * @since 1.3.0
	 * @param string $hook Current page hook.
	 * @access public
	 */
	public static function socoders_elements_admin_enqueue_scripts( $hook ) {

		// Register the icons styles.
		wp_register_style(
			'sce-style',
			softcoderselements_URL . 'assets/css/style.css',
			[],
			softcoderselements_VER
		);

		wp_enqueue_style( 'sce-style' );
	}

	/**
	 * Constructor
	 */
	private function __construct() {
		add_action( 'init', [ $this, 'header_footer_posttype' ] );
		add_action( 'admin_menu', [ $this, 'register_admin_menu' ], 50 );
		add_action( 'admin_enqueue_scripts', array( $this, 'softcoderselements_admin_scripts' ) );
		add_action( 'add_meta_boxes', [ $this, 'ehf_register_metabox' ] );
		add_action( 'save_post', [ $this, 'ehf_save_meta' ] );
		add_action( 'admin_notices', [ $this, 'location_notice' ] );
		add_action( 'template_redirect', [ $this, 'block_template_frontend' ] );
		add_filter( 'single_template', [ $this, 'load_canvas_template' ] );
		add_filter( 'manage_elementor-hf_posts_columns', [ $this, 'set_shortcode_columns' ] );
		add_action( 'manage_elementor-hf_posts_custom_column', [ $this, 'render_shortcode_column' ], 10, 2 );

		if ( is_admin() ) {
			add_action( 'manage_elementor-hf_posts_custom_column', [ $this, 'column_content' ], 10, 2 );
			add_filter( 'manage_elementor-hf_posts_columns', [ $this, 'column_headings' ] );
			require_once softcoderselements_DIR . 'admin/class-sce-addons-actions.php';
		}

		add_action( 'admin_init', array( $this, 'softcoderselements_page_init' ) );
	}

	/**
	 * Admin Style
	 */
	public function softcoderselements_admin_scripts(){
        wp_register_style('softcoderselements-admin-styles', softcoderselements_ASSETS_ADMIN . 'admin/assets/css/ehf-admin.css', array(), null );
        wp_enqueue_style('softcoderselements-admin-styles');
    }

	/**
	 * Adds or removes list table column headings.
	 *
	 * @param array $columns Array of columns.
	 * @return array
	 */
	public function column_headings( $columns ) {
		unset( $columns['date'] );

		$columns['elementor_hf_display_rules'] = __( 'Display Rules', 'softcoders-elements' );
		$columns['date']                       = __( 'Date', 'softcoders-elements' );

		return $columns;
	}

	/**
	 * Adds the custom list table column content.
	 *
	 * @param array $column Name of column.
	 * @param int   $post_id Post id.
	 * @return void
	 */
	public function column_content( $column, $post_id ) {

		if ( 'elementor_hf_display_rules' == $column ) {

			$locations = get_post_meta( $post_id, 'ehf_target_include_locations', true );
			if ( ! empty( $locations ) ) {
				echo '<div class="ast-advanced-headeSoftCoders-location-wrap" style="margin-bottom: 5px;">';
				echo '<strong>Display: </strong>';
				$this->column_display_location_rules( $locations );
				echo '</div>';
			}

			$locations = get_post_meta( $post_id, 'ehf_target_exclude_locations', true );
			if ( ! empty( $locations ) ) {
				echo '<div class="ast-advanced-headeSoftCoders-exclusion-wrap" style="margin-bottom: 5px;">';
				echo '<strong>Exclusion: </strong>';
				$this->column_display_location_rules( $locations );
				echo '</div>';
			}

			$users = get_post_meta( $post_id, 'ehf_target_user_roles', true );
			if ( isset( $users ) && is_array( $users ) ) {
				if ( isset( $users[0] ) && ! empty( $users[0] ) ) {
					$user_label = [];
					foreach ( $users as $user ) {
						$user_label[] = softcoderselements_Target_Rules_Fields::get_user_by_key( $user );
					}
					echo '<div class="ast-advanced-headeSoftCoders-useSoftCoders-wrap">';
					echo '<strong>Users: </strong>';
					echo join( ', ', $user_label );
					echo '</div>';
				}
			}
		}
	}

	/**
	 * Get Markup of Location rules for Display rule column.
	 *
	 * @param array $locations Array of locations.
	 * @return void
	 */
	public function column_display_location_rules( $locations ) {

		$location_label = [];
		$index          = array_search( 'specifics', $locations['rule'] );
		if ( false !== $index && ! empty( $index ) ) {
			unset( $locations['rule'][ $index ] );
		}

		if ( isset( $locations['rule'] ) && is_array( $locations['rule'] ) ) {
			foreach ( $locations['rule'] as $location ) {
				$location_label[] = softcoderselements_Target_Rules_Fields::get_location_by_key( $location );
			}
		}
		if ( isset( $locations['specific'] ) && is_array( $locations['specific'] ) ) {
			foreach ( $locations['specific'] as $location ) {
				$location_label[] = softcoderselements_Target_Rules_Fields::get_location_by_key( $location );
			}
		}

		echo join( ', ', $location_label );
	}


	/**
	 * Register Post type for Elementor Header & Footer Builder templates
	 */
	public function header_footer_posttype() {
		$labels = [
			'name'               => __( 'SoftCoders Header & Footer Builder', 'softcoders-elements' ),
			'singular_name'      => __( 'SoftCoders Header & Footer Builder', 'softcoders-elements' ),
			'menu_name'          => __( 'SoftCoders Header & Footer Builder', 'softcoders-elements' ),
			'name_admin_bar'     => __( 'SoftCoders Header & Footer Builder', 'softcoders-elements' ),
			'add_new'            => __( 'Add New', 'softcoders-elements' ),
			'add_new_item'       => __( 'Add New Header or Footer', 'softcoders-elements' ),
			'new_item'           => __( 'New Template', 'softcoders-elements' ),
			'edit_item'          => __( 'Edit Template', 'softcoders-elements' ),
			'view_item'          => __( 'View Template', 'softcoders-elements' ),
			'all_items'          => __( 'All Templates', 'softcoders-elements' ),
			'search_items'       => __( 'Search Templates', 'softcoders-elements' ),
			'parent_item_colon'  => __( 'Parent Templates:', 'softcoders-elements' ),
			'not_found'          => __( 'No Templates found.', 'softcoders-elements' ),
			'not_found_in_trash' => __( 'No Templates found in Trash.', 'softcoders-elements' ),
		];

		$args = [
			'labels'              => $labels,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => false,
			'exclude_from_search' => true,
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'menu_icon'           => 'dashicons-editor-kitchensink',
			'supports'            => [ 'title', 'elementor' ],
		];
		register_post_type( 'elementor-hf', $args );
	}

	/**
	 * Register the admin menu
	 *
	 * @since  1.0.0
	 */
	public function register_admin_menu() {
		$parent_slug = 'elementor-hf';
        add_menu_page( 
            __( 'Custom Menu Title', 'softcoders-elements' ),
            'SoftCoders Header-Footer',
            'manage_options',
            $parent_slug,
            [$this, 'softcoderselements_addon_switcher'],
            'dashicons-welcome-widgets-menus',
            6
        );

		add_submenu_page(
			$parent_slug,
			__( 'SoftCoders Header & Footer Builder', 'softcoders-elements' ),
			__( 'All Header Footer', 'softcoders-elements' ),
			// 'manage_options',
			'edit_pages',
			// $parent_slug,
			'edit.php?post_type=elementor-hf'
		);
	}

	function softcoderselements_addon_switcher(){
		$this->softcoderselements_options = get_option( 'softcoderselements_addon_option' );
        ?>
        <div class="wrap">
            <form class="rselements-form" method="post" action="options.php">
                <?php
                settings_fields( 'softcoderselements_addon_group' );
                do_settings_sections( 'softcoderselements-addon-field' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
	}

	/**
	 * 
	 */
	public function softcoderselements_page_init(){
        register_setting(
            'softcoderselements_addon_group',
            'softcoderselements_addon_option',
            array( $this, 'SoftCoderselements_sanitize' )
        );

        add_settings_section(
            'softcoderselements_section_field_id',
            esc_html__( 'Deactivate elements for better performance', 'softcoders-elements' ),
            array( $this, 'SoftCoderselements_section_info' ),
            'softcoderselements-addon-field',
        );

        /**
         * Copyright
         */
        add_settings_field(
            'softcoderselements_copyright',
            esc_html__( 'SoftCoders Copyright', 'softcoders-elements' ),
            array( $this, 'softcoderselements_copyright_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );
        /**
         * Video
         */
        add_settings_field(
            'softcoderselements_video',
            esc_html__( 'SoftCoders Video', 'softcoders-elements' ),
            array( $this, 'softcoderselements_video_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );
        /**
         * Accordion
         */
        add_settings_field(
            'softcoderselements_accordion',
            esc_html__( 'SoftCoders Accordion', 'softcoders-elements' ),
            array( $this, 'softcoderselements_accordion_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

        /**
         * Pricing Switcher
         */
        add_settings_field(
            'softcoderselements_pricing_switcher',
            esc_html__( 'SoftCoders Pricing Switcher', 'softcoders-elements' ),
            array( $this, 'softcoderselements_pricing_switcher_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

        /**
         * Newsletter
         */
        add_settings_field(
            'softcoderselements_newsletter',
            esc_html__( 'SoftCoders Newsletter', 'softcoders-elements' ),
            array( $this, 'softcoderselements_newsletter_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

        /**
         * Image
         */
        add_settings_field(
            'softcoderselements_image',
            esc_html__( 'SoftCoders Image', 'softcoders-elements' ),
            array( $this, 'softcoderselements_image_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

        /**
         * Heading
         */
        add_settings_field(
            'softcoderselements_heading',
            esc_html__( 'SoftCoders Heading', 'softcoders-elements' ),
            array( $this, 'softcoderselements_heading_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Header Button
         */
        add_settings_field(
            'softcoderselements_header_button',
            esc_html__( 'SoftCoders Header Button', 'softcoders-elements' ),
            array( $this, 'softcoderselements_header_button_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Navigation Menu
         */
        add_settings_field(
            'softcoderselements_navigation_menu',
            esc_html__( 'SoftCoders Navigation Menu', 'softcoders-elements' ),
            array( $this, 'softcoderselements_navigation_menu_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Site Logo
         */
        add_settings_field(
            'softcoderselements_site_logo',
            esc_html__( 'SoftCoders Site Logo', 'softcoders-elements' ),
            array( $this, 'softcoderselements_site_logo_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Page Title
         */
        add_settings_field(
            'softcoderselements_page_title',
            esc_html__( 'SoftCoders Page Title', 'softcoders-elements' ),
            array( $this, 'softcoderselements_page_title_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Search
         */

        add_settings_field(
            'softcoderselements_search',
            esc_html__( 'SoftCoders Search', 'softcoders-elements' ),
            array( $this, 'softcoderselements_search_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Service Grid
         */

        add_settings_field(
            'softcoderselements_service_grid',
            esc_html__( 'SoftCoders Service Grid', 'softcoders-elements' ),
            array( $this, 'softcoderselements_service_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );


		/**
         * SoftCoders Counter
         */

        add_settings_field(
            'softcoderselements_counter',
            esc_html__( 'SoftCoders Counter', 'softcoders-elements' ),
            array( $this, 'softcoderselements_counter_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		
		/**
         * Feature List
         */
        add_settings_field(
            'softcoderselements_feature_list',
            esc_html__( 'SoftCoders Feature List', 'softcoders-elements' ),
            array( $this, 'softcoderselements_feature_list_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Team Slider
         */

        add_settings_field(
            'softcoderselements_teamslider',
            esc_html__( 'SoftCoders Team Slider', 'softcoders-elements' ),
            array( $this, 'softcoderselements_teamslider_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Team Slider
         */

        add_settings_field(
            'softcoderselements_TeamGrid',
            esc_html__( 'SoftCoders Team Grid', 'softcoders-elements' ),
            array( $this, 'softcoderselements_TeamGrid_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Blog Slider
         */

        add_settings_field(
            'softcoderselements_blogslider',
            esc_html__( 'SoftCoders Blog Slider', 'softcoders-elements' ),
            array( $this, 'softcoderselements_blogslider_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Blog Grid
         */

        add_settings_field(
            'softcoderselements_BlogGrid',
            esc_html__( 'SoftCoders Blog Grid', 'softcoders-elements' ),
            array( $this, 'softcoderselements_BlogGrid_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );


		/**
         * SoftCoders Contact Form
         */
        add_settings_field(
            'softcoderselements_contactform',
            esc_html__( 'SoftCoders Contact Form', 'softcoders-elements' ),
            array( $this, 'softcoderselements_contactform_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Project Slider
         */
        add_settings_field(
            'softcoderselements_projectslider',
            esc_html__( 'SoftCoders Project Slider', 'softcoders-elements' ),
            array( $this, 'softcoderselements_projectslider_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Project Slider
         */
        add_settings_field(
            'softcoderselements_testimonial',
            esc_html__( 'SoftCoders Testimonials', 'softcoders-elements' ),
            array( $this, 'softcoderselements_testimonial_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Project Slider
         */
        add_settings_field(
            'softcoderselements_brandslider',
            esc_html__( 'SoftCoders Brand Slider', 'softcoders-elements' ),
            array( $this, 'softcoderselements_brandslider_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );
		
		/**
         * SoftCoders Price Table
         */
        add_settings_field(
            'softcoderselements_pricetable',
            esc_html__( 'SoftCoders Price Table', 'softcoders-elements' ),
            array( $this, 'softcoderselements_pricetable_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Price Table
         */
        add_settings_field(
            'softcoderselements_heroslider',
            esc_html__( 'SoftCoders Hero Slider', 'softcoders-elements' ),
            array( $this, 'softcoderselements_heroslider_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );
		
		/**
         * SoftCoders Price Table
         */
        add_settings_field(
            'softcoderselements_SC_Accordion',
            esc_html__( 'SoftCoders Accordion', 'softcoders-elements' ),
            array( $this, 'softcoderselements_sc_accordion_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Price Table
         */
        add_settings_field(
            'softcoderselements_service_slider',
            esc_html__( 'SoftCoders Service Slider', 'softcoders-elements' ),
            array( $this, 'softcoderselements_service_slider_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Price Table
         */
        add_settings_field(
            'softcoderselements_working_process',
            esc_html__( 'SoftCoders Working Process', 'softcoders-elements' ),
            array( $this, 'softcoderselements_working_process_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Breadcrumb
         */
        add_settings_field(
            'softcoderselements_sc_breadcrumb',
            esc_html__( 'SoftCoders Breadcrumb', 'softcoders-elements' ),
            array( $this, 'softcoderselements_sc_breadcrumb_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Breadcrumb
         */
        add_settings_field(
            'softcoderselements_ProjectGrid',
            esc_html__( 'SoftCoders Project Grid', 'softcoders-elements' ),
            array( $this, 'softcoderselements_ProjectGrid_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );

		/**
         * SoftCoders Breadcrumb
         */
        add_settings_field(
            'softcoderselements_SCoffcanvas',
            esc_html__( 'SoftCoders Offcanvas Icon', 'softcoders-elements' ),
            array( $this, 'softcoderselements_SCoffcanvas_block' ),
            'softcoderselements-addon-field',
            'softcoderselements_section_field_id',
            array( 'class' => 'SoftCoderselements_addon_field' )
        );


	}

	/**
     * Print the Section text
     */
    public function SoftCoderselements_section_info() {
        //print 'Enter your settings below:';
    }

	/**
     * Copyright
     */
    public function softcoderselements_copyright_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_copyright]" id="softcoderselements_copyright" value="softcoderselements_copyright" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_copyright']) && $this->softcoderselements_options['softcoderselements_copyright'] ) == 'softcoderselements_copyright' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_copyright"></label>
        </div>
        <?php
    }

    /**
     * Pricing Switcher
     */
    public function softcoderselements_pricing_switcher_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_pricing_switcher]" id="softcoderselements_pricing_switcher" value="softcoderselements_pricing_switcher" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_pricing_switcher']) && $this->softcoderselements_options['softcoderselements_pricing_switcher'] ) == 'softcoderselements_pricing_switcher' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_pricing_switcher"></label>
        </div>
        <?php
    }

    /**
     * Video
     */
    public function softcoderselements_video_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_video]" id="softcoderselements_video" value="softcoderselements_video" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_video']) && $this->softcoderselements_options['softcoderselements_video'] ) == 'softcoderselements_video' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_video"></label>
        </div>
        <?php
    }

    /**
     * Accordion
    */
    public function softcoderselements_accordion_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_accordion]" id="softcoderselements_accordion" value="softcoderselements_accordion" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_accordion']) && $this->softcoderselements_options['softcoderselements_accordion'] ) == 'softcoderselements_accordion' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_accordion"></label>
        </div>
        <?php
    }


    /**
     * Newsletter
     */
    public function softcoderselements_newsletter_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_newsletter]" id="softcoderselements_newsletter" value="softcoderselements_newsletter" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_newsletter']) && $this->softcoderselements_options['softcoderselements_newsletter'] ) == 'softcoderselements_newsletter' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_newsletter"></label>
        </div>
        <?php
    }
    /**
     * Image
     */
    public function softcoderselements_image_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_image]" id="softcoderselements_image" value="softcoderselements_image" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_image']) && $this->softcoderselements_options['softcoderselements_image'] ) == 'softcoderselements_image' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_image"></label>
        </div>
        <?php
    }
    /**
     * Heading
     */
    public function softcoderselements_heading_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_heading]" id="softcoderselements_heading" value="softcoderselements_heading" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_heading']) && $this->softcoderselements_options['softcoderselements_heading'] ) == 'softcoderselements_heading' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_heading"></label>
        </div>
        <?php
    }

	/**
     * Header Button
     */
    public function softcoderselements_header_button_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_header_button]" id="softcoderselements_header_button" value="softcoderselements_header_button" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_header_button']) && $this->softcoderselements_options['softcoderselements_header_button'] ) == 'softcoderselements_header_button' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_header_button"></label>
        </div>
        <?php
    }

	/**
     * Navigation Menu
     */
    public function softcoderselements_navigation_menu_block() {
        ?>
        <div class="checkbox">
            <?php
			$this->softcoderselements_options = get_option('softcoderselements_addon_option');
			
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_navigation_menu]" id="softcoderselements_navigation_menu" value="softcoderselements_navigation_menu" %s/>',
			(isset( $this->softcoderselements_options['softcoderselements_site_logo']) && $this->softcoderselements_options['softcoderselements_navigation_menu'] ) == 'softcoderselements_navigation_menu' ? 'checked' : ''
		);
            ?>
            <label for="softcoderselements_navigation_menu"></label>
        </div>
        <?php
    }

	/**
     * Site Logo
     */
    public function softcoderselements_site_logo_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_site_logo]" id="softcoderselements_site_logo" value="softcoderselements_site_logo" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_site_logo']) && $this->softcoderselements_options['softcoderselements_site_logo'] ) == 'softcoderselements_site_logo' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_site_logo"></label>
        </div>
        <?php
    }

	/**
     * Page Title
     */
    public function softcoderselements_page_title_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_page_title]" id="softcoderselements_page_title" value="softcoderselements_page_title" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_page_title']) && $this->softcoderselements_options['softcoderselements_page_title'] ) == 'softcoderselements_page_title' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_page_title"></label>
        </div>
        <?php
    }

	/**
     * Search
     */
    public function softcoderselements_search_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_search]" id="softcoderselements_search" value="softcoderselements_search" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_search']) && $this->softcoderselements_options['softcoderselements_search'] ) == 'softcoderselements_search' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_search"></label>
        </div>
        <?php
    }

	/**
     * Service Grid
     */
    public function softcoderselements_service_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_service_grid]" id="softcoderselements_service_grid" value="softcoderselements_service_grid" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_service_grid']) && $this->softcoderselements_options['softcoderselements_service_grid'] ) == 'softcoderselements_service_grid' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_service_grid"></label>
        </div>
        <?php
    }

	/**
     * Softcoder Counter
     */
    public function softcoderselements_counter_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_counter]" id="softcoderselements_counter" value="softcoderselements_counter" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_counter']) && $this->softcoderselements_options['softcoderselements_counter'] ) == 'softcoderselements_counter' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_counter"></label>
        </div>
        <?php
    }

	/**
     * Feature List
     */
    public function softcoderselements_feature_list_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_feature_list]" id="softcoderselements_feature_list" value="softcoderselements_feature_list" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_feature_list']) && $this->softcoderselements_options['softcoderselements_feature_list'] ) == 'softcoderselements_feature_list' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_feature_list"></label>
        </div>
        <?php
    }

	/**
     * Softcoder Team Slider
     */
    public function softcoderselements_teamslider_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_teamslider]" id="softcoderselements_teamslider" value="softcoderselements_teamslider" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_teamslider']) && $this->softcoderselements_options['softcoderselements_teamslider'] ) == 'softcoderselements_teamslider' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_teamslider"></label>
        </div>
        <?php
    }

	/**
     * Softcoder Team Slider
     */
    public function softcoderselements_TeamGrid_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_TeamGrid]" id="softcoderselements_TeamGrid" value="softcoderselements_TeamGrid" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_TeamGrid']) && $this->softcoderselements_options['softcoderselements_TeamGrid'] ) == 'softcoderselements_TeamGrid' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_TeamGrid"></label>
        </div>
        <?php
    }

	/**
     * Softcoder Blog Slider
     */
    public function softcoderselements_blogslider_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_blogslider]" id="softcoderselements_blogslider" value="softcoderselements_blogslider" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_blogslider']) && $this->softcoderselements_options['softcoderselements_blogslider'] ) == 'softcoderselements_blogslider' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_blogslider"></label>
        </div>
        <?php
    }

	/**
     * Softcoder Blog Grid
     */
    public function softcoderselements_BlogGrid_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_BlogGrid]" id="softcoderselements_BlogGrid" value="softcoderselements_BlogGrid" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_BlogGrid']) && $this->softcoderselements_options['softcoderselements_BlogGrid'] ) == 'softcoderselements_BlogGrid' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_BlogGrid"></label>
        </div>
        <?php
    }

	/**
     * Softcoder Counter
     */
    public function softcoderselements_contactform_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_contactform]" id="softcoderselements_contactform" value="softcoderselements_contactform" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_contactform']) && $this->softcoderselements_options['softcoderselements_contactform'] ) == 'softcoderselements_teamslider' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_contactform"></label>
        </div>
        <?php
    }

	/**
     * Softcoder Project Slider
     */
    public function softcoderselements_projectslider_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_projectslider]" id="softcoderselements_projectslider" value="softcoderselements_projectslider" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_projectslider']) && $this->softcoderselements_options['softcoderselements_projectslider'] ) == 'softcoderselements_teamslider' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_projectslider"></label>
        </div>
        <?php
    }
	
	/**
     * Softcoder Testimonils
     */
    public function softcoderselements_testimonial_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_testimonial]" id="softcoderselements_testimonial" value="softcoderselements_testimonial" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_testimonial']) && $this->softcoderselements_options['softcoderselements_testimonial'] ) == 'softcoderselements_teamslider' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_testimonial"></label>
        </div>
        <?php
    }
	
	/**
     * Softcoder Testimonils
     */
    public function softcoderselements_brandslider_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_brandslider]" id="softcoderselements_brandslider" value="softcoderselements_brandslider" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_brandslider']) && $this->softcoderselements_options['softcoderselements_brandslider'] ) == 'softcoderselements_teamslider' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_brandslider"></label>
        </div>
        <?php
    }
	
	/**
     * Softcoder Price Table
     */
    public function softcoderselements_heroslider_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_heroslider]" id="softcoderselements_heroslider" value="softcoderselements_heroslider" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_heroslider']) && $this->softcoderselements_options['softcoderselements_heroslider'] ) == 'softcoderselements_teamslider' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_heroslider"></label>
        </div>
        <?php
    }

	/**
     * Softcoder Price Table
     */
    public function softcoderselements_pricetable_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_pricetable]" id="softcoderselements_pricetable" value="softcoderselements_pricetable" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_pricetable']) && $this->softcoderselements_options['softcoderselements_pricetable'] ) == 'softcoderselements_teamslider' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_pricetable"></label>
        </div>
        <?php
    }

	/**
     * Softcoder Price Table
     */
    public function softcoderselements_sc_accordion_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_SC_Accordion]" id="softcoderselements_SC_Accordion" value="softcoderselements_SC_Accordion" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_SC_Accordion']) && $this->softcoderselements_options['softcoderselements_SC_Accordion'] ) == 'softcoderselements_SC_Accordion' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_SC_Accordion"></label>
        </div>
        <?php
    }

	/**
     * Softcoder Service Slider
     */
    public function softcoderselements_service_slider_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_service_slider]" id="softcoderselements_service_slider" value="softcoderselements_service_slider" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_service_slider']) && $this->softcoderselements_options['softcoderselements_service_slider'] ) == 'softcoderselements_service_slider' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_service_slider"></label>
        </div>
        <?php
    }

	

	/**
     * Softcoder Service Slider
     */
    public function softcoderselements_working_process_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_working_process]" id="softcoderselements_working_process" value="softcoderselements_working_process" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_working_process']) && $this->softcoderselements_options['softcoderselements_working_process'] ) == 'softcoderselements_working_process' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_working_process"></label>
        </div>
        <?php
    }
	
	/**
     * Softcoder Service Slider
     */
    public function softcoderselements_sc_breadcrumb_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_sc_breadcrumb]" id="softcoderselements_sc_breadcrumb" value="softcoderselements_sc_breadcrumb" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_sc_breadcrumb']) && $this->softcoderselements_options['softcoderselements_sc_breadcrumb'] ) == 'softcoderselements_sc_breadcrumb' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_sc_breadcrumb"></label>
        </div>
        <?php
    }
	
	/**
     * Softcoder Project Grid
     */
    public function softcoderselements_ProjectGrid_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_ProjectGrid]" id="softcoderselements_ProjectGrid" value="softcoderselements_ProjectGrid" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_ProjectGrid']) && $this->softcoderselements_options['softcoderselements_ProjectGrid'] ) == 'softcoderselements_ProjectGrid' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_ProjectGrid"></label>
        </div>
        <?php
    }
	
	/**
     * Softcoder Project Grid
     */
    public function softcoderselements_SCoffcanvas_block() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="softcoderselements_addon_option[softcoderselements_SCoffcanvas]" id="softcoderselements_SCoffcanvas" value="softcoderselements_SCoffcanvas" %s/>',
                (isset( $this->softcoderselements_options['softcoderselements_SCoffcanvas']) && $this->softcoderselements_options['softcoderselements_SCoffcanvas'] ) == 'softcoderselements_SCoffcanvas' ? 'checked' : ''
            );
            ?>
            <label for="softcoderselements_SCoffcanvas"></label>
        </div>
        <?php
    }




	/**
	 * Register meta box(es).
	 */
	function ehf_register_metabox() {
		add_meta_box(
			'ehf-meta-box',
			__( 'SoftCoders Header & Footer Builder Options', 'softcoders-elements' ),
			[
				$this,
				'efh_metabox_render',
			],
			'elementor-hf',
			'normal',
			'high'
		);
	}

	/**
	 * Render Meta field.
	 *
	 * @param  POST $post Currennt post object which is being displayed.
	 */
	function efh_metabox_render( $post ) {
		$values            = get_post_custom( $post->ID );
		$template_type     = isset( $values['ehf_template_type'] ) ? esc_attr( $values['ehf_template_type'][0] ) : '';
		$display_on_canvas = isset( $values['display-on-canvas-template'] ) ? true : false;

		// We'll use this nonce field later on when saving.
		wp_nonce_field( 'ehf_meta_nounce', 'ehf_meta_nounce' );
		?>
		<table class="sce-options-table widefat">
			<tbody>
				<tr class="sce-options-row type-of-template">
					<td class="sce-options-row-heading">
						<label for="ehf_template_type"><?php _e( 'Type of Template', 'softcoders-elements' ); ?></label>
					</td>
					<td class="sce-options-row-content">
						<select name="ehf_template_type" id="ehf_template_type">
							<option value="" <?php selected( $template_type, '' ); ?>><?php _e( 'Select Option', 'softcoders-elements' ); ?></option>
							<option value="type_header" <?php selected( $template_type, 'type_header' ); ?>><?php _e( 'Header', 'softcoders-elements' ); ?></option>
							<option value="type_before_footer" <?php selected( $template_type, 'type_before_footer' ); ?>><?php _e( 'Before Footer', 'softcoders-elements' ); ?></option>
							<option value="type_footer" <?php selected( $template_type, 'type_footer' ); ?>><?php _e( 'Footer', 'softcoders-elements' ); ?></option>
                            <option value="type_sidebar_canvas" <?php selected( $template_type, 'type_sidebar_canvas' ); ?>><?php _e( 'Sidebar Offcanvas', 'softcoders-elements' ); ?></option>
						</select>
					</td>
				</tr>

				<?php $this->display_rules_tab(); ?>
				<tr class="sce-options-row sce-shortcode">
					<td class="sce-options-row-heading">
						<label for="ehf_template_type"><?php _e( 'Shortcode', 'softcoders-elements' ); ?></label>
						<i class="sce-options-row-heading-help dashicons dashicons-editor-help" title="<?php _e( 'Copy this shortcode and paste it into your post, page, or text widget content.', 'softcoders-elements' ); ?>">
						</i>
					</td>
					<td class="sce-options-row-content">
						<span class="sce-shortcode-col-wrap">
							<input type="text" onfocus="this.select();" readonly="readonly" value="[softcoderselements_template id='<?php echo esc_attr( $post->ID ); ?>']" class="sce-large-text code">
						</span>
					</td>
				</tr>
				<tr class="sce-options-row enable-for-canvas">
					<td class="sce-options-row-heading">
						<label for="display-on-canvas-template">
							<?php _e( 'Enable Layout for Elementor Canvas Template?', 'softcoders-elements' ); ?>
						</label>
						<i class="sce-options-row-heading-help dashicons dashicons-editor-help" title="<?php _e( 'Enabling this option will display this layout on pages using Elementor Canvas Template.', 'softcoders-elements' ); ?>"></i>
					</td>
					<td class="sce-options-row-content">
						<input type="checkbox" id="display-on-canvas-template" name="display-on-canvas-template" value="1" <?php checked( $display_on_canvas, true ); ?> />
					</td>
				</tr>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Markup for Display Rules Tabs.
	 *
	 * @since  1.0.0
	 */
	public function display_rules_tab() {
		// Load Target Rule assets.
		softcoderselements_Target_Rules_Fields::get_instance()->admin_styles();

		$include_locations = get_post_meta( get_the_id(), 'ehf_target_include_locations', true );
		$exclude_locations = get_post_meta( get_the_id(), 'ehf_target_exclude_locations', true );
		$users             = get_post_meta( get_the_id(), 'ehf_target_user_roles', true );
		?>
		<tr class="bsf-target-rules-row sce-options-row">
			<td class="bsf-target-rules-row-heading sce-options-row-heading">
				<label><?php esc_html_e( 'Display On', 'softcoders-elements' ); ?></label>
				<i class="bsf-target-rules-heading-help dashicons dashicons-editor-help"
					title="<?php echo esc_attr__( 'Add locations for where this template should appear.', 'softcoders-elements' ); ?>"></i>
			</td>
			<td class="bsf-target-rules-row-content sce-options-row-content">
				<?php
				softcoderselements_Target_Rules_Fields::target_rule_settings_field(
					'bsf-target-rules-location',
					[
						'title'          => __( 'Display Rules', 'softcoders-elements' ),
						'value'          => '[{"type":"basic-global","specific":null}]',
						'tags'           => 'site,enable,target,pages',
						'rule_type'      => 'display',
						'add_rule_label' => __( 'Add Display Rule', 'softcoders-elements' ),
					],
					$include_locations
				);
				?>
			</td>
		</tr>
		<tr class="bsf-target-rules-row sce-options-row">
			<td class="bsf-target-rules-row-heading sce-options-row-heading">
				<label><?php esc_html_e( 'Do Not Display On', 'softcoders-elements' ); ?></label>
				<i class="bsf-target-rules-heading-help dashicons dashicons-editor-help"
					title="<?php echo esc_attr__( 'Add locations for where this template should not appear.', 'softcoders-elements' ); ?>"></i>
			</td>
			<td class="bsf-target-rules-row-content sce-options-row-content">
				<?php
				softcoderselements_Target_Rules_Fields::target_rule_settings_field(
					'bsf-target-rules-exclusion',
					[
						'title'          => __( 'Exclude On', 'softcoders-elements' ),
						'value'          => '[]',
						'tags'           => 'site,enable,target,pages',
						'add_rule_label' => __( 'Add Exclusion Rule', 'softcoders-elements' ),
						'rule_type'      => 'exclude',
					],
					$exclude_locations
				);
				?>
			</td>
		</tr>
		<tr class="bsf-target-rules-row sce-options-row">
			<td class="bsf-target-rules-row-heading sce-options-row-heading">
				<label><?php esc_html_e( 'User Roles', 'softcoders-elements' ); ?></label>
				<i class="bsf-target-rules-heading-help dashicons dashicons-editor-help" title="<?php echo esc_attr__( 'Display custom template based on user role.', 'softcoders-elements' ); ?>"></i>
			</td>
			<td class="bsf-target-rules-row-content sce-options-row-content">
				<?php
				softcoderselements_Target_Rules_Fields::target_user_role_settings_field(
					'bsf-target-rules-users',
					[
						'title'          => __( 'Users', 'softcoders-elements' ),
						'value'          => '[]',
						'tags'           => 'site,enable,target,pages',
						'add_rule_label' => __( 'Add User Rule', 'softcoders-elements' ),
					],
					$users
				);
				?>
			</td>
		</tr>
		<?php
	}

	/**
	 * Save meta field.
	 *
	 * @param  POST $post_id Currennt post object which is being displayed.
	 *
	 * @return Void
	 */
	public function ehf_save_meta( $post_id ) {

		// Bail if we're doing an auto save.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// if our nonce isn't there, or we can't verify it, bail.
		if ( ! isset( $_POST['ehf_meta_nounce'] ) || ! wp_verify_nonce( $_POST['ehf_meta_nounce'], 'ehf_meta_nounce' ) ) {
			return;
		}

		// if our current user can't edit this post, bail.
		if ( ! current_user_can( 'edit_posts' ) ) {
			return;
		}

		$target_locations = softcoderselements_Target_Rules_Fields::get_format_rule_value( $_POST, 'bsf-target-rules-location' );
		$target_exclusion = softcoderselements_Target_Rules_Fields::get_format_rule_value( $_POST, 'bsf-target-rules-exclusion' );
		$target_users     = [];

		if ( isset( $_POST['bsf-target-rules-users'] ) ) {
			$target_users = array_map( 'sanitize_text_field', $_POST['bsf-target-rules-users'] );
		}

		update_post_meta( $post_id, 'ehf_target_include_locations', $target_locations );
		update_post_meta( $post_id, 'ehf_target_exclude_locations', $target_exclusion );
		update_post_meta( $post_id, 'ehf_target_user_roles', $target_users );

		if ( isset( $_POST['ehf_template_type'] ) ) {
			update_post_meta( $post_id, 'ehf_template_type', esc_attr( $_POST['ehf_template_type'] ) );
		}

		if ( isset( $_POST['display-on-canvas-template'] ) ) {
			update_post_meta( $post_id, 'display-on-canvas-template', esc_attr( $_POST['display-on-canvas-template'] ) );
		} else {
			delete_post_meta( $post_id, 'display-on-canvas-template' );
		}
	}

	/**
	 * Display notice when editing the header or footer when there is one more of similar layout is active on the site.
	 *
	 * @since 1.0.0
	 */
	public function location_notice() {
		global $pagenow;
		global $post;

		if ( 'post.php' != $pagenow || ! is_object( $post ) || 'elementor-hf' != $post->post_type ) {
			return;
		}

		$template_type = get_post_meta( $post->ID, 'ehf_template_type', true );

		if ( '' !== $template_type ) {
			$templates = Header_Footer_Elementor::get_template_id( $template_type );

			// Check if more than one template is selected for current template type.
			if ( is_array( $templates ) && isset( $templates[1] ) && $post->ID != $templates[0] ) {
				$post_title        = '<strong>' . get_the_title( $templates[0] ) . '</strong>';
				$template_location = '<strong>' . $this->template_location( $template_type ) . '</strong>';
				/* Translators: Post title, Template Location */
				$message = sprintf( __( 'Template %1$s is already assigned to the location %2$s', 'softcoders-elements' ), $post_title, $template_location );

				echo '<div class="error"><p>';
				echo $message;
				echo '</p></div>';
			}
		}
	}

	/**
	 * Convert the Template name to be added in the notice.
	 *
	 * @since  1.0.0
	 *
	 * @param  String $template_type Template type name.
	 *
	 * @return String $template_type Template type name.
	 */
	public function template_location( $template_type ) {
		$template_type = ucfirst( str_replace( 'type_', '', $template_type ) );

		return $template_type;
	}

	/**
	 * Don't display the elementor Elementor Header & Footer Builder templates on the frontend for non edit_posts capable users.
	 *
	 * @since  1.0.0
	 */
	public function block_template_frontend() {
		if ( is_singular( 'elementor-hf' ) && ! current_user_can( 'edit_posts' ) ) {
			wp_redirect( site_url(), 301 );
			die;
		}
	}

	/**
	 * Single template function which will choose our template
	 *
	 * @since  1.0.1
	 *
	 * @param  String $single_template Single template.
	 */
	function load_canvas_template( $single_template ) {
		global $post;

		if ( 'elementor-hf' == $post->post_type ) {
			$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

			if ( file_exists( $elementor_2_0_canvas ) ) {
				return $elementor_2_0_canvas;
			} else {
				return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
			}
		}

		return $single_template;
	}

	/**
	 * Set shortcode column for template list.
	 *
	 * @param array $columns template list columns.
	 */
	function set_shortcode_columns( $columns ) {
		$date_column = $columns['date'];

		unset( $columns['date'] );

		$columns['shortcode'] = __( 'Shortcode', 'softcoders-elements' );
		$columns['date']      = $date_column;

		return $columns;
	}

	/**
	 * Display shortcode in template list column.
	 *
	 * @param array $column template list column.
	 * @param int   $post_id post id.
	 */
	function render_shortcode_column( $column, $post_id ) {
		switch ( $column ) {
			case 'shortcode':
				ob_start();
				?>
				<span class="sce-shortcode-col-wrap">
					<input type="text" onfocus="this.select();" readonly="readonly" value="[softcoderselements_template id='<?php echo esc_attr( $post_id ); ?>']" class="sce-large-text code">
				</span>

				<?php

				ob_get_contents();
				break;
		}
	}
}

socoders_elements_Admin::instance();
