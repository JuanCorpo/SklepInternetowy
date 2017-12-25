<?php
include_once('./Code/CustomFunctions/Cookie.php');
include_once("./Models/UserModel.php");
include_once("./Code/Helpers/AreVarsSet.php");
include_once("./Code/CustomFunctions/Cookie.php");
include_once("./Config/DatabaseContext.php");
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
        if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
            $this->Profile($model);
            return;
        } else {
            $this->Login($model, 0);
            return;
        }
    }

    public function Login($model, $view)
    {
        AccountLoginView($model, $view);
        return;
    }

    public function Profile($model)
    {
        AccountProfileView($model);
        return;
    }

    public function RegisterPost()
    {
        $model = new UserModel();


        if (ArePostSet(array(0 => 'Email', 1 => 'Password'))) {
            $model = $this->context->Users->GetUserByEmail($_POST['Email']);

            $pass = $_POST['Password'];

            if ($model == null) {
                $model = new UserModel();
                $email = $_POST['Email'];

                if (strlen($pass) < 7) {
                    $model->UserPrivateMail = "";
                    $model->ErrorLogin = "Minimalna liczba znaków to 7";
                    $this->Login($model, 1);
                    return ;
                }

                if (isset($_POST['Policies'])) {

                    $model->UserName = explode("@", $email)[0];
                    $model->UserPrivateMail = $email;
                    $model->UserRole = 0;
                    $model->EmailConfirmed = false;
                    $model->IsActive = true;
                    $model->IsPasswordChangeRequired = false;
                    $model->CreationDate = date('Y-m-d H:i:s');

                    $this->context->Users->AddNewUser($model, sha1($pass));

                    if (isset($_POST['Newsletter'])) {
                        $this->context->Users->AddToNewsletter($email);
                    }


                } else {
                    $model->UserPrivateMail = "";
                    $model->ErrorLogin = "Nie zaakceptowano regulaminu!";
                    $this->Login($model, 1);
                    return ;
                }
            } else {
                $model->UserPrivateMail = "";
                $model->ErrorLogin = "Istnieje już konto z podanym adresem email!";
                $this->Login($model, 1);
                return ;
            }

        }
        $model->UserPrivateMail = "";
        $model->ErrorLogin = "Niepodano prawidłowych danych!";
        $this->Login($model, 1);
        return ;

        $this->Index($model);
        return ;
    }

    public function AddToNewsLetter()
    {
        if (isset($_POST['Email'])) {
            $this->context->Users->AddToNewsletter($_POST['Email']);
        }
    }

    public function LoginPost()
    {
        $password = sha1($_POST['Password']);
        $model = new UserModel();

        if (ArePostSet(array(0 => 'Email', 1 => 'Password'))) {
            $model = $this->context->Users->ValidateUser($_POST['Email'], $password);

            if ($model->Id != null) {
                $_SESSION['user'] = new UserModel();
                $_SESSION['user'] = serialize($model);

                if (isset($_POST['RememberMe'])) {
                    setNewCookie('ID', $model->Id, 365);
                    $newToken = $model->generateRandomToken();
                    setNewCookie("TOKEN", $newToken, 365);
                    $this->context->Users->SaveToken($model->Id, $newToken);
                }
                header("Location: /");
            }
        }

        $model->UserPrivateMail = "";
        $model->ErrorLogin = "Dane logowania nie są poprawne.";

        $this->Login($model, 0);
        return;

    }

    public function LogoutPost()
    {
        if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
            deleteCookie("ID");
            deleteCookie("TOKEN");

            $session = unserialize($_SESSION['user']);
            $id = $session->Id;

            $_SESSION['user'] = null;
            $this->context->Users->SaveToken($id, "");
        }

        $this->Index(null);
    }


}