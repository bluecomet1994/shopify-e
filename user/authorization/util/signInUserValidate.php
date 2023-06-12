<?php

class signInUserValidate{
    private $pwd; 
    private $em;
    
    public function __construct($pwd,$em){

        $this ->em = $em;
        $this ->pwd = $pwd;   
    }
    public function emptyCheck(){
        $state=true; 
        if( empty($this->em) || empty($this->pwd)){
          $state =false;
        }else{
            $state = true;
        }

        return $state;
    }
    public function checkEmail(){
        $state = true;
        if(!filter_var($this->em,FILTER_VALIDATE_EMAIL)){
          $state =false;
        }else{
            $state = true;
        }
        return $state;
    }
    public function validatePassword($pwd)
    {
        $error = "";
        $state = true;
        $pwd = $this->pwd;
        if (strlen($pwd) < 8) {
            $error .= "Password too short!";
        }
        if (strlen($pwd) > 20) {
            $error .= "Password too long!";
        }
        if (strlen($pwd) < 8) {
            $error .= "Password too short!";
        }
        if (!preg_match("#[0-9]+#", $pwd)) {
            $error .= "Password must include at least one number!";
        }
        if (!preg_match("#[a-z]+#", $pwd)) {
            $error .= "Password must include at least one letter!";
        }
        if (!preg_match("#[A-Z]+#", $pwd)) {
            $error .= "Password must include at least one CAPS!";
        }
        if (!preg_match("#W+#", $pwd)) {
            $error .= "Password must include at least one symbol!";
        }
        if ($error) {
            $state =false;
            echo "Password validation failure(your choise is weak): $error";
        } else {
            $state =true;
        }
        return $state;
    }
    


}
