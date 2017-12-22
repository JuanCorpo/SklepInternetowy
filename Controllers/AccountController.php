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

    public function RegisterPost()
    {
        echo "Rejestruje ".$_POST['newEmail'];

    }

    public function LoginPost()
    {
        $password = md5($_POST['password']);

        echo "Loguje ".$_POST['email'];
        if(isset($_POST['remeberMe']))
            echo "<br>zapamiętam";
        echo "<br>$password";

    }

    public function Profile($model)
    {
        return  AccountProfileView($model);
    }
}