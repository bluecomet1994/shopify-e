<?php
session_start();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("admin_db");
require_once $db_path;

if (isset($_SESSION["admin_verify_session"]) && isset($_POST["verify_code"])) {

    $email = $_SESSION["admin_verify_session"];
    $verifyCode = $_POST["verify_code"];
    $admin = new Admin();
    $state = $admin->verifyCodeAdmin($email, $verifyCode);
    if ($state) {
        unset($_SESSION["admin_verify_session"]);
        $_SESSION["admin_session"] = $email;
        ob_clean();
        echo "Verification success";
    }else{
        echo "failed";
    }
}
