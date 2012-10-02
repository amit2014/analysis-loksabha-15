// JavaScript Document
window.onload = initall;

function initall() {
	d3.csv("MPTrack.csv", function(data) {
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
		var allparties=['All','UPA','NDA'];
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
		
		document.getElementById('statef').onchange = setstate;
		document.getElementById('partyf').onchange = setparty;
		
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
			d3.select("iframe").attr("src", encodeURI(get[1]+"?field="+get[2]+"&state="+vv+"&field2="+get[4]+'&party='+get[5]+"&sortt="+get[6]));
		}
		function setparty(){
			var p=decodeURIComponent(this.options[this.selectedIndex].value);
			var get=showurl();
			add_bc();
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
		}
		//*****************
		
		
		
	});
}
