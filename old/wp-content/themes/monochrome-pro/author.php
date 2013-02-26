<?php get_header(); ?>
<div class="column span-15 first">
	<div class="content">
<!-- This sets the $curauth variable -->
<?php
if(isset($_GET['author_name'])) :
$curauth = get_userdatabylogin($author_name);
else :
$curauth = get_userdata(intval($author));
endif;
?>
		<div class="author">
			<h4>About: 
<?php echo $curauth->nickname; ?>
			</h4> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/authors/<?php echo $curauth->last_name; ?>.jpg" alt="<?php echo $curauth->nickname; ?>" /> <h6>Profile:</h6> 
			<p class="small">
<?php echo $curauth->user_description; ?>
			</p>
			<h6>Website</h6> 
			<p class="small">
				<a href="<?php echo $curauth->user_url; ?>">
<?php echo $curauth->user_url; ?>
				</a>
			</p>
			<h6>Contact:</h6> 
			<p class="small">
				<a href="mailto:<?php echo $curauth->user_email; ?>">Email 
<?php echo $curauth->nickname; ?>
				</a>
			</p>
		</div>
		<h6 class="alignright">Posts by 
<?php echo $curauth->nickname; ?>
		</h6> 
<!-- The Loop -->
<?php if (have_posts()) : ?>
<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_category()) { ?>
		<h6 class="departments">
<?php echo single_cat_title(); ?>
			Department</h6> 
<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h6 class="departments">Entries from 
<?php the_time('F Y'); ?>
		</h6> 
<?php /* If this is a search */ } elseif (is_search()) { ?>
		<h2>Search Results</h2> 
<?php } ?>
<?php while (have_posts()) : the_post(); ?>
		<div class="entry">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" class="title"> 
<?php the_title(); ?>
				</a></h2> 
			<div class="column span-2 first">
				<div class="byline">
<?php the_time('M j, Y') ?>
				</div>
			</div>
			<div class="column span-11 last">
<?php the_excerpt() ?>
				<div class="meta">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read</a> | 
<?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
					| <strong>Tags:</strong> 
<?php the_category(' &middot; ') ?>
				</div>
			</div>
		</div>
		<hr>
		</hr>
<?php endwhile; ?>
<?php else : ?>
		<h2>Welp, we couldn't find that...try again?</h2> 
		<div class="entry">
<?php get_template_part('searchform.php'); ?>
		</div>
<?php endif; ?>
<!-- End Loop -->
<?php posts_nav_link(' &#183; ', 'previous page', 'next page'); ?>
	</div>
</div>
<div class="column span-8 prepend-1 last">
<hr class="space" />
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar-Single') ) : ?>
<?php endif; ?>
</div>
<hr />
</hr>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
