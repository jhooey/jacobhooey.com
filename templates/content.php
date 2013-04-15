<!--

  /****************************************************************************
   * Title: content.php                                                       *
   * Author: Jacob Hooey                                                      *
   * URL: http://www.jacobhooey.com                                           *
   * Description: This is the template used to collect all the other templates*
   *              and then output the HTML code for a specified page. This    *
   *              page is specified by the content function located in index.php
   * Created: March 16th, 2012                                                *
   ****************************************************************************/
-->
<?php include("header.php"); ?>

<div class="coda-slider-wrapper">
  <div class="coda-slider preload" id="coda-slider-1" style="padding:0px">
    
    <?php foreach ( $results['articles'] as $article ) { ?>
    
    <div class="panel">
      <div class="panel-wrapper">
     <h2 class="title"><?php echo $article->content_title?></h2>
       <!--         <h3><?php echo $article->content_title?></h3> -->
        <?php echo $article->panel_content?>
      </div>
    </div>
    
    <?php } ?>
    
  </div><!-- .coda-slider -->
</div><!-- .coda-slider-wrapper -->

<?php include("noscript.php"); ?>

<?php include("social.php"); ?>
<?php include("footer.php"); ?>
