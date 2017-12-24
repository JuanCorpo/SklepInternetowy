<?php

class Products
{
    private $ProductModel;
    private $SQL;

    private $productList = [];

    public function __construct($sql)
    {
        $this->SQL = $sql;

    }

    public function LoadProductForCategory($CategoryId)
    {
        $d = $this->GetMenuData();
        return $this->ShowForCategory($d, $CategoryId, 0);
    }

    public function GetMenuData()
    {
        $result = $this->SQL->Query("SELECT * FROM categories");
        $data = array();
        while ($d = $result->fetch_assoc()) {
            $data[] = $d;
        }

        return $data;
    }

    function ShowForCategory($array, $mainCategoryId, $level)
    {
        $fr = "";

        foreach ($array as $row) {
            $i = $row['CategoryId'];

            if (($level == 0 && $row['CategoryId'] == $mainCategoryId) || $row['ParentId'] == $mainCategoryId) {
                if ($row['ParentId'] != 0) {

                    $fr .= "<div id='menuBtn_$i' class='menuButton' style='width: 250px;float:left'>";

                    if ($level == 0) {
                        $fr .= "<b>";
                    }

                    $fr .= "<a style='display: inline-block;' href='/Products/ListFor/$row[CategoryId]'>$row[CategoryName]</a>";

                    if ($level == 0) {
                        $fr .= "</b>";
                    }

                    $fr .= "</div>";
                }

                if ($row['ParentId'] == $mainCategoryId) {
                    $fr .= $this->ShowForCategory($array, $row['CategoryId'], $level + 1);
                }
            }
        }
        return $fr;
    }

    function GetProductsIdFrom($CategoryId, $level)
    {
        $array = $this->GetMenuData();

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
                $products[count($products) - 1]->Name = $d['ProductName'];
                $products[count($products) - 1]->Id = $d['ProductId'];
            }
        }
        return $products;
    }

    function GetAllProductsFrom($categoryId)
    {
        $ProductList = null;


    }
}