<?php get_header(); ?>
<div class="column span-15 first">
	<div class="content">
<?php if (have_posts()) : ?>
			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
			<?php /* If this is a category archive */ if (is_category()) { ?>					        <h2 class="category_page"><?php echo single_cat_title(); ?></h2>
                        <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h2 class="category_page">Entries from <?php the_time('F Y'); ?></h2>
                        <?php /* If this is a search */ } elseif (is_search()) { ?>
                        <h2>Search Results</h2>
                <?php } ?>
<?php while (have_posts()) : the_post(); ?>
<div class="post" id="post-<?php the_ID(); ?>">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<p class="small"><?php the_time('F jS, Y') ?> by <?php the_author() ?> | <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></p>
<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
<div class="entry">
				<?php the_excerpt() ?>
			</div>
<hr class="space" />
</div>
		<?php endwhile; ?>

<div class="navigation">
<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
</div>
		<?php else : ?>
			<h2>Welp, we couldn't find that...try again?</h2>
			<div class="entry">
				<?php get_template_part('searchform.php'); ?>
			</div>
	<?php endif; ?>
		</div>
</div>
<div class="column span-8 prepend-1 last">
<hr class="space" />
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar-Single') ) : ?>
<?php endif; ?>
</div>
<hr />
<?php get_sidebar(); ?>
<?php get_footer(); ?>
