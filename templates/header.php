<!DOCTYPE HTML>

<html>
<head>

<meta itemprop="name" content="JacobHooey.com">
<meta itemprop="description" content="Everything you need to know about Jacob Hooey can be found here, from my professional resume to my personal artwork. This site also contains open source software and code samples that I have created myself.">

<title>
    Jacob Hooey
</title>

<!-- Begin Stylesheets -->
  
  <!--[if IE]>
<link rel="stylesheet" type="text/css" href="./css/style_ie.css" />
<![endif]-->
  
  
<!--[if !IE]><!-->  
	<link rel="stylesheet" type="text/css" href="./css/style.css" />
 <!--<![endif]--> 
  
  
<link href='http://fonts.googleapis.com/css?family=Alegreya+SC' rel='stylesheet' type='text/css'>
<!-- End Stylesheets -->

	<link rel="icon" type="image/png" href="./css/img/favicon.png">
	
<!-- Begin JavaScript -->
<script type="text/javascript" src="./js/codaSlider/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="./js/codaSlider/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="./js/codaSlider/jquery.coda-slider-2.0.js"></script>

	
<!-- script for Shadow box-->  

	<link rel="stylesheet" type="text/css" href="./js/shadowbox/shadowbox.css">
	<script type="text/javascript" src="./js/shadowbox/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init();
</script>
	
	
<!-- script for Google Analytics-->  
<?php include_once("analyticstracking.php") ?>  
	

<!-- script for CodaSlider content container-->  
<script type="text/javascript">
    $().ready(function() {
    $('#coda-slider-1').codaSlider({
        dynamicArrows: false,
        dynamicTabsAlign: "left"
        });
    });   
</script>

<!-- script for the twitter button -->
<script>
    !function(d,s,id){
        var js,fjs=d.getElementsByTagName(s)[0];
        if(!d.getElementById(id)){
            js=d.createElement(s);
            js.id=id;js.src="//platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js,fjs);
        }
    }
    (document,"script","twitter-wjs");
</script>

<!--script for the google plus share button -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<!-- End JavaScript -->

</head>
<body>

  
<div id="fb-root"></div>

<!--script for the facebook like button-->
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

  
  
<!--container for the entire page-->
<div class="page-container">

    <div class="main-nav">    
    <div class="main-nav-left">
      <?php if ($nav == "home") echo "<span class='current-page'>" ?>
          <a href="index.php?action=home">Home</a>
      <?php if ($nav == "home") echo "</span>" ?>
    </div>
    <div class="main-nav-right">
      <?php if ($nav == "resume") echo "<span class='current-page'>" ?>
          <a href="index.php?action=resume">Resume</a>
      <?php if ($nav == "resume") echo "</span>" ?>
    </div>
    <div class="main-nav-left">
      <?php if ($nav == "artwork") echo "<span class='current-page'>" ?>
          <a href="index.php?action=artwork">Artwork</a>
      <?php if ($nav == "artwork") echo "</span>" ?>
    </div>
    <div class="main-nav-right">
      <?php if ($nav == "thesis") echo "<span class='current-page'>" ?>
          <a href="index.php?action=thesis">Thesis</a>
      <?php if ($nav == "thesis") echo "</span>" ?>
    </div>
    <div class="main-nav-left">
      <?php if ($nav == "projects") echo "<span class='current-page'>" ?>
          <a href="index.php?action=projects">Projects</a>
      <?php if ($nav == "projects") echo "</span>" ?>
    </div>
    <div class="main-nav-right">
      <?php if ($nav == "contact") echo "<span class='current-page'>" ?>
          <a href="index.php?action=contact">Contact Info</a>
      <?php if ($nav == "contact") echo "</span>" ?>
    </div>  
</div>

<!--Here lies the website header-->
<div class="header">
    <a href="index.php?action=home">
        <h1>JACOB<span class="green">HOOEY</span></h1>
        <h2><span class="green">Software Developer</span> and Physicist</h2>
    </a>
</div>
  


