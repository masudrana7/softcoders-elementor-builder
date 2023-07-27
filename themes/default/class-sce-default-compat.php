<?php
/**
 * socoders_elements_Default_Compat setup
 */

namespace HFE\Themes;

/**
 * theme compatibility.
 */
class socoders_elements_Default_Compat {

	/**
	 *  Initiator
	 */
	public function __construct() {
		add_action( 'wp', [ $this, 'hooks' ] );
	}

	/**
	 * Run all the Actions / Filters.
	 */
	public function hooks() {
		if ( socoders_elements_header_enabled() || socoders_elements_is_sidebar_canvas_enabled() ) {
			// Replace header.php template.
			add_action( 'get_header', [ $this, 'override_header' ] );
		}
		
		if ( socoders_elements_header_enabled() ) {
			// Display HFE's header in the replaced header.
			add_action( 'socoders_elements_header', 'socoders_elements_render_header' );
		}

		if ( socoders_elements_is_sidebar_canvas_enabled() ) {
			add_action( 'socoders_elements_sidebar_canvas', [ 'Header_Footer_Elementor', 'get_sidebar_canvas_content' ] );
		}

		if ( socoders_elements_footer_enabled() || socoders_elements_is_before_footer_enabled() ) {
			// Replace footer.php template.
			add_action( 'get_footer', [ $this, 'override_footer' ] );
		}

		if ( socoders_elements_footer_enabled() ) {
			// Display HFE's footer in the replaced header.
			add_action( 'socoders_elements_footer', 'socoders_elements_render_footer' );
		}

		if ( socoders_elements_is_before_footer_enabled() ) {
			add_action( 'socoders_elements_footer_before', [ 'Header_Footer_Elementor', 'get_before_footer_content' ] );
		}
	}

	/**
	 * Function for overriding the header in the elmentor way.
	 *
	 * @since 1.2.0
	 *
	 * @return void
	 */
	public function override_header() {
		require softcoderselements_DIR . 'themes/default/sce-header.php';
		$templates   = [];
		$templates[] = 'header.php';
		// Avoid running wp_head hooks again.
		remove_all_actions( 'wp_head' );
		ob_start();
		locate_template( $templates, true );
		ob_get_clean();
	}

	/**
	 * Function for overriding the footer in the elmentor way.
	 *
	 * @since 1.2.0
	 *
	 * @return void
	 */
	public function override_footer() {
		require softcoderselements_DIR . 'themes/default/sce-footer.php';
		$templates   = [];
		$templates[] = 'footer.php';
		// Avoid running wp_footer hooks again.
		remove_all_actions( 'wp_footer' );
		ob_start();
		locate_template( $templates, true );
		ob_get_clean();
	}

}

new socoders_elements_Default_Compat();
