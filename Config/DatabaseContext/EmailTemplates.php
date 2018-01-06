<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/Models/EmailTemplateModel.php";

class EmailTemplates
{
    private $Context;
    private $SQL;

    public function __construct($context)
    {
        $this->Context = $context;
        $this->SQL = $this->Context->sql;
    }

    public function GetTemplates($cond = null)
    {
        $Emails = [];

        $query = "SELECT * FROM emailtemplates";

        if ($cond != null) {
            $query .= " WHERE " . $cond;
        }

        $sqlResult = $this->SQL->Query($query);
        foreach ($sqlResult as $item) {

            $Emails[] = new EmailTemplateModel();

            $Emails[count($Emails) - 1]->Id = $item['Id'];
            $Emails[count($Emails) - 1]->Type = $item['Type'];
            $Emails[count($Emails) - 1]->Subject = $item['Subject'];
            $Emails[count($Emails) - 1]->Body = $item['Body'];
        }

        return $Emails;
    }

    public function GetTemplate($id ,$type)
    {
        $Emails = null;

        $query = "SELECT * FROM emailtemplates ";

        if($id !== null || $type !== null)
        {
            $query.= " WHERE ";
        }

        if($id!==null)
        {
            $query.= " Id=$id ";
        }
        if($id !== null && $type !== null)
        {
            $query.= " AND ";
        }
        if($type!==null)
        {
            $query.= " Type=$type ";
        }

        $sqlResult = $this->SQL->Query($query);

        if (count($sqlResult) == 1) {

            $Emails = new EmailTemplateModel();
            foreach ($sqlResult as $item) {
                $Emails->Id = $item['Id'];
                $Emails->Type = $item['Type'];
                $Emails->Subject = $item['Subject'];
                $Emails->Body = $item['Body'];
            }
        }

        return $Emails;
    }

    public function Update($id,$subject,$body)
    {
        $q = "UPDATE emailtemplates SET              
            Subject = '$subject',
            Body = '$body'
            WHERE Id=$id";

        $this->SQL->Query($q);

    }
}