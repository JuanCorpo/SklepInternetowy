<?php
include_once "PagedListViewModel.php";

class ProductListViewModel extends PagedListViewModel
{
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
        foreach ($itemList as $item) {
            $this->ItemList[] = new ProductModel();
            $this->ItemList[count($this->ItemList) - 1]->ProductId = $item->ProductId;
            $this->ItemList[count($this->ItemList) - 1]->CategoryId = $item->CategoryId;
            $this->ItemList[count($this->ItemList) - 1]->Name = $item->Name;
            $this->ItemList[count($this->ItemList) - 1]->Price = $item->Price;
            $this->ItemList[count($this->ItemList) - 1]->Rating = $item->NoOfRatings!=0?($item->Rating/$item->NoOfRatings):0;
            $this->ItemList[count($this->ItemList) - 1]->NoOfRatings = $item->NoOfRatings;
            $this->ItemList[count($this->ItemList) - 1]->StockSize = $item->StockSize;
            $this->ItemList[count($this->ItemList) - 1]->ProductEmployeeId = $item->ProductEmployeeId;

            $this->ItemList[count($this->ItemList) - 1]->AssignedEmployee = $this->Context->Users->GetUserById($item->ProductEmployeeId);

            $this->ItemList[count($this->ItemList) - 1]->Parameters = $this->Context->Parameters->LoadParametersForProduct($item->ProductId);
        }
        return $this->ItemList;
    }

    public function Sort($itemList)
    {
        // TODO: Implement Sort() method.
    }
}