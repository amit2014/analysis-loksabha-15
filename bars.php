<html>
  <head>
    <title>Bar Charts</title>
    <style type="text/css">
        .label
        {
            font-family: Verdana;
            font-size: 11pt;
            color: gray;
            fill-opacity: .6;
        }
        .value
        {
            font-family: Verdana;
            font-size: 9pt;
            color: gray;
            fill-opacity: .6;
        }

        .tick_label
        {
            font-size: 10pt;
            font-family: Verdana;
            color: black;
            fill-opacity: 1;
        }
    </style>
  </head>
  <body style="text-align:left;width:700px;margin-right:8px">
    <script src="js/d3.v2.js"></script>
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
    var dict = {};
    var flag = false, //for percentage flag should be true
        yField = '<?php 
	       	       getvar('field2','State'); 
                ?>', //either state or party will be on y axis
        stateFilt = [<?php
                    getvar('state','');
                    ?>],
        partyFilt = [<?php
                    getvar('party','');
                    ?>],
        xField = '<?php
                getvar('field','');
                ?>',
        sortby = true, //sortby = true for sortby value, false for label
        data_max = 0;
    if('<?php
        getvar('sortt','x')
        ?>' == 'y')
        sortby = false;
    </script>
    <script type="text/javascript" src="js/bars.js"></script>
  </body>
</html>