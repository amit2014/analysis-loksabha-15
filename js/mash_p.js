

      var margin = {top: 150, right: 0, bottom: 10, left: 215},
          width = 620,
          height = 620;

      var x = d3.scale.ordinal().rangeBands([0, width]),
          y = d3.scale.ordinal().rangeBands([0, width]),
          c = d3.scale.category10().domain(d3.range(100));

      var svg = d3.select("#feature").append("svg")
          .attr("width", width + margin.left + margin.right)
          .attr("height", height + margin.top + margin.bottom)
        .append("g")
          .attr("transform", "translate(" + margin.left + "," + margin.top + ")");		  
      d3.csv("MPTrack.csv", function(data) {
        var matrix = [];
        var numb = [];
        var states = [];
        var parties = [];
		
     
        for (var i = 0, s = 0, p = 0; i < data.length; i++) {
          if(states.indexOf(data[i]["State"]) < 0 && data[i]["State"].length > 0 && (stateFilt.length == 0 || stateFilt.indexOf(data[i]["State"]) >= 0) )
            states[s++] = data[i]["State"];
          if(parties.indexOf(data[i]["Political party"]) < 0 && data[i]["Political party"].length > 0 && (partyFilt.length == 0 || partyFilt.indexOf(data[i]["Political party"]) >= 0) )
            parties[p++] = data[i]["Political party"];
        };

        if(sortvar == 'party') {
          states.sort();

          var num = {};
          var mat = {};
          for (var i = data.length - 1; i >= 0; i--)
            if( states.indexOf(data[i]["State"]) >= 0 && parties.indexOf(data[i]["Political party"]) >= 0 && !isNaN(parseFloat(data[i][field])) ) {
              if(mat[data[i]["Political party"]] == undefined) {
                mat[data[i]["Political party"]] = 0;
                num[data[i]["Political party"]] = 0;
              }
              mat[data[i]["Political party"]] += parseFloat(data[i][field]);
              num[data[i]["Political party"]]++;
            }
          for(var i = 0; i < parties.length; ++i)
            if(num[parties[i]] > 0)
              mat[parties[i]] /= parseFloat(num[parties[i]]);
          parties.sort(function(a,b)  {
            return mat[b] - mat[a];
          })
        }
        else if(sortvar == 'state') {
          parties.sort();

          var num = {};
          var mat = {};
          for (var i = data.length - 1; i >= 0; i--)
            if( states.indexOf(data[i]["State"]) >= 0 && parties.indexOf(data[i]["Political party"]) >= 0 && !isNaN(parseFloat(data[i][field])) ) {
              if(mat[data[i]["State"]] == undefined) {
                mat[data[i]["State"]] = 0;
                num[data[i]["State"]] = 0;
              }
              mat[data[i]["State"]] += parseFloat(data[i][field]);
              num[data[i]["State"]]++;
            }
          for(var i = 0; i < states.length; ++i)
            if(num[states[i]] > 0)
              mat[states[i]] /= parseFloat(num[states[i]]);
          states.sort(function(a,b)  {
            return mat[b] - mat[a];
          })
        }
        else if(sortvar == 'sp')  {
          var num = {};
          var mat = {};
          for (var i = data.length - 1; i >= 0; i--)
            if( states.indexOf(data[i]["State"]) >= 0 && parties.indexOf(data[i]["Political party"]) >= 0 && !isNaN(parseFloat(data[i][field])) ) {
              if(mat[data[i]["Political party"]] == undefined) {
                mat[data[i]["Political party"]] = 0;
                num[data[i]["Political party"]] = 0;
              }
              mat[data[i]["Political party"]] += parseFloat(data[i][field]);
              num[data[i]["Political party"]]++;
            }
          for(var i = 0; i < parties.length; ++i)
            if(num[parties[i]] > 0)
              mat[parties[i]] /= parseFloat(num[parties[i]]);
          parties.sort(function(a,b)  {
            return mat[b] - mat[a];
          });          

          var num = {};
          var mat = {};
          for (var i = data.length - 1; i >= 0; i--)
            if( states.indexOf(data[i]["State"]) >= 0 && parties.indexOf(data[i]["Political party"]) >= 0 && !isNaN(parseFloat(data[i][field])) ) {
              if(mat[data[i]["State"]] == undefined) {
                mat[data[i]["State"]] = 0;
                num[data[i]["State"]] = 0;
              }
              mat[data[i]["State"]] += parseFloat(data[i][field]);
              num[data[i]["State"]]++;
            }
          for(var i = 0; i < states.length; ++i)
            if(num[states[i]] > 0)
              mat[states[i]] /= parseFloat(num[states[i]]);
          states.sort(function(a,b)  {
            return mat[b] - mat[a];
          });
        }
        else  {
          states.sort();
          parties.sort();
        }


        for (var i = 0; i < states.length; i++) {
          matrix[i] = [];
          numb[i] = [];
          for (var j = 0; j < parties.length; j++)  {
            matrix[i][j] = {state: states[i], party: parties[j], z: 0};
            numb[i][j] = 0;
          }
        }

        for (var i = data.length - 1; i >= 0; i--)
          if( states.indexOf(data[i]["State"]) >= 0 && parties.indexOf(data[i]["Political party"]) >= 0 && !isNaN(parseFloat(data[i][field])) ) {
            matrix[states.indexOf(data[i]["State"])][parties.indexOf(data[i]["Political party"])].z += parseFloat(data[i][field]);
            numb[states.indexOf(data[i]["State"])][parties.indexOf(data[i]["Political party"])]++;
          }

        for(var i = 0; i < matrix.length; ++i)
          for(var j = 0; j < matrix[0].length; ++j)
            if(numb[i][j] > 0)
              matrix[i][j].z /= parseFloat(numb[i][j]);

        var max = 0, min = 999999;
        for(var i = 0; i < matrix.length; ++i)
          for(var j = 0; j < matrix[0].length; ++j) {
            max = Math.max(matrix[i][j].z,max);
            if(matrix[i][j].z != 0)
              min = Math.min(matrix[i][j].z,min);
          }
        for(var i = 0; i < matrix.length; ++i)
          for(var j = 0; j < matrix[0].length; ++j) {
            if(matrix[i][j].z != 0)
              matrix[i][j].z = 0.85*(matrix[i][j].z - min)/(max-min) + 0.015;
          }
console.log(matrix,min,max);
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