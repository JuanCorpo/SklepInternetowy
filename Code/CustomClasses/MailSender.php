<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] .'/Code/CustomClasses/PHPMailer/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] .'/Code/CustomClasses/PHPMailer/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] .'/Code/CustomClasses/PHPMailer/SMTP.php';

class MailSender
{

    public static function Send($context,$templateId, $email ,$subject, $body)
    {
        $mail  = new PHPMailer(true);                           // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'cba.pl';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'juancorp@juancorp.cba.pl';                 // SMTP username
            $mail->Password = 'JuanCorp12';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('juancorp@juancorp.cba.pl', 'JuanCorp');
            $mail->addAddress($email);               // Name is optional

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;

            //send the message, check for errors
            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
                die();
            } else {
                //echo "Message sent!";
                $model = new EmailQueueModel();
                $model->AppendDate = date('Y-m-d H:i:s');
                $model->SendDate = date('Y-m-d H:i:s');;
                $model->IsSend = true;
                $model->EmailAddress = $email;
                $model->EmailTemplateId = $templateId;
                $model->Body = $body;
                $model->Subject = $subject;
                $context->EmailQueues->AddEmailToQueue($model);
            }

            //echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            die();
        }
    }

    public static function SendEmailConfirmInfo($context,$sendTo, $sendDataArray)
    {
        $emailTemplate = $context->EmailTemplates->GetTemplate(null,0);

        $body = $emailTemplate->Body;

        for($i=0;$i<count($sendDataArray);$i++)
        {
            $str = "{".$i."}";
            $body = str_replace($str,$sendDataArray[$i],$body);
        }
        MailSender::Send($context,0,$sendTo, $emailTemplate->Subject ,$body);
    }

    public static function SendNewsletterInfo($context, $sendTo)
    {
        $emailTemplate = $context->EmailTemplates->GetTemplate(null,1);

        $body = $emailTemplate->Body;
        $body = str_replace("{0}",$sendTo,$body);

        MailSender::Send($context,1,$sendTo, $emailTemplate->Subject ,$body);
    }

    public static function SendOrderPlacedInfo($context, $sendTo)
    {
        $emailTemplate = $context->EmailTemplates->GetTemplate(null,2);

        $user = unserialize($_SESSION['user']);
        $body = $emailTemplate->Body;
        $body = str_replace("{0}",$user->FirstName,$body);
        $body = str_replace("{1}",$user->SurName,$body);

        $str = '<br>';
        $products = Cookie::GetBasketsProducts($context);

        foreach($products as $item)
        {
            $str .= $item->Product->Name.'<br>';
        }
        $body = str_replace("{2}",$str,$body);

        MailSender::Send($context,2,$sendTo, $emailTemplate->Subject ,$body);
    }

}