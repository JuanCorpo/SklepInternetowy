<?php
function _ProductListForFilters($model, $categoryId)
{
    echo "
    <div class='panel panel-default'>
        <form style='min-height:50%' id='FilterForm' method='get'>
             <input type=\"hidden\" name=\"filters\" value=\"true\"/>
             <input type=\"hidden\" name=\"categoryId\" value=\"$categoryId\"/>
             <div class='panel-heading'><h2>Wyszukiwanie</h2></div>
             
             <div style='margin-left: 20px;'>
             ";

    $params = [];
    foreach ($model->ItemList as $product) {
        foreach ($product->Parameters as $item) {
            $params[] = $item;
        }
    }

    usort($params, "cmp");

    $prevParamId = -1;
    foreach ($params as $item) {
        if ($prevParamId != $item->ParameterType->ParameterId) {
            echo "<h3>" . $item->ParameterType->ParameterName . "</h3>";
            $prevParamId = $item->ParameterType->ParameterId;
        }

        echo '
        <div class="checkbox">
          <label>
            <input name="' . $prevParamId . '" value="' . $item->ParameterValue . '" type="checkbox"> ' . $item->ParameterValue . " " . $item->ParameterType->Suffix . '
          </label>
        </div>
        ';
    }

    echo "<input class=\"btn btn-primary\" type='submit' value='Szukaj'/> 
            </div>
         </form>
    </div>
    ";
}

function cmp($a, $b)
{
    return strcmp($a->ParameterId, $b->ParameterId);
}