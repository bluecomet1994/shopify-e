<?php
session_start();
unset($_SESSION["userEmail"]);
if (isset($_POST["I"]) && !empty($_POST["I"]) && isset($_POST["IR"]) && !empty($_POST["IR"]) && isset($_SESSION["verifyForgotPasswordEmail"]) )  {
$_SESSION["changePasswordProcessEmail"]=$_SESSION["verifyForgotPasswordEmail"];
    $P= $_POST["I"];
    $PR = $_POST["IR"];
   
    if($P==$PR){
        require "../query/User.php";
        $checkUser = new User();
        $updatePassword=$checkUser->reCreatePassword($_SESSION["changePasswordProcessEmail"], $PR);
        if($updatePassword){
          session_destroy();
          exit("Success");
         
        }else{
          exit("Counld't verify");
        }
    }

}else{
    exit("Couldn't receive vaild data");
}

?>