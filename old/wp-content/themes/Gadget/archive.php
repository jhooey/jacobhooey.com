<?php get_header(); ?>
	
	<div id="main">
	
		<?php if (have_posts()) : ?>

		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h1 class="pagetitle">Posts categorized under &#8216;<?php single_cat_title(); ?>&#8217;</h1>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h1 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h1 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h1>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h1 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h1>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h1 class="pagetitle">Archive for <?php the_time('Y'); ?></h1>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h1 class="pagetitle">Author Archive</h1>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h1 class="pagetitle">Blog Archives</h1>
 	  <?php } ?>

		<?php while (have_posts()) : the_post(); ?>
	
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			
			<div class="comment-count"><?php comments_popup_link('0', '1', '%'); ?></div>
			
			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- END: .entry-content -->
			
			<p class="read-more"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read More</a></p>
			

		</div><!-- END: #post-<?php the_ID(); ?> -->
			
		<?php endwhile; ?>
		
		<div class="entry-navigation">
			<div class="previous-entry"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="next-entry"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div><!-- END: .entry-navigation -->
		
		<?php else : 
		
			if ( is_category() ) { // If this is a category archive
				printf("<h2>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
			} else if ( is_date() ) { // If this is a date archive
				echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
			} else if ( is_author() ) { // If this is a category archive
				$userdata = get_userdatabylogin(get_query_var('author_name'));
				printf("<h2>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
			} else {
				echo("<h2>No posts found.</h2>");
			}
			get_search_form();
		
		endif; ?>
	
	</div><!-- END: #main -->		
		
<?php get_sidebar(); ?>	

<?php get_footer(); ?>