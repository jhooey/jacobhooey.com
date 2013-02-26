<?php include "templates/include/header.php" ?>
 
      <div id="adminHeader">
        <h2>JacobHooey.com Admin Panel</h2>
        <p align="right">You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></p>
      </div>
 
      <h1>All Articles</h1>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
 
<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>
 
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
 
      <p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>
 
      <p><a href="admin.php?action=newArticle">Add a New Article</a></p>
 
<?php include "templates/include/footer.php" ?>

<?php if(get_magic_quotes_gpc())
	echo "Magic quotes are enabled";
else
	echo "Magic quotes are disabled";?>