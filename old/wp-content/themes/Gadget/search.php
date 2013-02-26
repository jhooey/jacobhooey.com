<?php get_header(); ?>
	
	<div id="main" class="clearfix">
	
		<?php if (have_posts()) : ?>

		<h1 class="pagetitle">Search results for '<?php the_search_query(); ?>':</h1>

		<?php while (have_posts()) : the_post(); ?>
	
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			
			<div class="comment-count"><?php comments_popup_link('0', '1', '%'); ?></div>
			
			<div class="entry-content">
				<?php the_content(''); ?>
			</div><!-- END: .entry-content -->
			
			<p class="read-more"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read More</a></p>

		</div><!-- END: #post-<?php the_ID(); ?> -->
			
		<?php endwhile; else : ?>

		<h2>Not Found</h2>
		<p>Sorry, nothing matched.  Try your search again:</p>
		<?php get_search_form(); ?>
	
		<?php endif; ?>
	
	</div><!-- END: #main -->		
		
<?php get_sidebar(); ?>	

<?php get_footer(); ?>