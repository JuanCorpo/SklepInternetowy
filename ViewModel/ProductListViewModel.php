<?php
include_once "PagedListViewModel.php";

class ProductListViewModel extends PagedListViewModel
{
    private $Items;/*List<ProductModel>*/

    public $Name;
    public $OtherCategories;

    public function __construct($pageSize = 10, $page = 1)
    {
        $this->PageSize = $pageSize;
        $this->Page = $page;
    }

    public function Populate($itemList)
    {
        // TODO: Implement Populate() method.


        foreach ($itemList as $item) {
            $this->ItemList[] = new ProductModel();
            $this->ItemList[count($this->ItemList) - 1]->Name = $item->Name;
            $this->ItemList[count($this->ItemList) - 1]->Id = $item->Id;
        }
        return $this->ItemList;
    }

    public function Sort($itemList)
    {
        // TODO: Implement Sort() method.
    }
}