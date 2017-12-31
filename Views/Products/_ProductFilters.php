<?php
function _ProductListForFilters($model)
{
    echo "
    <div class='panel panel-default'>
        <form id='FilterForm' method='get'>
        
                <div class='panel-heading'>Filtry</div>
                
                <div class='panel-body'>
                    Panel content
                </div>
                <div class='panel-body'>
                    Panel content
                </div>
                <div class='panel-body'>
                    Panel content
                </div>
                <div class='panel-body'>
<p>
  <label for=\"amount\">Price range:</label>
  <input type=\"text\" id=\"amount\" readonly style=\"border:0; color:#f6931f; font-weight:bold;\">
</p>
 
<div id=\"slider-range\"></div>
    
                </div>"; ?>
    <script>
        $(function () {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 500,
                values: [75, 300],
                slide: function (event, ui) {
                    $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                }
            });
            $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                " - $" + $("#slider-range").slider("values", 1));
        });
    </script>
    <?php echo "
                   <input class=\"btn btn-primary\" type='submit' value='Szukaj'/> 
         </form>
    </div>
    ";
}