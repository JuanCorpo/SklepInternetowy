<?php

class ProductModel
{
    public $ProductId;
    public $CategoryId;
    public $Name;
    public $Price;
    public $ImageDirectory;
    public $Rating;
    public $NoOfRatings;
    public $StockSize;
    public $Description;
    public $ProductEmployeeId;

    public $AssignedEmployee;

    public $Parameters = [];

    public function GetRating()
    {
        return $this->NoOfRatings == 0 ? 0 : $this->Rating / $this->NoOfRatings;
    }
}