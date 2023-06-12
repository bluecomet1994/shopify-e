<?php
if (isset($_POST["FN"]) && isset($_POST["LN"]) && isset($_POST["PWD"]) && isset($_POST["REPWD"])  && isset($_POST["UN"]) && isset($_POST["EM"])) {
    $password = $_POST["PWD"];
    $firstName = $_POST["FN"];
    $lastName = $_POST["LN"];
    $email = $_POST["EM"];
    $userName = $_POST["UN"];

    require "../util/UserInputValidation.php";
   
    $validate = new UserinputValidation($firstName, $lastName, $userName, $password, $email);
    if ($validate->emptyCheck() == false  ) {
      exit("Empty Input Fields");
        
    }else  if ( $validate->nameCheck($firstName) == false  ) {
      exit("Not a Valid First Name");
        
    }else  if ( $validate->nameCheck($lastName) == false ) {
      exit("Not a Valid Last Name");
        
    }else  if ($validate->nameCheck($userName) == false ) {
      exit("Not a Valid User Name");
        
    }else  if ($password!==$_POST["REPWD"] ) {
      exit("Passwords not matching");
        
    }else if($validate->userNameCheck()==false){
      exit("user name cannot be same with first name or last name");
    }else if($validate->sameFnL()==false){
      exit("first name and last name cannot be same");
    }else  if ( $validate->checkEmail() == false) {
       exit("Not a Valid Email");
        
    } else {
       $hashPassword= password_hash($password,PASSWORD_DEFAULT);
       require "../query/User.php";
       $checkUser = new User();
        $userRegState =$checkUser->checkUandE($userName,$email);
        if($userRegState==false){
           
          // require "../PDOPHP/Sample_query_functions.php";
         
           $checkUser->signUpUsers($firstName,$lastName,$userName,$hashPassword,$email);
           exit("Success");
        }else{
            exit("Someone already has been registered under this provided Email");
        }
     
    }
} else {
  
    exit("DO DO DOOO");
}
