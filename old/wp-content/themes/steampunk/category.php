<?php get_header(); ?>
	<div id="container">
		<div id="content">
			<h1 class="page-title"><?php printf(__('Category Archives: %s'), '<span>'.single_cat_title('', false).'</span>'); ?></h1>
			<?php $category_description = category_description(); ?>
			<?php if (!empty($category_description)) ?>
				<?php echo '<div class="archive-meta">' . $category_description . '</div>'; ?>
			
			<?php get_template_part( 'loop', 'category' ); ?>
		</div><!-- #content -->
	</div><!-- #container -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
