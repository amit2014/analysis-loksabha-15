<style type="text/css">
.noborder {
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
</style>

<div class="panel" >
  <div class="widget-wrapper" style="height:400px">
    <div class="widget-title-home" >
      <h3>Panel</h3>
    </div>
    <div class="textwidget">
      <div id="radioset" style="zoom: 0.85">
        <input type="radio" name="graphs" id="graphs_0" graph="histogram" checked="checked" />
        <label for="graphs_0">Histogram</label>
        <input type="radio" name="graphs" id="graphs_1" graph="pie"/>
        <label for="graphs_1">Pie</label>
        <input type="radio" name="graphs" id="graphs_2" graph="brush"/>
        <label for="graphs_2">Scatter</label>
        <input type="radio" name="graphs" id="graphs_3" graph="area"/>
        <label for="graphs_3">Area</label>
        <input type="radio" name="graphs" id="graphs_4" graph="bars"/>
        <label for="graphs_4">Bar</label>
      </div>
      <div class="noborder">
      <br/>
          <div style="float:left;clear:left"><label for="xfield" >X-axis</label><select name="xfield" id="xfield" style="width:120px"></select></div>
          <div style="float:right;clear:right"><label for="yfield" >Y-axis</label><select name="yfield" id="yfield" style="width:120px"></select></div>
      </div>
    </div>
  </div>
  <!-- end of .widget-wrapper --> 
</div>
<!-- end of .col-300 --> 