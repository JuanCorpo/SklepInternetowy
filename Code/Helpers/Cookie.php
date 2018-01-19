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
        if (Cookie::isCookieSet('basket')) {
            foreach ($basket as $item) {
                $product = $context->Products->GetProduct($item->ProductId);
                if($product != null) {
                    $price += $product->Price;
                }
            }
        }

        return $price;
    }
    public static function GetBasketsProducts($context)
    {
        $basket = unserialize(Cookie::GetCookieValue('basket'));

        $model = [];

        if (Cookie::isCookieSet('basket')) {
            foreach ($basket as $item) {
                $product = $context->Products->GetProduct($item->ProductId);
                if($product != null) {
                    $model[] = new BasketModel();
                    $model[count($model) - 1]->Product = $product;
                    $model[count($model) - 1]->Count = $item->Count;
                }
            }
            return $model;
        }
    }
}