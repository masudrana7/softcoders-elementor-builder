<?php
/**
 * Plugin AJAX functions.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'socoders_elements_Addons_Actions' ) ) {

	/**
	 * Initialization
	 *
	 * @since 1.0.0
	 */
	class socoders_elements_Addons_Actions {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {
			add_action( 'wp_ajax_socoders_elements_admin_modal', [ $this, 'socoders_elements_admin_modal' ] );
			add_action( 'wp_ajax_sce-update-subscription', [ $this, 'update_subscription' ] );
			add_action( 'wp_ajax_socoders_elements_activate_addon', [ $this, 'socoders_elements_activate_addon' ] );
		}

		/**
		 * Open modal popup.
		 *
		 * @since 1.6.0
		 */
		public function socoders_elements_admin_modal() {

			// Run a security check.
			check_ajax_referer( 'sce-admin-nonce', 'nonce' );

			update_user_meta( get_current_user_id(), 'sce-popup', 'dismissed' );
		}

		/**
		 * Update Subscription
		 *
		 * @since 1.6.0
		 */
		public function update_subscription() {

			check_ajax_referer( 'sce-admin-nonce', 'nonce' );

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_send_json_error( 'You can\'t perform this action.' );
			}

			$api_domain = trailingslashit( $this->get_api_domain() );

			$arguments = isset( $_POST['data'] ) ? array_map( 'sanitize_text_field', json_decode( stripslashes( $_POST['data'] ), true ) ) : [];

			$url = add_query_arg( $arguments, $api_domain . 'wp-json/starter-templates/v1/subscribe/' ); // add URL of your site or mail API.

			$response = wp_remote_post( $url, [ 'timeout' => 60 ] );

			if ( ! is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 200 ) {
				$response = json_decode( wp_remote_retrieve_body( $response ), true );

				// Successfully subscribed.
				if ( isset( $response['success'] ) && $response['success'] ) {
					update_user_meta( get_current_user_ID(), 'sce-subscribed', 'yes' );
					wp_send_json_success( $response );
				}
			} else {
				wp_send_json_error( $response );
			}

		}

		/**
		 * Get the API URL.
		 *
		 * @since 1.6.0
		 */
		public function get_api_domain() {
			return apply_filters( 'socoders_elements_api_domain', 'https://themeforest.net/user/SoftCoders/portfolio/' );
		}

		/**
		 * Activate addon.
		 *
		 * @since 1.6.0
		 */
		public function socoders_elements_activate_addon() {

			// Run a security check.
			check_ajax_referer( 'sce-admin-nonce', 'nonce' );

			if ( isset( $_POST['plugin'] ) ) {

				$type = '';
				if ( ! empty( $_POST['type'] ) ) {
					$type = sanitize_key( wp_unslash( $_POST['type'] ) );
				}

				$plugin = sanitize_text_field( $_POST['plugin'] );

				if ( 'plugin' === $type ) {

					// Check for permissions.
					if ( ! current_user_can( 'activate_plugins' ) ) {
						wp_send_json_error( esc_html__( 'Plugin activation is disabled for you on this site.', 'SoftCoders-header-footer-elementor' ) );
					}

					$activate = activate_plugins( $plugin );

					if ( ! is_wp_error( $activate ) ) {

						do_action( 'socoders_elements_plugin_activated', $plugin );

						wp_send_json_success( esc_html__( 'Plugin Activated.', 'SoftCoders-header-footer-elementor' ) );
					}
				}

				if ( 'theme' === $type ) {

					$slug = sanitize_key( wp_unslash( $_POST['slug'] ) );

					// Check for permissions.
					if ( ! ( current_user_can( 'switch_themes' ) ) ) {
						wp_send_json_error( esc_html__( 'Theme activation is disabled for you on this site.', 'SoftCoders-header-footer-elementor' ) );
					}

					$activate = switch_theme( $slug );

					if ( ! is_wp_error( $activate ) ) {

						do_action( 'socoders_elements_theme_activated', $plugin );

						wp_send_json_success( esc_html__( 'Theme Activated.', 'SoftCoders-header-footer-elementor' ) );
					}
				}
			}

			if ( 'plugin' === $type ) {
				wp_send_json_error( esc_html__( 'Could not activate plugin. Please activate from the Plugins page.', 'SoftCoders-header-footer-elementor' ) );
			} elseif ( 'theme' === $type ) {
				wp_send_json_error( esc_html__( 'Could not activate theme. Please activate from the Themes page.', 'SoftCoders-header-footer-elementor' ) );
			}
		}

	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	socoders_elements_Addons_Actions::get_instance();

}

