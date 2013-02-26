<?php
/*
Template Name: Projects
*/
?>
<?php get_header(); ?>

<div id="left">
	<div id="content">
		<?php if (have_posts()) : ?>

			<?php while (have_posts()) : the_post(); ?>
				<div class="entry">

							<?php the_content('More &raquo;'); ?>
							<p style="font-size:10px; padding-bottom:10px; margin-bottom:5px;"><?php edit_post_link('Edit', '', ''); ?></p>

				</div>
			<?php endwhile; ?>

			<div class="navigation">
				<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
				<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
			</div>

		<?php else : ?>
			
			<h2 class="center">Not Found</h2>
			<div class="post" id="post-<?php the_ID(); ?>"></div>
			<p class="center">Sorry, but you are looking for something that isn't here.</p>

		<?php endif; ?>
		<?php
		// The Query
		$the_query = new WP_Query( 'category_name=projects');
		if ($the_query->have_posts()) :
		// The Loop
			while ( $the_query->have_posts() ) : $the_query->the_post();
		?>
				<div class="entry">
					<div class="post" id="post-<?php the_ID(); ?>">
						<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

						<p class="postinfo"><span class="upper"><?php the_time('M j, Y') ?></span> <span class="category"><?php the_category(', ') ?></span><?php edit_post_link('Edit', ' | ', ''); ?></p>

						<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
						<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

						<p class="postinfo"><?php the_tags( 'Tags: ', ', ', ''); ?></p>
					</div>
				</div>
			
				<div class="clear"></div>
			<?php endwhile; else: ?>
		<div class="entry">
			<p>Sorry, no posts matched your criteria.</p>
		</div>
		<?php endif; ?>
	</div>
</div>





<?php get_sidebar(); ?>

<?php get_footer(); ?>