<?php get_header(); ?>

<div id="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="entry">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
<?php the_title(); ?></a></h2>

			
                <div class="loaf"><?php the_content(__('(more...)')); ?></div>
		<p>&nbsp;</p> 
<div class="clearfix"></div><hr class="clear" />
<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
<div class="clearfix"></div><hr class="clear" />


<?php endwhile; else: ?><?php endif; ?>

				</div></div>
<?php include(TEMPLATEPATH."/l_sidebar.php");?>
<?php include(TEMPLATEPATH."/r_sidebar.php");?>

</div>
<?php get_footer(); ?>