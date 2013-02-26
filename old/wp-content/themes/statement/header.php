<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/tab.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/tabber.js"></script>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript">
document.write('<style type="text/css">.tabber{display:none;}<\/style>');
</script>

<?php wp_head(); ?>
</head>
<body>
<div id="wrapper">
<div id="header">
<div id="logo">
<h1><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?><?php echo $langblog;?></a></h1>
</div>
<div id="topleft">
<div id="searchbox">
<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
<div><input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="swap_value" />
<input type="image" src="<?php bloginfo('template_directory'); ?>/images/go.gif" id="go" alt="Search" title="Search" />
</div>
</form>
</div>
<div class="clear"></div>
<div id="nav">
<ul>
<li class="<?php if (((is_home()) && !(is_paged())) or (is_archive()) or (is_single()) or (is_paged()) or (is_search())) { ?>current_page_item<?php } else { ?>page_item<?php } ?>"><a href="<?php echo get_settings('home'); ?>">Home<?php echo $langblog;?></a></li>
<?php wp_list_pages('sort_column=menu_order&depth=1&title_li='); ?>
</ul>
</div>
</div>
</div>
<div id="frame">
<div id="infobar">
<div id="browse">
<?php if (class_exists('breadcrumb_navigation_xt')) {
echo 'Browse > ';
// New breadcrumb object
$mybreadcrumb = new breadcrumb_navigation_xt;
// Options for breadcrumb_navigation_xt
$mybreadcrumb->opt['title_blog'] = 'Home';
$mybreadcrumb->opt['separator'] = ' / ';
$mybreadcrumb->opt['singleblogpost_category_display'] = true;
// Display the breadcrumb
$mybreadcrumb->display();
} ?>	
</div>
<div id="rss">
<p><script src="<?php bloginfo('template_url'); ?>/date.js" type="text/javascript"></script> | Subcribe via <a href="<?php bloginfo('rss2_url'); ?>" title="RSS"><strong>RSS</strong></a></p>
</div>
</div>
<div id="content">