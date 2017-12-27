<?php
include_once("./Models/HomeModel.php");
foreach (glob("./Views/Home/*.php") as $filename) {
    include_once $filename;
}

class HomeController
{
    public function Index()
    {
        $model = new HomeModel();

        HomeIndexView($model);
        return;
    }
}