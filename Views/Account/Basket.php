<?php
function Basket($model,$userAddresses)
{
    SidePanel();
    echo '<div id=\"ProfileMainContent\" class="col-md-9">

<form action="#" method="post">
    <div class="col-md-12" id="BasketProductList">';

    if (count($model) == 0) {
        echo '<div class="cs-empty" colspan="100%" style="text-align:center">Brak danych</div>';
    } else {
        echo '
<div class="col-md-12">
<a onclick="SaveBasket()" class="btn btn-warning col-md-4">Zapisz koszyk</a>
</div>
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
        echo '</table>';

    }
    echo '

</div> 
        <div class="col-md-12">
        
        <div class="col-md-4">
        Sposób płatności       

          <div class="form-group">
            <div class="custom-control custom-radio">
              <input type="radio" id="customRadio1" name="PayMethod" value="1" class="custom-control-input" checked="">
              <label class="custom-control-label" for="customRadio1">Bitcoin</label>
            </div>
            <div class="custom-control custom-radio">
              <input type="radio" id="customRadio2" name="PayMethod" value="2" class="custom-control-input">
              <label class="custom-control-label" for="customRadio2">Karta płatnicza</label>
            </div>
            <div class="custom-control custom-radio">
              <input type="radio" id="customRadio3" name="PayMethod" value="3" class="custom-control-input">
              <label class="custom-control-label" for="customRadio3">Płatność przy odbiorze</label>
            </div>
          </div>
  
        
        </div>
        <div class="col-md-4">
        <div class="form-group">
      <label for="select" class="col-md-12 control-label">Adres dostawy</label>
      <div class="col-lg-10">
        <select class="form-control" id="select">
          <option value="-1">Wybierz adres</option>';

    foreach($userAddresses as $item){
        echo "<option value='$item->Id'>$item->GetFullAddress()</option>";
    }
        echo '</select>
      </div>
    </div>
        
        </div>
        
        <div class="col-md-4">
        <a href="#" class="btn btn-warning col-md-12">Zamów</a>
            </div>

</div>  
</form>
    <script src="/Scripts/ajax/Basket.js"></script>
    <script src="/Scripts/ajax/SaveBasket.js"></script>
';

    echo '</div>';

}