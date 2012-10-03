<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.23.custom.css">
<script type="text/javascript" src="js/d3.v2.js"></script>
<script type="text/javascript" src="js/jquery-1.8.1.js"></script>
<script type="text/javascript">
	<?php
	function getvar($vname, $deflt)  { 
	  if(isset($_GET[$vname]) && $_GET[$vname]!=''){
		echo urldecode($_GET[$vname]) ;
	  }
	  else
	  echo "$deflt"; 
	}
	?>

	var field = "<?php 
			getvar('field',"Political party");
			?>";
	var state =[<?php 
			getvar('state','');
			?>];
	var party = [<?php 
			getvar('party','');
			?>]; 
	var data = [];
</script>
<script type="text/javascript" src="js/pie.js"></script>
<title>Pie</title>
</head>
<body>
<div></div>
</body>
</html>