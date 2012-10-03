document.getElementById('field').onchange=fchange;
document.getElementById('field').selectedIndex=3;
document.getElementById('graphs_0').onchange=function (e){
	var get=geturl();
	$('#frame').attr('src','mash_p.php?field='+get[2]+'&sort=')
}
document.getElementById('graphs_1').onchange=function (e){
	var get=geturl();
	$('#frame').attr('src','mash_p.php?field='+get[2]+'&sort=state')
}
document.getElementById('graphs_2').onchange=function (e){
	var get=geturl();
	$('#frame').attr('src','mash_p.php?field='+get[2]+'&sort=party')
}
document.getElementById('graphs_3').onchange=function (e){
	var get=geturl();
	$('#frame').attr('src','mash_p.php?field='+get[2]+'&sort=sp')
}

function fchange(){
	var v=this.options[this.selectedIndex].value;
	var get=geturl();
	$('#frame').attr('src','mash_p.php?field='+v+'&sort='+get[3])
}
function geturl(){
      var curl = decodeURIComponent(d3.select("#frame").attr("src"));
      var file =  curl.substring(0,curl.indexOf('.php'))+'.php';
      var field='';
	  field=  curl.substring(curl.indexOf('?')+7,curl.indexOf('&'));
      var sortt = '';
	  if(curl.indexOf('sort=')!=-1)
	  sortt=curl.substring(curl.indexOf('sort=')+5);sortt=sortt.substring(0,sortt.indexOf('&')==-1?sortt.length:sortt.indexOf('&'))
      console.log([curl,file,field,sortt]);
      return [curl,file,field,sortt];

	
}