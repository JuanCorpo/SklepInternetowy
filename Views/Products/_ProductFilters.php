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
    
<input id=\"ex2\" type=\"text\" name='val' class=\"span2\" value=\"\" data-slider-min=\"10\" data-slider-max=\"1000\" data-slider-step=\"5\" data-slider-value=\"[250,450]\"/>
    
                </div>
                <script>$(\"#ex2\").slider({});</script>
                    
                   <input class=\"btn btn-primary\" type='submit' value='Szukaj'/> 
         </form>
    </div>
    ";
}