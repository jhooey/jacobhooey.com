<?php

/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'FlickrInit' );

/* Function that registers our widget. */
function FlickrInit() {
	register_widget( 'Flickr' );
}

class Flickr extends WP_Widget {

	function Flickr() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'flickr', 'description' => 'Display Flickr Photos.' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 285, 'height' => 350, 'id_base' => 'flickr' );

		/* Create the widget. */
		$this->WP_Widget( 'flickr', 'Flickr (by @ThemeJam)', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$flickrid = $instance['flickrid'];
		$flickrcount = $instance['flickrcount'];
		$flickrtag = $instance['flickrtag'];

		/* Before widget (defined by theme). */
		echo $before_widget;

		/* Title of widget (before and after defined by theme). */
		if ( $title )
			echo $before_title . $title . $after_title;
		
		/* Display Flickr photos */
		?> <script type='text/javascript' src='http://www.flickr.com/badge_code_v2.gne?count=<?php echo $flickrcount; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user_tag&amp;user=<?php echo $flickrid; if ( $flickrtag ) : ?>&amp;tag=<?php echo $flickrtag; endif; ?>'></script>
		
		<?php
		
		/* After widget (defined by theme). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickrid'] = strip_tags( $new_instance['flickrid'] );
		$instance['flickrcount'] = strip_tags( $new_instance['flickrcount'] );
		$instance['flickrtag'] = strip_tags( $new_instance['flickrtag'] );
		
		return $instance;
	}
	
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' => 'Flickr',
			'flickrid' => '',
			'flickrcount' => '6',
			'flickrtag' => ''
			
			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
				
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>" style="display:block;">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:270px;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'flickrid' ); ?>" style="display:block;">Flickr ID:</label>
			<input id="<?php echo $this->get_field_id( 'flickrid' ); ?>" name="<?php echo $this->get_field_name( 'flickrid' ); ?>" value="<?php echo $instance['flickrid']; ?>" style="width:270px;" /><br />
			<em>find your Flickr ID at <a href='http://idgettr.com/' target='_blank'>idgettr.com</a></em>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'flickrcount' ); ?>" style="display:block;">Number of Photos:</label>
			<input id="<?php echo $this->get_field_id( 'flickrcount' ); ?>" name="<?php echo $this->get_field_name( 'flickrcount' ); ?>" value="<?php echo $instance['flickrcount']; ?>" style="width:270px;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'flickrtag' ); ?>" style="display:block;">Flickr Tag:</label>
			<input id="<?php echo $this->get_field_id( 'flickrtag' ); ?>" name="<?php echo $this->get_field_name( 'flickrtag' ); ?>" value="<?php echo $instance['flickrtag']; ?>" style="width:270px;" />
		</p>
		
		
		
		<?php
	}
}

?>