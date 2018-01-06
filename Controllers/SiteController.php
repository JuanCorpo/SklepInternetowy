<?php
include_once("./Code/Helpers/VariablesHelper.php");
include_once("./Code/Helpers/RoleHelper.php");
include_once("./Code/Helpers/Cookie.php");
include_once("./Config/DatabaseContext.php");
foreach (glob("./Views/Site/*.php") as $filename) {
    include_once $filename;
}

class SiteController
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
    }

    public function Installment()
    {
        Installment();
        return;
    }

    public function Complaint()
    {
        Complaint();
        return;
    }

    public function FAQ()
    {
        FAQ();
        return;
    }

    public function Warranty()
    {
        Warranty();
        return;
    }

    public function Terms()
    {
        Terms();
        return;
    }

    public function Cookies()
    {
        Cookies();
        return;
    }

    public function Security()
    {
        Security();
        return;
    }

    public function Downloads()
    {
        Downloads();
        return;
    }




    public function Contact()
    {
        Contact();
        return;
    }

    public function About()
    {
        About();
        return;
    }

    public function Career()
    {
        Career();
        return;
    }

    public function Corpo()
    {
        Corpo();
        return;
    }

    public function TradeCooperation()
    {
        TradeCooperation();
        return;
    }

    public function Reference()
    {
        Reference();
        return;
    }


}