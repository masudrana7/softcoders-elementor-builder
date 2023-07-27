

<?php
/**
 * @author  UiGigs
 * @since   1.0
 * @version 1.0
 */

class About_Widget extends \WP_Widget {
	public function __construct() {
		$id = softcoderselements_PREFIX . '_about';
		parent::__construct(
            $id, // Base ID
            esc_html__( 'A1: About', 'spria-core' ), // Name
            array( 'description' => esc_html__( 'spria: About Widget', 'spria-core' )
        ) );
	}

	public function widget( $args, $instance ){

		echo wp_kses_post( $args['before_widget'] );

		$title = $instance['title'];
		$logo  = wp_get_attachment_image( $instance['logo'], 'full' );
		$desc  = $instance['desc'];
		?>
		
		<?php if (!empty($logo)) { ?>
			<a href="<?php echo esc_url( home_url('/') ); ?>" class="footer-logo img-logo">
				<?php echo $logo; ?>
			</a>
		<?php } elseif (!empty($title)) { ?>
			<a href="<?php echo esc_url( home_url('/') ); ?>" class="footer-logo text-logo">
				<?php echo $title; ?>
			</a>
		<?php } if (!empty($desc)) { ?>
			<div class="description"><?php echo $desc; ?></div>
		<?php } ?>

		<?php 
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ){
		$instance          = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['logo']  = ( ! empty( $new_instance['logo'] ) ) ? sanitize_text_field( $new_instance['logo'] ) : '';
		$instance['desc'] = ( ! empty( $new_instance['desc'] ) ) ? sanitize_text_field( $new_instance['desc'] ) : '';

		return $instance;
	}

	public function form( $instance ){
		$defaults = array(
			'title' => '',
			'logo'  => '',
			'desc'  => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = array(
			'title'       => array(
				'label'   => esc_html__( 'Title', 'spria-core' ),
				'type'    => 'text',
			),
			'logo'       => array(
				'label'   => esc_html__( 'Logo Image', 'spria-core' ),
				'type'    => 'image',
			),
			'desc'        => array(
				'label'   => esc_html__( 'Description', 'spria-core' ),
				'type'    => 'textarea',
			),
		);

		spria_Widget_Fields::display( $fields, $instance, $this );
	}
}
