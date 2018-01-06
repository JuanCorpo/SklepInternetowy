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
            $Employees = $this->context->Users->GetEmployeesList();
            $Categories = $this->context->Categories->GetCategories();
            $ParametersTypes = $this->context->ParametersTypes->GetParametersTypes();
//            echo "<pre>";
//            print_r($Employees);
//            die();

            // Dodanie produktu
            if (VariablesHelper::IsAnyPostActive()) {


                // Wypełnić model danymi z POST i context->add

                echo "POST";
                die();

            } else { // Tworzenie nowego

                // Pobrać liste pracowników, liste kategorii

            }
            AddProduct($model, $Categories, $Employees, $ParametersTypes);
            return;
        }
    }

    public function EmailQueue()
    {
        if (RoleHelper::IsInRole(1)) {
            $model = null;

            $model = $this->context->EmailQueues->GetEmails();

            EmailQueue($model);
            return;
        }
    }

    public function EmailTemplates()
    {
        $model = null;

        if (RoleHelper::IsInRole(1)) {
            $model = $this->context->EmailTemplates->GetTemplates();

            EmailTemplates($model);
            return;
        }
    }

    public function EditEmailTemplate($id)
    {

        if (RoleHelper::IsInRole(1)) {
            if (VariablesHelper::ArePostSet(array(0 => 'id', 1 => 'subject', 2 => 'body')))
            {
                $id = VariablesHelper::GetPostValue('id');
                $subject = VariablesHelper::GetPostValue('subject');
                $body = VariablesHelper::GetPostValue('body');

                $this->context->EmailTemplates->Update($id,$subject,$body);
            }

            $model = $this->context->EmailTemplates->GetTemplate($id, null);
            EditEmailTemplateView($model);
            return;
        }
    }
}