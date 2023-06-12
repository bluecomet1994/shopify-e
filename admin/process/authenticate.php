<?php

session_start();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("admin_db");
$send_mail = GlobalLinkFiles::getFilePath("send_email");
require_once $db_path;
require_once $send_mail;
echo $db_path;
// session checking 
if (isset($_SESSION["admin_session"])) {
    // header('Location: http://localhost/sampleSelling-master/admin/view/home.php');
} else {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        // require_once("admin_db");
        $email = $_POST["email"];
        $password = $_POST["password"];

        $timezone = new DateTimeZone("Asia/Colombo");
        $currentDateandTime = new DateTime("now", $timezone);
        $formattedrightnow = $currentDateandTime->format('Y-m-d H:i:s');

        $admin = new Admin();
        $status = $admin->checkAdmin($email, $password);
        if ($status) {
            $_SESSION["admin_verify_session"] = $email;
            //generate randome code 
            $randomCode = hash("md5", rand() . (string)$formattedrightnow);

            //update the admin email verification row ;
            $updateAdminStatus = $admin->updateAdminEmailVerify($email, $randomCode, $formattedrightnow);
            if ($updateAdminStatus) {

                $sendmail = new SendEmail($email, "admin login verification code", $randomCode);
                // $sendmail->sendEmail();
                ob_clean();
                echo "Verification is sent";
            }
        } else {
            echo "login fail";
        }
    }
}
