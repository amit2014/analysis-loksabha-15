<div id="featured" name="featured" class="grid col-940" style="width:70%;height:400px"> 
  <div  id="frame">
  	<div id="flegend">
    &nbsp;
    </div>
    <iframe src="histogram.php" id="frame" style="text-align:center;width:110%;height:110%;padding-left:10px;padding-right:20px;padding-top:20px;padding-bottom:10px; overflow:visible;" scrolling="yes" class="center"> </iframe>
  </div>
  <script>
	var f= document.getElementById("frame").style;
	var z="0.91";
	f["zoom"]=z;
	f["-moz-tranform"]="scale("+z+")";
	f["-moz-tranform-origin"]="0 0";
	f["-o-transform"]="scale("+z+")";
	f["-o-transform-origin"]="0 0";
	f["-webkit-transform"]="scale("+z+")";
	f["-webkit-transform-origin"]= "0 0";
	document.getElementById("flegend").style["margin-bottom"]="70px";
  </script>
</div>
<!--
      <div class="grid col-460" >
      
        <h1 class="featured-title">Hello, World!</h1>
        <h2 class="featured-subtitle">Your H2 subheadline here</h2>
        <p>Your title, subtitle and this very content is editable from Theme Option. Call to Action button and its destination link as well. Image on your right can be an image or even YouTube video if you like.</p>
        <div class="call-to-action"> <a href="http://localhost/wordpress/#nogo" class="blue button">Call to Action</a> </div>
        <!-- end of .call-to-action --> 
<!--/div--> 
<!-- end of .col-460 --> 
<!--
      <div id="featured-image" class="grid col-460 fit"> <img class="aligncenter" src="resources/featured-image.png" width="440" height="300" alt=""> </div>
      <!-- end of #featured-image --> 

<!-- end of #featured -->