<?php
function Basket($model)
{
    SidePanel();
    echo "<div id=\"ProfileMainContent\" class='col-md-9'>";

    if (count($model) == 0) {
        echo '<div class="cs-empty" colspan="100%" style="text-align:center">
                            Brak danych
                        </div>';
    }
    else {
    echo '
<form action="#" method="post">
<div class="col-md-12" id="BasketProductList">
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Nazwa produktu</th>
      <th>Cena</th>
      <th>Ilość</th>
      <th> </th>
    </tr>
  </thead>';


    $i = 1;
    $suma = 0.0;


        foreach ($model as $item) {
            $suma += ($item->Product->Price * $item->Count);
            echo '<tr >
                  <td> ' . $i++ . '</td>
                  <td><a href="/Products/Show/' . $item->Product->ProductId . '">' . $item->Product->Name . '</a></td>
                  <td>' . $item->Product->Price . 'zł</td>
                  <td style="width: 150px;">
                  <input style="width:100px;" placeholder="Podaj ilość" value="' . $item->Count . '" class="form-control" type="text" id="ProductOrder_' . $item->Product->ProductId . '" name="ProductOrder_' . $item->Product->ProductId . '"/>
                  </td>
                  <td>
                  
                  <span class="glyphicon glyphicon-remove" onclick="removeFromBasket(' . $item->Product->ProductId . ')" style="color:red;cursor:pointer; text-decoration: none;"> </span>
                  </td>
                 
                </tr>';

        }


    echo '<tr ><td></td>   <td></td>    <td>' . $suma . 'zł</td>  <td></td>  <td></td></tr>';
    echo '</table> ';



    echo '</div>';
    }

echo '
<div class="col-md-12">

<div class="col-md-4">Sposób płatności</div>
<div class="col-md-4">Adres dostawy</div>
<div class="col-md-4">Podsumownie ZAMÓW</div>

</div>
<div class="col-md-12">
<h2>
TODO 3 panele na dole, obliczanie kwoty przy zmianie ilosci, przeslanie formularza z wylistowanymi produktami, powiadomienie mail. (pola na input/ hidden input - id produktów, id uzytkownika, ilosc, id adresu, ....)
</h2>
</div>


</div>
</form>
    <script src="/Scripts/ajax/Basket.js"></script>
';


}