<?php


class Users
{
    private $SQL;
    private $UserModel;

    public function __construct($sql)
    {
        $this->SQL = $sql;

    }

    public function GetUserByEmail($Email)
    {
        $this->UserModel = null;

        $res = $this->SQL->Query("SELECT * FROM users WHERE UserPrivateEmail='$Email'");
        $res = $this->SQL->SqlResultToArray($res);

        if (count($res) != 0) {
            $this->UserModel = new UserModel();

            $this->UserModel->Id = $res[0]['UserId'];
            $this->UserModel->UserName = $res[0]['UserName'];
            $this->UserModel->UserRole = $res[0]['UserRole'];
            $this->UserModel->IsActive = $res[0]['IsActive'];
            $this->UserModel->IsPasswordChangeRequired = $res[0]['IsPasswordChangeRequired'];
            $this->UserModel->UserPrivateMail = $res[0]['UserPrivateEmail'];
            $this->UserModel->FirstName = $res[0]['FirstName'];
            $this->UserModel->SurName = $res[0]['SurName'];
            $this->UserModel->EmailConfirmed = $res[0]['EmailConfirmed'];
            $this->UserModel->CreationDate = $res[0]['CreationDate'];
            $this->UserModel->Avatar = $res[0]['Avatar'];
        }

        return $this->UserModel;
    }

    public function ValidateUser($Email, $Password)
    {
        $this->UserModel = new UserModel();

        $res = $this->SQL->Query("SELECT * FROM users WHERE UserPrivateEmail='$Email'");// AND UserPassword='$Password'
        $res = $this->SQL->SqlResultToArray($res);

        if (count(count($res) != 0)) {


            $res = $this->SQL->Query("SELECT * FROM users WHERE UserPrivateEmail='$Email' AND UserPassword='$Password'");
            $res = $this->SQL->SqlResultToArray($res);

            if (count($res) != 0) {
                $this->UserModel->Id = $res[0]['UserId'];
                $this->UserModel->UserName = $res[0]['UserName'];
                $this->UserModel->UserRole = $res[0]['UserRole'];
                $this->UserModel->IsActive = $res[0]['IsActive'];
                $this->UserModel->IsPasswordChangeRequired = $res[0]['IsPasswordChangeRequired'];
                $this->UserModel->UserPrivateMail = $res[0]['UserPrivateEmail'];
                $this->UserModel->FirstName = $res[0]['FirstName'];
                $this->UserModel->SurName = $res[0]['SurName'];
                $this->UserModel->EmailConfirmed = $res[0]['EmailConfirmed'];
                $this->UserModel->CreationDate = $res[0]['CreationDate'];
                $this->UserModel->Avatar = $res[0]['Avatar'];
                return $this->UserModel;
            }
        }
        $this->UserModel->Id = null;
        $this->UserModel->UserPrivateMail = $Email;
        $this->UserModel->ErrorLogin = "Dane logowania nie są poprawne.";
        return $this->UserModel;
    }

    public function SaveToken($userId, $token)
    {
        $q = "UPDATE users SET ValidationToken = '$token' WHERE UserId=$userId";
        $this->SQL->Query($q);
    }

    public function RememberMeToken()
    {
        if (isset($_COOKIE['ID']) && isset($_COOKIE['TOKEN'])) {
            $ID = $_COOKIE['ID'];
            $TOKEN = $_COOKIE['TOKEN'];

            $this->UserModel = new UserModel();

            $res = $this->SQL->Query("SELECT * FROM users WHERE UserId=$ID AND ValidationToken='$TOKEN'");
            $res = $this->SQL->SqlResultToArray($res);

            if (count(count($res) == 1)) {

                $this->UserModel->Id = $res[0]['UserId'];
                $this->UserModel->UserName = $res[0]['UserName'];
                $this->UserModel->UserRole = $res[0]['UserRole'];
                $this->UserModel->IsActive = $res[0]['IsActive'];
                $this->UserModel->IsPasswordChangeRequired = $res[0]['IsPasswordChangeRequired'];
                $this->UserModel->UserPrivateMail = $res[0]['UserPrivateEmail'];
                $this->UserModel->FirstName = $res[0]['FirstName'];
                $this->UserModel->SurName = $res[0]['SurName'];
                $this->UserModel->EmailConfirmed = $res[0]['EmailConfirmed'];
                $this->UserModel->CreationDate = $res[0]['CreationDate'];
                $this->UserModel->Avatar = $res[0]['Avatar'];

                $_SESSION['user'] = new UserModel();
                $_SESSION['user'] = serialize($this->UserModel);
            }
        }
    }

    public function AddToNewsletter($Email)
    {
        $this->SQL->Query("INSERT INTO newsletter(Email) VALUES ('$Email')");
    }

    public function AddNewUser($UserModel ,$Password)
    {
        $q = "
INSERT INTO users VALUES ('',
'$UserModel->UserName','$Password',$UserModel->UserRole,TRUE,FALSE,
'$UserModel->UserPrivateMail','$UserModel->UserName','',FALSE ,'$UserModel->CreationDate',
'https://scontent-frx5-1.xx.fbcdn.net/v/t1.0-1/c43.0.148.148/p148x148/10354686_10150004552801856_220367501106153455_n.jpg?oh=9484fb0f3b0a4c91056f5a9875e81e36&oe=5AFB190F',
''
)";
        $this->SQL->Query($q);
    }
}