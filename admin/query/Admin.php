<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("db");
require_once $db_path;

class Admin extends Db
{
    public function checkAdmin($email, $password)
    {
        $state = false;
        $query = "SELECT * FROM `admin` WHERE `email`=? AND `password`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$email, $password]);
        $resultset = $statement->fetchAll();
        $rowCount = count($resultset);
        if ($rowCount == 1) {
            $state = true;
        }
        return $state;
    }
    public function updateAdminEmailVerify($email, $code, $created_at)
    {
        $updateStatus = false;
        $query = "UPDATE `admin_email_verification` SET `verify_code`=?,`created_at`=? WHERE `email`=? ";
        $statement = $this->connect()->prepare($query);
        $state = $statement->execute([ $code,$created_at,$email]);
        if($state){
           $updateStatus = true;
        }
        return $updateStatus;
    }
    public function verifyCodeAdmin($email, $code)
    {
        $state = false;
        $query = "SELECT * FROM `admin_email_verification` WHERE `email` = ? AND `verify_code` = ? ";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$email, $code]);
        $resultset = $statement->fetchAll();
        $rowCount = count($resultset);
        if ($rowCount == 1) {
            $state = true;
        }
        return $state;
    }
}
