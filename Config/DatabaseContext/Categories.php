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

    public function NewCategoryId()
    {
        return (mysqli_num_rows($this->SQL->Query("SELECT * FROM categories")) + 1);
    }

    public function UpdateCategory($catId, $catName, $catParentId)
    {
        $result = $this->SQL->Query("SELECT * FROM categories WHERE CategoryId=$catId");
        if (mysqli_num_rows($result) != 0) {
            $this->SQL->Query("UPDATE categories SET CategoryName='$catName',ParentId=$catParentId WHERE CategoryId=$catId");
        } else {
            $this->SQL->Query("INSERT INTO categories (CategoryId,CategoryName,ParentId) VALUES ($catId, '$catName',$catParentId)");
        }
    }
}