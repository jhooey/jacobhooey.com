<?php get_header(); ?>

<div id="left">
<div id="content">
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
<div class="entry">
			<div class="post" id="post-<?php the_ID(); ?>">



					<?php the_content('More &raquo;'); ?>

<p class="postinfo"><?php edit_post_link('Edit', '', ''); ?></p>

</div></div>
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>

	<?php endif; ?>
</div>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
