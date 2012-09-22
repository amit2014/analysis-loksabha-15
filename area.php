<!DOCTYPE html>
<html>
  <head>
    <title>Crimean War</title>
    <script type="text/javascript" src="d3.v2.js"></script>
    <style type="text/css">

svg {
  width: 960px;
  height: 500px;
  font: 10px sans-serif;
}

.rule {
  shape-rendering: crispEdges;
}

path.line {
  fill: none;
}

    </style>
  </head>
  <body>
    <script type="text/javascript">

var margin = {top: 20, right: 50, bottom: 170, left: 32},
    width = 960 - margin.right - margin.left,
    height = 550 - margin.top - margin.bottom;

var x = d3.scale.ordinal()
    .rangeRoundBands([0, width], 0.1);

var y = d3.scale.linear()
    .range([height, 0]);

var colors = [];
var color = Math.random()*360, off = 4*360/39;
for(var i = 1; i <= 50; ++i)
  colors.push( "hsl(" + ((color+off*i)%360) + ", 60%, 60%)");


var z = d3.scale.ordinal()
    .range(colors);

var svg = d3.select("body").append("svg")
    .attr("width", width)
    .attr("height", height)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

svg.append("rect")
  .attr("width", width-28)
  .attr("height", height)
  .attr("transform", "translate(3,0)")
  .attr("fill", "#ddd");

d3.csv("MPTrack.csv", function(mps) {

  var statesD = {}, states = [];
  var partiesD = {}, parties = [];

  function count(state, party)  {
    var c = 0;
    for (var i = mps.length - 1; i >= 0; i--)
      if (mps[i]["State"] == state && mps[i]["Political party"] == party)
        c++;
    return c;
  }
  
  //get distinct parties & states
  for (var i = mps.length - 1; i >= 0; i--) {
    if(mps[i]["State"].length > 0)  {
      if (statesD[mps[i]["State"]] == undefined)
        statesD[mps[i]["State"]] = 1;
      else
        statesD[mps[i]["State"]]++;
    }
    partiesD[mps[i]["Political party"]] = true;
  }

  //sort states into an array
  for(var state in statesD)
    states.push(statesD[state]+state);
  //sort first on the number of MPs from a state. If that's equal, sort lexico-ly
  x.domain(states.sort(function(x,y)  {
    var xd = x.replace(/[^\d]/g,'');
    var yd = y.replace(/[^\d]/g,'');
    var diff = parseInt(yd)-parseInt(xd);
    if (diff == 0 && x.replace(/[\d]/g,'') < y.replace(/[\d]/g,''))
      diff = -1;
    else if (diff == 0 && x.replace(/[\d]/g,'') > y.replace(/[\d]/g,''))
      diff = 1;
    return diff;
  }));

  states = states.map(function(d) {
    return d.replace(/[\d]/g,'');
  })

  //form parties into a new proper dictionary
  for(var party in partiesD)  {
    parties.push([]);
    for (var i = 0; i < states.length; i++)
      parties[parties.length - 1].push({x: states[i], y: count(states[i], party), party: party});
  }
  //now parties is an array with each party as an element which is an array of 35 (x,y) tuples, x being a state, y being its seats in that state.
  //sort the parties on the basis of no. of MPs
  parties.sort(function(s,t)  {
    var cs = 0, ct = 0;
    for(var i = 0; i < s.length; ++i) {
      cs += s[i].y;
      ct += t[i].y;
    }
    return cs-ct;
  });

  // Transpose the data into layers by party
  var stackLayout = d3.layout.stack()(parties);

  //setting the y domain
  var maxFromAState = 0;
  for(var state in statesD) {
    var fromState = 0;
    for(var party in partiesD)
      fromState += count(state, party);  
    maxFromAState = Math.max(maxFromAState, fromState);
  }
  y.domain([0, maxFromAState]);

  // Add an area for each party
  svg.selectAll("path.area")
      .data(stackLayout)
    .enter().append("path")
      .attr("class", "area")
      .style("fill", function(d, i) { return z(i); })
      .attr("d", d3.svg.area()
      .x(function(d) { return x(d.x); })
      .y0(function(d) { return y(d.y0); })
      .y1(function(d) { return y(d.y0 + d.y); }))
      .on("mouseover", function(d,i) {
        svg.selectAll("path.area").filter(function(d,j) { return i==j; })
          .transition().style("fill", function(d,j) {
            return d3.rgb(z(i)).brighter();
          });
      })
      .on("mouseout", function(d,i) {
        svg.selectAll("path.area")
          .transition().style("fill", function(d,i) {
            return z(i);
          });
      })
      .append("svg:title")
        .text(function(d,i) { return d[0].party; });

  // Add a line for each party.
  svg.selectAll("path.line")
      .data(stackLayout)
    .enter().append("path")
      .attr("class", "line")
      .style("stroke", function(d, i) { return d3.rgb(z(i)).darker(); })
      .attr("d", d3.svg.line()
      .x(function(d) { return x(d.x); })
      .y(function(d) { return y(d.y0 + d.y); }));

  // Add a label per state.
  svg.selectAll("text")
      .data(states)
    .enter().append("text")
      .attr("x", x)
      .attr("y", height + 6)
      .attr("text-anchor", "end")
      //.attr("dy", ".150em")
      .text(function(d) {return d;})
      .attr("transform", function(d, i)  {return "rotate(-60 " + x(i) + " " + (height + 6) + ")";});

  // Add y-axis rules.
  var rule = svg.selectAll("g.rule")
      .data(y.ticks(25))
    .enter().append("g")
      .attr("class", "rule")
      .attr("transform", function(d) { return "translate(0," + y(d) + ")"; });

  rule.append("line")
      .attr("x2", width-25)
      .attr("stroke-width","1")
      .style("stroke", function(d) { return d ? "#eee" : "#000"; })
      .style("stroke-opacity", function(d) { return d ? .7 : null; });

  rule.append("text")
      .attr("x", width -20)
      .attr("dy", ".35em")
      .text(d3.format(",d"));
});

    </script>
  </body>
</html>
