<?php get_header(); ?>
<div class="column span-15 first">
	<div class="content">
<?php if (have_posts()) : ?>
		<h2 class="category_page">Search Results for "
<?php echo $s ?>
			"</h2> 
		<div class="navigation">
			<div class="alignleft">
<?php next_posts_link('&laquo; Previous') ?>
			</div>
			<div class="alignright">
<?php previous_posts_link('Next &raquo;') ?>
			</div>
		</div>
		<div class="clear">
		</div>
<?php while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<p class="small">
<?php the_time('F jS, Y') ?>
				&nbsp;|&nbsp; 
<!-- by <?php the_author() ?> -->
				Published in 
<?php the_category(', ');

						if($post->comment_count > 0) { 

								echo ' &nbsp;|&nbsp; ';

								comments_popup_link('', '1 Comment', '% Comments'); 

						}

					?>
			</p>
			
<?php

				// Support for "Search Excerpt" plugin

				// http://fucoder.com/code/search-excerpt/

				if ( function_exists('the_excerpt') && is_search() ) {

					the_excerpt();

				} ?>
		</div>
<?php endwhile; ?>
		<div class="navigation">
			<div class="alignleft">
<?php next_posts_link('&laquo; Previous') ?>
			</div>
			<div class="alignright">
<?php previous_posts_link('Next &raquo;') ?>
			</div>
		</div>
<?php else : ?>
		<h2 class="center">No posts found. Try a different search?</h2> 
<?php get_template_part('searchform.php'); ?>
<?php endif; ?>
</div>
</div>
<div class="column span-8 prepend-1 last">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar-Single') ) : ?>
<?php endif; ?>
</div>
<hr />
<?php get_sidebar(); ?>
<?php get_footer(); ?>
