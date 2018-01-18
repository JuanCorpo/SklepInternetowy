<?php

function Baskets($model)
{
    SidePanel();
    echo "<div id=\"ProfileMainContent\" class='col-md-9'>

lista zapasynach / kupionych  koszyków

";

echo"
    <table  class=\"table table-hover\">

        <tr>
            <td>Numer koszyka</td><td>Data stworzenia</td><td>Wartość</td><td>Zadaj pytanie</td>
        </tr>";

foreach($model as $item) {
    echo"<tr >
            <td > <a href='../../Account/Basket/".$item->BasketId."'>".sprintf("%08d", $item->BasketId)."</a> </td >
            <td > $item->CreationDate </td >
            <td > VAR </td >
            <td > <a href='../../Account/AskAboutOrder/".$item->BasketId."'>Zapytaj</a> </td >
        </tr >";
}
        
    echo "</table> </div>
<pre>";

}