<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>Scatterplot Matrix</title>
    <script type="text/javascript" src="d3.v2.js"></script>
    <link type="text/css" rel="stylesheet" href="css/splom.css"/>
  </head>
  <body>
    <div id="chart"></div>
    <script type="text/javascript">
          <?php
        function getvar($vname)  { 
          if(isset($_GET[$vname]))
            echo urldecode($_GET[$vname]) ;
        }
      ?>

      var stateFilt = [<?php
                      getvar('state');
                      ?>],
          partyFilt = [<?php
                      getvar('party');
                      ?>];
console.log(stateFilt);
      d3.csv("MPTrack.csv", function(mps) {

        var age = "Age",
            debs = "Debates",
            qs = "Questions",
            att = "Attendance",
            quali = "Educational qualifications";
        var traits = [age, debs, qs, att];

        function qual2class(q)  {
          return q.replace(/[^a-z]+/gi, '');
        }

        mps = mps.filter(function(obj) {
          for(trait in traits)
            if ( isNaN ( parseFloat ( obj[ traits[trait] ] ) ) )
              return false;
          if (stateFilt.length != 0 && stateFilt.indexOf(obj["State"]) < 0)
            return false;
          if (partyFilt.length != 0 && partyFilt.indexOf(obj["Political party"]) < 0)
            return false;
          return true;
        });

        // Size parameters.
        var size = 150,
            padding = 19.5,
            n = 4;

        // Position scales.
        var x = {}, y = {};
        function setScales(trait) {
          var valueExtractor = function(d) { return parseFloat(d[trait]); },
              domain = [d3.min(mps, valueExtractor), d3.max(mps, valueExtractor)],
              range = [padding / 2, size - padding / 2];
          x[trait] = d3.scale.linear()
          .domain(domain)
          .range(range);

          y[trait] = d3.scale.linear()
          .domain(domain)
          .range(range.slice().reverse());
        }
        for(trait in traits)
          setScales(traits[trait]);

        // Axes.
        var axis = d3.svg.axis()
            .ticks(5)
            .tickSize(size * n);

        // Brush.
        var brush = d3.svg.brush()
            .on("brushstart", brushstart)
            .on("brush", brush)
            .on("brushend", brushend);

        // Root panel.
        var svg = d3.select("#chart").append("svg")
            .attr("width", size * n + padding + 500)
            .attr("height", size * n + padding);


        // X-axis.
        svg.selectAll("g.x.axis")
            .data(traits)
          .enter().append("g")
            .attr("class", "x axis")
            .attr("transform", function(d, i) { return "translate(" + i * size + ",0)"; })
            .each(function(d) { d3.select(this).call(axis.scale(x[d]).orient("bottom")); });

        // Y-axis.
        svg.selectAll("g.y.axis")
            .data(traits)
          .enter().append("g")
            .attr("class", "y axis")
            .attr("transform", function(d, i) { return "translate(0," + i * size + ")"; })
            .each(function(d) { d3.select(this).call(axis.scale(y[d]).orient("right")); });

        // Cell and plot.
        var cell = svg.selectAll("g.cell")
            .data(cross(traits, traits))
          .enter().append("g")
            .attr("class", "cell")
            .attr("transform", function(d) { return "translate(" + d.i * size + "," + d.j * size + ")"; })
            .each(plot);

        // Titles for the diagonal.
        cell.filter(function(d) { return d.i == d.j; }).append("text")
            .attr("x", padding)
            .attr("y", padding)
            .attr("dy", ".71em")
            .text(function(d) { return d.x; });

        function plot(p) {
          var cell = d3.select(this);

          // Plot frame.
          cell.append("rect")
              .attr("class", "frame")
              .attr("x", padding / 2)
              .attr("y", padding / 2)
              .attr("width", size - padding)
              .attr("height", size - padding);

          // Plot dots.
          cell.selectAll("circle")
              .data(mps)
            .enter().append("circle")
              .attr("class", function(d) { return qual2class(d[quali]); })
              .attr("cx", function(d) { return x[p.x](parseFloat(d[p.x])); })
              .attr("cy", function(d) { return y[p.y](parseFloat(d[p.y])); })
              .attr("r", 3);

          // Plot brush.
          cell.call(brush.x(x[p.x]).y(y[p.y]));
        }

        // Clear the previously-active brush, if any.
        function brushstart(p) {
          if (brush.data !== p) {
            cell.call(brush.clear());
            brush.x(x[p.x]).y(y[p.y]).data = p;
          }
        }

        // Highlight the selected circles.
        function brush(p) {
          var e = brush.extent();
          svg.selectAll("circle").attr("class", function(d) {
            return e[0][0] <= parseFloat(d[p.x]) && parseFloat(d[p.x]) <= e[1][0]
                && e[0][1] <= parseFloat(d[p.y]) && parseFloat(d[p.y]) <= e[1][1]
                ? qual2class(d[quali]) : null;
          });
        }

        // If the brush is empty, select all circles.
        function brushend() {
          if (brush.empty()) svg.selectAll("circle").attr("class", function(d) {
            return qual2class(d[quali]);
          });
        }

        function cross(a, b) {
          var c = [], n = a.length, m = b.length, i, j;
          for (i = -1; ++i < n;) for (j = -1; ++j < m;) c.push({x: a[i], i: i, y: b[j], j: j});
          return c;
        }
        

        // var legend = svg.append("text")
        //   .attr("width", 100)
        //   .attr("height", 200)
        //   .attr("stroke", "black")
        //   .attr("stroke-width", "8")
        //   .attr("x", size * n + padding + 50);
        // legend.attr("y", (size * n + padding)/2 - legend.attr("height")/2);
        // console.log(legend);

      });

    </script>
  </body>
</html>
