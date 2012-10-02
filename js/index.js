// JavaScript Document
window.onload = initall;

function initall() {
	d3.csv("MPTrack.csv", function(data) {
		//Setting xfield up
		var sel_field = document.getElementById("xfield");
		var blocked_fields = ["MP name", "Nature of membership", "Start of term", "End of term", "State", "Constituency", "Political party", "Gender", 
		"Educational qualifications", "Educational qualifications - details", "Private Member Bills", "Notes", "National Debates average", 
		"National Private Member Bills average", "National Questions average", "National Attendance average", "State's Debates average", 
		"State's Private Member Bills  average", "State's Questions average", "State's Attendance average"];
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
		document.getElementById("yfield").onchange = setfield2;
		document.getElementById("xfield").onchange = setfield;
		document.getElementById('statef').onchange = setstate;
		document.getElementById('partyf').onchange = setparty;
		function setfield2(){
			var get=showurl();
			var v=decodeURIComponent(this.options[this.selectedIndex].value);
			d3.select("iframe").attr("src", encodeURI(get[1]+"?field="+get[2]+"&state="+get[3]+"&field2="+v+'&party='+get[5]));
		}

		function setfield() {
			var get=showurl();
			d3.select("iframe").attr("src", encodeURI(get[1]+"?field="+this.options[this.selectedIndex].value+"&state="+get[3]+"&field2="+get[4]+'&party='+get[5]));
		}
		function setstate(){
			var v=decodeURIComponent(this.options[this.selectedIndex].value);
			var get=showurl();
			console.log('yo->',v);
			add_pc();
			var vv='';
			for (f in dstatea){
				if(dstatea[f]!='All'){
				vv+="\""+dstatea[f]+"\"";
				}
				else this.selectedIndex=0;
				if (f!=dstatea.length-1)
				vv+=","	;
				}
			d3.select("iframe").attr("src", encodeURI(get[1]+"?field="+get[2]+"&state="+vv+"&field2="+get[4]+'&party='+get[5]));
			//if(this.options[this.selectedIndex].value!='All') 
			//else d3.select("iframe").attr("src", encodeURI(get[1]+"?field="+get[2]+"&state="+"&field2="+get[4]+'&party='+get[5]));
		}
		function setparty(){
			var p=decodeURIComponent(this.options[this.selectedIndex].value);
			var get=showurl();
			add_bc();
//			console.log(dpartya);	
			var pp='';
			for( f in dpartya){
				if(dpartya[f]!='All'){
				pp+="\""+dpartya[f]+"\"";
				}
				else this.selectedIndex=0;
				if (f!=dpartya.length-1)
				pp+=","	;
			}		
			d3.select("iframe").attr("src", encodeURI(get[1]+"?field="+get[2]+"&state="+get[3]+"&field2="+get[4]+"&party="+pp+"&sortt="+get[6]));
			//if(this.options[this.selectedIndex].value!='All') 
			//else d3.select("iframe").attr("src", encodeURI(get[1]+"?field="+get[2]+"&state="+get[3]+"&field2="+get[4]+'&party='));
		}
		//*****************
		
		$('#featured').css('overflow','hidden');
		document.getElementById("yfield").innerHTML= "<option value=\'"+escape("")+"\'>Frequency</options>";
		d3.select('#statef').attr('disabled',null);
		d3.select('#xfield').attr('disabled',null);
		d3.select('#yfield').attr('disabled','disabled');
		d3.select('#partyf').attr('disabled',null);
			

		function getdhw(){
	
	var f= document.getElementById("frame").style;

	var file=showurl()[1];
	
	var z=0.85;
	if (file=='histogram.php') z=0.9;
	else if (file=='pie.php') z=0.93;
	else if (file=='area.php') z=0.83;
	else if (file=='brush.php') z=0.8;
	else if (file=='bars.php') z=0.7;
	else z=0.5;

	f["zoom"]=z;
	f["-moz-tranform"]="scale("+z+")";
	f["-moz-tranform-origin"]="0 0";
	f["-o-transform"]="scale("+z+")";
	f["-o-transform-origin"]="0 0";
	f["-webkit-transform"]="scale("+z+")";
	f["-webkit-transform-origin"]= "0 0";
/*	
	document.getElementById("yfield").innerHTML= "<option value=\'"+escape("")+"\'>Frequency</options>";
	d3.select('#statef').attr('disabled',null);
	d3.select('#xfield').attr('disabled',null);
	d3.select('#yfield').attr('disabled','disabled');
	d3.select('#partyf').attr('disabled',null);*/
}

		getdhw();
		document.getElementById('frame').onload = getdhw;
		document.getElementById("graphs_0").onchange = function(e) {
			$('#featured').css('overflow','hidden');
			$("#xf")[0].innerHTML='X-axis';
			document.getElementById("yfield").innerHTML= "<option value=\'"+escape("")+"\'>Frequency</options>";
			d3.select('#statef').attr('disabled',null);
			d3.select('#xfield').attr('disabled',null);
			d3.select('#yfield').attr('disabled','disabled');
			d3.select('#partyf').attr('disabled',null);
			var sel_field = document.getElementById("xfield");
			var blocked_fields = ["MP name", "Nature of membership", "Start of term", "End of term", "State", "Constituency", "Political party", "Gender", 
			"Educational qualifications", "Educational qualifications - details",  "Notes", "National Debates average", 
			"National Private Member Bills average", "National Questions average", "National Attendance average", "State's Debates average", 
			"State's Private Member Bills  average", "State's Questions average", "State's Attendance average"];
			sel_field.innerHTML = "";
			for (field in data[0]) {
				if (blocked_fields.indexOf(field) < 0) sel_field.innerHTML += "	<option value=\'" + escape(field)+ "\'>" + field + "</option>";
			}
			document.getElementById("xfield").selectedIndex = 0;
			var get=showurl();
			d3.select("iframe").attr("src", encodeURI("histogram.php"+"?field=Age"+"&state="+get[3]+"&field2="+get[4]+'&party='+get[5]));
			//getdhw();
		}

		document.getElementById("graphs_1").onchange = function(e) {
			$('#featured').css('overflow','hidden');
			document.getElementById("yfield").innerHTML= "<option value=\'"+escape("")+"\'>None</options>";
			d3.select('#statef').attr('disabled',null);
			d3.select('#xfield').attr('disabled',null);
			d3.select('#yfield').attr('disabled','disabled');
			d3.select('#partyf').attr('disabled',null);
			
			var sel_field = document.getElementById("xfield");
			var blocked_fields = ["MP name","Nature of membership", "Start of term", "End of term", "Constituency", "Educational qualifications - details", "Private Member Bills", "Notes", "National Debates average", "National Private Member Bills average", "National Questions average", "National Attendance average", "State's Debates average", "State's Private Member Bills  average", "State's Questions average", "State's Attendance average","Age","Debates","Questions","Attendance"];
			sel_field.innerHTML = "";
			for (field in data[0]) {
				if (blocked_fields.indexOf(field) < 0) sel_field.innerHTML += "	<option value=\'" + escape(field) + "\'>" + field + "</option>";
			}
			
			$("#xf")[0].innerHTML='Field';
			
			document.getElementById("xfield").selectedIndex = 1;
			var get=showurl();
			d3.select("iframe").attr("src", encodeURI("pie.php"+"?field=Political party&state="+get[3]+"&field2="+get[4]+'&party='+get[5]));		
			//getdhw();
		}

		document.getElementById("graphs_2").onchange = function(e) {
			$('#featured').css('overflow','hidden');
			$("#xf")[0].innerHTML='X-axis';
 			d3.select('#statef').attr('disabled',null);
			d3.select('#xfield').attr('disabled',null);
			d3.select('#yfield').attr('disabled',null);
			d3.select('#partyf').attr('disabled',null);
			var x_field = document.getElementById("xfield");
			var y_field = document.getElementById("yfield");
			var avx_fields = ["Age","Attendance","Debates","Questions","Private Member Bills"];
			x_field.innerHTML = "";
			y_field.innerHTML = "";
			for (field in avx_fields) {
				 x_field.innerHTML += "<option value=\'" + escape(avx_fields[field]) +"\'>" + avx_fields[field] + "</option>";
				y_field.innerHTML += "<option value=\'" + escape(avx_fields[field]) +"\'>" + avx_fields[field] + "</option>";
			}
			document.getElementById("xfield").selectedIndex = 0;
			document.getElementById("yfield").selectedIndex = 1;
			
			var get=showurl();
			d3.select("iframe").attr("src", encodeURI("brush.php"+"?field=Age"+"&state="+get[3]+"&field2=Attendance"+'&party='+get[5]));		
			//getdhw();
		}

		document.getElementById("graphs_3").onchange = function(e) {
			$('#featured').css('overflow','hidden');
			$("#xf")[0].innerHTML='X-axis';
			document.getElementById("xfield").innerHTML= "<option value=\'"+escape("State")+"\'>State</options>";
			document.getElementById("yfield").innerHTML= "<option value=\'"+escape("Political party")+"\'>Political Party</options>";
			document.getElementById('statef').selectedIndex = 0;
 			d3.select('#statef').attr('disabled','disabled');
			d3.select('#xfield').attr('disabled','disabled');
			d3.select('#yfield').attr('disabled','disabled');
			d3.select('#partyf').attr('disabled',null);
			dstatea=[];
			add_pc();
			
			var get=showurl();
			d3.select("iframe").attr("src", encodeURI("area.php"+"?field="+get[2]+"&state="+"&field2="+get[4]+'&party='+get[5]));		
			//getdhw();
		}

		document.getElementById("graphs_4").onchange = function(e) {
			$('#frame').css('height','150%');
			$('#frame').css('width','142%');
			$("#xf")[0].innerHTML='X-axis';
 			d3.select('#statef').attr('disabled',null);
			d3.select('#xfield').attr('disabled',null);
			d3.select('#yfield').attr('disabled',null);
			d3.select('#partyf').attr('disabled',null);
			var x_field = document.getElementById("xfield");
			var y_field = document.getElementById("yfield");
			var avx_fields = ["Frequency","Age","Attendance","Debates","Questions"];
			var avy_fields = ["Political party","State","Educational qualifications"];
			x_field.innerHTML = "";
			y_field.innerHTML = "";
			for (field in avx_fields) {
				
				 x_field.innerHTML += "<option value=\'" + escape(avx_fields[field]=='Frequency'?'':avx_fields[field]) +"\'>" + avx_fields[field] + "</option>";}
			for(field in avy_fields){
				y_field.innerHTML += "<option value=\'" + escape(avy_fields[field]) +"\'>" + avy_fields[field] + "</option>";
			}
			document.getElementById("xfield").selectedIndex = 0;
			document.getElementById("yfield").selectedIndex = 1;
			var get=showurl();
			d3.select("iframe").attr("src", encodeURI("bars.php"+"?field="+"&state="+get[3]+"&field2=State"+'&party='+get[5]+"&sortt="+get[6]));		
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