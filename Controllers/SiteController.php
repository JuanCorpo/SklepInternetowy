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

    public function SaveSiteInfo()
    {
        if (VariablesHelper::IsAnyPostActive()) {
            $Type = VariablesHelper::GetPostValue('type');
            $Text = VariablesHelper::GetPostValue('content');

            $this->context->SiteInfos->SaveSiteInfo($Type, $Text);

            header("Location: /Site/$Type");
            return;
        }
        header("Location: /");
    }

    public function Installment()
    {
        $text = $this->context->SiteInfos->GetSite(1);
        SiteInfoView($text, 'Installment');
        return;
    }

    public function Complaint()
    {
        $text = $this->context->SiteInfos->GetSite(2);
        SiteInfoView($text, 'Complaint');
        return;
    }

    public function FAQ()
    {
        $text = $this->context->SiteInfos->GetSite(3);
        SiteInfoView($text, 'FAQ');
        return;
    }

    public function Warranty()
    {
        $text = $this->context->SiteInfos->GetSite(4);
        SiteInfoView($text, 'Warranty');
        return;
    }

    public function Terms()
    {
        $text = $this->context->SiteInfos->GetSite(5);
        SiteInfoView($text, 'Terms');
        return;
    }

    public function Cookies()
    {
        $text = $this->context->SiteInfos->GetSite(6);
        SiteInfoView($text, 'Cookies');
        return;
    }

    public function Security()
    {
        $text = $this->context->SiteInfos->GetSite(7);
        SiteInfoView($text, 'Security');
        return;
    }

    public function Downloads()
    {
        $text = $this->context->SiteInfos->GetSite(8);
        SiteInfoView($text, 'Downloads');
        return;
    }


    public function Contact()
    {
        $text = $this->context->SiteInfos->GetSite(9);
        SiteInfoView($text, 'Contact');
        return;
    }

    public function About()
    {
        $text = $this->context->SiteInfos->GetSite(10);
        SiteInfoView($text, 'About');
        return;
    }

    public function Career()
    {
        $text = $this->context->SiteInfos->GetSite(11);
        SiteInfoView($text, 'Career');
        return;
    }

    public function Corpo()
    {
        $text = $this->context->SiteInfos->GetSite(12);
        SiteInfoView($text, 'Corpo');
        return;
    }

    public function TradeCooperation()
    {
        $text = $this->context->SiteInfos->GetSite(13);
        SiteInfoView($text, 'TradeCooperation');
        return;
    }

    public function Reference()
    {
        $text = $this->context->SiteInfos->GetSite(14);
        SiteInfoView($text, 'Reference');
        return;
    }


}