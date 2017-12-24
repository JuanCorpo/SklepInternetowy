<?php
include_once("sql.php");
include_once("DatabaseContext/Users.php");
include_once("DatabaseContext/Products.php");

class DatabaseContext
{
    public $sql;
    public $Users;
    public $Products;

    public function __construct()
    {
        $this->sql = new SQL();
        $this->Users = new Users($this->sql);
        $this->Products = new Products($this->sql);
    }
}