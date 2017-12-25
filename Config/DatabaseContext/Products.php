<?php

class Products
{
    private $ProductModel;
    private $Context;
    private $SQL;

    private $productList = [];

    public function __construct($context)
    {
        $this->Context = $context;
        $this->SQL = $this->Context->sql;
    }

    public function LoadProductForCategory($CategoryId)
    {
        $d = $this->Context->Categories->GetCategories();
        return $this->ShowForCategory($d, $CategoryId, 0);
    }

    private $result = [];

    function ShowForCategory($array, $mainCategoryId, $level)
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

    function GetProductsIdFrom($CategoryId, $level)
    {
        $array = $this->Context->Categories->GetCategories();

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

            while ($d = $result->fetch_assoc()) {
                $products[] = new ProductModel();
                $products[count($products) - 1]->ProductId = $d['ProductId'];
                $products[count($products) - 1]->CategoryId = $d['CategoryId'];
                $products[count($products) - 1]->Name = $d['ProductName'];
                $products[count($products) - 1]->Price = $d['ProductPrice'];
                $products[count($products) - 1]->Rating = $d['Rating'];
                $products[count($products) - 1]->NoOfRatings = $d['NumberOfBought'];
                $products[count($products) - 1]->StockSize = $d['StockStatus'];
                $products[count($products) - 1]->ProductEmployeeId = $d['ProductEmployeeId'];

                $products[count($products) - 1]->Parameters = $this->Context->Parameters->LoadParametersForProduct($d['ProductId']);
            }
        }
        return $products;
    }

    function GetProduct($productId)
    {
        $product = null;
        $product = new ProductModel();

        $result = $this->SQL->Query("SELECT * FROM products WHERE ProductId=$productId");
        $result = $this->Context->sql->SqlResultToArray($result);

        if (count($result) == 1) {

            $product->ProductId = $result[0]['ProductId'];
            $product->CategoryId = $result[0]['CategoryId'];
            $product->Name = $result[0]['ProductName'];
            $product->Price = $result[0]['ProductPrice'];
            $product->Rating = $result[0]['Rating'];
            $product->NoOfRatings = $result[0]['NumberOfBought'];
            $product->StockSize = $result[0]['StockStatus'];
            $product->ProductEmployeeId = $result[0]['ProductEmployeeId'];

            $product->Parameters = $this->Context->Parameters->LoadParametersForProduct($result[0]['ProductId']);

        }
        return $product;
    }

}