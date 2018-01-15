<?php

class Cookie
{
    public static function CreateCookie($cookieName, $cookieValue, $cookieDays)
    {
        setcookie($cookieName, $cookieValue, time() + 3600 * 24 * $cookieDays, "/");
    }

    public static function DeleteCookie($cookieName)
    {
        setcookie($cookieName, "", -1, "/");
    }

    public static function IsCookieSet($cookieName)
    {
        return isset($_COOKIE[$cookieName]);
    }

    public static function GetCookieValue($cookieName)
    {
        if (Cookie::isCookieSet($cookieName)) {
            return $_COOKIE[$cookieName];
        }
        return null;
    }

    public static function IsCookieEqual($cookieName, $cookieValue)
    {
        return (Cookie::isCookieSet($cookieName) && Cookie::getCookieValue($cookieName) == $cookieValue);
    }

    public static function GetBasketValue($context)
    {
        $price = 0.0;
        $basket = unserialize(Cookie::GetCookieValue('basket'));

        foreach ($basket as $item) {
            $product = $context->Products->GetProduct($item->ProductId);
            $price += $product->Price;
        }

        return $price;
    }

}