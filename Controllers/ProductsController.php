<?php
include_once("./Models/ProductModel.php");
include_once("./ViewModel/ProductListViewModel.php");
include_once("./Code/Helpers/VariablesHelper.php");
include_once("./Code/Helpers/RoleHelper.php");
include_once("./Code/Helpers/Cookie.php");
include_once("./Config/DatabaseContext.php");
foreach (glob("./Views/Products/*.php") as $filename) {
    include_once $filename;
}

class ProductsController
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
    }

    public function ListFor($category)
    {
        $model = null;

        $model = new ProductListViewModel($this->context, 10, 1);

        $productsCategoryIds = $this->context->Products->GetProductsIdFrom($category, 0);
        $productsIds = $this->context->Products->GetProductsFromCategories($productsCategoryIds);

        $model->Populate($productsIds);

        $model->OtherCategories = $this->context->Products->LoadProductForCategory($category);

        ListFor($model);
        return;
    }

    public function ListAll()
    {
        $model = null;
        if (RoleHelper::IsInRole(1)) {
            $model = new ProductListViewModel($this->context, 10, 1);

            $allProducts = $this->context->Products->GetProducts();

            $model->Populate($allProducts);
            ListAll($model);
            return;
        }
    }

    public function Show($productId)
    {
        $product = $this->context->Products->GetProduct($productId);

        ProductsShow($product);
        return;
    }

}