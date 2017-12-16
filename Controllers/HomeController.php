<?php
include_once ("./Models/HomeModel.php");
foreach (glob("./Views/Home/*.php") as $filename) {
    include_once $filename;
}
include_once("./Code/CustomClasses/Product.php");

class HomeController
{
    private $model;

    public function Index()
    {
        $model = new HomeModel();
        $model->text = "Produkty polecane / najlepsze / reklamy / ostatnio odwiedzane / produkt dnia";

        $model->recommendedProduct = new Product(10,100.00,"TEST",2,"Opis");

        return HomeIndexView($this ,$model);
    }
}