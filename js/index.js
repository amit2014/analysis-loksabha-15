// JavaScript Document
window.onload = initall;

function initall() {
	d3.csv("MPTrack.csv", function(data) {
		//Setting xfield up
		var sel_field = document.getElementById("xfield");
		var blocked_fields = ["MP name", "Nature of membership", "Start of term", "End of term", "State", "Constituency", "Political party", "Gender", "Educational qualifications", 			"Educational qualifications - details", "Private Member Bills", "Notes", "National Debates average", "National Private Member Bills average", 
			"National Questions average", "National Attendance average", "State's Debates average", "State's Private Member Bills  average", "State's Questions average", 
			"State's Attendance average"];
		sel_field.innerHTML = "";
		for (field in data[0]) {
			if (blocked_fields.indexOf(field) < 0) 
			sel_field.innerHTML += "<option value=\'" + escape(field)+ "\'>" + field + "</option>";
		}
		//**************
		
		//Setting States field up
		var allstates=['All'];
		for (var i=0;i<data.length;i++){
			if (allstates.indexOf(data[i]['State'])==-1){
				if (data[i]['State'])allstates=allstates.concat(data[i]['State']);
			}
		}
		allstates=allstates.sort();
		var statef = document.getElementById("statef");
		statef.innerHTML= '';
		for (state in allstates){
			statef.innerHTML += "<option value=\'" + escape(allstates[state])+ "\'>" + allstates[state] + "</option>";
		}
		//***************
	
		//Setting Party field up
		var allparties=['All'];
		for (var i=0;i<data.length;i++){
			if (allparties.indexOf(data[i]['Political party'])==-1){
				if (data[i]['Political party'])allparties=allparties.concat(data[i]['Political party']);
			}
		}
		allparties=allparties.sort();
		var statef = document.getElementById("partyf");
		statef.innerHTML= '';
		for (state in allparties){
			statef.innerHTML += "<option value=\'" + escape(allparties[state])+ "\'>" + allparties[state] + "</option>";
		}
		//***************
		
		//Setting onchange functions of dropdowns
		document.getElementById("xfield").selectedIndex = 0;
		document.getElementById("yfield").innerHTML = '<option value="Frequency">Frequency</option>';
		document.getElementById("xfield").onchange = setfield;
		document.getElementById('statef').onchange = setstate;
		document.getElementById('partyf').onchange = setparty;
		function showurl(){
			var curl = decodeURIComponent(d3.select("iframe").attr("src"));
			var file =	curl.substring(0,curl.indexOf('.php'))+'.php';
			var field=  curl.substring(curl.indexOf('?')+7,curl.indexOf('&'));
			var state=  curl.substring(curl.indexOf("state")+6);state=state.substring(0,state.indexOf('&'));
			var field2= curl.substring(curl.indexOf("field2")+7);field2=field2.substring(0,field2.indexOf('&'));
			var party = curl.substring(curl.indexOf('party')+6).substring(0);
			//console.log([curl,file,field,state,field2,party]);
			return [curl,file,field,state,field2,party];
		}
		function setfield() {
			var get=showurl();
			d3.select("iframe").attr("src", encodeURI(get[1]+"?field="+this.options[this.selectedIndex].value+"&state="+get[3]+"&field2="+get[4]+'&party='+get[5]));
		}
		function setstate(){
			var get=showurl();
			if(this.options[this.selectedIndex].value!='All') d3.select("iframe").attr("src", encodeURI(get[1]+"?field="+get[2]+"&state="+decodeURIComponent(this.options[this.selectedIndex].value)+"&field2="+get[4]+'&party='+get[5]));
			else d3.select("iframe").attr("src", encodeURI(get[1]+"?field="+get[2]+"&state="+"&field2="+get[4]+'&party='+get[5]));
		}
		function setparty(){
			var get=showurl();
			if(this.options[this.selectedIndex].value!='All') d3.select("iframe").attr("src", encodeURI(get[1]+"?field="+get[2]+"&state="+get[3]+"&field2="+get[4]+'&party='+decodeURIComponent(this.options[this.selectedIndex].value)));
			else d3.select("iframe").attr("src", encodeURI(get[1]+"?field="+get[2]+"&state="+"&field2="+get[4]+'&party='+get[5]));
		}
		function setstate(){
			var get=showurl();
			if(this.options[this.selectedIndex].value!='All') d3.select("iframe").attr("src", encodeURI(get[1]+"?field="+get[2]+"&state="+this.options[this.selectedIndex].value+"&field2="+get[4]+'&party='+get[5]));
			else d3.select("iframe").attr("src", encodeURI(get[1]+"?field="+get[2]+"&state="+"&field2="+get[4]+'&party='+get[5]));
		}
		//*****************
		
		function getdhw(){
	
	var f= document.getElementById("frame").style;

	var file=showurl()[1];
	
	var z=0.85;
	if (file=='histogram.php') z=0.9;
	else if (file=='pie.php') z=0.93;
	else if (file=='area.php') z=0.83;
	else if (file=='brush.php') z=0.8;
	else if (file=='bars.php') z=0.45;
	else z=0.5;

	f["zoom"]=z;
	f["-moz-tranform"]="scale("+z+")";
	f["-moz-tranform-origin"]="0 0";
	f["-o-transform"]="scale("+z+")";
	f["-o-transform-origin"]="0 0";
	f["-webkit-transform"]="scale("+z+")";
	f["-webkit-transform-origin"]= "0 0";
}

		getdhw();
		document.getElementById('frame').onload = getdhw;
		document.getElementById("graphs_0").onchange = function(e) {
			var sel_field = document.getElementById("xfield");
			var blocked_fields = ["MP name", "Nature of membership", "Start of term", "End of term", "State", "Constituency", "Political party", "Gender", 
			"Educational qualifications", "Educational qualifications - details", "Private Member Bills", "Notes", "National Debates average", 
			"National Private Member Bills average", "National Questions average", "National Attendance average", "State's Debates average", 
			"State's Private Member Bills  average", "State's Questions average", "State's Attendance average"];
			sel_field.innerHTML = "";
			for (field in data[0]) {
				if (blocked_fields.indexOf(field) < 0) sel_field.innerHTML += "	<option value=\'" + escape(field)+ "\'>" + field + "</option>";
			}
			document.getElementById("xfield").selectedIndex = 0;
			var get=showurl();
			d3.select("iframe").attr("src", encodeURI("histogram.php"+"?field="+get[2]+"&state="+get[3]+"&field2="+get[4]+'&party='+get[5]));
			//getdhw();
		}

		document.getElementById("graphs_1").onchange = function(e) {
			var sel_field = document.getElementById("xfield");
			var blocked_fields = ["MP name", "Start of term", "End of term", "Constituency", "Educational qualifications - details", "Private Member Bills", "Notes", "National Debates average", "National Private Member Bills average", "National Questions average", "National Attendance average", "State's Debates average", "State's Private Member Bills  average", "State's Questions average", "State's Attendance average","Age","Debates","Questions","Attendance"];
			sel_field.innerHTML = "";
			for (field in data[0]) {
				if (blocked_fields.indexOf(field) < 0) sel_field.innerHTML += "	<option value=\'" + escape(field) + "\'>" + field + "</option>";
			}

			document.getElementById("xfield").selectedIndex = 0;
			var get=showurl();
			d3.select("iframe").attr("src", encodeURI("pie.php"+"?field="+get[2]+"&state="+get[3]+"&field2="+get[4]+'&party='+get[5]));		
			//getdhw();
		}

		document.getElementById("graphs_2").onchange = function(e) {
			var sel_field = document.getElementById("xfield");
			var blocked_fields = ["MP name", "Nature of membership", "Start of term", "End of term", "State", "Constituency", "Political party", "Gender", "Educational qualifications", "Educational qualifications - details", "Private Member Bills", "Notes", "National Debates average", "National Private Member Bills average", "National Questions average", "National Attendance average", "State's Debates average", "State's Private Member Bills  average", "State's Questions average", "State's Attendance average"];
			sel_field.innerHTML = "";
			for (field in data[0]) {
				if (blocked_fields.indexOf(field) < 0) sel_field.innerHTML += "<option value=\'" + escape(field) +"\'>" + field + "</option>";
			}
			document.getElementById("xfield").selectedIndex = 0;
			var get=showurl();
			d3.select("iframe").attr("src", encodeURI("brush.php"+"?field="+get[2]+"&state="+get[3]+"&field2="+get[4]+'&party='+get[5]));		
			//getdhw();
		}

		document.getElementById("graphs_3").onchange = function(e) {
			var sel_field = document.getElementById("xfield");
			var blocked_fields = ["MP name", "Nature of membership", "Start of term", "End of term", "Constituency", "Political party", "Gender", "Educational qualifications", "Educational qualifications - details", "Private Member Bills", "Notes", "National Debates average", "National Private Member Bills average", "National Questions average", "National Attendance average", "State's Debates average", "State's Private Member Bills  average", "State's Questions average", "State's Attendance average"];
			sel_field.innerHTML = "";
			for (field in data[0]) {
				if (blocked_fields.indexOf(field) < 0) sel_field.innerHTML += "<option value=\'" + escape(field)+ "\'>" + field + "</option>";
			}
			document.getElementById("xfield").selectedIndex = 0;
			var get=showurl();
			d3.select("iframe").attr("src", encodeURI("area.php"+"?field="+get[2]+"&state="+get[3]+"&field2="+get[4]+'&party='+get[5]));		
			//getdhw();
		}

		document.getElementById("graphs_4").onchange = function(e) {
			var sel_field = document.getElementById("xfield");
			var blocked_fields = ["MP name", "Nature of membership", "Start of term", "End of term", "State", "Constituency", "Political party", "Gender", "Educational qualifications", "Educational qualifications - details", "Private Member Bills", "Notes", "National Debates average", "National Private Member Bills average", "National Questions average", "National Attendance average", "State's Debates average", "State's Private Member Bills  average", "State's Questions average", "State's Attendance average"];
			sel_field.innerHTML = "";
			for (field in data[0]) {
				if (blocked_fields.indexOf(field) < 0) sel_field.innerHTML += "<option value=\'" + escape(field)+ "\'>" + field + "</option>	";
			}
			document.getElementById("xfield").selectedIndex = 0;
			var get=showurl();
			d3.select("iframe").attr("src", encodeURI("bars.php"+"?field="+get[2]+"&state="+get[3]+"&field2="+get[4]+'&party='+get[5]));		
			//getdhw();
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