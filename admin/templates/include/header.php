<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo htmlspecialchars( $results['pageTitle'] )?></title>
    
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    
    
    <link rel="stylesheet" href="../js/codemirror/codemirror.css">
    <link rel="stylesheet" href="../js/codemirror/docs.css">
    
    <script src="../js/codemirror/codemirror.js"></script>
    <script src="../js/codemirror/xml.js"></script>
    <script src="../js/codemirror/javascript.js"></script>
    <script src="../js/codemirror/css.js"></script>
    <script src="../js/codemirror/vbscript.js"></script>
    <script src="../js/codemirror/htmlmixed.js"></script>

    <style>.CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black;height:800px;width:100%;}</style>
    
  </head>
  <body>
      
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
 
<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>
        
    <div id="admin">
        <h1><?php echo $results['pageTitle']?></h1>