<?php

function ListFor($model){
    echo "
<div class='col-md-3'>
<div class=\"panel panel-default\">
  <div class=\"panel-heading\">Filtry</div>
  <div class=\"panel-body\">
    Panel content
  </div>
  <div class=\"panel-body\">
    Panel content
  </div>
  <div class=\"panel-body\">
    Panel content
  </div>
  <div class=\"panel-body\">
  
<input id=\"ex13\" type=\"text\" data-slider-ticks=\"[0, 100, 200, 300, 400]\" data-slider-ticks-snap-bounds=\"30\" data-slider-ticks-labels='[\"$0\", \"$100\", \"$200\", \"$300\", \"$400\"]'/>

  </div>
  <script>$(\"#ex13\").slider({
    ticks: [0, 100, 200, 300, 400],
    ticks_labels: ['$0', '$100', '$200', '$300', '$400'],
    ticks_snap_bounds: 30
});</script>
<style>
#ex1Slider .slider-selection {
	background: #BABABA;
}</style>
</div>
</div>
    ";
    echo "SHOW FOR " .$model;
}