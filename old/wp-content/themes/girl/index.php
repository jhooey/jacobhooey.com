<?php get_header(); ?>
  <div id="content">
  
  <?php if (have_posts()) : ?>
  
  	<?php while (have_posts()) : the_post(); ?>
  
    <div class="post" id="post-<?php the_ID(); ?>">
    <div class="post-date"><span class="post-month"><?php the_time('M') ?></span> <span class="post-day"><?php the_time('d') ?></span></div>
<div class="title">
	  <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<small class="author">Posted by <b><?php the_author() ?> </b>on <b><?php the_time('l') ?> <?php the_time('M j, Y') ?></b> Under <?php the_category(', ') ?> </small></div>
		

	  <div class="entry">
		<?php the_content('<b>Read More</b>'); ?>
	  </div>
	  
	  <span class="comments">Tags : <?php the_tags('', ', ', ''); ?> | <?php comments_popup_link('add comments ', '1 comment ', '% comments '); ?></span>
	</div><!--/post -->
	
	<?php endwhile; ?>
	
	<div class="navigation">
	  <span class="previous-entries"><?php next_posts_link('Previous Entries') ?></span> <span class="next-entries"><?php previous_posts_link('Next Entries') ?></span>
	</div>
	
	<?php else : ?>
	
		<h2>Not Found</h2>
		<p>Sorry, but you are looking for something that isn't here.</p>
		
  <?php endif; ?>
	
  </div><!--/content -->
  
<?php get_sidebar(); ?>

<?php get_footer(); ?>
