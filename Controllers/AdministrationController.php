<?php
foreach (glob("./Views/Administration/*.php") as $filename) {
    include_once $filename;
}
include_once("./Code/Helpers/RoleHelper.php");
include_once("./ViewModel/ProductListViewModel.php");
include_once("./Models/ProductModel.php");
include_once("./Code/Helpers/VariablesHelper.php");
include_once("./Code/Helpers/Cookie.php");
include_once("./Config/DatabaseContext.php");

class AdministrationController
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
    }

    public function Categories()
    {
        if (RoleHelper::IsInRole(1)) {
            $model = null;

            $model = $this->context->Categories->LoadCategories();

            $_SESSION['context'] = serialize($this->context->Categories);
            AdministrationCategories($model);
            return;

        }
    }

    public function ListAll()
    {
        $model = null;
        if (RoleHelper::IsInRole(1)) {
            $model = new ProductListViewModel($this->context, 10, 1);

            $allProducts = $this->context->Products->GetProducts();

            $model->Populate($allProducts);
            ListAll($model);
            return;
        }
    }

    public function AddProduct()
    {
        if (RoleHelper::IsInRole(1)) {
            $model = new ProductModel();

            // Dodanie produktu
            if(VariablesHelper::IsAnyPostActive()){

                // Wypełnić model danymi z POST i context->add

                echo"POST";
                die();

            }else{ // Tworzenie nowego

                // Pobrać liste pracowników, liste kategorii

            }

            AddProduct($model);
            return;
        }
    }

}