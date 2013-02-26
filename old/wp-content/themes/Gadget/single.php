<?php get_header(); ?>
	
	<div id="main">
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<h1 class="entry-title"><?php the_title(); ?></h1>
			
			<div class="entry-meta-before clearfix">
				<div id="byline"><?php the_time('F jS, Y') ?>  by <?php the_author() ?></div>
				<div id="comments-top"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></div>
			</div><!-- END: .entry-meta-before -->
			
			<div class="entry-content">
				<?php the_content('Read more &raquo;'); ?>
			</div><!-- END: .entry-content -->
			
		</div><!-- END: #post-<?php the_ID(); ?> -->
			
		<?php comments_template(); ?>

		<?php endwhile; else: ?>
	
			<p>Sorry, no posts matched your criteria.</p>
	
		<?php endif; ?>
	
	</div><!-- END: #main -->		
		
<?php get_sidebar(); ?>	

<?php get_footer(); ?>