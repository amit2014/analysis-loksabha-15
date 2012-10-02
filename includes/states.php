<div class="grid" style="width:1200px">
  <div class="widget-wrapper">
    <div id="content" class="grid col-620">
      <div id="post-2" class="post-2 page type-page status-publish hentry">
        <h1 class="post-title">State wise distribution</h1>
        <div class="post-entry">
          <style type="text/css">
    #india {
      fill: #008000;
      opacity: .8;
      stroke: #000000;
      stroke-width: .7;
      }
    </style>
          <div id="chart"></div>
    <script type="text/javascript">
	d3.csv("MPTrack.csv",function(data){
    var w = 600;
    var h = 600;
    var proj = d3.geo.mercator();
    var path = d3.geo.path().projection(proj);
    var t = proj.translate(); // the projection's default translation
    var s = proj.scale() // the projection's default scale

    var map = d3.select("#chart").append("svg:svg")
        .attr("width", w)
        .attr("height", h)
        .call(initialize);

    var india = map.append("svg:g")
        .attr("id", "india");

    d3.json("states.json", function (json) {
      india.selectAll("path")
          .data(json.features)
        .enter().append("path")
		.attr("state",function (d){return d.id;})
          .attr("d", path)
   		  .on("mouseover",cll)
		  .on("mouseout",clr)
		  .on("click",clc);
    });
	var clicked=false;
	var that;
	function clc(){
		clicked=true;

		
		var parties=getallpartiesfrom(d3.select(this).attr("state"));
		var party=[];
		var partyv=[];
		for(j=0;j<parties.length;j++){
			var key=parties[j];
			if(party.indexOf(key)>=0){
				partyv[party.indexOf(key)]++;
			}
			else{
				party.push(key);
				partyv.push(1);
			}
		}
		$("#s_party ul").html("");
		var s=0;
		for(i=0;i<party.length;i++){
			$("#s_party ul").append('<li class="cat-item" style="cursor:default" ><a>'+party[i]+': '+partyv[i]+'</a></li>');
			s+=partyv[i];
		}
		
		$("#s_info span").html("<li class='cat-item cat-item-1'>State Name: <a style='cursor:default'>"+d3.select(this).attr("state")+" : "+s+"</a></li>");
		if(this.style["fill"]!="#55aa99"){
		if(that){
			that.style["fill"]="green";
		}
		this.style["fill"]="#5a9";
		that= this;
		}
		else{
		this.style["fill"]="#393";
		clicked=false;
		}
	}
	
	function cll(){
		if(this.style["fill"]!="#55aa99")
		this.style["fill"]="#393";
		this.style["cursor"]="pointer";
		if(!clicked){

		var parties=getallpartiesfrom(d3.select(this).attr("state"));
		var party=[];
		var partyv=[];
		for(j=0;j<parties.length;j++){
			var key=parties[j];
			if(party.indexOf(key)>=0){
				partyv[party.indexOf(key)]++;
			}
			else{
				party.push(key);
				partyv.push(1);
			}
		}
		
		var s=0;
		$("#s_party ul").html("");
		for(i=0;i<party.length;i++){
			$("#s_party ul").append('<li class="cat-item" style="cursor:pointer" ><a>'+party[i]+': '+partyv[i]+'</a></li>');
			s+=partyv[i];
		}
		$("#s_info span").html("<li class='cat-item cat-item-1'>State Name: <a style='cursor:default'>" + d3.select(this).attr("state")+" : "+s+"</a></li>");
		}
	}
	

	
	function clr(){
		if (!clicked)
		setall();
		if(this.style["fill"]!="#55aa99"){
		this.style["fill"]="green";
		}

	}
	
	function getallpartiesfrom(thisstate){
		var parties=[];
		for(i=0;i<data.length;i++){
			if(data[i]["State"]==thisstate){
				parties=parties.concat([data[i]["Political party"]]);
			}
		}
		return parties;
	}
	
    function initialize() {
      proj.scale(6700);
      proj.translate([-1240, 720]);
    }

	function setall(){
		part=[];
		partw=[];		
	
		  for(i in data){	
		  if (part.indexOf(data[i]['Political party'])==-1 && data[i]['Political party']!=''){
			  part=part.concat(data[i]['Political party']);
			  partw[part.indexOf(data[i]['Political party'])]=1;
		  }
		  else{
				partw[part.indexOf(data[i]['Political party'])]++;
		  }

		}
		$("#s_party ul").html("");
		var partyy=part.map(function(d)	{ return [d,partw[part.indexOf(d)]]; });
		partyy.sort(function(a,b){return a[1]==b[1]?0:(a[1]>b[1]?-1:1)});
		console.log(partyy);
		var s=0;
		for (i in part){
			$("#s_party ul").append("<li class='cat-item cat-item-1'><a style='cursor:default'>" + partyy[i][0]+" : "+partyy[i][1]+"  </a></li>");
			s+=partyy[i][1];	
		}
		$("#s_info span").html("<li class='cat-item cat-item-1'><a style='cursor:default'>All India : "+s+"</a></li>");
	}
	setall();
	});
  </script> 
        </div>
      </div>
    </div>    
    <div id="widgets" class="grid col-300 fit">
      <div id="s_info" class="widget-wrapper widget_recent_entries">
        <div class="widget-title">State Info</div>
        <ul>
          <span></span>
        </ul>
      </div>
      <div id="s_party" class="widget-wrapper widget_categories">
        <div class="widget-title">Parties</div>
        <ul>
        </ul>
      </div>
    </div>
  </div><!-- end of .call-to-action --> 
</div><!-- end of .col-460 --> 