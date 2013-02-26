<div id="sidebar">
<ul>

  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

	<li>
	<h2 class="sidebartitle">Recent Post</h2>
	<ul class="sidecol">
	<?php
		$myposts = get_posts('numberposts=10&offset=1');
		foreach($myposts as $post) :
		?>
	<li><a href="<?php the_permalink(); ?>"><?php the_title();
		?></a></li>
		<?php endforeach; ?>
	
	</ul>
	</li>
    <li>
      <h2 class="sidebartitle"><?php _e('Categories'); ?></h2>
      <ul class="sidecol">
        <?php wp_list_cats('sort_column=name'); ?>
      </ul>
    </li>
    <li>
      <h2 class="sidebartitle"><?php _e('Archives'); ?></h2>
      <ul class="sidecol">
        <?php wp_get_archives('type=monthly'); ?>
      </ul>
    </li>
    <li>
      <h2 class="sidebartitle"><?php _e('Links'); ?></h2>
      <ul class="sidecol">
        <?php get_links('-1', '<li>', '</li>', '<br />', FALSE, 'id', FALSE, FALSE, -1, FALSE); ?>
      </ul>
    </li>
    <li>
    <h2 class="sidebartitle"><?php _e('Meta'); ?></h2>
		<ul class="sidecol">
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr 			title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
		<li><a href="http://wordpress.org/" title="Powered by WordPress">WordPress</a></li>
		<li><a href="<?php bloginfo('rss2_url'); ?>">Entries RSS</a></li>
		<li><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments RSS</a>
		</li>
<?php wp_meta(); ?>
</ul>
</li>
<li>
  <h2 class="sidebartitle"><?php _e('Search'); ?></h2>
      <?php include (TEMPLATEPATH . '/searchform.php'); ?>
    </li>
  <?php endif; ?>

 </ul>
</div>
<!--/sidebar -->