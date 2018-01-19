<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/Models/ProductModel.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/ViewModel/ProductListViewModel.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Code/Helpers/VariablesHelper.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Code/Helpers/RoleHelper.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Code/Helpers/Cookie.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Config/DatabaseContext.php");
foreach (glob($_SERVER['DOCUMENT_ROOT'] . "/Views/Products/*.php") as $filename) {
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

        $categoryGet = $category;

        if (VariablesHelper::GetGetValue('filters') == true) {
            $catId = VariablesHelper::GetGetValue('categoryId');
            if ($catId != null) {
                $categoryGet = $catId;
            }
        }

        $productsCategoryIds = $this->context->Products->GetProductsIdFrom($categoryGet, 0);
        $productsAll = $this->context->Products->GetProductsFromCategories($productsCategoryIds);

        $products = [];
        if (VariablesHelper::GetGetValue('filters') == true) {
            $name = VariablesHelper::GetGetValue('name');
            $priceMin = VariablesHelper::GetGetValue('priceMin');
            $priceMax = VariablesHelper::GetGetValue('priceMax');

            if ($name != null) {
                foreach ($productsAll as $item) {
                    if (strpos($item->Name, $name) !== false) {
                        $products[] = $item;
                    }

                }
            }
            $model->Populate($products);
        } else {
            $model->Populate($productsAll);
        }

        $model->OtherCategories = $this->context->Products->LoadProductForCategory($categoryGet);

        ListFor($model, $categoryGet);
        return;
    }

    public function Show($productId)
    {
        $product = $this->context->Products->GetProduct($productId);

        ProductsShow($product);
        return;
    }
}