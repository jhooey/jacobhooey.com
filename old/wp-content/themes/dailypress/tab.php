<div class="tabber">

<div class="tabbertab">
<h2>Recent Post</h2>
<ul>
<?php
$myposts = get_posts('numberposts=10&offset=1');
foreach($myposts as $post) :
?>
<li><a href="<?php the_permalink(); ?>"><?php the_title();
?></a></li>
<?php endforeach; ?>
</ul>
</div>


<div class="tabbertab">
<h2>Archives</h2>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>
</div>

</div>