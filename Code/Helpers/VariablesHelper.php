<?php

class VariablesHelper
{
    public static function IsSessionActive(){
        return isset($_SESSION);
    }
    // Sprawdzenie czy zmienne istnieją
    public static function IsPostSet($postName)
    {
        return isset($_POST[$postName]);
    }

    public static function IsGetSet($getName)
    {
        return isset($_GET[$getName]);
    }

    public static function IsSessionSet($sessionName)
    {
        return isset($_SESSION[$sessionName]);
    }

    // Pobranie wartości istniejących zmiennych
    public static function GetPostValue($postName)
    {
        if (VariablesHelper::IsPostSet($postName))
            return $_POST[$postName];
        return null;
    }

    public static function GetGetValue($getName)
    {
        if (VariablesHelper::IsGetSet($getName))
            return $_GET[$getName];
        return null;
    }

    public static function GetSessionValue($sessionName)
    {
        if (VariablesHelper::IsSessionSet($sessionName))
            return $_SESSION[$sessionName];
        return null;
    }

    public static function IsUserActive()
    {
        return (VariablesHelper::GetSessionValue('user') != null);
    }

    public static function GetActiveUser()
    {
        return VariablesHelper::GetSessionValue('user');
    }

    // Sprawdzenie serii zmiennych
    public static function ArePostSet($postNameArray)
    {
        foreach ($postNameArray as $postName) {
            if (!VariablesHelper::IsPostSet($postName) || VariablesHelper::GetPostValue($postName) == null) {
                return false;
            }
        }
        return true;
    }

    public static function AreGetSet($getNameArray)
    {
        foreach ($getNameArray as $getName) {
            if (!VariablesHelper::IsGetSet($getName) || VariablesHelper::GetGetValue($getName) == null) {
                return false;
            }
        }
        return true;
    }

    public static function AreSessionSet($sessionNameArray)
    {
        foreach ($sessionNameArray as $sessionName) {
            if (!VariablesHelper::IsSessionSet($sessionName) || VariablesHelper::GetSessionValue($sessionName) == null) {
                return false;
            }
        }
        return true;
    }
}