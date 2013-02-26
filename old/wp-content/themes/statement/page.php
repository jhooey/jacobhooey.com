<?php get_header(); ?>

<div id="left">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
<div class="entry">
			<div class="post" id="post-<?php the_ID(); ?>">
				<h2><?php the_title(); ?></h2>

					<?php the_content('More &raquo;'); ?>


<?php the_tags('Tags: ', ', ', ' '); ?> <?php edit_post_link('Edit', '[ ', ' ]'); ?>
</div></div>
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
