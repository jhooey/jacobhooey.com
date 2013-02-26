<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

<script type="text/javascript"><!--
function dsp(loc){
   if(document.getElementById){
      var foc=loc.firstChild;
      foc=loc.firstChild.innerHTML?
         loc.firstChild:
         loc.firstChild.nextSibling;
      foc.innerHTML=foc.innerHTML=='+'?'-':'+';
      foc=loc.parentNode.nextSibling.style?
         loc.parentNode.nextSibling:
         loc.parentNode.nextSibling.nextSibling;
      foc.style.display=foc.style.display=='block'?'none':'block';}}  

if(!document.getElementById)
   document.write('<style type="text/css"><!--\n'+
      '.dspcont{display:block;}\n'+
      '//--></style>');
//--></script>


<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/tabber.js"></script>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/tab.css" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="/favicon.ico" >
<?php wp_head(); ?>




<noscript>
<style type="text/css"><!--
.dspcont{display:block;}
//--></style>
</noscript>


</head>


<body>

<div id="wrapper">

<div id="header">
<span style="float:right;"><?php echo qtrans_generateLanguageSelectCode('dropdown'); ?></span>


<div id="logo"><h1><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?><?php echo $langblog;?></a></h1></div>



<div id="searchbox">

<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
<div><input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="swap_value" />
<input type="image" src="<?php bloginfo('template_directory'); ?>/images/go.gif" id="go" alt="Search" title="Search" />
</div>
</form>

</div>


</div>

<div id="nav">
<ul>
<!-- <li class="<?php if (((is_home()) && !(is_paged())) or (is_archive()) or (is_single()) or (is_paged()) or (is_search())) { ?>current_page_item<?php } else { ?>page_item<?php } ?>"><a href="<?php echo get_settings('home'); ?>">Home<?php echo $langblog;?></a></li> -->
<?php wp_list_pages('sort_column=menu_order&depth=1&title_li='); ?>
</ul>
</div>
<div id="main">