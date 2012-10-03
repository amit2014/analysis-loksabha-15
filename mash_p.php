<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mash</title>
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
          if(isset($_GET[$vname])&& ($_GET[$vname]!='')){
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
                        getvar('sort','');
                      ?>';
</script>
</head>
<body>
	<div id="feature"></div>
    <script src="js/mash_p.js"></script>
</body>
</html>