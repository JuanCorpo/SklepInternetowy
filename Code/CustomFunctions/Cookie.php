<?php


function setNewCookie($sName, $sValue, $iDays)
{
    setcookie($sName, $sValue, time() + 3600 * 24 * $iDays, "/");
}


function deleteCookie($sName)
{
    setNewCookie($sName, "false", -1);

}

function isSetCookie($name)
{
    if (isset($_COOKIE[$name])) {
        return true;
    }
    return false;
}

function isCookieEqual($name, $value)
{
    if ((isset($_COOKIE[$name]) && $_COOKIE[$name] == $value)) {
        return true;
    }
    return false;
}