// JavaScript Document
window.onload = initall;

function initall() {
	d3.csv("MPTrack.csv", function(data) {
		var sel_field = document.getElementById("xfield");
		var blocked_fields = ["MP name", "Nature of membership", "Start of term", "End of term", "State", "Constituency", "Political party", "Gender", "Educational qualifications", "Educational qualifications - details", "Private Member Bills", "Notes", "National Debates average", "National Private Member Bills average", "National Questions average", "National Attendance average", "State's Debates average", "State's Private Member Bills  average", "State's Questions average", "State's Attendance average"];
		sel_field.innerHTML = "";
		for (field in data[0]) {
			if (blocked_fields.indexOf(field) < 0) 
			sel_field.innerHTML += "<option value=\'" + escape(field)+ "\'>" + field + "</option>";
		}


		document.getElementById("xfield").selectedIndex = 0;
		document.getElementById("yfield").innerHTML = '<option value="Frequency">Frequency</option>';

		document.getElementById("xfield").onchange = getfield;

		function getfield() {
			var url = encodeURI(this.options[this.selectedIndex].value);
			d3.select("iframe").attr("src", "histogram.php?field=" + url);
		}


		document.getElementById("graphs_0").onchange = function(e) {
			//	var g=d3.select(this).attr("graph");
			var sel_field = document.getElementById("xfield");
			var blocked_fields = ["MP name", "Nature of membership", "Start of term", "End of term", "State", "Constituency", "Political party", "Gender", "Educational qualifications", "Educational qualifications - details", "Private Member Bills", "Notes", "National Debates average", "National Private Member Bills average", "National Questions average", "National Attendance average", "State's Debates average", "State's Private Member Bills  average", "State's Questions average", "State's Attendance average"];
			sel_field.innerHTML = "";
			for (field in data[0]) {
				if (blocked_fields.indexOf(field) < 0) sel_field.innerHTML += "	<option value=\'" + escape(field)+ "\'>" + field + "</option>";
			}
			document.getElementById("xfield").selectedIndex = 0;
			document.getElementById("xfield").onchange = getfield1;

			function getfield1() {
				var url = encodeURI(this.options[this.selectedIndex].value);
				d3.select("iframe").attr("src", "histogram.php?field=" + url);
			}
			d3.select("iframe").attr("src", "histogram.php");

		}

		document.getElementById("graphs_1").onchange = function(e) {
			var sel_field = document.getElementById("xfield");
			var blocked_fields = ["MP name", "Start of term", "End of term", "Constituency", "Educational qualifications - details", "Private Member Bills", "Notes", "National Debates average", "National Private Member Bills average", "National Questions average", "National Attendance average", "State's Debates average", "State's Private Member Bills  average", "State's Questions average", "State's Attendance average","Age","Debates","Questions","Attendance"];
			sel_field.innerHTML = "";
			for (field in data[0]) {
				if (blocked_fields.indexOf(field) < 0) sel_field.innerHTML += "	<option value=\'" + escape(field) + "\'>" + field + "</option>";
			}

			document.getElementById("xfield").selectedIndex = 0;
			document.getElementById("xfield").onchange = getfield1;

			function getfield1() {
				var url = encodeURI(this.options[this.selectedIndex].value);
				d3.select("iframe").attr("src", "pie.php?field=" + url);
			}
			d3.select("iframe").attr("src", "pie.php?field="+(document.getElementById("xfield").options[document.getElementById("xfield").selectedIndex]).value);
		}

		document.getElementById("graphs_2").onchange = function(e) {
			var sel_field = document.getElementById("xfield");
			var blocked_fields = ["MP name", "Nature of membership", "Start of term", "End of term", "State", "Constituency", "Political party", "Gender", "Educational qualifications", "Educational qualifications - details", "Private Member Bills", "Notes", "National Debates average", "National Private Member Bills average", "National Questions average", "National Attendance average", "State's Debates average", "State's Private Member Bills  average", "State's Questions average", "State's Attendance average"];
			sel_field.innerHTML = "";
			for (field in data[0]) {
				if (blocked_fields.indexOf(field) < 0) sel_field.innerHTML += "<option value=\'" + escape(field) +"\'>" + field + "</option>";
			}

			d3.select("iframe").attr("src", "brush.php");
		}

		document.getElementById("graphs_3").onchange = function(e) {
			var sel_field = document.getElementById("xfield");
			var blocked_fields = ["MP name", "Nature of membership", "Start of term", "End of term", "Constituency", "Political party", "Gender", "Educational qualifications", "Educational qualifications - details", "Private Member Bills", "Notes", "National Debates average", "National Private Member Bills average", "National Questions average", "National Attendance average", "State's Debates average", "State's Private Member Bills  average", "State's Questions average", "State's Attendance average"];
			sel_field.innerHTML = "";
			for (field in data[0]) {
				if (blocked_fields.indexOf(field) < 0) sel_field.innerHTML += "<option value=\'" + escape(field)+ "\'>" + field + "</option>";
			}
			document.getElementById("xfield").onchange = getfield1;

			function getfield1() {
				var url = encodeURI(this.options[this.selectedIndex].value);
				d3.select("iframe").attr("src", "area.php?field=" + url);
			}
			d3.select("iframe").attr("src", "area.php");
		}

		document.getElementById("graphs_4").onchange = function(e) {
			var sel_field = document.getElementById("xfield");
			var blocked_fields = ["MP name", "Nature of membership", "Start of term", "End of term", "State", "Constituency", "Political party", "Gender", "Educational qualifications", "Educational qualifications - details", "Private Member Bills", "Notes", "National Debates average", "National Private Member Bills average", "National Questions average", "National Attendance average", "State's Debates average", "State's Private Member Bills  average", "State's Questions average", "State's Attendance average"];
			sel_field.innerHTML = "";
			for (field in data[0]) {
				if (blocked_fields.indexOf(field) < 0) sel_field.innerHTML += "<option value=\'" + escape(field)+ "\'>" + field + "</option>	";
			}

			document.getElementById("xfield").selectedIndex = 0;
			document.getElementById("xfield").onchange = getfield;

			function getfield() {
				var url = encodeURI(this.options[this.selectedIndex].value);
				d3.select("iframe").attr("src", "bars.php?field=" + url);
			}
			d3.select("iframe").attr("src", "bars.php");
		}
	});
}


function clone(obj) {
	if (null == obj || "object" != typeof obj) return obj;
	var copy = obj.constructor();
	for (var attr in obj) {
		if (obj.hasOwnProperty(attr)) copy[attr] = obj[attr];
	}
	return copy;
}