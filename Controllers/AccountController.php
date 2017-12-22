<?php
include_once ("./Models/UserModel.php");
foreach (glob("./Views/Account/*.php") as $filename) {
    include_once $filename;
}


class AccountController
{
    public function Index()
    {
        $model = new UserModel();

        if(isset($_SESSION['user']) && $_SESSION['user'] != null){
            $this->Profile($model);
        }else{
            $this->Login($model);
        }
    }

    public function Login($model)
    {
        return  AccountLoginView($model);
    }

    public function Profile($model)
    {
        return  AccountProfileView($model);
    }
}