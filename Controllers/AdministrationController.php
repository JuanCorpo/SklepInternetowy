<?php
foreach (glob("./Views/Administration/*.php") as $filename) {
    include_once $filename;
}

class AdministrationController
{
    private $context;

    public function __construct($sql)
    {
        $this->context = $sql;
    }

    public function Categories()
    {
        $model = null;

        $model = $this->context->Categories->GetCategories();

        AdministrationCategories($model);
        return;
    }
}