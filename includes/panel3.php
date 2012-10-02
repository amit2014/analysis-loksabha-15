<style type="text/css">
.noborder {
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
.UnderMatric {
  fill: #aa0000;
}

.Matric {
  fill: #dd6f00;
}

.InterHigherSecondary, .CertificateCourse {
  fill: #eeee00;
}

.UnderGraduate, .DiplomaCourse {
  fill: #6fdd00;
}

.ProfessionalGraduate, .Graduate, .PostDiplomaCourse {
  fill: #00dddd;
}

.PostGraduate {
  fill: #0000cc;
}

.Doctorate {
  fill: #ee00ee;
}

.Informationnotavailable, .Others {
  fill: #fff;
  stroke: #000;
}

</style>

<div class="panel" >	
  <div class="widget-wrapper" style="height:auto;min-height:400px">
    <div class="widget-title-home" >
      <h3>Panel</h3>
    </div>
    <div class="textwidget">      
     	  <div id="dstatef" style="float:left;clear:left;" class="panelf"><label for="statef" >State</label><select name="statef" id="statef" style="width:270px"></select> <div id="dstatefs" style="max-height:50px"></div></div><br />
      	  <div id="dpartyf" style="float:left;clear:left;text-align:center" class="panelf" ><label for="partyf" style="text-align:left">Political Party</label><select name="partyf" id="partyf" style="width:270px"></select>
          <div id="dpartyfs" style="max-height:50px"></div>
         </div>
         <div id="leg" style="float:left;clear:left;clear:both;zoom:0.82;width:90%" class="panelf" >
         <label style="zoom:1.2;margin-bottom:5px">Legend</label>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="UnderMatric"/><text x="40" y="15" fill="black">Under Matric</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="Matric"/><text x="40" y="15" fill="black">Matric</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="InterHigherSecondary"/><text x="40" y="15" fill="black">Inter / Higher Secondary</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="UnderGraduate"/><text x="40" y="15" fill="black">Under Graduate</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="DiplomaCourse"/><text x="40" y="15" fill="black">Diploma Course</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="ProfessionalGraduate"/><text x="40" y="15" fill="black">Professional Graduate</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="Graduate"/><text x="40" y="15" fill="black">Graduate</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="PostDiplomaCourse"/><text x="40" y="15" fill="black">Post-Diploma Course</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="PostGraduate"/><text x="40" y="15" fill="black">Post-Graduate</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="Doctorate"/><text x="40" y="15" fill="black">Doctorate</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="1" class="Informationnotavailable"/><text x="40" y="15" fill="black">Information not available</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="1" class="Others"/><text x="40" y="15" fill="black">Others</text></svg>
         </div>

    </div>
  </div>
  <!-- end of .widget-wrapper --> 
</div>
<!-- end of .col-300 --> 