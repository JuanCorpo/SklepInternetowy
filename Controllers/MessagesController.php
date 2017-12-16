<?php
include_once("./Models/MessagesModel.php");
foreach (glob("./Views/Messages/*.php") as $filename) {
    include_once $filename;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './Code/CustomClasses/PHPMailer/Exception.php';
require './Code/CustomClasses/PHPMailer/PHPMailer.php';
require './Code/CustomClasses/PHPMailer/SMTP.php';

class MessagesController
{
    private $model;

    public function Index()
    {
        $this->model = new MessagesModel();
        $this->model->text = "MESSAGE VIEW";

        return MessagesIndexView($this, $this->model);
    }

    public function SendMailPost()
    {
        $this->model = new MessagesModel();

        if (isset($_POST['inputEmail']) && isset($_POST['inputTitle']) && isset($_POST['inputBody'])) {
            $this->model->email = $_POST['inputEmail'];
            $this->model->title = $_POST['inputTitle'];
            $this->model->body = $_POST['inputBody'];
            $this->SendMail();
        }
        $this->Index();
    }

    public function SendMail()
    {
        $mail  = new PHPMailer(true);                           // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'cba.pl';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'juancorp@juancorp.cba.pl';                 // SMTP username
            $mail->Password = 'JuanCorp12';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('juancorp@juancorp.cba.pl', 'JuanCorp');
            $mail->addAddress($this->model->email);               // Name is optional

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $this->model->title;
            $mail->Body = $this->model->body;

            //send the message, check for errors
            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
                die();
            } else {
                echo "Message sent!";
            }

            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            die();
        }

    }
}