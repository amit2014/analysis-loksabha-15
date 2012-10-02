<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="robots" content="noindex,nofollow">
<title>Analysis of 15th LOK SABHA</title>

  <link rel="icon" type="image/ico" href="recources/favicon.png"></link>
  <link rel="shortcut icon" href="resources/favicon.png"></link>
  
  <link rel="stylesheet" id="admin-bar-css" href="resources/admin-bar.css" type="text/css" media="all">
  <link rel="stylesheet" id="responsive-style-css" href="resources/style.css" type="text/css" media="all">
  <link rel="stylesheet" href="css/styles.css" type="text/css">
  <link rel="stylesheet" href="css/ui-darkness/jquery-ui-1.8.23.custom.css">
  <link rel="stylesheet" href="css/button.css">
  
  <script src="js/jquery-1.8.1.js"></script>
  <script src="js/jquery-ui-1.8.23.custom.min.js"></script>
  <script type="text/javascript" src="resources/jquery.js"></script>
  <script type="text/javascript" src="resources/responsive-modernizr.js"></script>
  <script type="text/javascript" src="js/d3.v2.js"></script>
  <script type="text/javascript" src="js/jquery.tipTip.js"></script>
  <script type="text/javascript" src="js/jquery.tipTip.minified.js"></script>
  <script>
  var dpartya=[];
  var dstatea=[];
  function showurl(){
      var curl = decodeURIComponent(d3.select("iframe").attr("src"));
      var file =  curl.substring(0,curl.indexOf('.php'))+'.php';
      var field=  curl.substring(curl.indexOf('?')+7,curl.indexOf('&'));
      var state=  curl.substring(curl.indexOf("state")+6);state=state.substring(0,state.indexOf('&'));
      var field2= curl.substring(curl.indexOf("field2")+7);field2=field2.substring(0,field2.indexOf('&'));
      var party = curl.substring(curl.indexOf('party=')+6);party=party.substring(0,party.indexOf('&')==-1?party.length:party.indexOf('&'))
      console.log([curl,file,field,state,field2,party]);
      return [curl,file,field,state,field2,party];
  }
  arrupa = ['Indian National Congress', 'Nationalist Congress Party', 'All India Majlis-E-Ittehadul Muslimmen', 'Assam United Democratic Front', 'Dravida Munnetra Kazhagam', 'Jammu and Kashmir National Conference', 'Kerala Congress (M)', 'Muslim League Kerala State Committee', 'Rashtriya Lok Dal', 'Sikkim Democratic Front', 'Viduthalai Chiruthaigal Katchi'];
  arrnda = ['Asom Gana Parishad', 'Bharatiya Janata Party', 'Haryana Janhit Congress', 'Janata Dal (United)', 'Jharkhand Mukti Morcha', "Nagaland People's Front", 'Shiromani Akali Dal', 'Shiv Sena', 'Telangana Rashtra Samithi'];
  function add_bc(){
                  var d=decodeURIComponent($('#partyf')[0].options[$('#partyf')[0].selectedIndex].value)
                  if (d=="All") {dpartya=[];
                  d3.select('#dpartyfs').html('');
                  }
                  else if(d=="UPA")	{
                  	for(var indx = 0; indx < arrupa.length; ++indx)
                  		addo(arrupa[indx]);
                  }
                  else if (d == "NDA")	{
                  	for(var indx = 0; indx < arrnda.length; ++indx)
                  		addo(arrnda[indx]);
                  }
                  else
                  	addo(d);
                  function addo(d)	{
                  	if(dpartya.indexOf(d)==-1){ 
                      dpartya=dpartya.concat(d);
                      var sug = d3.select('#dpartyfs').append('div').style('background-color','rgba(230,230,230,0.9)').style('font-size','smaller').style('padding','1px 8px').style('margin','2px 0px').attr('name',d).html(d).style('text-align','left');
                          sug.append('div').style('background-color','rgba(1,1,1,0)').style('float','right').style('padding','0px 5px').html('X').on('click',function(){
							  sug.remove();delete dpartya[dpartya.indexOf(d)];
							  var get=showurl();
							  var pp='';
							  for( f in dpartya){
								  if(dpartya[f]!='All')pp+="\""+dpartya[f]+"\"";
								  else this.selectedIndex=0;
								  if (f!=dpartya.length-1)
								  pp+=","	;
							  }		
							  d3.select("iframe").attr("src", encodeURI(get[1]+"?field="+get[2]+"&state="+get[3]+"&field2="+get[4]+"&party="+pp));
                      }).on('mouseover',crosshover).on('mouseout',crossout);						
                      function crosshover(d){
                          d3.select(this).style('background-color','rgba(1,1,1,0.25)');
                          d3.select(this).style('cursor','pointer');
                      }
                      function crossout(d){
                          d3.select(this).style('background-color','rgba(1,1,1,0)')
                      }
                    }
              	  }
          }
  function add_pc(){
                  var d=decodeURIComponent($('#statef')[0].options[$('#statef')[0].selectedIndex].value)
                  if (d=="All") {dstatea=[];
                  d3.select('#dstatefs').html('');
                  }
                  if(dstatea.indexOf(d)==-1 && d!='All'){ 
                      dstatea=dstatea.concat(d);
                      var sug = d3.select('#dstatefs').append('div').style('background-color','rgba(230,230,230,0.9)').style('font-size','smaller').style('padding','1px 8px').style('margin','2px 0px').attr('name',d).html(d).style('text-align','left');
                          sug.append('div').style('background-color','rgba(1,1,1,0)').style('float','right').style('padding','0px 5px').html('X').on('click',function(){
							  sug.remove();delete dstatea[dstatea.indexOf(d)];
							  var get=showurl();
							  var pp='';
							  for( f in dstatea){
								  if(dstatea[f]!='All')pp+="\""+dstatea[f]+"\"";
								  else this.selectedIndex=0;
								  if (f!=dstatea.length-1)
								  pp+=","	;
							  }		
							  d3.select("iframe").attr("src", encodeURI(get[1]+"?field="+get[2]+"&state="+pp+"&field2="+get[4]+"&party="+get[5]));
                      }).on('mouseover',crosshover).on('mouseout',crossout);						
                      function crosshover(d){
                          d3.select(this).style('background-color','rgba(1,1,1,0.25)');
                          d3.select(this).style('cursor','pointer');
                      }
                      function crossout(d){
                          d3.select(this).style('background-color','rgba(1,1,1,0)')
                      }
                  }
          }
		  
   $(function() { $( "#radioset" ).buttonset();  });
  </script>
<style type="text/css" media="print">
#wpadminbar {
	display:none;
}
</style>
<style type="text/css" media="screen">
html {
	margin-top: 15px !important;
}
* html body {
	margin-top: 15px !important;
}
</style>
<style type="text/css" id="custom-background-css">
body.custom-background {
	background-color: #dfde2b;
}
</style>
<style id="wrc-middle-css" type="text/css">
.wrc_whole_window {
	display: none;
	position: fixed;
	z-index: 2147483647;
	background-color: rgba(40, 40, 40, 0.9);
	word-spacing: normal !important;
	margin: 0px !important;
	padding: 0px !important;
	border: 0px !important;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	line-height: normal !important;
	letter-spacing: normal !important;
	overflow: hidden;
}
.wrc_bar_window {
	display: none;
	position: fixed;
	z-index: 2147483647;
	background-color: rgba(60, 60, 60, 1.0);
	word-spacing: normal !important;
	font-family: Segoe UI, Arial Unicode MS, Arial, Sans-Serif;
	margin: 0px !important;
	padding: 0px !important;
	border: 0px !important;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 40px;
	line-height: normal !important;
	letter-spacing: normal !important;
	color: white !important;
	font-size: 13px !important;
}
.wrc_middle {
	display: table-cell;
	vertical-align: middle;
	width: 100%;
}
.wrc_middle_main {
	font-family: Segoe UI, Arial Unicode MS, Arial, Sans-Serif;
	font-size: 14px;
	width: 600px;
	height: auto;
	background: url(chrome-extension://icmlaeflemplmjndnaapfdbbnpncnbda/skin/images/background-body.jpg) repeat-x left top;
	background-color: rgb(39, 53, 62);
	position: relative;
	margin-left: auto;
	margin-right: auto;
	text-align: left;
}
.wrc_middle_tq_main {
	font-family: Segoe UI, Arial Unicode MS, Arial, Sans-Serif;
	font-size: 16px;
	width: 615px;
	height: 460px;
	background: url(chrome-extension://icmlaeflemplmjndnaapfdbbnpncnbda/skin/images/background-sitecorrect.png) no-repeat;
	background-color: white;
	color: black !important;
	position: relative;
	margin-left: auto;
	margin-right: auto;
	text-align: center;
}
.wrc_middle_logo {
	background: url(chrome-extension://icmlaeflemplmjndnaapfdbbnpncnbda/skin/images/logo.jpg) no-repeat left bottom;
	width: 140px;
	height: 42px;
	color: orange;
	display: table-cell;
	text-align: right;
	vertical-align: middle;
}
.wrc_icon_warning {
	margin: 20px 10px 20px 15px;
	float: left;
	background-color: transparent;
}
.wrc_middle_title {
	color: #b6bec7;
	height: auto;
	margin: 0px auto;
	font-size: 2.2em;
	white-space: nowrap;
	text-align: center;
}
.wrc_middle_hline {
	height: 2px;
	width: 100%;
	display: block;
}
.wrc_middle_description {
	text-align: center;
	margin: 15px;
	font-size: 1.4em;
	padding: 20px;
	height: auto;
	color: white;
	min-height: 3.5em;
}
.wrc_middle_actions_main_div {
	margin-bottom: 15px;
	text-align: center;
}
.wrc_middle_actions_blue_button div {
	display: inline-block;
	width: auto;
	cursor: Pointer;
	margin: 3px 10px 3px 10px;
	color: white;
	font-size: 1.2em;
	font-weight: bold;
}
.wrc_middle_actions_blue_button {
	-moz-appearance: none;
	border-radius: 7px;
	-moz-border-radius: 7px/7px;
	border-radius: 7px/7px;
	background-color: rgb(0, 173, 223) !important;
	display: inline-block;
	width: auto;
	cursor: Pointer;
	border: 2px solid #00dddd;
	padding: 0px 20px 0px 20px;
}
.wrc_middle_actions_blue_button:hover {
	background-color: rgb(0, 159, 212) !important;
}
.wrc_middle_actions_blue_button:active {
	background-color: rgb(0, 146, 200) !important;
	border: 2px solid #00aaaa;
}
.wrc_middle_actions_grey_button div {
	display: inline-block;
	width: auto;
	cursor: Pointer;
	margin: 3px 10px 3px 10px;
	color: white !important;
	font-size: 15px;
	font-weight: bold;
}
.wrc_middle_actions_grey_button {
	-moz-appearance: none;
	border-radius: 7px;
	-moz-border-radius: 7px/7px;
	border-radius: 7px/7px;
	background-color: rgb(100, 100, 100) !important;
	display: inline-block;
	width: auto;
	cursor: Pointer;
	border: 2px solid #aaaaaa;
	text-decoration: none;
	padding: 0px 20px 0px 20px;
}
.wrc_middle_actions_grey_button:hover {
	background-color: rgb(120, 120, 120) !important;
}
.wrc_middle_actions_grey_button:active {
	background-color: rgb(130, 130, 130) !important;
	border: 2px solid #00aaaa;
}
.wrc_middle_action_low {
	font-size: 0.9em;
	white-space: nowrap;
	cursor: Pointer;
	color: grey !important;
	margin: 10px 10px 0px 10px;
	text-decoration: none;
}
.wrc_middle_action_low:hover {
	color: #aa4400 !important;
}
.wrc_middle_actions_rest_div {
	padding-top: 5px;
	white-space: nowrap;
	text-align: center;
}
.wrc_middle_action {
	white-space: nowrap;
	cursor: Pointer;
	color: red !important;
	font-size: 1.2em;
	margin: 10px 10px 0px 10px;
	text-decoration: none;
}
.wrc_middle_action:hover {
	color: #aa4400 !important;
}
</style>
<script id="wrc-script-middle_window" type="text/javascript" language="JavaScript">
var g_inputsCnt = 0;var g_InputThis = new Array(null, null, null, null);var g_alerted = false;/* we test the input if it includes 4 digits   (input is a part of 4 inputs for filling the credit-card number)*/function is4DigitsCardNumber(val){	var regExp = new RegExp('[0-9]{4}');	return (val.length == 4 && val.search(regExp) == 0);}/* testing the whole credit-card number 19 digits devided by three '-' symbols or   exactly 16 digits without any dividers*/function isCreditCardNumber(val){	if(val.length == 19)	{		var regExp = new RegExp('[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}');		return (val.search(regExp) == 0);	}	else if(val.length == 16)	{		var regExp = new RegExp('[0-9]{4}[0-9]{4}[0-9]{4}[0-9]{4}');		return (val.search(regExp) == 0);	}	return false;}function CheckInputOnCreditNumber(self){	if(g_alerted)		return false;	var value = self.value;	if(self.type == 'text')	{		if(is4DigitsCardNumber(value))		{			var cont = true;			for(i = 0; i < g_inputsCnt; i++)				if(g_InputThis[i] == self)					cont = false;			if(cont && g_inputsCnt < 4)			{				g_InputThis[g_inputsCnt] = self;				g_inputsCnt++;			}		}		g_alerted = (g_inputsCnt == 4);		if(g_alerted)			g_inputsCnt = 0;		else			g_alerted = isCreditCardNumber(value);	}	return g_alerted;}function CheckInputOnPassword(self){	if(g_alerted)		return false;	var value = self.value;	if(self.type == 'password')	{		g_alerted = (value.length > 0);	}	return g_alerted;}function onInputBlur(self, bRatingOk, bFishingSite){	var bCreditNumber = CheckInputOnCreditNumber(self);	var bPassword = CheckInputOnPassword(self);	if((!bRatingOk || bFishingSite == 1) && (bCreditNumber || bPassword) )	{		var warnDiv = document.getElementById("wrcinputdiv");		if(warnDiv)		{			/* show the warning div in the middle of the screen */			warnDiv.style.left = "0px";			warnDiv.style.top = "0px";			warnDiv.style.width = "100%";			warnDiv.style.height = "100%";			document.getElementById("wrc_warn_fs").style.display = 'none';			document.getElementById("wrc_warn_cn").style.display = 'none';			if(bFishingSite)				document.getElementById("wrc_warn_fs").style.display = 'block';			else				document.getElementById("wrc_warn_cn").style.display = 'block';			warnDiv.style.display = 'table';		}	}}
</script>
</head>
