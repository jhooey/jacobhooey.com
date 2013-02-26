<?php get_header(); ?>
<div id="left">
<div id="content">
<?php if ( $paged < 2 ) { // Do stuff specific to first page?>

<?php $my_query = new WP_Query('showposts=1');
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate = $post->ID; ?>
<div class="entry">
<h2 class="sectionhead" style="margin-top:0px">

<?php _e("<!--:en--><a href='http://feeds.feedburner.com/JacobHooey'><!--:--><!--:fr--><a href='http://feeds.feedburner.com/JacobHooey/french'><!--:-->"); ?>

<img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.gif" alt="Main Content RSS Feed" title="Main Content RSS Feed" style="float:right; margin-left:5px;" /></a>

<?php _e("<!--:en-->Latest Entry<!--:--><!--:fr-->Dernier Message<!--:-->"); ?></h2>
	
<div class="post" id="post-<?php the_ID(); ?>">
						
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>

<p class="postinfo"><span class="upper"><?php the_time('M j, Y') ?></span> <span class="category"><?php the_category(', ') ?></span> <span ><?php edit_post_link('Edit', ' | ', ''); ?></span></p>


						<?php the_content('<strong>Read More..</strong>'); ?>

</div></div>
  	
<?php endwhile; ?>

<div class="entry">	
<h2 class="sectionhead"><?php _e("<!--:en-->Recent Entries<!--:--><!--:fr-->Messages récents<!--:-->"); ?></h2>

<?php if (have_posts()) : while (have_posts()) : the_post();
if( $post->ID == $do_not_duplicate ) continue; update_post_caches($posts); ?>

				<div class="post" id="post-<?php the_ID(); ?>">

<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>

<p class="postinfo"><span class="upper"><?php the_time('M j, Y') ?></span> <span class="category"><?php the_category(', ') ?></span> <span><?php edit_post_link('Edit', ' | ', ''); ?></span></p>


						<?php the_content('<strong>Read More..</strong>'); ?>

				</div>

<?php endwhile; endif; ?>
</div>
<div class="entry">	
<?php } else { // Do stuff specific to non-first page ?>
	<div class="entry">	
<h2 class="sectionhead"><?php _e("<!--:en-->Past Entries<!--:--><!--:fr-->Messages Passé<!--:-->"); ?></h2>
<?php if (have_posts()) : while (have_posts()) : the_post();
if( $post->ID == $do_not_duplicate ) continue; update_post_caches($posts); ?>

<div class="post" id="post-<?php the_ID(); ?>">

<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>

<p class="postinfo"><span class="upper"><?php the_time('M j, Y') ?></span> <span class="category"><?php the_category(', ') ?></span> <?php edit_post_link('Edit', ' | ', ''); ?></p>

						<?php the_content('<strong>Read More..</strong>'); ?>

				</div>

<?php endwhile; endif; ?>

<?php } ?>
<!--
<div class="navigation">	

					<div class="alignleft">
						<?php next_posts_link('<span class=\'older\'>Older Entries</span>') ?>
					</div>

					<div class="alignright">
						<?php previous_posts_link('<span class=\'newer\'>Newer Entries</span>') ?>
					</div>

                		</div>
-->

<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
<br>
<br>

</div>

<div class="clear"></div>
</div></div>



<?php get_sidebar(); ?>

<?php get_footer(); ?>
