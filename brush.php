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
    if(isset($_GET[$vname])){
      echo "\"";
      echo urldecode($_GET[$vname]) ;
      echo "\"";
    }
    else
    echo "'$deflt'"; 
  }
?>

var data = [],
    dict = {},
    fx = <?php
          getvar('fx',"Age");
          ?>,
    fy = <?php
          getvar('fy',"Attendance");
          ?>;
dict[fx] = [];
dict[fy] = [];
var stateFilt = <?php
                getvar('state',"");
                ?>,
    partyFilt = <?php
                getvar('party',"");
                ?>;

d3.csv("MPTrack.csv", function(mps) {

  for (var i = mps.length - 1; i >= 0; i--) {
    var a = parseFloat(mps[i][fx]);
    var b = parseFloat(mps[i][fy]);
    if(isNaN(a) || isNaN(b))
      continue;
    if(stateFilt != "" && mps[i]["State"] != stateFilt)
      continue;
    if(partyFilt != "" && mps[i]["Political party"] != partyFilt)
      continue;
    data.push([a, b]);
    dict[fx].push(a);
    dict[fy].push(b);
  };

  var margin = {top: 10, right: 10, bottom: 50, left: 40},
    width = 960 - margin.right - margin.left,
    height = 500 - margin.top - margin.bottom;

  var x = d3.scale.linear()
      .domain(d3.extent(dict[fx]))
      .range([0, width]);

  var y = d3.scale.linear()
      .domain(d3.extent(dict[fy]))
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
