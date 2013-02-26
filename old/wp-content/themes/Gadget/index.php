<?php get_header(); ?>
	
	<div id="feature">
	<!-- Feature area prev/next buttons -->
	<a id="prev" href="#"></a>
	<a id="next" href="#"></a>
		<div id="feature-slides" class="clearfix">
		 
		 <?php
		 global $post;
		 $slidercat = get_option("gt_featured_category");
		 $slidercount = get_option("gt_featured_count");
		 $myposts = get_posts('category_name='. $slidercat .'&showposts= '. $slidercount . '');
		 foreach($myposts as $post) : setup_postdata($post);
		 if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
		 	$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
		 }	
		 ?>
		    <div class="slide">
		    
		    	<div class="feature-content clearfix">
					
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					
					<?php the_excerpt('10'); ?>
					
					<p class="read-more"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read More</a></p>
				
				</div><!-- END: .feature-content -->
				
				<div class="feature-img">
					<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { 
						 the_post_thumbnail(); 
					 } else { ?><a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/no-image.jpg" width="315" height="190" alt="<?php the_title(); ?>" border="0" /></a><?php } ?>					 
				</div><!-- END: .feature-img -->
						    
		    </div><!-- END: .slide -->
		 <?php endforeach; ?>
	 	</div><!-- END: #feature-slides --> 
	</div><!-- END: #feature --> 
	
	<div id="main" class="clearfix">
		
		<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
	
		<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
			
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			
			<div class="comment-count"><?php comments_popup_link('0', '1', '%'); ?></div>
			
			<div class="entry-content">
				<?php the_content('<p class="read-more">Read More</p>'); ?>
			</div><!-- END: .entry-content -->

		</div><!-- END: #post-<?php the_ID(); ?> -->
					

		<?php endwhile; ?>
		
		<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>

		
		<?php else : ?>

		<h2>Not Found</h2>
		<p>Sorry, what you&rsquo;re looking for isn&rsquo;t here.  Try searching for it:</p>
		<?php get_search_form(); ?>
	
		<?php endif; ?>
		
	</div><!-- END: #main -->		
		
<?php get_sidebar(); ?>	

<?php get_footer(); ?>