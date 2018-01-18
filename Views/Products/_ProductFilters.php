<?php
function _ProductListForFilters($model)
{
    echo "
    <div class='panel panel-default'>
        <form style='height:50%' id='FilterForm' method='get'>
        
                <div class='panel-heading'>Filtry</div>";

    echo "<input class=\"btn btn-primary\" type='submit' value='Szukaj'/> 
         </form>
    </div>
    ";
}