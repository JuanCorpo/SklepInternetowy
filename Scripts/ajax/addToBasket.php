<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/Config/sql.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Code/Helpers/VariablesHelper.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Config/DatabaseContext.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Models/UserModel.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Models/BasketModel.php");
foreach (glob($_SERVER['DOCUMENT_ROOT'] . "/Config/DatabaseContext/*.php") as $filename) {
    include_once $filename;
}

if(VariablesHelper::IsUserActive()) {
    $user = unserialize($_SESSION['user']);
    $userId = $user->Id;
}
$userId = -1;
$action = $_POST['Action'];
$productId = $_POST['ID'];
$currentBasket = null;

if (isset($_COOKIE['basket'])) {
    $currentBasket = unserialize($_COOKIE['basket']);
} else {
    $currentBasket = [];
}

// Dodawanie produktu
if ($action == 1) {

    $exists = false;
    for ($i = 0; $i < count($currentBasket); $i++) {
        if ($currentBasket[$i]->ProductId == $productId) {
            $exists = true;
            $currentBasket[$i]->Count += 1;
        }
    }

    if (!$exists) {
        $currentBasket[] = new BasketModel();

        $currentBasket[count($currentBasket) - 1]->Id = -1;
        $currentBasket[count($currentBasket) - 1]->BasketId = -1;
        $currentBasket[count($currentBasket) - 1]->ProductId = $productId;
        $currentBasket[count($currentBasket) - 1]->Count = 1;
        $currentBasket[count($currentBasket) - 1]->UserId = $userId;
        $currentBasket[count($currentBasket) - 1]->CreationDate = date('Y-m-d H:i:s');
    }

    $serializedBasket = serialize($currentBasket);
    Cookie::CreateCookie('basket', $serializedBasket, 365);

} else if ($action == -1) {
    // Usuwanie produktu
    for ($i = 0; $i < count($currentBasket); $i++) {
        if ($currentBasket[$i]->ProductId == $productId) {
            array_splice($currentBasket, $i, 1);
        }
    }
    $serializedBasket = serialize($currentBasket);
    Cookie::CreateCookie('basket', $serializedBasket, 365);

    $model = [];
    $context = unserialize($_SESSION['context']);

    foreach ($currentBasket as $item) {
        $product = $context->GetProduct($item->ProductId);
        $model[] = new BasketModel();
        $model[count($model)-1]->Product = $product;
        $model[count($model)-1]->Count = $item->Count;
    }

    echo '
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
        $suma+= ($item->Product->Price*$item->Count);
        echo '<tr >
                  <td> ' . $i++ . '</td>
                  <td><a href="/Products/Show/' . $item->Product->ProductId . '">' . $item->Product->Name . '</a></td>
                  <td>' . $item->Price . '</td>
                  <td style="width: 150px;">
                  <input style="width:100px;" placeholder="Podaj ilość" value="'.$item->Count.'" class="form-control" type="text" id="ProductOrder_'.$item->Product->ProductId.'" name="ProductOrder_'.$item->Product->ProductId.'"/>
                  </td>
                  <td>
                  
                  <span class="glyphicon glyphicon-remove" onclick="removeFromBasket(' . $item->Product->ProductId . ')" style="color:red;cursor:pointer; text-decoration: none;"> </span>
                  </td>
                 
                </tr>';

    }
    echo '<tr ><td></td>   <td></td>    <td>' . $suma . 'zł</td>  <td></td>  <td></td></tr>';

    echo '</table> ';
    if (count($model) == 0) {
        echo '<div class="cs-empty" colspan="100%" style="text-align:center">
                            Brak danych
                        </div>';
    }
}