<?php
include_once('./Code/CustomFunctions/Cookie.php');
include_once("./Models/UserModel.php");
include_once("./Code/Helpers/AreVarsSet.php");
include_once("./Code/CustomFunctions/Cookie.php");
include_once("./Config/DatabaseContext.php");
foreach (glob("./Views/Products/*.php") as $filename) {
    include_once $filename;
}

class ProductsController
{
    private $context;

    public function __construct($sql)
    {
        $this->context = $sql;
    }

    public function ListFor($category)
    {
        return ListFor($category);
    }

}