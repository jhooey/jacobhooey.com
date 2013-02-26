<?php
/*
Template Name: Archives
*/
?>
<?php get_header(); ?>
<div class="column span-15 first">
	<div class="content">
		<h2>Archives by Month:</h2> 
		<ul>
<?php wp_get_archives('type=monthly'); ?>
		</ul>
		<h2>Archives by Subject:</h2> 
		<ul>
<?php wp_list_categories(); ?>
		</ul>
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
