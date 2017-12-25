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
        if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
            $session = unserialize($_SESSION['user']);
            if ($session->UserRole == 1) {
                $model = null;

                $model = $this->context->Categories->GetCategories();

                AdministrationCategories($model);
                return;
            }
        }
        header("Location: /");
    }
}