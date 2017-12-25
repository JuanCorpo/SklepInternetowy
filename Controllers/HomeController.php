<?php
include_once ("./Models/HomeModel.php");
foreach (glob("./Views/Home/*.php") as $filename) {
    include_once $filename;
}

class HomeController
{
    public function Index()
    {
        $model = new HomeModel();
        $model->text = "Produkty polecane / najlepsze / reklamy / ostatnio odwiedzane / produkt dnia";

        return HomeIndexView($model);
    }
}