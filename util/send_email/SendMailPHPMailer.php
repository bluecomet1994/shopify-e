<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";

$vendor_path = GlobalLinkFiles::getFilePath("vendor_autoload");
require_once $vendor_path;
require_once "config.php";


use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
//class that is made for sending emails it has the needed methods that could be useful
//configuring the email messages 
class SendMailPHPMailer 
{
    private $emailSentStatus = false;
    private $sendersEmail;
    private $emailPassword;
    private $username;
    private $hostname;

    private $email;
    private $body;

    public function setCredentials()
    {
        $this->sendersEmail = constant("EMAIL");
        $this->emailPassword = constant("PASSWORD");
        $this->username = constant("USERNAME");
        $this->hostname = constant("HOSTNAME");
    }
    private $headerText;
    public function setReceiversEmail($email)
    {
        $this->email = $email;
    }
    public function setHeader($headerText)
    {
        $this->headerText = $headerText;
    }


    public function setBody($B)
    {
        $this->body = $B;
    }
    public function sendEmail()
    {
        $this->setCredentials();

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = $this->hostname;
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->sendersEmail;
            $mail->Password   = $this->emailPassword;
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
            $mail->setFrom($this->sendersEmail, $this->username);
            $mail->addAddress($this->email);
            $mail->addReplyTo($this->sendersEmail, $this->username);
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
            $mail->isHTML(true);
            $mail->Subject = $this->headerText;
            $mail->Body    = $this->body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients eee';
            $mail->send();
            $mail->SMTPDebug = true;
            $this->emailSentStatus = true;
            echo "Success";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error {$e} : {$mail->ErrorInfo}";
            $this->emailSentStatus = false;
        }
        return $this->emailSentStatus;
    }
}
