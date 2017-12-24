<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alan
 * Date: 24.12.2017
 * Time: 21:47
 */

abstract class PagedListViewModel
{
    public $ItemList;
    public $Page;
    public $PageSize;

    abstract public function Populate($itemList);

    abstract public function Sort($itemList);
}