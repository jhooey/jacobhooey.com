<?php get_header(); ?>
	
	<div id="main" class="clearfix">
			
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post clearfix" id="post-<?php the_ID(); ?>">
		
			<h1 class="entry-title"><?php the_title(); ?></h1>
			
			<div class="entry-content">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</div><!-- END: .entry-content -->
			
		</div><!-- END: #post-<?php the_ID(); ?> -->
		<?php endwhile; endif; ?>			
			
	</div><!-- END: #main -->		
		
<?php get_sidebar(); ?>	

<?php get_footer(); ?>