<?php
session_start();
if (isset($_POST["PWD"]) && isset($_POST["EM"])) {
    $password = $_POST["PWD"];
    $email = $_POST["EM"];
    require "../util/signInUserValidate.php";

    $validate = new signInUserValidate($password, $email);
    if ($validate->emptyCheck() == false) {
        exit("Empty Input Fields");
    } else  if ($validate->checkEmail() == false) {
        exit("Not a Valid Email");
    } else {

        require "../query/User.php";
        $checkUser = new User();
        $signInFunction =  $checkUser->signInUsers($password, $email);
        if ($signInFunction) {
            if (isset($_SESSION["userEmail"])) {
                echo "resetSessionExits";
            } else {
            }
            $_SESSION["userEmail"] = $email;
            
            echo "Success";
        }else{
            echo "Wrong Password";
        }
    }
} else {

    exit("DO DO DOOO");
}
