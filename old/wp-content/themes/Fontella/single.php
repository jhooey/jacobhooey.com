<?php get_header(); ?>
			
		
<?php get_header(); ?>
			
<div id="wrapper">
		
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
	<div class="post"><h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"></a>  <?php the_title(); ?></h1>

		<div class="singlelinks"><span><a href="<?php echo get_settings('home'); ?>">Back to home</a> / <a href="#comments" title="View comments of this entry">View comments</a></span></div>
						
		<?php the_content("Continue reading - ".the_title('', '', false)." &raquo;"); ?>
			
		<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
			
			<div class="feedback">
				<div class="date"> <!--The calendar-->
					<div class="year"><?php the_time('Y'); ?></div>
					<div class="day"><?php the_time('j'); ?></div>
					<div class="month"><?php the_time('M'); ?></div>
				</div>
				<ul>
				<li>Posted by <?php the_author('') ?> at <?php the_time('h:i a') ?> <?php edit_post_link('Edit', ' &#8212; ', ''); ?></li>
				<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Permalink for this entry</a></li>
				<li>Filed under: <?php the_category(', ') ?></li>
				<li><?php comments_rss_link(__('<abbr title="Really Simple Syndication">RSS</abbr> comments feed of this entry')); ?> </li>
				<li><a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack <abbr title="Uniform Resource Identifier">URI</abbr>'); ?></a></li>
				</ul>
			</div>

			<div class="navposts"><?php previous_post_link('&laquo; %link') ?> &mdash; <?php next_post_link('%link &raquo;') ?></div>

	</div>

</div>

			
<?php comments_template(); ?>
			
	<?php endwhile; else: ?>

		<h2 class="center">Not found</h2>

		<?php endif; ?>

<?php get_footer(); ?>