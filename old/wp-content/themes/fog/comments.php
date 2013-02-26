<?php if ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
<p>
  <?php _e('Enter your password to view comments.'); ?>
</p>
<?php return; endif; ?>
<?php $i = 0; ?>
<?php if ($comments) : ?>
<h4>
  <?php comments_number('No Responses', 'One Response', '% Responses' );?>
  to '
  <?php the_title(); ?>
  '</h4>
<p class="comment_meta">Subscribe to comments with 
  <?php comments_rss_link(__('<abbr title="Really Simple Syndication">RSS</abbr>')); ?>
  <?php if ( pings_open() ) : ?>
  or <a href="<?php trackback_url() ?>" rel="trackback">
  <?php _e('TrackBack');?>
  </a> to '
  <?php the_title(); ?>
  '. 
  <?php endif; ?>
</p>
<ol class="commentlist">
  <?php foreach ($comments as $comment) : ?>
<?php $i++; ?>
  <li class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>"> 

<?php 
if ( !empty( $comment->comment_author_email ) ) {
	$md5 = md5( $comment->comment_author_email );
	$default = urlencode( 'http://3oneseven.com/wp-content/uploads/2007/11/15.gif' );
	echo "<img style='float:left;margin-right:10px;' src='http://www.gravatar.com/avatar.php?gravatar_id=$md5&amp;size=25&amp;default=$default' alt='' />";
}
?>
<span class="count">
<?php echo $i; ?>
</span>

    <div class="comment_author"> 
      <?php comment_author_link() ?>
      said, </div>
    <?php if ($comment->comment_approved == '0') : ?>
    <em>Your comment is awaiting moderation.</em> 
    <?php endif; ?>
    <br />
    <p class="metadate">on 
      <?php comment_date('F jS, Y') ?>
      at 
      <?php comment_time() ?>
    </p>
    <?php comment_text() ?>
  </li>
  <?php /* Changes every other comment to a different class */	
		if ('alt' == $oddcomment) $oddcomment = '';
		else $oddcomment = 'alt';
	?>
  <?php endforeach; /* end for each comment */ ?>
</ol>
<?php else : // this is displayed if there are no comments so far ?>
<?php if ('open' == $post-> comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments">Comments are closed.</p>
<?php endif; ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>
<h4>
  <?php _e('Leave a reply'); ?>
</h4>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged 
  in</a> to post a comment.</p>
<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
  <?php if ( $user_ID ) : ?>
  <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. 
    <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account') ?>">Logout 
    &raquo;</a></p>
  <?php else : ?>
  <p>
    <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
    <label for="author"><small>Name 
    <?php if ($req) _e('(required)'); ?>
    </small></label>
  </p>
  <p>
    <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
    <label for="email"><small>Mail (will not be published) 
    <?php if ($req) _e('(required)'); ?>
    </small></label>
  </p>
  <p>
    <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
    <label for="url"><small>Website</small></label>
  </p>
  <?php endif; ?>
  <!--<p><small><strong>XHTML:</strong> You can use these tags: <?php echo allowed_tags(); ?></small></p>-->
  <br />
  <p> 
    <textarea name="comment" id="comment" cols="50%" rows="6" tabindex="4"></textarea>
  </p>
  <p>
    <input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
    <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
  </p>
  <?php do_action('comment_form', $post->ID); ?>
</form>

<?php endif; // If registration required and not logged in ?>
<?php else : // Comments are closed ?>
<p>
  <?php _e('Sorry, the comment form is closed at this time.'); ?>
</p>
<?php endif; ?>
