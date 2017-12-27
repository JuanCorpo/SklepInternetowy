<?php

class UserModel
{
    public $Id;
    public $UserName;
    public $UserRole;
    public $IsActive;
    public $IsPasswordChangeRequired;
    public $UserPrivateMail;
    public $FirstName;
    public $SurName;
    public $EmailConfirmed;
    public $CreationDate;
    public $Avatar;
    public $ValidationToken;

    public $ErrorLogin;

    public function generateRandomToken()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+-*!@#$%^&*()_=<>{}[]';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 150; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function GetFullName()
    {
        return $this->FirstName . ' ' . $this->SurName;
    }

}