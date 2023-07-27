<?php
/**
 * @author  UiGigs
 * @since   1.0
 * @version 1.0
 */

class Custom_Widgets_Init {

	public $widgets;
	protected static $instance = null;
	public function __construct() {
		$sidebar_widgets = array(
			'post'     	  => 'Post_Widget',
		);
		$footer_widgets = array(
			'about'    	 => 'About_Widget',
			'newsletter' => 'Newsletter_Widget',
		);
		$this->widgets = array_merge( $sidebar_widgets, $footer_widgets );

		add_action( 'widgets_init', array( $this, 'custom_widgets' ) );
		add_action( 'widgets_init', array( $this, 'spria_event_widgets' ), 100 );
		add_filter( 'widget_form_callback', array( $this, 'spria_widget_form_extend' ), 10, 2);
		add_filter( 'widget_update_callback', array( $this, 'spria_widget_update'), 10, 2 );
		add_filter( 'dynamic_sidebar_params', array( $this, 'spria_dynamic_sidebar_params'), 0 );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/*====================================================================*/ 
	/* - Add a custom class in every widget
	/*====================================================================*/ 
	public function spria_widget_form_extend( $instance, $widget ) {
		$row = '';
		if ( !isset($instance['classes']) )
			$instance['classes'] = null;   
			$row .= "<p><label>Custom Class:</label>\t<input type='text' name='widget-{$widget->id_base}[{$widget->number}][classes]' id='widget-{$widget->id_base}-{$widget->number}-classes' class='widefat' value='{$instance['classes']}'/>\n";
			$row .= "</p>\n";
			echo $row;
			return $instance;
	}

	public function spria_widget_update( $instance, $new_instance ) {
		$instance['classes'] = $new_instance['classes'];
		return $instance;
	}

	// Value add in widget
	public function spria_dynamic_sidebar_params( $params ) {
		global $wp_registered_widgets;
		$widget_id    = $params[0]['widget_id'];
		$widget_obj   = $wp_registered_widgets[$widget_id];
		$widget_opt   = get_option($widget_obj['callback'][0]->option_name);
		$widget_num   = $widget_obj['params'][0]['number'];    
		if ( isset($widget_opt[$widget_num]['classes']) && !empty($widget_opt[$widget_num]['classes']) )
			$params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['classes']} ", $params[0]['before_widget'], 1 );
		return $params;
	}

	public function spria_event_widgets() {
		register_sidebar( array(
			'name'          => esc_html__( 'Event Widgets', 'spria-core' ),
			'id'            => 'event-widgets',
			'description'   => esc_html__('Service details page widgets area', 'spria-core'),
			'before_widget' => '<div id="%1$s" class="widget %2$s sidebar-widget service-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget-heading heading-dark"><h4 class="heading-title">',
			'after_title'   => '</h4></div>',
		) );

		if ( class_exists( 'woocommerce' ) ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Products Page', 'spria-core' ),
				'id'            => 'product-archive',
				'description'   => esc_html__('Products Page Sidebar widgets', 'spria-core'),
				'before_widget' => '<div id="%1$s" class="widget %2$s sidebar-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-heading heading-dark"><h4 class="heading-title">',
				'after_title'   => '</h4></div>',
			) );
			register_sidebar( array(
				'name'          => esc_html__( 'Products Details', 'spria-core' ),
				'id'            => 'product-details',
				'description'   => esc_html__('Products Details Page Sidebar widgets', 'spria-core'),
				'before_widget' => '<div id="%1$s" class="widget %2$s sidebar-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-heading heading-dark"><h4 class="heading-title">',
				'after_title'   => '</h4></div>',
			) );
		}
			
	}

	public function custom_widgets() {
		 if ( !class_exists( 'spria_Widget_Fields' ) ) return;

		foreach ( $this->widgets as $filename => $classname ) {
			$file  = dirname(__FILE__) . '/' . $filename . '.php';
			$class = __NAMESPACE__ . '\\' . $classname;
			require_once $file;
			register_widget( $class );
		}
	}
}

Custom_Widgets_Init::instance();
