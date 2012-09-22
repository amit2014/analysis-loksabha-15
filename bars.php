<!-- Annotated javascript available at http://enja.org/code/tuts/d3/bar -->
<!-- Code walkthrough screencast available at -->
<html>
  <head>
    <title>Bar Charts</title>
    <style type="text/css">
        .bar rect
        {
/*
fill: black;
stroke: black;
*/
        }
        .label
        {
            font-family: Verdana;
            font-size: 11pt;
            color: gray;
            fill-opacity: .6;
        }
        .value
        {
            font-family: Verdana;
            font-size: 9pt;
            color: gray;
            fill-opacity: .6;
        }

        .tick_label
        {
            font-size: 10pt;
            font-family: Verdana;
            color: black;
            fill-opacity: 1;
        }
    </style>
  </head>
  <body style="text-align:center">
    <script src="js/d3.v2.js"></script>
    <script type="text/javascript">

    var dict = {};
    
    var flag = false, //for percentage flag should be true
        field = <?php 
			if(isset($_GET['field'])){
				echo "\"";
				echo urldecode($_GET['field']) ;
				echo "\"";
			}
			else
			echo "'Age'"; 
			?>, //field which has to be plotted
        sortby = true, //sortby = true for sortby value, false for label
        data_max = 0;
    d3.csv("MPTrack.csv", function(data) {
    
        for(var i = data.length - 1; i >= 0; --i) {
            if(dict[data[i][field]] == undefined)
                dict[data[i][field]] = 0;
            dict[data[i][field]]++;
            }
        rest();

    });
    function rest() {
    var data = [];
    var formatter;
    var length = 0;
    if (flag){
        formatter = d3.format(".02f");
        for (field in dict){
            var val = (dict[field]*100/552);
            data.push({"label":field, "value":val});
            if (val>data_max)
                data_max = val;
            length++;
        }
    }
    else{
        formatter = d3.format(".00f");
        for (field in dict){
            var val = (dict[field]);
            data.push({"label":field, "value":val});
            if (val>data_max)
                data_max = val;
            length++;
        }
    }
    if (sortby)
        data.sort(function(a,b){
            return b.value - a.value;
        });
    else
        data.sort(function(a,b){
            if (b.label > a.label)
                return -1;
            else if (b.label < a.label)
                return 1;
            return 0;
        });
    
    //number of tickmarks to use
    var num_ticks = 10,

    //margins
    left_margin = 325,
    right_margin = left_margin,
    top_margin = 30,
    bottom_margin = 0;


    var w = 900, //width
        h = 25*length, //height
        color = function(id) { return '#008aa9' };

    var x = d3.scale.linear()
        .domain([0, data_max])
        .range([0, w - ( left_margin +50 ) ]),
        y = d3.scale.ordinal()
        .domain(d3.range(data.length))
        .rangeBands([bottom_margin, h - top_margin], .5);


    var chart_top = h - y.rangeBand()/2 - top_margin;
    var chart_bottom = bottom_margin + y.rangeBand()/2;
    var chart_left = left_margin;
    var chart_right = w -10;

    /*
* Setup the SVG element and position it
*/
    var vis = d3.select("body")
        .append("svg:svg")
            .attr("width", w)
            .attr("height", h)
        .append("svg:g")
            .attr("id", "barchart")
            .attr("class", "barchart")


    //Ticks
    var rules = vis.selectAll("g.rule")
        .data(x.ticks(num_ticks))
    .enter()
        .append("svg:g")
        .attr("transform", function(d)
                {
                return "translate(" + (chart_left + x(d)) + ")";});
    rules.append("svg:line")
        .attr("class", "tick")
        .attr("y1", chart_top)
        .attr("y2", chart_top + 4)
        .attr("stroke", "black");

    rules.append("svg:text")
        .attr("class", "tick_label")
        .attr("text-anchor", "middle")
        .attr("y", chart_top)
        .text(function(d)
        {
        return d;
        });
    var bbox = vis.selectAll(".tick_label").node().getBBox();
    vis.selectAll(".tick_label")
    .attr("transform", function(d)
            {
            return "translate(0," + (bbox.height) + ")";
            });

    var bars = vis.selectAll("g.bar")
        .data(data)
    .enter()
        .append("svg:g")
            .attr("class", "bar")
            .attr("transform", function(d, i) {
                    return "translate(0, " + (y(i)-8) + ")"; });

    bars.append("svg:rect")
        .attr("x", right_margin)
        .attr("fill", color(0))
        .attr("stroke", color(0))
        .attr("height", y.rangeBand()+10).transition().duration(1000)
        .attr("width", function(d) {
                return (x(d.value));
                });


    //Labels

    var labels = vis.selectAll("g.bar")
        .append("svg:text")
            .attr("class", "label")
            .attr("x", function(d){
                return left_margin - this.getBBox().width - 8})
            .attr("text-anchor", "end")
            .text(function(d) {
                    return d.label;
                    });

    var bbox = labels.node().getBBox();
    vis.selectAll(".label")
        .attr("transform", function(d) {
                return "translate(0, " + (y.rangeBand()/2 + bbox.height/4 + 8) + ")";
                });


    labels = vis.selectAll("g.bar")
        .append("svg:text")
        .attr("class", "value")
        .attr("x", function(d)
                {
                return right_margin + 10;
                })
        .attr("text-anchor", "left")
        .text(function(d)
        {
            if (flag)
                return "" + formatter(d.value) + "%";
            return "" + formatter(d.value);
        });

    labels.transition().duration(900)
        .attr("x", function(d)
                {
                return x(d.value) + right_margin + 10;
                });

    bbox = labels.node().getBBox();
    vis.selectAll(".value")
        .attr("transform", function(d)
        {
            return "translate(0, " + (y.rangeBand()/2 + bbox.height/4 + 8) + ")";
        });

    //Axes
    vis.append("svg:line")
        .attr("class", "axes")
        .attr("x1", chart_left)
        .attr("x2", chart_left)
        .attr("y1", chart_bottom)
        .attr("y2", chart_top)
        .attr("stroke", "black");
     vis.append("svg:line")
        .attr("class", "axes")
        .attr("x1", chart_left)
        .attr("x2", chart_right)
        .attr("y1", chart_top)
        .attr("y2", chart_top)
        .attr("stroke", "black");
    }
 
    </script>
  </body>
</html>