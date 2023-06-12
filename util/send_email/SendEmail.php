<?php

use SendGrid\Mail\SendAt;

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";

$vendor_path = GlobalLinkFiles::getFilePath("vendor_autoload");
require_once $vendor_path;
require_once "config.php";

class SendEmail
{
    private $receivers_email;
    private $header;
    private $body;

    function __construct( $receivers_email, $header, $body)
    {
    
        $this->receivers_email = $receivers_email;
        $this->header = $header;
        $this->body = $body;


        $this->sendEmail();
    }
    public function sendEmail()
    {
        $sendgrid_key = $this->getSendGridKey();
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($this->getSenderEmail(), $this->getSenderUserName());
        $email->setSubject($this->header);
        $email->addTo($this->receivers_email, "");
        $email->addContent("text/html", $this->body);

        $sendgrid = new \SendGrid($sendgrid_key);
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }

    public function getSendGridKey()
    {
        return constant("SENDGRID_API_KEY");
    }
    public function getSenderEmail()
    {
        return constant("EMAIL");
    }
    public function getSenderUserName()
    {
        return constant("USERNAME");
    }
}
