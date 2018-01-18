<?php
include_once "Models/EmailQueueModel.php";

class EmailQueues
{
    private $Context;
    private $SQL;

    public function __construct($context)
    {
        $this->Context = $context;
        $this->SQL = $this->Context->sql;
    }

    public function AddEmailToQueue($model)
    {
        $q = "INSERT INTO emailqueue VALUES ('','$model->AppendDate','$model->SendDate','$model->IsSend','$model->EmailAddress','$model->EmailTemplateId','$model->Body','$model->Subject')";
        $this->SQL->Query($q);
    }


    public function GetEmails($cond = null)
    {
        $Emails = [];

        $query = "SELECT * FROM emailqueue";

        if ($cond != null) {
            $query .= " WHERE " . $cond;
        }

        $sqlResult = $this->SQL->Query($query);
        foreach ($sqlResult as $item) {

            $Emails[] = new EmailQueueModel();

            $Emails[count($Emails) - 1]->Id = $item['Id'];
            $Emails[count($Emails) - 1]->AppendDate = $item['AppendDate'];
            $Emails[count($Emails) - 1]->SendDate = $item['SendDate'];
            $Emails[count($Emails) - 1]->IsSend = $item['IsSend'];
            $Emails[count($Emails) - 1]->EmailAddress = $item['EmailAddress'];
            $Emails[count($Emails) - 1]->EmailTemplateId = $item['EmailTemplateId'];
            $Emails[count($Emails) - 1]->Body = $item['Body'];
            $Emails[count($Emails) - 1]->Subject = $item['Subject'];
        }

        return $Emails;
    }

    public function GetEmail($id)
    {
        $Emails = null;

        $query = "SELECT * FROM emailqueue WHERE Id=$id";

        $sqlResult = $this->SQL->Query($query);

        if (count($sqlResult) == 1) {

            $Emails = new EmailQueueModel();
            foreach ($sqlResult as $item) {
                $Emails->Id = $item['Id'];
                $Emails->AppendDate = $item['AppendDate'];
                $Emails->SendDate = $item['SendDate'];
                $Emails->IsSend = $item['IsSend'];
                $Emails->EmailAddress = $item['EmailAddress'];
                $Emails->EmailTemplateId = $item['EmailTemplateId'];
                $Emails->Body = $item['Body'];
                $Emails->Subject = $item['Subject'];
            }
        }

        return $Emails;
    }
}