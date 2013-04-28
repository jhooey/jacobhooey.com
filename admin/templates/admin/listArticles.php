<?php include "../templates/functions.php" ?>
<?php include "./templates/include/header.php" ?>

<div class="list">
    <div class="header-row">
        <div class="narrow-column">content_id</div>
        <div class="narrow-column">nav_id</div>
        <div class="wide-column">content_title</div>
        <div class="narrow-column">menu_order</div>
    </div>
 
<?php 
$rowCount = 1;
foreach ( $results['articles'] as $article ) { ?>
 
    <div class="row-<?php echo evenOrOdd($rowCount)?>" onclick="location='admin.php?action=editArticle&amp;articleId=<?php echo $article->content_id?>'">
          <div class="narrow-column"><?php echo $article->content_id?></div>
          <div class="narrow-column"><?php echo $article->nav_id?></div>
          <div class="wide-column"><?php echo $article->content_title?></div>
          <div class="narrow-column"><?php echo $article->menu_order?></div>
    </div>
 
<?php
    $rowCount += 1;
} 
?>
 
</div>
<div style="float:left;">
<p><a href="admin.php?action=newArticle">Add a New Article</a></p>
</div>
<?php include "templates/include/footer.php" ?>