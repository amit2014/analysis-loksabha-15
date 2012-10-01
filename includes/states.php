<div class="grid" style="width:1200px">
  <div class="widget-wrapper">
    <div id="content" class="grid col-620">
      <div id="post-2" class="post-2 page type-page status-publish hentry">
        <h1 class="post-title">State wise distribution</h1>
        <div class="post-meta"> <span class="meta-prep meta-prep-author">Posted on</span> <a href="http://localhost/wordpress/?page_id=2" title="10:38 am" rel="bookmark">September 12, 2012</a> by <span class="author vcard"><a class="url fn n" href="http://localhost/wordpress/?author=1" title="View all posts by admin">admin</a></span> <span class="comments-link"> <span class="mdash">&mdash;</span> <a href="http://localhost/wordpress/?page_id=2#respond" title="Comment on Sample Page">No Comments &darr;</a> </span> </div>
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

		$("#s_info span").html("State Name: <a style='cursor:default'>"+d3.select(this).attr("state")+"</a>");
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
		for(i=0;i<party.length;i++){
			$("#s_party ul").append('<li class="cat-item" style="cursor:default" ><a>'+party[i]+': '+partyv[i]+'</a></li>');
		}
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
		$("#s_info span").html("State Name: <a style='cursor:default'>" + d3.select(this).attr("state")+"</a>");
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
		for(i=0;i<party.length;i++){
			$("#s_party ul").append('<li class="cat-item" style="cursor:pointer" ><a>'+party[i]+': '+partyv[i]+'</a></li>');
		}
		}
	}
	

	
	function clr(){
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

	});
  </script> 
        </div>
        <!--<div class="post-entry">
          <p>This is an example page. It&#8217;s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:</p>
          <blockquote>
            <p>Hi there! I&#8217;m a bike messenger by day, aspiring actor by night, and this is my blog. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin&#8217; caught in the rain.)</p>
          </blockquote>
          <p>&#8230;or something like this:</p>
          <blockquote>
            <p>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickies to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</p>
          </blockquote>
          <p>As a new WordPress user, you should go to <a href="http://localhost/wordpress/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!</p>--> 
        <!-- end of .post-entry -->
        
        <div class="post-data"> </div>
        <!-- end of .post-data -->
        
        <div class="post-edit"></div>
      </div>
      <!-- end of #post-2 --> 
      
    </div>
    <!-- end of #content -->
    
    <div id="widgets" class="grid col-300 fit">
      <div id="search-2" class="widget-wrapper widget_search">
        <form method="get" id="searchform" action="http://localhost/wordpress/">
          <input type="text" class="field" name="s" id="s" placeholder="search here &hellip;" />
          <input type="submit" class="submit" name="submit" id="searchsubmit" value="Go"  />
        </form>
      </div>
      <div id="s_info" class="widget-wrapper widget_recent_entries">
        <div class="widget-title">State Info</div>
        <ul>
          <li class="cat-item cat-item-1"><span></span></li>
        </ul>
      </div>
      <div id="s_party" class="widget-wrapper widget_categories">
        <div class="widget-title">Parties</div>
        <ul>
        </ul>
      </div>
    </div>

    <!-- end of #widgets --> 
    <!--		<div> 
          <h1 class="featured-title">Hello, World!</h1>
          <h2 class="featured-subtitle">Your H2 subheadline here</h2>
          <p>Your title, subtitle and this very content is editable from Theme Option. Call to Action button and its destination link as well. Image on your right can be an image or even YouTube video if you like.</p>
          <div class="call-to-action"> <a href="http://localhost/wordpress/#nogo" class="blue button">Call to Action</a> </div>
        </div>--> 
  </div>
  <!-- end of .call-to-action --> 
</div>
<!-- end of .col-460 --> 