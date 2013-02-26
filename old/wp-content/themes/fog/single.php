<?php get_header(); ?>

<div id="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="entry">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
<?php the_title(); ?></a></h2>
<div class="meat"><?php the_category(', ') ?> | <?php edit_post_link('Edit','',' | '); ?><?php the_tags('Tags:', ', ', '<br />'); ?></div>
			
                <div class="loaf"><?php the_content(__('(more...)')); ?></div>
		<p>&nbsp;</p> 
<div class="clearfix"></div><hr class="clear" />
<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
<div class="clearfix"></div><hr class="clear" />

<small>
This entry was posted
<?php /* This is commented, because it requires a little adjusting sometimes.
You'll need to download this plugin, and follow the instructions:
http://binarybonsai.com/archives/2004/08/17/time-since-plugin/ */
/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?> 
on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?> 
and is filed under <?php the_category(', ') ?>.
You can follow any responses to this entry through the <?php comments_rss_link('RSS 2.0'); ?> feed. 

<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
// Both Comments and Pings are open ?>
You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(true); ?>" rel="trackback">trackback</a> from your own site.

<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
// Only Pings are Open ?>
Responses are currently closed, but you can <a href="<?php trackback_url(true); ?> " rel="trackback">trackback</a> from your own site.

<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
// Comments are open, Pings are not ?>
You can skip to the end and leave a response. Pinging is currently not allowed.

<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
// Neither Comments, nor Pings are open ?>
Both comments and pings are currently closed.			

<?php } edit_post_link('Edit this entry','',''); ?>
</small>

<h3>Related Posts</h3>
<?php
if( function_exists('cattag_related_posts') ) { echo '<ul>' . cattag_related_posts() . '</ul>'; }
?>

		<?php comments_template(); // Get wp-comments.php template ?>

<div class="clearfix"></div><hr class="clear" />
<?php endwhile; else: ?><?php endif; ?>
<div class="navigation">
			<div class="alignleft"><?php previous_post('&laquo; %','','yes') ?></div>
			<div class="alignright"><?php next_post(' % &raquo;','','yes') ?></div>
		</div>


				</div></div>
<?php include(TEMPLATEPATH."/l_sidebar.php");?>
<?php include(TEMPLATEPATH."/r_sidebar.php");?>

</div>
<?php get_footer(); ?>