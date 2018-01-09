<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/Models/BasketModel.php";

class Baskets
{
    private $Context;
    private $SQL;

    public function __construct($context)
    {
        $this->Context = $context;
        $this->SQL = $this->Context->sql;
    }

    public function GetBasket($basketId)
    {
        $basket = null;

        $result = $this->SQL->Query("SELECT * FROM baskets WHERE BasketId=$basketId");

        $basket = new BasketModel();

        $basket->Id = $result[0]['Id'];
        $basket->BasketId = $result[0]['BasketId'];
        $basket->UserId = $result[0]['UserId'];
        $basket->CreationDate = $result[0]['CreationDate'];
        $basket->User = $this->Context->Users->GetUserBy($result[0]['UserId'], null);

        foreach ($result as $item) {
            $basket->ProductId[] = $item['ProductId'];
            $basket->Count[] = $item['Count'];
            $basket->Price[] = $item['Price'];
            $basket->Product[] = $this->Context->Products->GetProduct($item['ProductId']);
        }
        return $basket;
    }

    public function GetBaskets()
    {
        $basket = [];

        $result = $this->SQL->Query("SELECT * FROM baskets GROUP BY BasketId");

        foreach ($result as $d) {
            $baskets[] = new BasketModel();

            $basket[count($baskets) - 1]->Id = $d['Id'];
            $basket[count($baskets) - 1]->BasketId = $d['BasketId'];
            $basket[count($baskets) - 1]->ProductId = $d['ProductId'];
            $basket[count($baskets) - 1]->Count = $d['Count'];
            $basket[count($baskets) - 1]->Price = $d['Price'];
            $basket[count($baskets) - 1]->UserId = $d['UserId'];
            $basket[count($baskets) - 1]->CreationDate = $d['CreationDate'];

            $baskets[count($baskets) - 1]->AssignedEmployee = $this->Context->Users->GetUserBy($d['Id'], null);
            $baskets[count($baskets) - 1]->Parameters = $this->Context->Parameters->LoadParametersForbasket($d['BasketId']);

        }
        return $basket;
    }

    public function GetUserBaskets($userId)
    {
        $basket = [];

        $result = $this->SQL->Query("SELECT * FROM baskets WHERE UserId=$userId GROUP BY BasketId");

        foreach ($result as $d) {
            $basket[] = new BasketModel();

            $basket[count($basket) - 1]->Id = $d['Id'];
            $basket[count($basket) - 1]->BasketId = $d['BasketId'];
            $basket[count($basket) - 1]->ProductId = $d['ProductId'];
            $basket[count($basket) - 1]->Count = $d['Count'];
            $basket[count($basket) - 1]->Price = $d['Price'];
            $basket[count($basket) - 1]->UserId = $d['UserId'];
            $basket[count($basket) - 1]->CreationDate = $d['CreationDate'];

            $basket[count($basket) - 1]->AssignedEmployee = $this->Context->Users->GetUserBy($d['Id'], null);
            $basket[count($basket) - 1]->Parameters = $this->Context->Parameters->LoadParametersForProduct($d['BasketId']);

        }
        return $basket;
    }

}