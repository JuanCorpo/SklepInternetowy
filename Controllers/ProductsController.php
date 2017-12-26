<?php
include_once('./Code/CustomFunctions/Cookie.php');
include_once("./Models/ProductModel.php");
include_once("./ViewModel/ProductListViewModel.php");
include_once("./Code/Helpers/AreVarsSet.php");
include_once("./Code/Helpers/RoleHelper.php");
include_once("./Code/CustomFunctions/Cookie.php");
include_once("./Config/DatabaseContext.php");
foreach (glob("./Views/Products/*.php") as $filename) {
    include_once $filename;
}

class ProductsController
{
    private $context;
    private $model;

    public function __construct($sql)
    {
        $this->context = $sql;
    }

    public function ListFor($category)
    {
        $this->model = new ProductListViewModel($this->context, 10, 1);

        $arr = $this->context->Products->GetProductsIdFrom($category, 0);
        $arr = $this->context->Products->GetProductsFromCategories($arr);

        $this->model->ItemList = $this->model->Populate($arr);

        $this->model->OtherCategories = $this->context->Products->LoadProductForCategory($category);

        ListFor($this->model);
        return;
    }

    public function ListAll()
    {
        if (IsInRole(1)) {
            $this->model = new ProductListViewModel($this->context, 10, 1);

            $arr = $this->context->Products->GetProducts();

            $this->model->ItemList = $this->model->Populate($arr);
            ListAll($this->model);
            return;

        }
    }

    public function Show($productId)
    {

        $this->model = $this->context->Products->GetProduct($productId);

        ProductsShow($this->model);
        return;
    }

}