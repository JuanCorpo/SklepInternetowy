<?php

abstract class PagedListViewModel
{
    public $ItemList;
    public $Page;
    public $PageSize;

    abstract public function Populate($itemList);

    abstract public function Sort($itemList);
}