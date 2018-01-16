<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/Models/ProductModel.php";

class Products
{
    private $Context;
    private $SQL;

    public function __construct($context)
    {
        $this->Context = $context;
        $this->SQL = $this->Context->sql;
    }

    public function GetProduct($productId)
    {
        $product = null;

        $result = $this->SQL->Query("SELECT * FROM products WHERE ProductId=$productId");

        if (count($result) == 1) {
            $product = new ProductModel();

            $product->ProductId = $result[0]['ProductId'];
            $product->CategoryId = $result[0]['CategoryId'];
            $product->Name = $result[0]['ProductName'];
            $product->Price = $result[0]['ProductPrice'];
            $product->Rating = $result[0]['Rating'];
            $product->NoOfRatings = $result[0]['NumberOfRatings'];
            $product->ImageDirectory = $result[0]['ImageDirectory'];
            $product->StockSize = $result[0]['StockStatus'];
            $product->ProductEmployeeId = $result[0]['ProductEmployeeId'];
            $product->Description = $result[0]['Description'];

            $product->AssignedEmployee = $this->Context->Users->GetUserBy($result[0]['ProductEmployeeId'],null);
            $product->Parameters = $this->Context->Parameters->LoadParametersForProduct($result[0]['ProductId']);
        }
        return $product;
    }

    function GetProducts()
    {
        $products = [];

        $result = $this->SQL->Query("SELECT * FROM products");

        foreach ($result as $d) {
            $products[] = new ProductModel();
            $products[count($products) - 1]->ProductId = $d['ProductId'];
            $products[count($products) - 1]->CategoryId = $d['CategoryId'];
            $products[count($products) - 1]->Name = $d['ProductName'];
            $products[count($products) - 1]->Price = $d['ProductPrice'];
            $products[count($products) - 1]->ImageDirectory = $d['ImageDirectory'];
            $products[count($products) - 1]->Rating = $d['Rating'];
            $products[count($products) - 1]->NoOfRatings = $d['NumberOfRatings'];
            $products[count($products) - 1]->StockSize = $d['StockStatus'];
            $products[count($products) - 1]->ProductEmployeeId = $d['ProductEmployeeId'];
            $products[count($products) - 1]->Description = $d['Description'];

            $products[count($products) - 1]->AssignedEmployee = $this->Context->Users->GetUserBy($d['ProductEmployeeId'],null);
            $products[count($products) - 1]->Parameters = $this->Context->Parameters->LoadParametersForProduct($d['ProductId']);

        }
        return $products;
    }

    private $result = [];

    private function ShowForCategory($array, $mainCategoryId, $level)
    {
        foreach ($array as $row) {
            if (($level == 0 && $row['CategoryId'] == $mainCategoryId) || $row['ParentId'] == $mainCategoryId) {
                if ($row['ParentId'] != 0 && $mainCategoryId != $row['CategoryId']) {
                    $this->result[] = new ProductModel();
                    $this->result[count($this->result) - 1]->Name = $row['CategoryName'];
                    $this->result[count($this->result) - 1]->CategoryId = $row['CategoryId'];
                }

                if ($row['ParentId'] == $mainCategoryId) {
                    $this->ShowForCategory($array, $row['CategoryId'], $level + 1);
                }
            }
        }

        return $this->result;
    }

    public function LoadProductForCategory($CategoryId)
    {
        $categories = $this->Context->Categories->LoadCategories();
        return $this->ShowForCategory($categories, $CategoryId, 0);
    }

    private $productList = [];

    public function GetProductsIdFrom($CategoryId, $level)
    {
        $array = $this->Context->Categories->LoadCategories();

        foreach ($array as $row) {
            if (($level == 0 && $row['CategoryId'] == $CategoryId) || $row['ParentId'] == $CategoryId) {

                $this->productList[] = $row['CategoryId'];

                if ($row['ParentId'] == $CategoryId) {
                    $this->GetProductsIdFrom($row['CategoryId'], $level + 1);
                }
            }
        }
        return $this->productList;
    }

    function GetProductsFromCategories($CategoryIds)
    {
        $products = [];
        foreach ($CategoryIds as $id) {

            $result = $this->SQL->Query("SELECT * FROM products WHERE CategoryId=$id");

            foreach ($result as $item) {
                $products[] = $this->GetProduct($item['ProductId']);
            }
        }
        return $products;
    }

    public function AddProduct($ProductModel)
    {
        $this->SQL->Query("INSERT INTO products VALUES ('', $ProductModel->CategoryId, '$ProductModel->Name', $ProductModel->Price, '$ProductModel->ImageDirectory', $ProductModel->Rating, $ProductModel->NoOfRatings, $ProductModel->StockSize, '$ProductModel->Description', $ProductModel->ProductEmployeeId)");
        $result = $this->SQL->Query("SELECT ProductId FROM products ORDER BY ProductId DESC LIMIT 1");
        return $result[0]['ProductId'];
    }

    public function UpdateProduct($ProductModel)
    {
        $ProductId = $ProductModel->ProductId;
        $query = "UPDATE products SET 
        CategoryId = $ProductModel->CategoryId,
        ProductName = '$ProductModel->Name',
        ProductPrice = $ProductModel->Price,
        ImageDirectory = '$ProductModel->ImageDirectory',
        StockStatus = $ProductModel->StockSize,
        Description = '$ProductModel->Description',
        ProductEmployeeId = $ProductModel->ProductEmployeeId WHERE ProductId = $ProductId";


        $this->SQL->Query($query);
    }
}