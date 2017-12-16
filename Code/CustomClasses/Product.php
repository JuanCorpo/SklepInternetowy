<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alan
 * Date: 26.11.2017
 * Time: 17:52
 */

class Product
{
    public $Id;
    public $Price;
    public $Name;
    public $Category;
    public $Description;

    public function __construct($Id, $Price, $Name, $Category, $Description)
    {
        $this->Id = $Id;
        $this->Price = $Price;
        $this->Name = $Name;
        $this->Category = $Category;
        $this->Description = $Description;
    }
}