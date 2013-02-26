<?php get_header(); ?>
<div id="left">
<div id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    

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
