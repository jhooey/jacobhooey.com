<?php get_header(); ?>
<div id="left">
<div id="content">
		<?php if (have_posts()) : ?>
<div class="post">
 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h2 class="search">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2 class="search">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="search">Archive for <?php the_time('F jS, Y'); ?></h2>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="search">Archive for <?php the_time('F, Y'); ?></h2>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="search">Archive for <?php the_time('Y'); ?></h2>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="search">Author Archive</h2>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="search">Blog Archives</h2>
 	  <?php } ?>
</div>
		<?php while (have_posts()) : the_post(); ?>
       
<div class="entry">
<div class="post" id="post-<?php the_ID(); ?>">
<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

<p class="postinfo"><span class="upper"><?php the_time('M j, Y') ?></span> <span class="category"><?php the_category(', ') ?></span><?php edit_post_link('Edit', ' | ', ''); ?></p>

<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

<p class="postinfo"><?php the_tags( 'Tags: ', ', ', ''); ?></p>
</div></div>

		<div class="clear"></div>
	<?php endwhile; else: ?>
<div class="entry">
		<p>Sorry, no posts matched your criteria.</p>
</div>
<?php endif; ?>

</div></div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
