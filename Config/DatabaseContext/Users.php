<?php
include $_SERVER['DOCUMENT_ROOT']."/Code/Helpers/Cookie.php";

class Users
{
    private $Context;
    private $SQL;

    public function __construct($context)
    {
        $this->Context = $context;
        $this->SQL = $this->Context->sql;
    }

    public function GetUsersAll($cond = null)
    {
        $Users = [];

        $query = "SELECT * FROM users";

        if($cond != null){
            $query .= " WHERE " . $cond;
        }

        $sqlResult = $this->SQL->Query($query);
        foreach ($sqlResult as $item) {

            $Users[] = new UserModel();

            $Users[count($Users)-1]->Id = $item['UserId'];
            $Users[count($Users)-1]->UserName = $item['UserName'];
            $Users[count($Users)-1]->UserRole = $item['UserRole'];
            $Users[count($Users)-1]->IsActive = $item['IsActive'];
            $Users[count($Users)-1]->IsPasswordChangeRequired = $item['IsPasswordChangeRequired'];
            $Users[count($Users)-1]->UserPrivateMail = $item['UserPrivateEmail'];
            $Users[count($Users)-1]->FirstName = $item['FirstName'];
            $Users[count($Users)-1]->SurName = $item['SurName'];
            $Users[count($Users)-1]->EmailConfirmed = $item['EmailConfirmed'];
            $Users[count($Users)-1]->CreationDate = $item['CreationDate'];
            $Users[count($Users)-1]->Avatar = $item['Avatar'];
        }

        return $Users;
    }

    public function GetUserBy($emailOrId ,$userToken = null)
    {
        $Users = null;

        $query = "SELECT * FROM users";

        if (strpos($emailOrId, '@') !== false) {
            $query . " WHERE UserPrivateEmail='$emailOrId''";
        } else {
            $query . " WHERE UserId= $emailOrId";
        }

        if($userToken != null){
            $query . " AND ValidationToken= '$userToken''";
        }

        $sqlResult = $this->SQL->Query($query);

        if (count($sqlResult) == 1) {
            $this->UserModel = new UserModel();

            $Users[count($Users)]->Id = $sqlResult[0]['UserId'];
            $Users[count($Users)]->UserName = $sqlResult[0]['UserName'];
            $Users[count($Users)]->UserRole = $sqlResult[0]['UserRole'];
            $Users[count($Users)]->IsActive = $sqlResult[0]['IsActive'];
            $Users[count($Users)]->IsPasswordChangeRequired = $sqlResult[0]['IsPasswordChangeRequired'];
            $Users[count($Users)]->UserPrivateMail = $sqlResult[0]['UserPrivateEmail'];
            $Users[count($Users)]->FirstName = $sqlResult[0]['FirstName'];
            $Users[count($Users)]->SurName = $sqlResult[0]['SurName'];
            $Users[count($Users)]->EmailConfirmed = $sqlResult[0]['EmailConfirmed'];
            $Users[count($Users)]->CreationDate = $sqlResult[0]['CreationDate'];
            $Users[count($Users)]->Avatar = $sqlResult[0]['Avatar'];
        }

        return $Users;
    }

    public function ValidateUser($Email, $Password)
    {
        $User = null;

        $res = $this->SQL->Query("SELECT * FROM users WHERE UserPrivateEmail='$Email'");

        if (count($res) == 1) {

            $res = $this->SQL->Query("SELECT * FROM users WHERE UserPrivateEmail='$Email' AND UserPassword='$Password'");

            if (count($res) == 1) {
                $User = new UserModel();

                $User->Id = $res[0]['UserId'];
                $User->UserName = $res[0]['UserName'];
                $User->UserRole = $res[0]['UserRole'];
                $User->IsActive = $res[0]['IsActive'];
                $User->IsPasswordChangeRequired = $res[0]['IsPasswordChangeRequired'];
                $User->UserPrivateMail = $res[0]['UserPrivateEmail'];
                $User->FirstName = $res[0]['FirstName'];
                $User->SurName = $res[0]['SurName'];
                $User->EmailConfirmed = $res[0]['EmailConfirmed'];
                $User->CreationDate = $res[0]['CreationDate'];
                $User->Avatar = $res[0]['Avatar'];

            }
        }
        return $User;
    }

    public function SaveToken($userId, $token)
    {
        $this->SQL->Query("UPDATE users SET ValidationToken = '$token' WHERE UserId=$userId");
    }

    public function CheckRememberMeToken()
    {
        $ID = Cookie::GetCookieValue('ID');
        $TOKEN = Cookie::GetCookieValue('TOKEN');

        if ($ID!=null && $TOKEN!=null) {
            $User = $this->GetUserBy($ID ,$TOKEN);

            if ($User != null) {
                $_SESSION['user'] = new UserModel();
                $_SESSION['user'] = serialize($User);
            }
        }
    }

    public function AddToNewsletter($Email)
    {
        $this->SQL->Query("INSERT INTO newsletter(Email) VALUES ('$Email')");
    }

    public function AddNewUser($UserModel, $Password)
    {
        $q = "INSERT INTO users VALUES ('','$UserModel->UserName','$Password',$UserModel->UserRole,TRUE,FALSE,'$UserModel->UserPrivateMail','$UserModel->UserName','',FALSE ,'$UserModel->CreationDate',
'https://scontent-frx5-1.xx.fbcdn.net/v/t1.0-1/c43.0.148.148/p148x148/10354686_10150004552801856_220367501106153455_n.jpg?oh=9484fb0f3b0a4c91056f5a9875e81e36&oe=5AFB190F','')";
        $this->SQL->Query($q);
    }

    public function GetEmployeesList()
    {
        return $this->GetUsersAll("UserRole = 2");
      // return $this->SQL->Query("SELECT * FROM users WHERE UserRole=2");
    }
}