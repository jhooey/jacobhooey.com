<?php get_header(); ?>
			
<div id="wrapper">
		
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
	<div class="post"><div class="titlelink"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></div>
						
		<?php the_excerpt_rss("Continue reading - ".the_title('', '', false)." &raquo;"); ?>
			
		<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
			
			<div class="feedback">

				<div class="date"> <!--The calendar-->
					<div class="year"><?php the_time('Y'); ?></div>
					<div class="day"><?php the_time('j'); ?></div>
					<div class="month"><?php the_time('M'); ?></div>
				</div>
				<ul>
				<li>Posted by <?php the_author('') ?> at <?php the_time('h:i a') ?> <?php edit_post_link('Edit', ' &#8212; ', ''); ?></li>
				<li><?php comments_popup_link('No comments', '1 Comment', '% Comments'); ?> published</li>
				<li>Filed under: <?php the_category(', ') ?></li>
				</ul>
			</div>

	</div>

<?php comments_template(); // Get wp-comments.php template ?>
			
	<?php endwhile; else: ?>
	<h2 class="center">Not Found</h2>
	<?php endif; ?>

	<div id="pagination">
	<?php posts_nav_link(' &#8212; ', __('&laquo; Next page'), __('Previous page &raquo;')); ?>
	</div>

</div>

<?php get_footer(); ?>