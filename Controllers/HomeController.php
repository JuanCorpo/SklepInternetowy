<?php
include_once("Models/HomeModel.php");
foreach (glob("Views/Home/*.php") as $filename) {
    include_once $filename;
}

class HomeController
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
    }
    public function Index()
    {
        $model = new HomeModel();
        $BestProductModel = $this->context->Products->GetProduct(1);
        $ProductsTableModel = $this->context->Products->GetProductsForMainSite();
        HomeIndexView($model, $ProductsTableModel, $BestProductModel);
        return;
    }
}