function histogramChart(field) {
  var margin = {top: 0, right: 30, bottom: 50, left: 30},
      width = 900,
      height = 350;

  var histogram = d3.layout.histogram(),
      x = d3.scale.ordinal(),
      y = d3.scale.linear(),
      xAxis = d3.svg.axis().scale(x).orient("bottom").tickSize(6, 0),
      yAxisLeft = d3.svg.axis().scale(y).orient("left").tickSize(6,0,2),
      yAxisRight = d3.svg.axis().scale(y).orient("right").tickSize(6,0,2);

  function chart(selection) {
    selection.each(function(data) { 
      
      // Compute the histogram.
      data = histogram(data);

      // Update the x-scale.
      x   .domain(data.map(function(d) { return d.x; }))
          .rangeRoundBands([0, width - margin.left - margin.right], .1);

      // Update the y-scale.
      y   .domain([0, d3.max(data, function(d) { return d.y; })])
          .range([height - margin.top - margin.bottom, 0]);

      // Select the svg element, if it exists.
      var svg = d3.select(this).selectAll("svg").data([data]);

      // Otherwise, create the skeletal chart.
      var gEnter = svg.enter().append("svg").append("g");
      gEnter.append("g").attr("class", "shads");
      gEnter.append("g").attr("class", "bars");
      gEnter.append("g").attr("class", "x axis");
      gEnter.append("g").attr("class", "y axis right");
      gEnter.append("g").attr("class", "y axis left");

      // Update the outer dimensions.
      svg .attr("width", width)
          .attr("height", height)
		  .attr("style","padding:10px");

      // Update the inner dimensions.
      var g = svg.select("g")
          .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

      
      var pts = [];

      // Update the bars.
      var shads = svg.select(".shads").selectAll(".shad").data(data);
      shads.enter().append("rect");
      shads.exit().remove();
      shads.attr("width", x.rangeBand())
          .attr("x", function(d) { return x(d.x)+3; })
          .attr("y", function(d) { return y.range()[0]-3; })
          .attr("height", function(d) { return 0; })
          .order();
      var bar = svg.select(".bars").selectAll(".bar").data(data);
      bar.enter().append("rect");
      bar.exit().remove();
      bar .attr("width", x.rangeBand())
          .attr("x", function(d) { pts.push([x(d.x)+x.rangeBand()/2, y.range()[0]]); return x(d.x); })
          .attr("y", function(d) { return y.range()[0]; })
          .attr("height", function(d) { return 0; })
          .order();

      var line = d3.svg.line();
      line.interpolate("bundle");
      line.tension(0.8);
      var c = g.append("path").data([pts]).attr("class", "curve").attr("d",line);
      var pts2 = [];

      shads.transition().duration(750)
          .attr("y", function(d) { return y(d.y)+3; })
          .attr("height", function(d) { return Math.max(y.range()[0] - y(d.y)-3, 0); });
      
      bar.transition().duration(750)
          .attr("y", function(d,i) {pts[i][1] = y(d.y); return y(d.y); })
          .attr("height", function(d) { return y.range()[0] - y(d.y); });

      setTimeout(function() {c.transition().duration(700).attr("d", line);}, 50);

      // Update the axes.
      g.select(".x.axis")
          .attr("transform", "translate(0," + y.range()[0] + ")")
          .call(xAxis);
      g.select(".y.axis.left")
          .call(yAxisLeft);
      g.select(".y.axis.right")
          .attr("transform", "translate("+(width-margin.right-margin.left)+",0)")
          .call(yAxisRight);
      svg.append("text")
        .attr("class", "x label")
        .attr("x", (width/2)-(field.length/2)*17 - 100)
        .attr("y", height-10)
        .attr("font-size", 17)
        .attr("stroke-width", 9)
		.attr("font-family",'-webkit-body')
        .text(field+" of MP's of selected States and Parties "
		);
    });
  }

  chart.margin = function(_) {
    if (!arguments.length) return margin;
    margin = _;
    return chart;
  };

  chart.width = function(_) {
    if (!arguments.length) return width;
    width = _;
    return chart;
  };

  chart.height = function(_) {
    if (!arguments.length) return height;
    height = _;
    return chart;
  };

  // Expose the histogram's value, range and bins method.
  d3.rebind(chart, histogram, "value", "range", "bins");

  // Expose the x-axis' tickFormat method.
  d3.rebind(chart, xAxis, "tickFormat");

  return chart;
}
