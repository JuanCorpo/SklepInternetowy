<?php

class Categories
{
    private $Context;
    private $SQL;

    public function __construct($context)
    {
        $this->Context = $context;
        $this->SQL = $this->Context->sql;
    }

    public function GetCategories()
    {
        $result = $this->SQL->Query("SELECT * FROM categories");
        $data = array();
        while ($d = $result->fetch_assoc()) {
            $data[] = $d;
        }

        return $data;
    }
}