<?php
foreach (glob("./Views/Administration/*.php") as $filename) {
    include_once $filename;
}
include_once("./Code/Helpers/RoleHelper.php");

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
}