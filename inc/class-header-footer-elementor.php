<?php
use HFE\Lib\softcoderselements_Target_Rules_Fields;

class Header_Footer_Elementor {
	/**
	 * Current theme template
	 *
	 * @var String
	 */
	public $template;

	/**
	 * Instance of Elemenntor Frontend class.
	 */
	private static $elementor_instance;

	/**
	 * Instance of socoders_elements_Admin
	 *
	 * @var Header_Footer_Elementor
	 */
	private static $_instance = null;

	/**
	 * Instance of Header_Footer_Elementor
	 *
	 * @return Header_Footer_Elementor Instance of Header_Footer_Elementor
	 */
	public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}
	/**
	 * Constructor
	 */
	function __construct() {
		$this->template = get_template();

		$is_elementor_callable = ( defined( 'ELEMENTOR_VERSION' ) && is_callable( 'Elementor\Plugin::instance' ) ) ? true : false;

		$required_elementor_version = '3.5.0';

		$is_elementor_outdated = ( $is_elementor_callable && ( ! version_compare( ELEMENTOR_VERSION, $required_elementor_version, '>=' ) ) ) ? true : false;

		if ( ( ! $is_elementor_callable ) || $is_elementor_outdated ) {
			$this->elementor_not_available( $is_elementor_callable, $is_elementor_outdated );
		}

		if ( $is_elementor_callable ) {
			self::$elementor_instance = Elementor\Plugin::instance();

			$this->includes();
			$this->load_textdomain();


			add_filter( 'socoders_elements_settings_tabs', [ $this, 'setup_unsupported_theme' ] );
			add_action( 'init', [ $this, 'setup_fallback_support' ] );

			if ( 'yes' === get_option( 'socoders_elements_plugin_is_activated' ) ) {
				add_action( 'admin_init', [ $this, 'show_setup_wizard' ] );
			}

			// Scripts and styles.
			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

			add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );

			add_filter( 'body_class', [ $this, 'body_class' ] );
			add_action( 'switch_theme', [ $this, 'reset_unsupported_theme_notice' ] );

			add_shortcode( 'socoders_elements_template', [ $this, 'render_template' ] );

			//add_action( 'astra_notice_before_markup_header-footer-elementor-rating', [ $this, 'rating_notice_css' ] );
		}

	}

	/**
	 * Reset the Unsupported theme nnotice after a theme is switched.
	 *
	 * @since 1.0.16
	 *
	 * @return void
	 */
	public function reset_unsupported_theme_notice() {
		delete_user_meta( get_current_user_id(), 'unsupported-theme' );
	}

	/**
	 * Prints the admin notics when Elementor is not installed or activated or version outdated.
	 *
	 * @param  boolean $is_elementor_callable specifies if elementor is available.
	 * @param  boolean $is_elementor_outdated specifies if elementor version is old.
	 */
	public function elementor_not_available( $is_elementor_callable, $is_elementor_outdated ) {

		if ( ( ! did_action( 'elementor/loaded' ) ) || ( ! $is_elementor_callable ) ) {
			add_action( 'admin_notices', [ $this, 'elementor_not_installed_activated' ] );
			add_action( 'network_admin_notices', [ $this, 'elementor_not_installed_activated' ] );
			return;
		}

		if ( $is_elementor_outdated ) {
			add_action( 'admin_notices', [ $this, 'elementor_outdated' ] );
			add_action( 'network_admin_notices', [ $this, 'elementor_outdated' ] );
			return;
		}

	}

	/**
	 * Prints the admin notics when Elementor is not installed or activated.
	 */
	public function elementor_not_installed_activated() {

		$screen = get_current_screen();
		if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
			return;
		}

		if ( ! did_action( 'elementor/loaded' ) ) {
			// Check user capability.
			if ( ! ( current_user_can( 'activate_plugins' ) && current_user_can( 'install_plugins' ) ) ) {
				return;
			}

			/* TO DO */
			$class = 'notice notice-error';
			/* translators: %s: html tags */
			$message = sprintf( __( 'The %1$sElementor Header & Footer Builder%2$s plugin requires %1$sElementor%2$s plugin installed & activated.', 'SoftCoders-header-footer-elementor' ), '<strong>', '</strong>' );

			$plugin = 'elementor/elementor.php';

			if ( _is_elementor_installed() ) {

				$action_url   = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
				$button_label = __( 'Activate Elementor', 'SoftCoders-header-footer-elementor' );

			} else {

				$action_url   = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
				$button_label = __( 'Install Elementor', 'SoftCoders-header-footer-elementor' );
			}

			$button = '<p><a href="' . esc_url( $action_url ) . '" class="button-primary">' . esc_html( $button_label ) . '</a></p><p></p>';

			printf( '<div class="%1$s"><p>%2$s</p>%3$s</div>', esc_attr( $class ), wp_kses_post( $message ), wp_kses_post( $button ) );
		}
	}

	/**
	 * Prints the admin notics when Elementor version is outdated.
	 */
	public function elementor_outdated() {

		// Check user capability.
		if ( ! ( current_user_can( 'activate_plugins' ) && current_user_can( 'install_plugins' ) ) ) {
			return;
		}

		/* TO DO */
		$class = 'notice notice-error';
		/* translators: %s: html tags */
		$message = sprintf( __( 'The %1$sElementor Header & Footer Builder%2$s plugin has stopped working because you are using an older version of %1$sElementor%2$s plugin.', 'SoftCoders-header-footer-elementor' ), '<strong>', '</strong>' );

		$plugin = 'elementor/elementor.php';

		if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {

			$action_url   = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&amp;plugin=' ) . $plugin . '&amp;', 'upgrade-plugin_' . $plugin );
			$button_label = __( 'Update Elementor', 'SoftCoders-header-footer-elementor' );

		} else {

			$action_url   = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
			$button_label = __( 'Install Elementor', 'SoftCoders-header-footer-elementor' );
		}

		$button = '<p><a href="' . esc_url( $action_url ) . '" class="button-primary">' . esc_html( $button_label ) . '</a></p><p></p>';

		printf( '<div class="%1$s"><p>%2$s</p>%3$s</div>', esc_attr( $class ), wp_kses_post( $message ), wp_kses_post( $button ) );
	}

	/**
	 * Prints the admin notics when Elementor is not installed or activated.
	 */
	public function show_setup_wizard() {

		$screen    = get_current_screen();
		$screen_id = $screen ? $screen->id : '';

		if ( 'plugins' !== $screen_id ) {
			return;
		}

		/* TO DO */
		$class       = 'notice notice-info is-dismissible';
		$setting_url = admin_url( 'edit.php?post_type=elementor-hf' );

		/* translators: %s: html tags */
		$notice_message = sprintf( __( 'Thank you for installing %1$s Elementor Header & Footer Builder %2$s Plugin! Click here to %3$sget started. %4$s', 'SoftCoders-header-footer-elementor' ), '<strong>', '</strong>', '<a href="' . $setting_url . '">', '</a>' );
	}

	/**
	 * Loads the globally required files for the plugin.
	 */
	public function includes() {
		require_once softcoderselements_DIR . 'admin/class-softcoderselements-admin.php';
		require_once softcoderselements_DIR . 'admin/class-softcoderselements-settings.php';
		require_once softcoderselements_DIR . 'admin/softcoader-header-footer-setting.php';

		require_once softcoderselements_DIR . 'inc/softcoderselements-functions.php';

		// Load Elementor Canvas Compatibility.
		require_once softcoderselements_DIR . 'inc/class-sce-elementor-canvas-compat.php';

		// Load Target rules.
		require_once softcoderselements_DIR . 'inc/lib/target-rule/class-softcoderstarget-rules-fields.php';

		// Load the widgets.
		require softcoderselements_DIR . 'inc/widgets-manager/class-widgets-loader.php';
	}

	/**
	 * Loads textdomain for the plugin.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'SoftCoders-header-footer-elementor' );
	}

	/**
	 * Enqueue styles and scripts.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'sce-style', softcoderselements_URL . 'assets/css/header-footer-elementor.css', [], softcoderselements_VER );

		if ( class_exists( '\Elementor\Plugin' ) ) {
			$elementor = \Elementor\Plugin::instance();
			$elementor->frontend->enqueue_styles();
		}

		if ( class_exists( '\ElementorPro\Plugin' ) ) {
			$elementor_pro = \ElementorPro\Plugin::instance();
			$elementor_pro->enqueue_styles();
		}

		if ( socoders_elements_header_enabled() ) {
			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
				$css_file = new \Elementor\Core\Files\CSS\Post( get_socoders_elements_header_id() );
			} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
				$css_file = new \Elementor\Post_CSS_File( get_socoders_elements_header_id() );
			}

			$css_file->enqueue();
		}

		if ( socoders_elements_footer_enabled() ) {
			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
				$css_file = new \Elementor\Core\Files\CSS\Post( get_socoders_elements_footer_id() );
			} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
				$css_file = new \Elementor\Post_CSS_File( get_socoders_elements_footer_id() );
			}

			$css_file->enqueue();
		}

		if ( socoders_elements_is_before_footer_enabled() ) {
			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
				$css_file = new \Elementor\Core\Files\CSS\Post( socoders_elements_get_before_footer_id() );
			} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
				$css_file = new \Elementor\Post_CSS_File( socoders_elements_get_before_footer_id() );
			}
			$css_file->enqueue();
		}

		if ( socoders_elements_is_sidebar_canvas_enabled() ) {
			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
				$css_file = new \Elementor\Core\Files\CSS\Post( socoders_elements_get_sidebar_canvas_id() );
			} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
				$css_file = new \Elementor\Post_CSS_File( socoders_elements_get_sidebar_canvas_id() );
			}
			$css_file->enqueue();
		}
	}

	/**
	 * Load admin styles on header footer elementor edit screen.
	 */
	public function enqueue_admin_scripts() {
		global $pagenow;
		$screen = get_current_screen();

		if ( ( 'elementor-hf' == $screen->id && ( 'post.php' == $pagenow || 'post-new.php' == $pagenow ) ) || ( 'edit.php' == $pagenow && 'edit-elementor-hf' == $screen->id ) ) {

			wp_enqueue_style( 'sce-admin-style', softcoderselements_URL . 'admin/assets/css/ehf-admin.css', [], softcoderselements_VER );
			wp_enqueue_script( 'sce-admin-script', softcoderselements_URL . 'admin/assets/js/ehf-admin.js', [ 'jquery', 'updates' ], softcoderselements_VER, true );

		}
	}

	/**
	 * Adds classes to the body tag conditionally.
	 *
	 * @param  Array $classes array with class names for the body tag.
	 *
	 * @return Array          array with class names for the body tag.
	 */
	public function body_class( $classes ) {
		if ( socoders_elements_header_enabled() ) {
			$classes[] = 'ehf-header';
		}

		if ( socoders_elements_footer_enabled() ) {
			$classes[] = 'ehf-footer';
		}

		$classes[] = 'ehf-template-' . $this->template;
		$classes[] = 'ehf-stylesheet-' . get_stylesheet();

		return $classes;
	}

	/**
	 * Display Settings Page options
	 *
	 * @since 1.6.0
	 */


	/**
	 * Display Unsupported theme notice if the current theme does add support for 'header-footer-elementor'
	 *
	 * @param array $socoders_elements_settings_tabs settings array tabs.
	 */
	public function setup_unsupported_theme( $socoders_elements_settings_tabs = [] ) {
		if ( ! current_theme_supports( 'SoftCoders-header-footer-elementor' ) ) {
			$socoders_elements_settings_tabs['socoders_elements_settings'] = [
				'name' => __( 'Theme Support', 'SoftCoders-header-footer-elementor' ),
				'url'  => admin_url( 'themes.php?page=sce-settings' ),
			];
		}
		return $socoders_elements_settings_tabs;
	}

	/**
	 * Add support for theme if the current theme does add support for 'header-footer-elementor'
	 */
	public function setup_fallback_support() {

		if ( ! current_theme_supports( 'SoftCoders-header-footer-elementor' ) ) {
			$socoders_elements_compatibility_option = get_option( 'socoders_elements_compatibility_option', '1' );

			if ( '1' === $socoders_elements_compatibility_option ) {
				if ( ! class_exists( 'socoders_elements_Default_Compat' ) ) {
					require_once softcoderselements_DIR . 'themes/default/class-sce-default-compat.php';
				}
			} elseif ( '2' === $socoders_elements_compatibility_option ) {
				require softcoderselements_DIR . 'themes/default/class-global-theme-compatibility.php';
			}
		}
	}

	/**
	 * Prints the Header content.
	 */
	public static function get_header_content() {
		echo self::$elementor_instance->frontend->get_builder_content_for_display( get_socoders_elements_header_id() );
	}

	/**
	 * Prints the Footer content.
	 */
	public static function get_footer_content() {
		echo "<div class='footer-width-fixer'>";
		echo self::$elementor_instance->frontend->get_builder_content_for_display( get_socoders_elements_footer_id() );
		echo '</div>';
	}

	/**
	 * Prints the Before Footer content.
	 */
	public static function get_before_footer_content() {
		echo "<div class='footer-width-fixer'>";
		echo self::$elementor_instance->frontend->get_builder_content_for_display( socoders_elements_get_before_footer_id() );
		echo '</div>';
	}

	/**
	 * Prints the Before Footer content.
	 */
	public static function get_sidebar_canvas_content() {
		echo "<div class='sc-canvas-area'>";
		echo self::$elementor_instance->frontend->get_builder_content_for_display( socoders_elements_get_sidebar_canvas_id() );
		echo '</div>';
	}

	/**
	 * Get option for the plugin settings
	 *
	 * @param  mixed $setting Option name.
	 * @param  mixed $default Default value to be received if the option value is not stored in the option.
	 *
	 * @return mixed.
	 */
	public static function get_settings( $setting = '', $default = '' ) {
		if ( 'type_header' == $setting || 'type_footer' == $setting || 'type_before_footer' == $setting || 'type_sidebar_canvas' == $setting ) {
			$templates = self::get_template_id( $setting );

			$template = ! is_array( $templates ) ? $templates : $templates[0];

			$template = apply_filters( "socoders_elements_get_settings_{$setting}", $template );

			return $template;
		}
	}

	/**
	 * Get header or footer template id based on the meta query.
	 *
	 * @param  String $type Type of the template header/footer.
	 *
	 * @return Mixed       Returns the header or footer template id if found, else returns string ''.
	 */
	public static function get_template_id( $type ) {
		$option = [
			'location'  => 'ehf_target_include_locations',
			'exclusion' => 'ehf_target_exclude_locations',
			'users'     => 'ehf_target_user_roles',
		];

		$socoders_elements_templates = softcoderselements_Target_Rules_Fields::get_instance()->get_posts_by_conditions( 'elementor-hf', $option );

		foreach ( $socoders_elements_templates as $template ) {
			if ( get_post_meta( absint( $template['id'] ), 'ehf_template_type', true ) === $type ) {
				return $template['id'];
			}
		}

		return '';
	}

	/**
	 * Callback to shortcode.
	 *
	 * @param array $atts attributes for shortcode.
	 */
	public function render_template( $atts ) {
		$atts = shortcode_atts(
			[
				'id' => '',
			],
			$atts,
			'softcoderselements_template'
		);

		$id = ! empty( $atts['id'] ) ? apply_filters( 'socoders_elements_render_template_id', intval( $atts['id'] ) ) : '';

		if ( empty( $id ) ) {
			return '';
		}

		if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
			$css_file = new \Elementor\Core\Files\CSS\Post( $id );
		} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
			// Load elementor styles.
			$css_file = new \Elementor\Post_CSS_File( $id );
		}
			$css_file->enqueue();

		return self::$elementor_instance->frontend->get_builder_content_for_display( $id );
	}

}
/**
 * Is elementor plugin installed.
 */
if ( ! function_exists( '_is_elementor_installed' ) ) {

	/**
	 * Check if Elementor is installed
	 *
	 * @access public
	 */
	function _is_elementor_installed() {
		return ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) ? true : false;
	}
}
