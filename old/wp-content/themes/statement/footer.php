<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div id="footer">
<div id="foo">
<ul>
<li class="<?php if (((is_home()) && !(is_paged())) or (is_archive()) or (is_single()) or (is_paged()) or (is_search())) { ?>current_page_item<?php } else { ?>page_item<?php } ?>"><a href="<?php echo get_settings('home'); ?>">Home<?php echo $langblog;?></a></li>
<?php wp_list_pages('sort_column=menu_order&depth=1&title_li='); ?>
</ul>
<div class="clear"></div>
Statement by <a href="http://www.blogohblog.com" title="Premium WordPress Themes">Blog Oh! Blog</a>

</div>
</div>
</body>
</html>
