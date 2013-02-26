<?php get_header(); ?>

<div id="left">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
<div class="entry">
			<div class="post" id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
<div class="allinfos"><span class="date"><?php the_time('F jS, Y') ?></span> | <span class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> </span> | <span class="category">Posted in <?php the_category(', ') ?></span> <!-- by <?php the_author() ?> --></div>

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
