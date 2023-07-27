<?php
/**
 * @author  UiGigs
 * @since   1.0
 * @version 1.0
 */

class Post_Widget extends \WP_Widget {
	public function __construct() {
		$id = softcoderselements_PREFIX . '_post';
		parent::__construct(
            $id, // Base ID
            esc_html__( 'A3: Posts', 'spria-core' ), // Name
            array( 'description' => esc_html__( 'spria: Posts Widget', 'spria-core' )
        ) );
	}

	public function widget( $args, $instance ){
		echo wp_kses_post( $args['before_widget'] );

		if ( !empty( $instance['title'] ) ) {
			$html = apply_filters( 'widget_title', $instance['title'] );
			$html = $args['before_title'] . $html .$args['after_title'];
		}
		else {
			$html = '';
		}

      	if (!empty($instance['layout'])) {
        	$layout = $instance['layout'];
      	} else {
        	$layout = '';
      	} 
		$q_args = array(
			'cat'                 => (int) $instance['cat'],
			'orderby'             => $instance['orderby'],
			'posts_per_page'      => $instance['number'],
			'ignore_sticky_posts' => true,
		);

		switch ( $instance['orderby'] ){
			case 'title':
			case 'menu_order':
			$q_args['order'] = 'ASC';
			break;
		}

		$query = new \WP_Query( $q_args );
		?>
		<?php if ( $query->have_posts() ) 
		:?>
            <div class="post-item sc-mb-35">
                <?php echo wp_kses_stripslashes( $html ); ?>
					<?php while ( $query->have_posts() ) : $query->the_post();
    					$post_date = get_the_date( 'd M Y' );
    					?>
                        <div class="recent-content d-flex align-items-center sc-mb-13">
                            <?php if ( $layout == 2 && has_post_thumbnail() ) { ?>
                            <div class="recent-image">
                                <?php the_post_thumbnail( 'spria_small' ); ?>
                            </div>
                            <?php } ?>

                            <div class="recent-text sc-pl-20">
                                <h5>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h5>

                                <div class="calender-item">
                                    <i class="ri-calendar-fill"></i>
                                    <span><?php echo $post_date; ?></span>
                                </div>
                            </div>
                        </div>
					<?php endwhile;?>
	        </div>
		<?php else: ?>
			<div><?php esc_html_e( 'Currently there are no posts to display', 'spria-core' ); ?></div>
		<?php endif;?>
		<?php wp_reset_postdata();?>
		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ){
		$instance             = array();
		$instance['title']    = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['cat']      = ( ! empty( $new_instance['cat'] ) ) ? sanitize_text_field( $new_instance['cat'] ) : '';
		$instance['orderby']  = ( ! empty( $new_instance['orderby'] ) ) ? sanitize_text_field( $new_instance['orderby'] ) : '';
		$instance['number']   = ( ! empty( $new_instance['number'] ) ) ? sanitize_text_field( $new_instance['number'] ) : '';
		$instance['layout']   = ( ! empty( $new_instance['layout'] ) ) ? sanitize_text_field( $new_instance['layout'] ) : '';
		return $instance;
	}

	public function form( $instance ){
		$defaults = array(

			'title'   => '',
			'cat'     => '0',
			'orderby' => '',
			'number'  => '4',
			'layout'  => '1',

		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$categories = get_categories();
		$category_dropdown = array( '0' => esc_html__( 'All Categories', 'spria-core' ) );

		foreach ( $categories as $category ) {
			$category_dropdown[$category->term_id] = $category->name;
		}

		$orderby = array(
			'date'        => esc_html__( 'Date (Recents comes first)', 'spria-core' ),
			'title'       => esc_html__( 'Title', 'spria-core' ),
			'menu_order'  => esc_html__( 'Custom Order (Available via Order field inside Page Attributes box)', 'spria-core' ),
		);

		$fields = array(
			'title'       => array(
				'label'   => esc_html__( 'Title', 'spria-core' ),
				'type'    => 'text',
			),
			'cat'        => array(
				'label'   => esc_html__( 'Category', 'spria-core' ),
				'type'    => 'select',
				'options' => $category_dropdown,
			),
			'orderby' => array(
				'label'   => esc_html__( 'Order by', 'spria-core' ),
				'type'    => 'select',
				'options' => $orderby,
			),
			'number' => array(
				'label'   => esc_html__( 'Number of Post', 'spria-core' ),
				'type'    => 'number',
			),
			'layout'      => array(
				'label'   => esc_html__( 'Thumbnail Image', 'spria-core' ),
				'type'    => 'select',
				'options' => array(
					'1' => esc_html__( 'Without Thumbnail', 'spria-core' ),
					'2' => esc_html__( 'With Thumbnail', 'spria-core' ),
				),
			),
		);
		spria_Widget_Fields::display( $fields, $instance, $this );
	}
}
