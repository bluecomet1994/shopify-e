<?php
class UserinputValidation
{
    private $pwd;
    private $fn;
    private $ln;
    private $un;
    private $em;

    public function __construct($fn, $ln, $un, $pwd, $em)
    {
        $this->fn = $fn;
        $this->ln = $ln;
        $this->un = $un;
        $this->em = $em;
        $this->pwd = $pwd;
    }

    public function setEmail($email)
    {
        $this->em = $email;
    }

    public function emptyCheck()
    {
        $state = true;
        if (empty($this->fn) || empty($this->ln) || empty($this->un) || empty($this->em) || empty($this->pwd)) {
            $state = false;
        } else {
            $state = true;
        }

        return $state;
    }
    public function nameCheck($value)
    {
        $state = true;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $value)) {
            $state = false;
        } else {
            $state = true;
        }

        return $state;
    }
    public function userNameCheck()
    {
        $state = true;
        if ($this->un == $this->fn || $this->un == $this->ln) {
            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function sameFnL()
    {
        $state = true;
        if ($this->ln == $this->fn) {
            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function checkEmail()
    {
        $state = true;
        if (!filter_var($this->em, FILTER_VALIDATE_EMAIL)) {
            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function validatePassword($pwd)
    {
        $error = "";
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
            echo "Password validation failure(your choise is weak): $error";
        } else {
            echo "Your password is strong.";
        }
    }
}
