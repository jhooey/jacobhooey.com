<?php get_header(); ?>
<div id="content">

<div id="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="entry">
			<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<div class="meat">
    <?php comments_popup_link(__('0 Comments'), __('1 Comments'), __('% Comments')); ?> | <?php the_category(', ') ?></div>
			<div class="loaf"><?php the_content(__('(more...)')); ?></div>
		</div>
		
<?php endwhile; else: ?><?php endif; ?>
<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?>

	</div>
<?php include(TEMPLATEPATH."/l_sidebar.php");?>
<?php include(TEMPLATEPATH."/r_sidebar.php");?>

</div>
<?php get_footer(); ?>
