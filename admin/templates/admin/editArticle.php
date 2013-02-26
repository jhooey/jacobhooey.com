<?php include "templates/include/header.php" ?>
 
      <div id="adminHeader">
		<h2>JacobHooey.com Admin Panel</h2>
        <p align="right">You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></p>
      </div>
 
      <h1><?php echo $results['pageTitle']?></h1>
 
      <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="articleId" value="<?php echo $results['article']->content_id ?>"/>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul>
         <!-- This will be the title used in the secondary navigation of the website -->
          <li>
            <label for="content_title">Content Title</label>
            <input type="text" name="content_title" id="content_title" placeholder="Name of the article" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['article']->content_title )?>" />
          </li>
          
          <!--This Determines which section an article will be displayed in -->
          <li>
            <label for="nav_id"><strong>Navigation</strong></label><br /><br />
            Home<input type="radio" name="nav_id" id="nav_id" value="home" <?php if ($results['article']->nav_id == "home") echo checked ?> />
            Resume <input type="radio" name="nav_id" id="nav_id" value="resume" <?php if ($results['article']->nav_id == "resume") echo checked ?> />
            Artwork<input type="radio" name="nav_id" id="nav_id" value="artwork" <?php if ($results['article']->nav_id == "artwork") echo checked ?> />
            Thesis<input type="radio" name="nav_id" id="nav_id" value="thesis" <?php if ($results['article']->nav_id == "thesis") echo checked ?> />
            Projects<input type="radio" name="nav_id" id="nav_id" value="projects" <?php if ($results['article']->nav_id == "projects") echo checked ?> />
            Contact info<input type="radio" name="nav_id" id="nav_id" value="contact" <?php if ($results['article']->nav_id == "contact") echo checked ?> />
          </li>
          
          <!--content of the article-->
          <li>
            <label for="panel_content">Content</label><br /><br /><br />
            <textarea name="panel_content" id="panel_content" placeholder="The HTML content of the article" required maxlength="1000000" style="height: 30em;"><?php echo htmlspecialchars( $results['article']->panel_content )?></textarea>
          </li>
          
        </ul>
 
        <div class="buttons">
          <input type="submit" name="saveChanges" value="Save Changes" />
          <input type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>
 
      </form>
 
          <!-- delete the current article using its content_id-->
<?php if ( $results['article']->content_id ) { ?>
      <p><a href="admin.php?action=deleteArticle&amp;articleId=<?php echo $results['article']->content_id  ?>" onclick="return confirm('Delete This Article?')">Delete This Article</a></p>
<?php } ?>
 
<?php include "templates/include/footer.php" ?>

<?php if(get_magic_quotes_gpc())
	echo "Magic quotes are enabled";
else
	echo "Magic quotes are disabled";?>
	
