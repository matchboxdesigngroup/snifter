<?php
/**
 * Example Stub widget
 */
class MDG_Stub_Widget extends WP_Widget {
	/**
	 * Widget form fields for administrator.
	 *
	 * @var  array
	 */
	private $fields = array(
		'title' => 'Title (optional)',
	);



	/**
	 * Class constructor
	 */
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_mdg_stub',
			'description' => __( 'Use this widget to add a Stub Widget', 'roots' ),
		);

		$this->WP_Widget( 'widget_mdg_stub', __( 'Stub', 'roots' ), $widget_ops );
		$this->alt_option_name = 'widget_mdg_stub';

		add_action( 'save_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( &$this, 'flush_widget_cache' ) );
	} // __construct()



	/**
	 * Echo the widget content.
	 *
	 * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_mdg_stub', 'widget' );

		if ( ! is_array( $cache ) ) {
			$cache = array();
		} // if()

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = null;
		} // if()

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo esc_attr( $cache[$args['widget_id']] );
			return;
		} // if()

		ob_start();
		extract( $args, EXTR_SKIP );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Stub', 'roots' ) : $instance['title'], $instance, $this->id_base );

		foreach ( $this->fields as $name => $label ) {
			if ( ! isset( $instance[$name] ) ) {
				$instance[$name] = '';
			} // if()
		} // foreach()

		echo wp_kses( $before_widget, 'post' );

		if ( $title ) {
			echo wp_kses( "{$before_title}{$title}{$after_title}", 'post' );
		} // if() ?>
		<div class="stub-widget-wrap">

		</div>
		<?php echo wp_kses( $after_widget, 'post' );

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'widget_mdg_stub', $cache, 'widget' );
	} // widget()



	/** Update a particular instance.
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via form()
	 * @param array $old_instance Old settings for this instance
	 * @return array Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array_map( 'strip_tags', $new_instance );

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );

		if ( isset( $alloptions['widget_mdg_stub'] ) ) {
			delete_option( 'widget_mdg_stub' );
		} // if()

		return $instance;
	} // update()



	/**
	 * Flushes the widgets cache
	 *
	 * @return  void
	 */
	function flush_widget_cache() {
		wp_cache_delete( 'widget_mdg_stub', 'widget' );
	} // flush_widget_cache()



	/** Echo the settings update form
	 *
	 * @param array $instance Current settings
	 */
	function form( $instance ) {
		foreach ( $this->fields as $name => $label ) {
			${$name} = isset( $instance[$name] ) ? esc_attr( $instance[$name] ) : ''; ?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( $name ) ); ?>"><?php _e( "{$label}:", 'roots' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $name ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $name ) ); ?>" type="text" value="<?php echo esc_attr( ${$name} ); ?>">
			</p>
		<?php
		} // foreach()
	} // form()
} // MDG_Stub_Widget()