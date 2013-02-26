<?php get_header(); ?>
<!--START LEFT SIDE-->
<div id="feature" class="column span-15 first">
<!--BEGIN FEATURED POSTS-->
<?php
// Controls the categories displayed through the theme options page
global $options;
foreach ($options as $value) {
	if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } 
	else { $$value['id'] = get_option( $value['id'] ); }
	} // endforeach
?>
	<?php query_posts('cat='.$dt_top_left_cat.'&showposts=4'); ?>
	<?php
	$category = $wp_query->get_queried_object();
	$cat_name = $category->name;
	?>
	
<ul id="portfolio">
<?php while (have_posts()) : the_post(); ?>
<li>
<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span class="meta"><?php the_time('M j, Y') ?> | <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span></h4>
<?php 
	if (has_post_thumbnail()) {
		the_post_thumbnail('575x350');
	} else {
		echo '<img src="'.get_bloginfo("template_url").'/images/slideshow.jpg" />';
	} ?>
	<?php the_excerpt(); ?>
</li>
<?php endwhile; ?>
</ul>
<hr class="space" />
<!--BEGIN MIDDLE POSTS-->
	<div class="column span-7 append-1 news">
	<?php query_posts('cat='.$dt_mid_left_cat.'&showposts=1'); ?>
	<?php
	$category = $wp_query->get_queried_object();
	$cat_name = $category->name;
	?>
	<h6 class="category_head"><a href="<?php echo get_category_link($dt_mid_left_cat);?>"><?php echo $cat_name; ?></a></h6>
	<?php while (have_posts()) : the_post(); ?>
		<div class="post-<?php the_ID(); ?>">
			<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
			<div class="meta"><?php the_time('M j, Y') ?> | <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></div>
			<?php the_excerpt(); ?>
		</div>
	<?php endwhile; ?>
	</div>
	<div class="column span-7 last news">
	<?php query_posts('cat='.$dt_mid_right_cat.'&showposts=1'); ?>
	<?php
	$category = $wp_query->get_queried_object();
	$cat_name = $category->name;
	?>
	<h6 class="category_head"><a href="<?php echo get_category_link($dt_mid_right_cat);?>"><?php echo $cat_name; ?></a></h6>
	<?php while (have_posts()) : the_post(); ?>
		<div class="post-<?php the_ID(); ?>">
			<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
			<div class="meta"><?php the_time('M j, Y') ?> | <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></div>
			<?php the_excerpt(); ?>
		</div>
	<?php endwhile; ?>
	</div>
	<hr class="space" />
</div>
<!--END MIDDLE POSTS-->
<!--BEGIN RIGHT SIDE-->
<div class="column span-8 prepend-1 last news">
	<div id="home_right">
		<div class="news-block">
			<?php query_posts('cat='.$dt_top_right_cat.'&showposts=3'); ?>
			<?php
			$category = $wp_query->get_queried_object();
			$cat_name = $category->name;
			?>
			<h6 class="category_head"><a href="<?php echo get_category_link($dt_top_right_cat);?>"><?php echo $cat_name; ?></a></h6>
			<?php while (have_posts()) : the_post(); ?>
	<div class="column span-4 first">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
	</div>
	<div class="column span-4 last">
		<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6> 
		<div class="meta"><?php the_time('M j, Y') ?> | <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></div>
		<?php the_excerpt(); ?>
	</div>
<hr />
<?php endwhile; ?>
	</div>
<!-- ABOUT BOX -->
<div class="box">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar-Home') ) : ?>
<?php endif; ?>
</div>
</div>
</div>
<hr class="space" />
<!--END RIGHT SIDE-->
<!-- BOTTOM LEFT FIVE CATEGORY LISTINGS -->
<div id="gray_bg" class="five_posts">
<?php $i = 0; ?>
<?php
$display_categories = array("$dt_bot_1st_cat","$dt_bot_2nd_cat","$dt_bot_3rd_cat","$dt_bot_4th_cat","$dt_bot_5th_cat");
foreach ($display_categories as $category) { ?>
<?php query_posts("showposts=1&cat=$category"); ?>
<?php while (have_posts()) : the_post(); $i++; ?>
<div class="column span-4 post-<?php the_ID(); ?><?php if ($i < 5) { ?> append-1<?php  } ?><?php if ($i == 5) { ?> last<?php $i = 0; } ?>">
<h6 class="category_head"><a href="<?php echo get_category_link($category);?>"><?php single_cat_title(); ?></a></h6>
<h6><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title() ?></a></h6>
<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
<div class="excerpt_small"><?php the_excerpt(); ?></div>
<p class="postmetadata"><?php the_time('M d, Y') ?> | <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
<?php endwhile; ?>

<h6 class="category_more"><a href="<?php echo get_category_link($category);?>">More in <?php single_cat_title(); ?></a></h6>
<ul>
<?php query_posts("showposts=5&offset=1&cat=$category"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" class="title"><?php the_title(); ?></a></li>
<?php endwhile; ?>
</ul>
</div>
<?php } ?>
<div class="clear"></div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
