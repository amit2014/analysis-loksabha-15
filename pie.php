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
		console.log('->',field,state.length,party.length);
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
		/*for (var i = mps.length - 1; i >= 0; i--) {
		 if (mps[i]["Age"]>70)
		 data[0]++;
		 else if (mps[i]["Age"]>50)
		 data[1]++;
		 else if (mps[i]["Age"]>30)
		 data[2]++;
		 else
		 data[3]++;
		 }*/
	//	console.log(data);
	//	console.log(fieldd);
		/*var colors = [];
		 var color = Math.random()*360, off = 4*360/39;
		 for(var i = 1; i <= 50; ++i)
		 colors.push( "hsl(" + ((color+off*i)%360) + ", 60%, 60%)");
		 var z = d3.scale.ordinal()
		 .range(colors);*/
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

		var arcs = vis.selectAll("g.arc").data(donut).enter().append("g").attr("class", "arc").attr("transform", "translate(" + radius + "," + radius + ")");

		var paths = arcs.append("path").attr("style","stroke:#000; stroke-width:0.2")
			.attr("fill", function(d, i) {
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
		var j=$('path');
		for (l in j){
		d3.select("div").append("div").data([data]).attr("id","leg").attr("style","background-color:#faf;width;300px;height:400px;float:left");
		//console.log(j.text());
		}
			
		
		
		


		/*arcs.append("text")
		 .attr("transform", function(d) { return "translate(" + arc2.centroid(d) + ")"; })
		 .attr("dy", ".35em")
		 .attr("text-anchor", "middle")
		 .attr("display", function(d) { return d.value > .15 ? null : "none"; })
		 .text(function(d, i) { 
		 return fieldd[i];
		 });*/
		//d3.select("body").append("br");
/*		d3.select("body").selectAll("span").data(fieldd).enter().append("span").attr("style", function(d, i) {
				return " font-size:12px; " + "color:" + color(i)
			}).html(function(d, i) {
				return d + ':' + data[i] + '<br/>'
			});*/


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