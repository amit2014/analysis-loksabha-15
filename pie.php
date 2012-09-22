<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.23.custom.css">
<script type="text/javascript" src="js/d3.v2.js"></script>
<script type="text/javascript" src="js/pie.js"></script>
<script>
draw_pie(<?php 
			if(isset($_GET['field'])){
				echo "\"";
				echo urldecode($_GET['field']) ;
				echo "\"";
			}
			else
			echo "'Age'"; 
			?>);
</script>
<title>Pie</title>
</head>

<body>
<div> </div>
</body>
</html>

<!--      <h1 style="visibility:hidden">CSP301 <span class="off">Assignment</span></h1>
      <h2 style="visibility:hidden"> Abhishek Kumar<br />
        Akhil Jain<br />
        Shivanker Goel</h2>-->