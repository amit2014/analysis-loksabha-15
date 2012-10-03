<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link type="text/css" rel="stylesheet" href="css/splom.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Splom</title>
</head>

<body>
    <div class="splom" id="featured" style="width:840px;margin-right:10px"></div>
<script type="text/javascript" src="d3.v2.js"></script>

    <script type="text/javascript">
          <?php
        function getvar($vname)  { 
          if(isset($_GET[$vname]))
            echo urldecode($_GET[$vname]) ;
        }
      ?>

      var stateFilt = [<?php
                      getvar('state');
                      ?>],
          partyFilt = [<?php
                      getvar('party');
                      ?>];

    </script>
    <script src="js/splom_p.js"></script>
</body>
</html>