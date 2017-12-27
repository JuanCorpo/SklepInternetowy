<?php
include_once "PagedListViewModel.php";

class ProductListViewModel extends PagedListViewModel
{
    // TODO Zmiana strony - stronicowanie
    public $Name;
    public $OtherCategories;
    public $Context;

    public function __construct($context, $pageSize = 10, $page = 1)
    {
        $this->Context=$context;
        $this->PageSize = $pageSize;
        $this->Page = $page;
    }

    public function Populate($itemList)
    {
        $this->ItemList = [];
        foreach ($itemList as $item) {
            $this->ItemList[] = new ProductModel();
            $this->ItemList[count($this->ItemList) - 1] = $item;
        }
        return $this->ItemList;
    }

    public function Sort($itemList)
    {
        // TODO: Implement Sort() method.
    }
}