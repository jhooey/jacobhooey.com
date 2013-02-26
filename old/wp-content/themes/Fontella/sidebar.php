<!-- begin sidebar -->

<div id="sidebar">

<div class="sidebar">
	
	<div id="recententries">

		<h3>Latest posts</h3>
		
		<?php $lastposts = get_posts('numberposts=10');
	foreach($lastposts as $post) :
	setup_postdata($post);
	$id_hardware = $post->ID;
	?> <!--This call the last 10 post - Change the number 10 to insert more or less posts-->
		
				<ul><li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a> (<?php $comment_count = $post->comment_count; echo $comment_count ?>)<br/>

					<small>Posted by <?php the_author('') ?> / <?php the_time('d-m-Y'); ?> <br/></small></li></ul>
						
<?php endforeach; ?>

	</div>

	<div id="categories">
		<h3>Categories</h3>
		<ul>
		<?php wp_list_cats('sort_column=name&optioncount=1'); ?>
		</ul>
	</div>

	<div id="infocolumn">
		<h3>Blogroll</h3>
		<div id="blogroll">
		<ul>
		<?php get_links(-1, '<li>', '</li>', ' - '); ?>
		</ul>
		</div>

		<div id="archives">
		<br/><h3>Archives</h3>
		<ul>
		<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
		</ul>
		</div>

	</div>

</div>


</div>

<!-- end sidebar -->