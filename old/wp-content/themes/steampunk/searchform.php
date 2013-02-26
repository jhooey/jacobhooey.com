<?php $value = (get_search_query()) ? get_search_query() : 'Search'; ?>
<form method="get" id="searchform" action="<?php home_url('/' ); ?>" >
	<input type="text" value="<?php echo $value; ?>" name="s" id="s" /> <input type="submit" src="<?php bloginfo('stylesheet_directory'); ?>/images/submit.jpg" id="searchsubmit" value="Submit" />
</form>