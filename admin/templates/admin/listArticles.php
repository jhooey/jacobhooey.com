<?php include "templates/include/header.php" ?>

<table>
    <tr>
        <th>content_id</th>
        <th>nav_id</th>
        <th>content_title</th>
        <th>menu_order</th>
    </tr>
 
<?php foreach ( $results['articles'] as $article ) { ?>
 
    <tr onclick="location='admin.php?action=editArticle&amp;articleId=<?php echo $article->content_id?>'">
          <td><?php echo $article->content_id?></td>
          <td><?php echo $article->nav_id?></td>
          <td><?php echo $article->content_title?></td>
          <td><?php echo $article->menu_order?></td>
         
    </tr>
 
<?php } ?>
 
</table>
 
<p><a href="admin.php?action=newArticle">Add a New Article</a></p>
 
<?php include "templates/include/footer.php" ?>