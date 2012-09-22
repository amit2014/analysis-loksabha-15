<div class="grid" style="width:1200px">
  <div class="widget-wrapper">
    <h2>Hello Data</h2>
	<div id="ex_data" style="overflow:auto">
    <table border="0.0" cellspacing="0.5px" cellpadding="0">



    	<?php 
$row = 1; 
if (($handle = fopen("MPTrack.csv", "r")) !== FALSE) { 
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { 
        $num = count($data); 
        echo '<tr >'; 
        for ($c=0; $c < $num; $c++) { 
            echo '<td >'.$data[$c].'</td>'; 
        } 
		echo "</tr>";
    } 
    fclose($handle); 
} 
?>
</table>
    </div>
  </div>
</div>
