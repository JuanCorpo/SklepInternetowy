<?php

class SiteInfos
{
    private $Context;
    private $SQL;

    public function __construct($context)
    {
        $this->Context = $context;
        $this->SQL = $this->Context->sql;
    }

    public function SaveSiteInfo($Type, $Text){
        $this->SQL->Query("UPDATE SiteInfos SET Site = '$Text' WHERE Name='$Type'");
    }

    public function GetSite($id)
    {
        $result = $this->SQL->Query("SELECT Site FROM SiteInfos WHERE Id=$id");

        if(count($result) == 1){
            return $result[0]['Site'];
        }
        return "Wystąpił błąd podczas wczytywania zawartości strony.";
    }
}