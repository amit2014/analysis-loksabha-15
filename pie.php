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
	d3.csv("MPTrack.csv", function(mps) {
		var fieldd = [];
		
		for (var j = mps.length - 1; j >= 0; j--) {
			var key = mps[j][field];
			
//			console.log();
			if ( (state.length == 0 || state.indexOf(mps[j]['State']) >= 0)&& (party.length == 0 || party.indexOf(mps[j]['Political party']) >= 0)	){
				if ((fieldd.indexOf(key) >= 0)) {
					data[fieldd.indexOf(key)]++;
				}else{
					fieldd.push(key);
					data.push(1);
			}
		}
	}
		var width = 400,
			height = 400,
			outerRadius = Math.min(width, height) / 2,
			innerRadius = outerRadius * .6,
			radius = Math.min(width, height) / 2,
			data2 = d3.range(10).map(Math.random).sort(d3.descending),
			color = d3.scale.category20c(),
			arc = d3.svg.arc().outerRadius(radius),
			arc2 = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);
		donut = d3.layout.pie();


		var vis = d3.select("div").append("svg").data([data]).attr("width", width).attr("height", height).attr("style","float:left;");
		d3.select("div").append('div').attr('id','legend').style('float','left').style('width','340px').style('padding-left','90px').style('max-height','400px').style('overflow','auto');
		var arcs = vis.selectAll("g.arc").data(donut).enter().append("g").attr("class", "arc").attr("transform", "translate(" + radius + "," + radius + ")");

		var paths = arcs.append("path").attr("style","stroke:#000; stroke-width:0.2")
			.attr("fill", function(d, i) {
				var l = d3.select('#legend');
				var e = l.append('div').style('width','340px').style('height','20px').style('border','thin black solid').style('margin-top','1px')
					.style('border-collapse','collapse').style('float','right').style('text-align','left').style('font-size','smaller')
					.style('font-family','arial');
				var d = e.append('div').style('width','40px').style('height','20px').style('border','thin').style('float','left').style('background-color',color(i))
					.style('margin-right','10px');
				
				e.html(e.html()+fieldd[i]+': '+(data[i]*100/sum()).toFixed(2)+'%'+' ('+data[i]+')');
				return color(i);
			}).on("mouseover", function(d, i) {
				vis.selectAll("path").filter(function(d, j) {
					return i == j;
				}).style("fill", function(d, j) {
					return d3.rgb(color(i)).brighter();
				});
			}).on("mouseout", function(d, i) {
				vis.selectAll("path").style("fill", function(d, i) {
					return color(i);
				});
			});
		function sum(){var sum=0;for(i in data){ sum+=data[i];}return sum;}
		paths.append("title").text(function(d,i){return fieldd[i]+': '+(data[i]*100/sum()).toFixed(2)+'%'+' ('+data[i]+')'});


		paths.transition().ease("linear").duration(500).attrTween("d", tweenPie);

		paths.transition().ease("linear").delay(function(d, i) {
				return 2000 - i * 20;
			}).duration(500).attrTween("d", tweenDonut);

		function tweenPie(b) {
				b.innerRadius = 0;
				var i = d3.interpolate({
					startAngle: 0,
					endAngle: 0
				}, b);
				return function(t) {
					return arc(i(t));
				};
			}

		function tweenDonut(b) {
				b.innerRadius = radius * 0.0;
				var i = d3.interpolate({
					innerRadius: 0
				}, b);
				return function(t) {
					return arc(i(t));
				};
			}
	});
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