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

$context = unserialize($_SESSION['context']);
$products = Cookie::GetBasketsProducts($context);
$context->Baskets->AddBasket($products);