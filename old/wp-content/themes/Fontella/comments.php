<?php if ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>

<p><?php _e('Insert the password to view the comments'); ?></p>

<?php return; endif; ?>

<div id="comments">
	
	<h3><?php comments_number(__('No comments'), __('1 Comment'), __('% Comments')); ?> </h3>

<?php if ( $comments ) : ?>

	<ol id="commentlist">

<?php foreach ($comments as $comment) : ?>

		<li>
			<span class="headercomment"><?php comment_author_link() ?> &#8212; <?php comment_date() ?> <a href="#comment-<?php comment_ID() ?>">#</a></span><?php edit_comment_link(__("Edit"), ' / '); ?>
			<div class="commenttext"><?php comment_text() ?></div>
		</li>

<?php endforeach; ?>

	</ol>

<?php endif; ?>

<?php if ( comments_open() ) : ?>

	<div id="leavecomment"><a name="postcomment"></a><h3><?php _e('Leave a comment'); ?></h3>

		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p>You must <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">login</a> to leave comments.</p>
		<?php else : ?>

		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		<?php if ( $user_ID ) : ?>
		<?php else : ?>

		<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
		<label for="author">Name <?php if ($req) _e('(required)'); ?></label></p>

		<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
		<label for="email">Mail (will not be published) <?php if ($req) _e('(required)'); ?></label></p>

		<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
		<label for="url">Website (optional, leave blank if none)</label></p>

<?php endif; ?>

		<p><textarea name="comment" id="comment" cols="40" rows="10" tabindex="4"></textarea></p>

	<div id="submit"><input name="submit" type="submit" tabindex="5" value="Post Comment" /></div>
	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />

<?php do_action('comment_form', $post->ID); ?>

		</form></div>

<?php endif; // If registration required and not logged in ?>

<?php else : // Closed comments ?>

	<div class="commentsmess"><?php _e('Closed comments.'); ?></div>
	<?php endif; ?>

</div>

