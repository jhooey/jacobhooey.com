<div id="r_sidebar">
<a name="sidebar"></a>
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>


<?php if ( (is_home())  ) { ?>
<div class="col">
<h3>About</h3>
<?php query_posts('pagename=about');?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<p><?php the_content_rss('', FALSE, '', 20); ?></p>
<br />
<?php endwhile; endif; ?>  
</div>		
<?php } ?> 



<div class="col">
<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
	<div><input type="text" name="s" id="s" />
	<input type="submit" id="searchsubmit" value="GO" /></div></form>
</div>

<div class="col">
<h3>Popular</h3>       
<ul class="ul-blogroll">
<?php get_hottopics(); ?>
</ul>
</div>

<?php endif; ?>	
</div>