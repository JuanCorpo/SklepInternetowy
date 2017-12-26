<?php
function ListAll($model)
{
    //TODO filtry, sortowanie, dodawanie, szczegóły, edycja, usówanie<br>

    echo "<div style='display:inline;'>
<h2 style='display:inline;'>Lista produktów</h2>

    <div class='navbar-right'>
        <a class=\"btn btn-warning\" type=\"submit\"><span class=\"glyphicon glyphicon-plus\"></span> Dodaj</a>
    </div>
         
</div><hr>";

    echo '
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>#</th>
            <th>Nazwa</th>
            <th>Cena</th>
            <th>Sprzedanych</th>
            <th>Ocena</th>
            <th>Stan na magazynie</th>
            <th>Pracownik odpowiedzialny</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        ';
    $index = 1;


    foreach ($model->ItemList as $item) {
        echo '
        <tr>
            <td>' . ($index++) . '</td>
            <td>' . $item->Name . '</td>
            <td>' . number_format($item->Price, 2) . 'zł</td>
            <td>' . $item->NoOfRatings . '</td>
            <td>' . $item->Rating . '</td>
            <td>' . $item->StockSize . '</td>
            <td>';
        echo $item->AssignedEmployee != null ? $item->AssignedEmployee->GetFullName() : "Brak";
    echo '</td> 
            <td style="font-size:9pt;">[Szczegóły] [Edytuj] [Usuń]</td>
        </tr>
';

}

    echo '
        </tbody>
    </table>
    ';
}