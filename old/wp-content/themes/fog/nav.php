<ul>
<li class="Largenav"><h2><a title="Get back home" href="<?php echo get_settings('home'); ?>/">
<?php _e('Home'); ?></a></h2></li>
<li class="Largenav"><h2><?php _e('Pages'); ?></h2>
<ul><?php wp_list_pages('title_li=' ); ?></ul></li>

<li class="Largenav"><h2><?php _e('Recently'); ?></h2>
<ul><?php wp_get_archives('type=postbypost&limit=5'); ?></ul></li>

<li class="Largenav"><h2><?php _e('Topics'); ?></h2>
<ul><?php wp_list_cats('sort_column=name&hide_empty=0&optioncount=0&hierarchical=1'); ?></ul></li>
<li class="Largenav"><h2><a title="Get the feed" href="<?php bloginfo('rss2_url'); ?>"><?php _e('RSS'); ?></a></h2></li>
</ul>
