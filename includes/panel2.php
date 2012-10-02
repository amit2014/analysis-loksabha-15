<style type="text/css">
.noborder {
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
</style>

<div class="panel" >
  <div class="widget-wrapper" style="height:auto;min-height:400px">
    <div class="widget-title-home" >
      <h3>Panel</h3>
    </div>
    <div class="textwidget">
      <div id="radioset" style="zoom: 0.83;padding-left:35px">
        <input type="radio" name="graphs" id="graphs_0" graph="histogram" checked="checked" />
        <label for="graphs_0">Alphabatical</label>
        <input type="radio" name="graphs" id="graphs_1" graph="pie"/>
        <label for="graphs_1">By State</label>
        <input type="radio" name="graphs" id="graphs_2" graph="brush"/>
        <label for="graphs_2">By Party</label>
      </div>
      <div style="overflow:auto" class="panelf">
        <div style="float:left;clear:left;margin-bottom:0px">
          <label for="xfield" >X-axis</label>
          <select name="xfield" id="xfield" style="width:120px">
          </select>
        </div>
        <div style="float:right;clear:right;margin-bottom:0px">
          <label for="yfield" >Y-axis</label>
          <select name="yfield" id="yfield" style="width:120px">
          </select>
        </div>
      </div>
      <div id="dstatef" style="float:left;clear:left;" class="panelf">
        <label for="statef" >State</label>
        <select name="statef" id="statef" style="width:270px">
        </select>
        <div id="dstatefs" style="max-height:50px"></div>
      </div>
      <br />
      <div id="dpartyf" style="float:left;clear:left;text-align:center" class="panelf" >
        <label for="partyf" style="text-align:left">Political Party</label>
        <select name="partyf" id="partyf" style="width:270px">
        </select>
        <div id="dpartyfs" style="max-height:50px"></div>
      </div>
    </div>
  </div>
  <!-- end of .widget-wrapper --> 
</div>
<!-- end of .col-300 --> 