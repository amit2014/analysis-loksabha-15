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
  /*fill:gray;*/
  /*stroke:white;*/
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
          getvar('xfield',"Age");
          ?>',
    fy = '<?php
          getvar('field',"Attendance");
          ?>';
dict[fx] = [];
dict[fy] = [];
var stateFilt = [<?php
                getvar('state',"");
                ?>],
    partyFilt = [<?php
                getvar('party',"");
                ?>];

d3.csv("MPTrack.csv", function(mps) {

  for (var i = mps.length - 1; i >= 0; i--) {
    var a = parseFloat(mps[i][fx]);
    var b = parseFloat(mps[i][fy]);
    if(isNaN(a) || isNaN(b))
      continue;
    if(stateFilt.length != 0 && stateFilt.indexOf(mps[i]["State"]) < 0)
      continue;
    if(partyFilt.length != 0 && partyFilt.indexOf(mps[i]["Political party"]) < 0)
      continue;
    data.push([a, b]);
    dict[fx].push(a);
    dict[fy].push(b);
  };

  var margin = {top: 10, right: 10, bottom: 50, left: 40},
    width = 960 - margin.right - margin.left,
    height = 500 - margin.top - margin.bottom;

  var xdom = d3.extent(dict[fx]);
  var xdiff = xdom[1]-xdom[0];
  xdom[0] -= xdiff/17.5;
  xdom[0] = Math.max(0,xdom[0]);
  xdom[1] += xdiff/17.5;
  if(fx == "Attendance")
    xdom[1] = Math.min(100,xdom[1]);

  var ydom = d3.extent(dict[fy]);
  var ydiff = ydom[1]-ydom[0];
  ydom[0] -= ydiff/17.5;
  ydom[0] = Math.max(0,ydom[0]);
  ydom[1] += ydiff/17.5;
  if(fy == "Attendance")
    ydom[1] = Math.min(100,ydom[1]);

  var x = d3.scale.linear()
      .domain(xdom)
      .range([0, width]);

  var y = d3.scale.linear()
      .domain(ydom)
      .range([height, 0]);

  var svg = d3.select("body").append("svg")
      .attr("width", width + margin.right + margin.left)
      .attr("height", height + margin.top + margin.bottom)
    .append("g")
      .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(d3.svg.axis().scale(x).orient("bottom"));

  svg.append("g")
      .attr("class", "y axis")
      .call(d3.svg.axis().scale(y).orient("left"));

  var circle = svg.append("g").selectAll("circle")
      .data(data)
    .enter().append("circle")
      .attr("transform", function(d) { return "translate( 0," + height + ")"; });
  circle.transition().duration(750)
      .attr("r", 3.5)
      .attr("transform", function(d) { return "translate(" + x(d[0]) + "," + y(d[1]) + ")"; });

  svg.append("g")
      .attr("class", "brush")
      .call(d3.svg.brush().x(x).y(y)
      .on("brushstart", brushstart)
      .on("brush", brushmove)
      .on("brushend", brushend));

  function brushstart() {
    svg.classed("selecting", true);
  }

  function brushmove() {
    var e = d3.event.target.extent();
    circle.classed("selected", function(d) {
      console.log(d);
      return e[0][0] <= d[0] && d[0] <= e[1][0]
          && e[0][1] <= d[1] && d[1] <= e[1][1];
    });
  }

  function brushend() {
    svg.classed("selecting", !d3.event.target.empty());
  }

  svg.append("text")
    .text("... " + fx + " ...")
    .attr("x", width/2 - 12*fx.length/2)
    .attr("y", height+30)
    .attr("font-size", 12);

  svg.append("text")
    .text("... " + fy + " ...")
    .attr("x", "-" + (margin.left-15))
    .attr("y", height/2 + 3*fy.length)
    .attr("transform", "rotate(-90 -" + (margin.left-15) + " " + (height/2 + 3*fy.length) + ")")
    .attr("font-size", 12);
});

    </script>
  </body>
</html>
