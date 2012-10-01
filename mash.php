<!DOCTYPE html>
<meta charset="utf-8">
<html lang="en-US">
<?php include("includes/head.php"); ?>
<body class="home blog logged-in admin-bar custom-background customize-support">
<div id="container" class="hfeed">
  <?php include("includes/header.php"); ?>  
  <div id="wrapper" class="clearfix">
    <div class="home-widgets">
      <?php include("includes/panel.php"); ?>
    </div>
    <div class="mash" id="featured">

      <style>

      #featured {
        font-family: "Helvetica Neue", Helvetica, sans-serif;
        position: relative;
        width: 840px;
      }

      svg {
        font: 10px sans-serif;
      }

      .axis path, .axis line {
        fill: none;
        stroke: #000;
        shape-rendering: crispEdges;
      }

      .background {
        fill: #eee;
      }

      line {
        stroke: #fff;
      }

      text.active {
        fill: red;
      }

      </style>
      <script src="js/d3.v2.min.js?2.8.1"></script>

      <script>

      var margin = {top: 150, right: 0, bottom: 10, left: 215},
          width = 620,
          height = 620;

      var x = d3.scale.ordinal().rangeBands([0, width]),
          y = d3.scale.ordinal().rangeBands([0, width]),
          c = d3.scale.category10().domain(d3.range(100));

      var svg = d3.select("#featured").append("svg")
          .attr("width", width + margin.left + margin.right)
          .attr("height", height + margin.top + margin.bottom)
        .append("g")
          .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

      <?php
        function getvar($vname, $deflt)  { 
          if(isset($_GET[$vname])){
            echo urldecode($_GET[$vname]) ;
          }
          else
          echo "$deflt"; 
        }
      ?>

      var field = '<?php
                    getvar('field','Questions');
                  ?>',
          stateFilt = [<?php
                        getvar('state','');
                      ?>],
          partyFilt = [<?php
                        getvar('party','');
                      ?>];
      console.log(field);
      d3.csv("MPTrack.csv", function(mps) {
        var matrix = [];
        var numb = [];
        var states = [];
        var parties = [];

        
        for (var i = 0, s = 0, p = 0; i < mps.length; i++) {
          if(states.indexOf(mps[i]["State"]) < 0 && mps[i]["State"].length > 0 && (stateFilt.length == 0 || stateFilt.indexOf(mps[i]["State"]) >= 0) )
            states[s++] = mps[i]["State"];
          if(parties.indexOf(mps[i]["Political party"]) < 0 && mps[i]["Political party"].length > 0 && (partyFilt.length == 0 || partyFilt.indexOf(mps[i]["Political party"]) >= 0) )
            parties[p++] = mps[i]["Political party"];
        };

        states.sort();
        parties.sort();
        for (var i = 0; i < states.length; i++) {
          matrix[i] = [];
          numb[i] = [];
          for (var j = 0; j < parties.length; j++)  {
            matrix[i][j] = {state: states[i], party: parties[j], z: 0};
            numb[i][j] = 0;
          }
        }

        for (var i = mps.length - 1; i >= 0; i--)
          if( states.indexOf(mps[i]["State"]) >= 0 && parties.indexOf(mps[i]["Political party"]) >= 0 && !isNaN(parseFloat(mps[i][field])) ) {
            matrix[states.indexOf(mps[i]["State"])][parties.indexOf(mps[i]["Political party"])].z += parseFloat(mps[i][field]);
            numb[states.indexOf(mps[i]["State"])][parties.indexOf(mps[i]["Political party"])]++;
          }

        for(var i = 0; i < matrix.length; ++i)
          for(var j = 0; j < matrix[0].length; ++j)
            if(numb[i][j] > 0)
              matrix[i][j].z /= parseFloat(numb[i][j]);

        var max = 0;
        for(var i = 0; i < matrix.length; ++i)
          for(var j = 0; j < matrix[0].length; ++j)
            max = Math.max(matrix[i][j].z,max);
        for(var i = 0; i < matrix.length; ++i)
          for(var j = 0; j < matrix[0].length; ++j)
            matrix[i][j].z /= max;

        var mtrans = [];
        for (var i = 0; i < matrix.length; i++)
          for (var j = 0; j < matrix[0].length; j++)  {
            if(i == 0)
              mtrans[j] = [];
            mtrans[j][i] = matrix[i][j];
          }
        
        var rowData = mtrans, colData = matrix;

        // the axes
        x.domain(states);
        y.domain(parties);

        svg.append("rect")
            .attr("class", "background")
            .attr("width", width)
            .attr("height", height);

        var row = svg.selectAll(".row")
            .data(rowData)
          .enter().append("g")
            .attr("class", "row")
            .attr("transform", function(d, i) { return "translate(0," + y(i) + ")"; })
            .each(row);

        row.append("line")
            .attr("x2", width);

        row.append("text")
            .attr("x", -6)
            .attr("y", y.rangeBand() / 2)
            .attr("dy", ".32em")
            .attr("text-anchor", "end")
            .text(function(d, i) { return parties[i]; });

        var column = svg.selectAll(".column")
            .data(colData)
          .enter().append("g")
            .attr("class", "column")
            .attr("transform", function(d, i) { return "translate(" + x(i) + ")rotate(-90)"; });

        column.append("line")
            .attr("x1", -width);

        column.append("text")
            .attr("x", 6)
            .attr("y", x.rangeBand() / 2)
            .attr("dy", ".32em")
            .attr("text-anchor", "start")
            .text(function(d, i) { return states[i]; });

        function row(row) {

          d3.select(this).selectAll(".cell_bkg")
              .data(row)
            .enter().append("rect")
              .attr("class", "cell_bkg")
              .attr("x", function(d) { return x(d.state);})
              .attr("height", y.rangeBand())
              .attr("width", x.rangeBand())
              .style("fill","#ccc")
              .style("fill-opacity", 0)
              .on("mouseover", mouseover)
              .on("mouseout", mouseout);

          d3.select(this).selectAll(".cell")
              .data(row.filter(function(d) { return d.z; }))
            .enter().append("circle")
              .attr("class", "cell")
              .attr("cx", function(d) { return x(d.state) + x.rangeBand()/2; })
              .attr("cy", y.rangeBand()/2)
              .attr("r", Math.min(x.rangeBand(),y.rangeBand())/2-1)
              .attr("stroke", "black")
              .style("fill-opacity", function(d) { return d.z; })
              .style("fill", "darkred")
              .on("mouseover", mouseover)
              .on("mouseout", mouseout)
              .append("title").text(function(d)  {return "Average " + field + ": " + parseFloat(parseInt((d.z*max*100)))/100.0;});

        }

        function mouseover(p) {
          d3.selectAll(".row text").classed("active", function(d, i) { return i == parties.indexOf(p.party); });
          d3.selectAll(".column text").classed("active", function(d, i) { return i == states.indexOf(p.state); });
          d3.selectAll(".cell_bkg").transition().duration(375).style("fill-opacity", function(d) { return d.state == p.state || d.party == p.party ? 0 : 1; } );
          d3.selectAll(".cell").transition().duration(375).style("fill", function(d) { return d.state == p.state || d.party == p.party ? "darkred" : "gray"; } );
        }

        function mouseout() {
          d3.selectAll("text").classed("active", false);
          d3.selectAll(".cell_bkg").transition().duration(375).style("fill-opacity", 0);
          d3.selectAll(".cell").transition().duration(375).style("fill", "darkred" );
        }

      });

      </script>
    </div>
  </div>
  <!-- end of #wrapper --> 
</div>
<!-- end of #container -->
<?php include("includes/footer.php"); ?>
<?php include("includes/adminbar.php"); ?>
</div>
</body>
</html>
