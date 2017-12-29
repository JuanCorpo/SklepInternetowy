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

    public function LoadCategories()
    {
        $sqlResult = $this->SQL->Query("SELECT * FROM categories");
        return $sqlResult;
    }

    public function NewCategoryId()
    {
        return (count($this->SQL->Query("SELECT * FROM categories")) + 1);
    }

    public function UpdateCategory($catId, $catName, $catParentId)
    {
        $result = $this->SQL->Query("SELECT * FROM categories WHERE CategoryId=$catId");
        if (count($result) != 0) {
            $this->SQL->Query("UPDATE categories SET CategoryName='$catName',ParentId=$catParentId WHERE CategoryId=$catId");
        } else {
            $this->SQL->Query("INSERT INTO categories (CategoryId,CategoryName,ParentId) VALUES ($catId, '$catName',$catParentId)");
        }
    }
}