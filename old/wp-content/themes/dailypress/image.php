<?php get_header(); ?>
<div id="left">
<div id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
<div class="socials" style="margin-top:0px;">
<a class="btn_email" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink() ?>">E-mail</a>
<a class="btn_comment"  href="#respond">Comment</a>
<a href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>" title="Submit to Del.icio.us" target="_blank" class="btn_delicious">Del.icio.us</a>
<a href="http://www.digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>" title="Submit Post to Digg" target="_blank" class="btn_digg">Digg</a>
<a href="http://reddit.com/submit?url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>" title="Submit Reddit" target="_blank" class="btn_reddit">Reddit</a>
<a href="http://technorati.com/faves?add=<?php the_permalink() ?>" title="Submit to Technorati" target="_blank" class="btn_technorati">Technorati</a>
<a href="http://furl.net/storeIt.jsp?t=<?php the_title() ?>&amp;u=<?php the_permalink() ?>" title="Submit to Furl" target="_blank" class="btn_furl">Furl</a>
</div>

    
<div class="entry">
<div class="post" id="post-<?php the_ID(); ?>">
<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

<p class="postinfo"><span class="upper"><?php the_time('M j, Y') ?></span> <span class="category"><?php the_category(', ') ?></span><?php edit_post_link('Edit', ' | ', ''); ?></p>

				<!-- gallerycode -->
				<p class="attachment"><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a></p>
                <div class="caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?></div>
				<!-- gallerycode -->
                
<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<!-- gallerynavigation -->
				<div class="imgnav">
					<div class="imgleft"><?php previous_image_link() ?></div>
					<div class="imgright"><?php next_image_link() ?></div>
				</div>
				<br clear="all" />
				<!-- gallerynavigation -->
                
<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

<p class="postinfo"><?php the_tags( 'Tags: ', ', ', ''); ?></p>
</div></div>
<div class="entry">
				<div class="postmetadata">
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
							You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.

						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.

						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							You can skip to the end and leave a response. Pinging is currently not allowed.

						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							Both comments and pings are currently closed.

						<?php } edit_post_link('Edit this entry.','',''); ?>

					</small>
				</div>

			</div>

		<div class="clear"></div>

<div class="ccomment">
	<?php comments_template(); ?>
</div>

	<?php endwhile; else: ?>
<div class="entry">
		<p>Sorry, no posts matched your criteria.</p>
</div>
<?php endif; ?>

</div></div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
