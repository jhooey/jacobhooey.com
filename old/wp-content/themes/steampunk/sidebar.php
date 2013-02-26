<div id="primary" class="widget-area">
	<?php get_search_form(); ?>
	<ul class="xoxo">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
            <li id="pages" class="widget-container">
				<h3 class="widget-title"><?php _e('Pages'); ?></h3>
				<ul>
					<?php wp_list_pages('sort_column=post_title&title_li='); ?>
				</ul>
			</li>
            <li id="categories" class="widget-container">
				<h3 class="widget-title"><?php _e('Categories'); ?></h3>
				<ul>
					<?php wp_list_categories('title_li='); ?>
				</ul>
			</li>
            <li id="links" class="widget-container">
				<h3 class="widget-title"><?php _e('Links'); ?></h3>
				<ul>
					<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
				</ul>
			</li>
			<li id="archives" class="widget-container">
				<h3 class="widget-title"><?php _e('Archives'); ?></h3>
				<ul>
					<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>
			<li id="meta" class="widget-container">
				<h3 class="widget-title"><?php _e('Meta'); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</li>
		<?php endif; // end no dynamic sidebar ?>
    </ul>
</div><!-- #primary -->