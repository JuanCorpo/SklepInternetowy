<?php
include_once  $_SERVER['DOCUMENT_ROOT'] . "/Models/OrderModel.php";

class Orders
{
    private $Context;
    private $SQL;

    public function __construct($context)
    {
        $this->Context = $context;
        $this->SQL = $this->Context->sql;
    }

    public function AddOrder($OrderModel)
    {
        $date = date('Y-m-d H:i:s');

        $q = "INSERT INTO orders VALUES ('',0,$OrderModel->Price,'$date',$OrderModel->BasketId,$OrderModel->UserId,0)";
        $this->SQL->Query($q);
    }
}