<?php get_header(); ?>
<div class="column span-15 first">
	<div class="content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2>
<?php the_title(); ?>
			</h2> 
			<div class="entry">
<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</div>
		</div>
<?php endwhile; endif; ?>
<?php edit_post_link('Edit', '<p>[ ', ' ]</p>'); ?>
	</div>
</div>
<div class="column span-8 prepend-1 last">
<hr class="space" />
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar-Single') ) : ?>
<?php endif; ?>
</div>
<hr />
<?php get_sidebar(); ?>
<?php get_footer(); ?>
