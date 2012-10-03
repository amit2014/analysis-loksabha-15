<!DOCTYPE html>
<meta charset="utf-8">
<html lang="en-US">
<?php include("includes/head.php"); ?>
<body class="home blog logged-in admin-bar custom-background customize-support">
<div id="container" class="hfeed">
  <?php include("includes/header.php"); ?>  
  <div id="wrapper" class="clearfix">
    <div class="home-widgets">
      <?php include("includes/panel2.php"); ?>
    </div>
    <div class="mash" id="featured" style="overflow:hidden;height:800px;width:auto">
        <iframe src="mash_p.php?field=&sort=" id="frame" style="text-align:center;width:150%;height:130%;padding-left:2px;padding-right:2px;padding-top:22px;padding-bottom:2px;overflow:auto;margin:0px;" scrolling="no" class="center"> </iframe>

      <script src="js/d3.v2.min.js?2.8.1"></script>
      <script src="js/mash.js"></script>
    </div>
  </div><!-- end of #wrapper --> 
</div><!-- end of #container -->
<?php include("includes/footer.php"); ?>
</div>
</body>
</html>
