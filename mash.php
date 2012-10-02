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
    <div class="mash" id="featured">

      <style>

      #featured {
        font-family: "Helvetica Neue", Helvetica, sans-serif;
        position: relative;
        width: 840px;
      }

      svg {
        font: 10px sans-serif;
      }

      .axis path, .axis line {
        fill: none;
        stroke: #000;
        shape-rendering: crispEdges;
      }

      .background {
        fill: #eee;
      }

      line {
        stroke: #fff;
      }

      text.active {
        fill: red;
      }

      </style>
      <script src="js/d3.v2.min.js?2.8.1"></script>

      <script >
      <?php
        function getvar($vname, $deflt)  { 
          if(isset($_GET[$vname])){
            echo urldecode($_GET[$vname]) ;
          }
          else
          echo "$deflt"; 
        }
      ?>

      var field = '<?php
                    getvar('field','Questions');
                  ?>',
          stateFilt = [<?php
                        getvar('state','');
                      ?>],
          partyFilt = [<?php
                        getvar('party','');
                      ?>],
          sortvar = '<?php
                        getvar('sortt','');
                      ?>';
      </script>
      <script src="js/mash.js"></script>
    </div>
  </div><!-- end of #wrapper --> 
</div><!-- end of #container -->
<?php include("includes/footer.php"); ?>
</div>
</body>
</html>
