<?php
include_once ('./Code/CustomFunctions/Cookie.php');
include_once ("./Models/UserModel.php");
include_once ("./Code/Helpers/AreVarsSet.php");
include_once ("./Code/CustomFunctions/Cookie.php");
include_once ("./Config/DatabaseContext.php");
foreach (glob("./Views/Account/*.php") as $filename) {
    include_once $filename;
}


class AccountController
{
    private $context;

    public function __construct($sql)
    {
        $this->context = $sql;
    }

    public function Index($model)
    {
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

    public function RegisterPost()
    {
        $model = new UserModel();

        if(ArePostSet(array(0=>'Email',1=>'Password')))
        {
            $model = $this->context->Users->GetUserByEmail($_POST['Email']);

        }else{
            // Złe dane TODO Dodac validacje
        }

        $this->Index($model);
    }

    public function LoginPost()
    {
        $password = sha1($_POST['Password']);
        $model = new UserModel();

        if(ArePostSet(array(0=>'Email',1=>'Password')))
        {
            $model = $this->context->Users->ValidateUser($_POST['Email'] ,$password);

            if($model->Id !=null) {
                $_SESSION['user'] = new UserModel();
                $_SESSION['user'] = serialize($model);

                if (isset($_POST['RememberMe'])) {
                    setNewCookie('ID', $model->Id, 365);
                    $newToken = $model->generateRandomToken();
                    setNewCookie("TOKEN", $newToken, 365);
                    $this->context->Users->SaveToken( $model->Id ,$newToken);
                }

                return $this->Index($model);
            }
        }

        $model->UserPrivateMail = "";
        $model->ErrorLogin = "Dane logowania nie są poprawne.";


        return $this->Index($model);
    }

    public function LogoutPost()
    {
        if(isset($_SESSION['user']) && $_SESSION['user'] != null)
        {
            $session = unserialize($_SESSION['user']);

            deleteCookie("ID");
            deleteCookie("TOKEN");
            $this->context->Users->SaveToken( $session->Id ,"");
            $_SESSION['user'] = null;
        }

       $this->Index(null);
    }


}