<?php
session_start();
include_once("Config/sql.php");
include_once("Code/Helpers/VariablesHelper.php");
include_once("Config/DatabaseContext.php");
include_once("Models/UserModel.php");
include_once("Models/BasketModel.php");
foreach (glob("Config/DatabaseContext/*.php") as $filename) {
    include_once $filename;
}

$context = unserialize($_SESSION['context']);
$products = Cookie::GetBasketsProducts($context);
$context->Baskets->AddBasket($products);