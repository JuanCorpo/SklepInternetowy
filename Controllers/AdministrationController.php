<?php
foreach (glob("Views/Administration/*.php") as $filename) {
    include_once $filename;
}
include_once("Code/Helpers/RoleHelper.php");
include_once("ViewModel/ProductListViewModel.php");
include_once("Models/ProductModel.php");
include_once("Code/Helpers/VariablesHelper.php");
include_once("Code/Helpers/Cookie.php");
include_once("Config/DatabaseContext.php");

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

            // Warunek przesłania danych w formularzu
            if (VariablesHelper::IsAnyPostActive()) {


                $Picture_dir = "Content/Pictures/";
                $Target_file = $Picture_dir . basename($_FILES["ImageUpload"]["name"]);
                $ImageFileType = pathinfo($Target_file, PATHINFO_EXTENSION);
                move_uploaded_file($_FILES["ImageUpload"]["tmp_name"], $Target_file);


                // Wypełnienie danymi z formularza
                $model->CategoryId = VariablesHelper::GetPostValue("CategorySelect");
                $model->Name = VariablesHelper::GetPostValue("ProductName");
                $model->Price = VariablesHelper::GetPostValue("ProductPrice");
                $model->StockSize = VariablesHelper::GetPostValue("StockSize");
                $model->Description = VariablesHelper::GetPostValue("desc");
                $model->ProductEmployeeId = VariablesHelper::GetPostValue("EmployeerSelect");
                $model->ImageDirectory = "/" . $Target_file;


                // Wypełnienie domyślnymi wartościami bez formularza
                $model->NoOfRatings = 0;
                $model->Rating = 0;

                // Dodanie produktu do tabeli produkty, i zwrócenie ID produktu
                $ProductIdToParametersTable = $this->context->Products->Addproduct($model);

                // Wypełnienie modelu parametrów
                for ($i = 0; $i <= VariablesHelper::GetPostValue("ParamSize"); $i++) {
                    if (VariablesHelper::IsPostSet("ParamId_" . $i)) {
                        $ParamId = VariablesHelper::GetPostValue("ParamId_" . $i);
                        $ParamVal = VariablesHelper::GetPostValue("ParamVal_" . $i);

                        $model->Parameters[] = new ParametersModel();
                        $model->Parameters[count($model->Parameters) - 1]->CategoryId = $model->CategoryId;
                        $model->Parameters[count($model->Parameters) - 1]->ParameterId = $ParamId;
                        $model->Parameters[count($model->Parameters) - 1]->ParameterValue = $ParamVal;
                        $model->Parameters[count($model->Parameters) - 1]->ProductId = $ProductIdToParametersTable;
                    }
                }

                // Przesłanie modelu parametrów do bazy danych
                foreach ($model->Parameters as $item) {
                    $this->context->Parameters->AddParameter($item);
                }
            }
            // Przekierowanie do widoku
            AddProduct($model, $Categories, $Employees, $ParametersTypes);
            return;
        }
    }

    public
    function EmailQueue()
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
            if (VariablesHelper::ArePostSet(array(0 => 'id', 1 => 'subject', 2 => 'body'))) {
                $id = VariablesHelper::GetPostValue('id');
                $subject = VariablesHelper::GetPostValue('subject');
                $body = VariablesHelper::GetPostValue('body');

                $this->context->EmailTemplates->Update($id, $subject, $body);
            }

            $model = $this->context->EmailTemplates->GetTemplate($id, null);
            EditEmailTemplateView($model);
            return;
        }
    }

    public function Settings(){
        // TODO popeawić czytelność
        Settings();
        return;
    }

    public function ParametersTypes()
    {
        $model = null;
        if(VariablesHelper::IsAnyPostActive()){

            $model = new ParametersTypesModel();
            $model->ParameterName = VariablesHelper::GetPostValue('Name');
            $model->Prefix = VariablesHelper::GetPostValue('prefix');
            $model->Suffix = VariablesHelper::GetPostValue('Suffix');
            $model->ValueType = VariablesHelper::GetPostValue('ValueType');

            $this->context->ParametersTypes->AddParameterType($model);
            header("Location: ../../Administration/ParametersTypes/");
        }

        $model = $this->context->ParametersTypes->GetParametersTypes();
        ParametersTypes($model);
        return;
    }

    public function EditProduct($ProductId) {
        if (RoleHelper::IsInRole(1)) {

            if (VariablesHelper::IsAnyPostActive()) {
                $ProductModel = new ProductModel();
                // Wypełnienie danymi z formularza

                $Picture_dir = "Content/Pictures/";
                $Target_file = $Picture_dir . basename($_FILES["ImageUpload"]["name"]);
                $ImageFileType = pathinfo($Target_file, PATHINFO_EXTENSION);
                move_uploaded_file($_FILES["ImageUpload"]["tmp_name"], $Target_file);

                $ProductModel->ProductId = $ProductId;
                $ProductModel->CategoryId = VariablesHelper::GetPostValue("CategorySelect");
                $ProductModel->Name = VariablesHelper::GetPostValue("ProductName");
                $ProductModel->Price = VariablesHelper::GetPostValue("ProductPrice");
                $ProductModel->StockSize = VariablesHelper::GetPostValue("StockSize");
                $ProductModel->Description = VariablesHelper::GetPostValue("desc");
                $ProductModel->ProductEmployeeId = VariablesHelper::GetPostValue("EmployeerSelect");
                $ProductModel->ImageDirectory = "/" . $Target_file;

                $this->context->Products->UpdateProduct($ProductModel);

                $this->context->Parameters->DeleteParameters($ProductId);

                for ($i = 0; $i <= VariablesHelper::GetPostValue("ParamSize"); $i++) {
                    if (VariablesHelper::IsPostSet("ParamId_" . $i)) {
                        $ParamId = VariablesHelper::GetPostValue("ParamId_" . $i);
                        $ParamVal = VariablesHelper::GetPostValue("ParamVal_" . $i);

                        $ProductModel->Parameters[] = new ParametersModel();
                        $ProductModel->Parameters[count($ProductModel->Parameters) - 1]->CategoryId = $ProductModel->CategoryId;
                        $ProductModel->Parameters[count($ProductModel->Parameters) - 1]->ParameterId = $ParamId;
                        $ProductModel->Parameters[count($ProductModel->Parameters) - 1]->ParameterValue = $ParamVal;
                        $ProductModel->Parameters[count($ProductModel->Parameters) - 1]->ProductId = $ProductId;
                    }
                }
                // Przesłanie modelu parametrów do bazy danych
                foreach ($ProductModel->Parameters as $item) {
                    $this->context->Parameters->AddParameter($item);
                }
                header("Location: ../../Products/Show/$ProductId");
            }
            $ProductModel = $this->context->Products->GetProduct($ProductId);
            $Employees = $this->context->Users->GetEmployeesList();
            $Categories = $this->context->Categories->GetCategories();
            $ParametersTypes = $this->context->ParametersTypes->GetParametersTypes();
            EditProduct($ProductModel, $Employees, $Categories, $ParametersTypes);
            return;
        }
    }
}