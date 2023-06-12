<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("db");
require_once $db_path;
class CartRelated extends Db
{
    public $timeDifferenceGlobal;
    public function checkUandE($u, $e)
    {
        $state = true;
        $query = "SELECT * FROM  `customer` WHERE `UserName`=? AND `Email`=?";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$u, $e]);
        $rowCount = count($statement->fetchAll());
        if ($rowCount == 1) {
            $state = true;
        } else {
            $statement = null;
            $state = false;
        }
        return $state;
    }
    public function checkPandE($p, $e)
    {
        $state = true;
        //$query = "SELECT `Password` FROM  `customer` WHERE `Email`=?";
        $query = "SELECT verify_code_customer.verify_Code FROM customer 
        INNER JOIN verify_code_customer
        ON verify_code_customer.customer_CustomerID = customer.CustomerID
        WHERE customer.Email =?";
        $statement1 = $this->connect()->prepare($query);
        $statement1->execute([$e]);

        if ($statement1->rowCount() == 1) {
            $hashedPassword = $statement1->fetchAll(PDO::FETCH_ASSOC);

            $checkPassword = password_verify($p, $hashedPassword[0]["verify_Code"]);

            if ($checkPassword == false) {
                $state = false;
                echo "Wrong Password";
            } else {
                $state = true;
            }
        } else {
            $state = false;
        }
        return $state;
    }

    public function addToCustomerCart($sId, $qty, $cusId)
    {
        $query = "INSERT INTO usercart (`sampleID`,`qty`,`CustomerID`) 
        VALUES(?,?,?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$sId, $qty, $cusId]);
    }
    public function updateCustomerCart($sId, $qty, $cusId)
    {
        $query = "UPDATE `usercart` SET `qty`=? WHERE `sampleID`=? AND `CustomerID`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$qty, $sId, $cusId]);
    }

    public function getCustomerCart($email)
    {
        $id = $this->getCusIdByEmail($email);
        $array = array();
        if ($id != 0) {
            $query = "SELECT * FROM `usercart` WHERE `CustomerID`= '" . $id . "'";
            $statement = $this->connect()->prepare($query);
            $statement->execute([]);
            $resultSet = $statement->fetchAll();
            $rows = count($resultSet);
            for ($i = 0; $i < $rows; $i++) {

                $subArray = array("id" => $resultSet[$i]["sampleID"], "qty" =>  $resultSet[$i]["qty"]);
                array_push($array, $subArray);
            }

            return $array;
        }
    }
    public function removeRowsFromCustomerCart($email, $sId)
    {
        $id = $this->getCusIdByEmail($email);
        if ($id != 0) {
            $query = "SELECT * FROM `usercart` WHERE `CustomerID`= '" . $id . "' AND `sampleID`=?";
            $statement = $this->connect()->prepare($query);
            $statement->execute([$sId]);
            $resultSet = $statement->fetchAll();
            if (count($resultSet) == 1) {
                $query = "DELETE FROM `userCart` WHERE `CustomerID`= '" . $id . "' AND `sampleID`=?";
                $statement = $this->connect()->prepare($query);
               

                $statement->execute([$sId]);
            }
        }
    }
    public function checkCustomerCart($sId, $qty, $cusId)
    {
    }
    public function getUserDetails($pwd, $em)
    {
    }

    public function checkEmail($e)
    {
        $state = true;
        $query = "SELECT * FROM  `customer` WHERE `Email`=?";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$e]);
        $rowCount = count($statement->fetchAll());
        if ($rowCount == 1) {
            $state = true;
        } else {
            $statement = null;
            $state = false;
        }
        return $state;
    }

    public function getCusIdByEmail($email)
    {
        if ($this->checkEmail($email)) {
            $query = "SELECT * FROM `customer` WHERE `Email`=?";
            $statement = $this->connect()->prepare($query);
            $statement->execute([$email]);
            $resultSet = $statement->fetchAll();

            return $resultSet[0]["CustomerID"];
        } else {
            return 0;
        }
    }
    public function checkCusIdinCartByEmail($email, $sId, $qty)
    {
        $cusID = $this->getCusIdByEmail($email);
        $query = "SELECT * FROM `usercart` WHERE `CustomerID`=? AND `sampleID`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$cusID, $sId]);
        $rowCount = count($statement->fetchAll());
        if ($rowCount == 1) {
            $this->updateCustomerCart($sId, $qty, $cusID);
        } else {
            $this->addToCustomerCart($sId, $qty, $cusID);
        }
    }
 

}
