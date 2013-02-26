<?php get_header(); ?>

<?php include(TEMPLATEPATH."/l_sidebar.php");?>
	<div id="main">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="entry">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

			<div class="meat"><?php comments_popup_link(__('0 Comments'), __('1 Comments'), __('% Comments')); ?> | <?php the_category(', ') ?> <?php edit_post_link('Edit','',' | '); ?><?php the_tags('Tags:', ', ', '<br />'); ?></div>

			<div class="loaf"><?php the_content(__('(more...)')); ?></div>
<p>&nbsp;</p> 
<div class="clearfix"></div><hr class="clear" />
		</div>
		
<?php endwhile; else: ?><?php endif; ?>
<?php if(function_exists('wp_pagenavi')) : ?>
<?php { wp_pagenavi('', '', '', '', 3, false);} ?>
<?php else : ?>
  <div class="navigation fix">
  	<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
  	<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
  </div>
<?php endif; ?>

	</div>
<?php include(TEMPLATEPATH."/r_sidebar.php");?>

</div>
<?php get_footer(); ?>
