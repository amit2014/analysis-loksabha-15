<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>Brush</title>
    <script type="text/javascript" src="d3.v2.js"></script>
    <style type="text/css">
		svg {
		  font: 10px sans-serif;
		}
		circle {
		  -webkit-transition: fill-opacity 250ms linear;
		}
		.selecting circle {
		  fill-opacity: .2;
		}
		.selecting circle.selected {
		  stroke: #f00;
		}
		.axis path, .axis line {
		  fill: none;
		  stroke: #000;
		  shape-rendering: crispEdges;
		}
		.brush .extent {
		  stroke: #fff;
		  fill-opacity: .125;
		  shape-rendering: crispEdges;
		}
    </style>
  </head>
  <body>
    <script type="text/javascript">
	<?php
	  function getvar($vname, $deflt)  { 
		if(isset($_GET[$vname])&& $_GET[$vname]!=''){
		  echo urldecode($_GET[$vname]) ;
		}
		else
		echo "$deflt"; 
	  }
	?>
	var data = [],
		dict = {},
		fx = '<?php
			  getvar('field',"Age");
			  ?>',
		fy = '<?php
			  getvar('field2',"Attendance");
			  ?>';
	dict[fx] = [];
	dict[fy] = [];
	var stateFilt = [<?php
					getvar('state',"");
					?>],
		partyFilt = [<?php
					getvar('party',"");
					?>];	
    </script>
    <script type="text/javascript" src="js/brush.js"></script>
  </body>
</html>
