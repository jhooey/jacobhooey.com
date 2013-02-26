<div id="l_sidebar">

<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>
		

<div class="col">

<h3>Categories</h3>
<ul>
<?php wp_list_cats('sort_column=name&hide_empty=0'); ?>
</ul>

		</div>

<div class="col">
<h3>Archives</h3>

<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>

</div>

<div class="col">
<h3>Links</h3>

<ul>
<?php get_links('-1', '<li>', '</li>', '<br />', FALSE, 'id', FALSE, FALSE, -1, FALSE); ?>
	</ul>

		</div>

		<?php endif; ?>

	</div>