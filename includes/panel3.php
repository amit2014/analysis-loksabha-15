<style type="text/css">
.noborder {
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
.UnderMatric {
  fill: #000000;
}

.Matric {
  fill: #6c0000;
}

.InterHigherSecondary, .CertificateCourse {
  fill: #e30000;
}

.UnderGraduate, .DiplomaCourse {
  fill: #f31600;
}

.ProfessionalGraduate, .Graduate, .PostDiplomaCourse {
  fill: #00b228;
}

.PostGraduate {
  fill: #00488c;
}

.Doctorate {
  fill: #0000cc;
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
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="UnderMatric"/><text x="40" y="15" fill="black">UnderMatric</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="Matric"/><text x="40" y="15" fill="black">Matric</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="InterHigherSecondary"/><text x="40" y="15" fill="black">InterHigherSecondary</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="UnderGraduate"/><text x="40" y="15" fill="black">UnderGraduate</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="DiplomaCourse"/><text x="40" y="15" fill="black">DiplomaCourse</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="ProfessionalGraduate"/><text x="40" y="15" fill="black">ProfessionalGraduate</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="Graduate"/><text x="40" y="15" fill="black">Graduate</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="PostDiplomaCourse"/><text x="40" y="15" fill="black">PostDiplomaCourse</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="PostGraduate"/><text x="40" y="15" fill="black">PostGraduate</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="0" class="Doctorate"/><text x="40" y="15" fill="black">Doctorate</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="1" class="Informationnotavailable"/><text x="40" y="15" fill="black">Informationnotavailable</text></svg>
			<svg height="20px" width="250px"><circle cx="20" cy="10" r="4" stroke="black" stroke-width="1" class="Others"/><text x="40" y="15" fill="black">Others</text></svg>
         </div>

    </div>
  </div>
  <!-- end of .widget-wrapper --> 
</div>
<!-- end of .col-300 --> 