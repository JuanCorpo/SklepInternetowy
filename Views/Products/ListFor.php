<?php

function ListFor($model)
{
    echo "<div class='col-md-3'>";
_ProductListForFilters($model);
    echo "</div>
    <div class='col-md-9'>";

        if(count($model->OtherCategories)!=0){
        echo "
        <div class='panel panel-default'>
            <div class='panel-heading'>Podkategorie</div>
            <div class='panel-body'>
                ";
                foreach ($model->OtherCategories as $item) {
                    echo '<a class="col-md-3" style="display: inline-block;" href="/Products/ListFor/' . $item->CategoryId . '">' . $item->Name . '</a>';

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
                <div class="panel panel-primary col-md-4">
                <a href="/Products/Show/'.$item->ProductId.'">
                    <div class="panel-heading">
                        <h3 class="panel-title">Item id:  ' . $item->ProductId . ' </h3>
                    </div>
                    </a>
                    <div class="panel-body">
                        Nazwa: ' . $item->Name . ' <br></b>
                        Ilość parametrów: ' . count($item->Parameters).'<br>';

                        foreach($item->Parameters as $param){
                            echo 'Nazwa: '.$param->ParameterName.'<br>';
                            echo 'Wartość: '.$param->ParameterValue.'<br>';
                        }

                    echo '</div>
                </div>
                ';
            }
        } else {
            echo '<div class="cs-empty" colspan="100%" style="text-align:center">
                                        Brak produktów
                                    </div>';
        }
        ?>

    </div>
    <?php
}