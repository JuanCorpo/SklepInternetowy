<?php

// FORMAT: $vars = array(0=>'Email',1=>'Password')

function ArePostSet($vars)
{
    foreach ($vars as $sessionPost)
    {
        if(!isset($_POST[$sessionPost]) || $_POST[$sessionPost] == null)
        {
            return false;
        }
    }
    return true;
}

function AreGetSet($vars)
{
    foreach ($vars as $sessionPost)
    {
        if(!isset($_GET[$sessionPost]) || $_GET[$sessionPost] == null)
        {
            return false;
        }
    }
    return true;
}