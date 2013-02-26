<?php if (!have_posts()) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e('Not Found'); ?></h1>
		<div class="entry-content">
			<p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.'); ?></p>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
	<?php $check = 0; ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class() ?>>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<div class="entry-meta">
			<span class="date"><?php _e('Posted on'); ?> <?php the_time(__('F jS, Y')) ?></span>
		</div><!-- .entry-meta -->
        <?php if (is_archive() || is_search()) : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
            <div class="entry-content">
                <?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>')); ?>
                <?php wp_link_pages(array('before' => '<div class="page-link">'.__('Pages:'), 'after' => '</div>')); ?>
            </div><!-- .entry-content -->
		<?php endif; ?>
		<div class="entry-utility">
			<?php if (count(get_the_category()) && $post->post_type != "page") : ?>
                <span class="cat-links">
                	<?php printf(__('<span class="%1$s">Posted in</span> %2$s'), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list(', ')); ?>
                </span>
                <?php $check = 1; ?>
			<?php endif; ?>
			<?php $tags_list = get_the_tag_list('', ', '); ?>
			<?php if ($tags_list): ?>
                <span class="tag-links">
					<?php if($check) : ?>
                        <span class="meta-sep">|</span>
                        <?php $check = 1; ?>
                    <?php endif; ?>
                	<?php printf(__('<span class="%1$s">Tagged as: </span> %2$s'), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list); ?>
                </span>
			<?php endif; ?>
			<?php if (comments_open()) : ?>
                <span class="comments-link">
					<?php if($check) : ?>
                        <span class="meta-sep">|</span>
                        <?php $check = 1; ?>
                    <?php endif; ?>
                    <?php comments_popup_link(__('Leave a comment'), __('1 Comment'), __('% Comments')); ?>
                </span>
			<?php endif; ?>
			<?php if (is_user_logged_in()) : ?>
                <?php if($check) : ?>
                    <span class="meta-sep">|</span>
                    <?php $check = 1; ?>
				<?php endif; ?>
				<?php edit_post_link('Edit Post', '', ''); ?>
			<?php endif; ?>
        </div><!-- .entry-utility -->
	</div><!-- .post -->
    <?php comments_template('', true); ?>
<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
	<div id="nav-below" class="navigation">
		<div class="nav-next"><?php next_posts_link(__('Older posts <span class="meta-nav">&rarr;</span>')); ?></div>
		<div class="nav-previous"><?php previous_posts_link(__('<span class="meta-nav">&larr;</span> Newer posts')); ?></div>
	</div><!-- #nav-below -->
<?php endif; ?>