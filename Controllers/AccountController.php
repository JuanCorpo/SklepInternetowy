<?php
include_once('./Code/Helpers/Cookie.php');
include_once("./Models/UserModel.php");
include_once("./Code/Helpers/VariablesHelper.php");
include_once("./Code/CustomClasses/MailSender.php");
include_once("./Config/DatabaseContext.php");
foreach (glob("./Views/Account/*.php") as $filename) {
    include_once $filename;
}


class AccountController
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
    }

    public function Index($model)
    {
        if (VariablesHelper::IsUserActive()) {
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
        $model = null;

        if (VariablesHelper::ArePostSet(array(0 => 'Email', 1 => 'Password'))) {
            $model = $this->context->Users->GetUserBy($_POST['Email'], null);

            $pass = $_POST['Password'];

            if (count($model) == 0) {
                $model = new UserModel();
                $email = $_POST['Email'];

                if (strlen($pass) < 7) {
                    $model->UserPrivateMail = "";
                    $model->ErrorLogin = "Minimalna liczba znaków to 7";
                    $this->Login($model, 1);
                    return;
                }

                if (VariablesHelper::IsPostSet('Policies')) {
                    $model->UserName = explode("@", $email)[0];
                    $model->UserPrivateMail = $email;
                    $model->UserRole = 0;
                    $model->EmailConfirmed = false;
                    $model->IsActive = false;
                    $model->IsPasswordChangeRequired = false;
                    $model->CreationDate = date('Y-m-d H:i:s');

                    $this->context->Users->AddNewUser($model, sha1($pass));

                    $newToken = $model->generateEmailToken();
                    $this->context->Users->SaveEmailConfirmToken($model->UserPrivateMail, $newToken);

                    $actual_link = "http://$_SERVER[HTTP_HOST]" . "/Account/Confirm/" . $newToken;
                    MailSender::SendEmailConfirmInfo($this->context, $email, Array($model->UserName, $actual_link, $model->UserPrivateMail));

                    if (VariablesHelper::IsPostSet('Newsletter')) {
                        $this->context->Users->AddToNewsletter($email);
                        MailSender::SendNewsletterInfo($this->context, $email);
                    }
                    $model->ErrorLogin = "Wysłano link z potwierdzeniam adresu email!";
                    $this->Login($model, 1);
                    return;
                } else {
                    $model->UserPrivateMail = "";
                    $model->ErrorLogin = "Nie zaakceptowano regulaminu!";
                    $this->Login($model, 1);
                    return;
                }
            } else {
                $model->UserPrivateMail = "";
                $model->ErrorLogin = "Istnieje już konto z podanym adresem email!";
                $this->Login($model, 1);
                return;
            }

        }
        $model->UserPrivateMail = "";
        $model->ErrorLogin = "Niepodano prawidłowych danych!";
        $this->Login($model, 1);
        return;
    }

    public function AddToNewsLetter()
    {
        if (VariablesHelper::IsPostSet('Email')) {
            $this->context->Users->AddToNewsletter($_POST['Email']);
            MailSender::SendNewsletterInfo($this->context, $_POST['Email']);
        }
        header("Location: /");
    }

    public function LoginPost()
    {
        $model = null;

        if (VariablesHelper::ArePostSet(array(0 => 'Email', 1 => 'Password'))) {
            $password = sha1($_POST['Password']);
            $model = $this->context->Users->ValidateUser($_POST['Email'], $password);

            if ($model != null) {

                if (VariablesHelper::ArePostSet(array(0 => 'emailToken', 1 => 'confirmedToken'))) {
                    $token = $_POST['emailToken'];
                    $confirmed = $_POST['confirmedToken'];

                    if($model->EmailConfirmToken === $token && $confirmed === $model->EmailConfirmed) {
                        $model->EmailConfirmed = true;
                        $model->EmailConfirmToken = "";
                        $model = $this->context->Users->SaveModel($model);
                    }
                }

                if ($model->EmailConfirmed) {
                    $_SESSION['user'] = new UserModel();
                    $_SESSION['user'] = serialize($model);

                    if (VariablesHelper::IsPostSet('RememberMe')) {
                        Cookie::CreateCookie('ID', $model->Id, 365);
                        $newToken = $model->generateRandomToken();
                        Cookie::CreateCookie("TOKEN", $newToken, 365);
                        $this->context->Users->SaveToken($model->Id, $newToken);
                    }
                    header("Location: /");
                }
            } else {
                $model = new UserModel();
                $model->UserPrivateMail = "";
                $model->ErrorLogin = "Dane logowania nie są poprawne albo nie potwierdzono adresu email.";

                $this->Login($model, 0);
                return;
            }
        }
        $model = new UserModel();
        $model->UserPrivateMail = "";
        $model->ErrorLogin = "Dane logowania nie są poprawne albo nie potwierdzono adresu email.";

        $this->Login($model, 0);
        return;

    }

    public function LogoutPost()
    {
        if (VariablesHelper::IsUserActive()) {
            Cookie::DeleteCookie("ID");
            Cookie::DeleteCookie("TOKEN");

            $user = unserialize($_SESSION['user']);
            $this->context->Users->SaveToken($user->Id, "");
            $_SESSION['user'] = null;
        }
        $this->Index(null);
    }

    public function Confirm($token)
    {
        $model = new UserModel();
        $model->EmailConfirmToken = $token;
        $model->EmailConfirmed = 0;

        AccountLoginView($model, 0);
        return;
    }
}