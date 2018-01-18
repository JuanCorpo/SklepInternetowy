<?php

function ListFor($model)
{
    echo "<div class='col-md-3'>";
    _ProductListForFilters($model);
    echo "</div>
    <div class='col-md-9'>";

    if (count($model->OtherCategories) != 0) {
        echo "
        <div class='panel panel-default'>
            <div class='panel-heading'>Podkategorie</div>
            <div class='panel-body'>
                ";
        foreach ($model->OtherCategories as $item) {
            echo '<a class="col-md-3" style="display: inline-block;" href="../../Products/ListFor/' . $item->CategoryId . '">' . $item->Name . '</a>';

        }
        echo "
            </div>
        </div>";
    }
    echo "
    </div>

    <div class='col-md-9'>";

    if (count($model->ItemList) != 0) {
        foreach ($model->ItemList as $item) {
            echo '
                <div class="panel panel-primary col-md-12">
                    <a href="../../Products/Show/' . $item->ProductId . '">
                        <div class="panel-heading">
                            <h3 class="panel-title">Item id:  ' . $item->Name . ' </h3>
                            <small>ID produktu: ' . $item->ProductId . '</small>
                        </div>
                    </a>
                    <div class="panel-body">
                    
                    
                    <div class="col-md-3">
                        <div style="display: grid;">
                            <a href="../../Products/Show/' . $item->ProductId . '">
                                <img class=" col-md-10"  src="../../' . $item->ImageDirectory . '"/>
                            </a>
                        </div>
                        <div style="text-align: center;">
                                <div style="display: inline;" id="stars_' . $item->ProductId . '" stars="' . $item->GetRating() . '" class="starrr"></div>
                                <div style="display:inline">(' . $item->NoOfRatings . ')</div>
                        </div>
                    </div>
                    
                    <div class="col-md-5">';

            $max = 5;
            echo "<ul>";
            foreach ($item->Parameters as $param) {
                echo '<li>' . $param->ParameterType->ParameterName . ': ' . $param->GetFullValue() . '</li>';
                if (--$max <= 0) break;
            }
            echo "</ul>";

            echo '<b>Kupiło: ' . $item->NoOfRatings . '</b>
                    </div>
                    
                    <div class="col-md-4 text-right">';

            echo '<h3>' . $item->Price . 'zł</h3>';
            echo "<button class='btn btn-primary' onclick='addToBasket(".$item->ProductId.")'>Dodaj do koszyka</button><br>";
            echo "<small>Nie gwarantujemy dostarczenia produktu</small>";

            echo '</div>
                    
                </div>
    </div>';
        }
    } else {
        echo '<div class="cs-empty" colspan="100%" style="text-align:center">
              Brak produktów
        </div>';
    }
    echo '

    </div>

    <script src="../../Scripts/Custom/Stars.js"></script>
    <script src="../../Scripts/ajax/Basket.js"></script>
    ';
}