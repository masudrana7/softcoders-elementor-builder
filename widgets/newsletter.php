<?php
/**
 * @author  UiGigs
 * @since   1.0
 * @version 1.0
 */
class Newsletter_Widget extends \WP_Widget {
	public function __construct() {
		$id = softcoderselements_PREFIX . '_newsletter';
		parent::__construct(
            $id, // Base ID
            esc_html__( 'A2: Newsletter', 'spria-core' ), // Name
            array( 'description' => esc_html__( 'spria: Newsletter Widget', 'spria-core' )
        ) );
	}

	public function widget( $args, $instance ){
		if ( !empty( $instance['title'] ) ) {
			$html = apply_filters( 'widget_title', $instance['title'] );
			$html = $args['before_title'] . $html .$args['after_title'];
		}
		else {
			$html = '';
		}
	    $desc = $instance['desc'];
	    $form = $instance['form'];
	    
	    echo wp_kses_post( $args['before_widget'] );
	    ?>

        <?php echo wp_kses_stripslashes( $html ); ?>
        <?php if (!empty( $desc )) { ?>
        	<div class="desc"><?php echo $desc; ?></div>
    	<?php } ?>
        <div class="newsletter-wrapper">
            <?php echo do_shortcode( $form ); ?>
        </div>
        
        <?php
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ){
		$instance          = array();

		$instance['title']  = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['desc'] = ( ! empty( $new_instance['desc'] ) ) ? wp_kses_post( $new_instance['desc'] ) : '';
		$instance['form'] = ( ! empty( $new_instance['form'] ) ) ? wp_kses_post( $new_instance['form'] ) : '';

		return $instance;
	}

	public function form( $instance ){
		$defaults = array(
			'title' => '',
			'desc'  => '',
			'form'  => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = array(
			'title'       => array(
				'label'   => esc_html__( 'Title', 'spria-core' ),
				'type'    => 'text',
			),
			'desc'       => array(
				'label'   => esc_html__( 'Description', 'spria-core' ),
				'type'    => 'textarea',
			),
			'form' => array(
				'label'   => esc_html__( 'Form Shortcode', 'spria-core' ),
				'type'    => 'textarea',
			),
		);

		spria_Widget_Fields::display( $fields, $instance, $this );
	}
}
