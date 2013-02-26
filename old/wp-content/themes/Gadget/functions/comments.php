<?php

// Customize comments markup
function custom_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment; ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
      	<div class="comment-avatar">
	      <?php echo get_avatar($comment,$size=$args['avatar_size']); ?>
	    </div>
	    <div class="comment-content">
		    <div class="comment-author vcard">
		      <?php echo get_comment_author_link(); ?>
		      <span class="comment-date"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s'), get_comment_date()) ?></a> <?php edit_comment_link(__('EDIT'),' ','') ?></span>
		    </div><!-- END: .comment-author vcard -->
		    <?php if ($comment->comment_approved == '0') : ?>
		    <em><?php _e('Your comment is awaiting moderation.') ?></em>
		    <?php endif; ?>
	      
	        <div class="comment-text">
	          <?php comment_text(); ?>
	        </div>
	        <div class="reply rbot">
	          <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	        </div>
        </div><!-- END: .comment-content -->
    </div><!-- END: .comment-body -->
<?php }

// Customize pings markup
function custom_comments_pings($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment; ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
      	<div class="comment-avatar">
	      <?php echo get_avatar($comment,$size=$args['avatar_size']); ?>
	    </div>
	    <div class="comment-content">
		    <div class="comment-author vcard">
		      <?php echo get_comment_author_link(); ?>
		      <span class="comment-date"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s'), get_comment_date()) ?></a> <?php edit_comment_link(__('EDIT'),' ','') ?></span>
		    </div><!-- END: .comment-author vcard -->
		    <?php if ($comment->comment_approved == '0') : ?>
		    <em><?php _e('Your comment is awaiting moderation.') ?></em>
		    <?php endif; ?>
	      
	        <div class="comment-text">
	          <?php comment_text(); ?>
	        </div>
	        <div class="reply rbot">
	          <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	        </div>
        </div><!-- END: .comment-content -->
    </div><!-- END: .comment-body -->
<?php }

?>