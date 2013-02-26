<?php get_header(); ?>
  <div id="content">
  
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
    <div class="post" id="post-<?php the_ID(); ?>">
    <div class="post-date"><span class="post-month"><?php the_time('M') ?></span> <span class="post-day"><?php the_time('d') ?></span></div>
<div class="title">
	  <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<small class="author">Posted by <b><?php the_author() ?> </b>on <b><?php the_time('l') ?> <?php the_time('M j, Y') ?></b> Under <?php the_category(', ') ?> <small class="date"></small></small></div>
	  <div class="entry">
		<?php the_content('Read the rest of this entry &raquo;'); ?>
		<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>		
		<?php edit_post_link('Edit', '', ''); ?>
	  </div>		

		<?php comments_template(); ?>
	
	  </div><!--/post -->
		
			<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

  </div><!--/content -->

<?php get_sidebar(); ?>
  
<?php get_footer(); ?>

