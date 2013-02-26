<?php get_header(); ?>
			
<div id="indexwrapper">

	<div id="presentation">

		<div id="logo">

			<div class="logobg"></div> 	<!--You can put here your logo or photo-->
       
		</div>

		<div id="lastpost">

			<?php $lastposts = get_posts('numberposts=1');
			foreach($lastposts as $post) :
			setup_postdata($post);
			$id_hardware = $post->ID;
			?> <!--This call the last post - Change the number 1 to insert more posts-->

			<h1 class="post"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title() ?>"><?php the_title(); ?></a></h1>

			<?php the_content("Continue reading - ".the_title('', '', false)." &raquo;"); ?>

			<div class="feedback">

				<div class="date"> <!--The calendar-->
					<div class="year"><?php the_time('Y'); ?></div>
					<div class="day"><?php the_time('j'); ?></div>
					<div class="month"><?php the_time('M'); ?></div>
				</div>
				<ul>
				<li>Posted by <?php the_author('') ?> at <?php the_time('h:i a') ?> <?php edit_post_link('Edit', ' &#8212; ', ''); ?></li>
				<li><?php comments_popup_link('No comments', '1 Comment', '% Comments'); ?> published</li>
				<li>Filed under: <?php the_category(', ') ?></li>
				</ul>
			</div>

	<?php endforeach; ?>

		</div>

	</div>

</div>

<?php get_footer(); ?>