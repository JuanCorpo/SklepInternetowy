<?php
foreach (glob("./Views/Administration/*.php") as $filename) {
    include_once $filename;
}
include_once("./Code/Helpers/RoleHelper.php");

class AdministrationController
{
    private $context;

    public function __construct($sql)
    {
        $this->context = $sql;
    }

    public function Categories()
    {
        if (IsInRole(1)) {
            $model = null;

            $model = $this->context->Categories->GetCategories();

            $_SESSION['context'] = serialize($this->context->Categories);
            AdministrationCategories($model);
            return;

        }
    }
}