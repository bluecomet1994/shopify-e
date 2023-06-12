<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("db");
require_once $db_path;
class User extends Db
{
    private $generatedUniqueId = "0";
    public function genRandomUniqueId(): string
    {
        $isUniqueId  = true;

        $bytes = random_bytes(8);

        $encoded = base64_encode($bytes);


        $stripped = str_replace(['=', '+', '/'], 'R', $encoded);
        $uniqueNumComb = uniqid();



        return $stripped . $uniqueNumComb;
    }

    public function isGeneratedIdUnique($ranUniId)
    {
        $uniqueIdGenerated = TRUE;

        $query = "SELECT * FROM `customer` ";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        $rows = count($resultSet);

        if ($rows > 0) {
            for ($i = 0; $i < $rows; $i++) {
                $uid = $resultSet[$i]["Unique_ID"];

                if ($uid == $ranUniId) {

                    $uniqueIdGenerated = FALSE;
                    break;
                } else {
                    $this->generatedUniqueId = $ranUniId;
                }
            }
        }
        return $uniqueIdGenerated;
    }

    public function getCheckedRandomUniqueId()
    {
        $ok = true;
        while ($ok) {
            $uniqueId = $this->genRandomUniqueId();

            $state = $this->isGeneratedIdUnique($uniqueId);

            if ($state) {

                $ok = false;
                return $uniqueId;
            }
        }
    }


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
    public function signUpUsers($fn, $ln, $un, $pwd, $em)
    {

        $query = "INSERT INTO customer (`FName`,`LName`,`UserName`,`Password`,`Email`,`Unique_ID`) 
                  VALUES(?,?,?,?,?,?)";
        $statement1 = $this->connect()->prepare($query);
        $statement1->execute([$fn, $ln, $un, $pwd, $em, $this->getCheckedRandomUniqueId()]);
    }
    public function updateUsers($fn, $ln, $un, $email)
    {
        $queryStatus = false;
        $query = "UPDATE `customer` SET `FName`=?,`LName`=?,`UserName`=? WHERE `Email`=? ";
        $statement = $this->connect()->prepare($query);
        $status = $statement->execute([$fn, $ln, $un, $email]);
        if ($status) {
            $queryStatus = true;
        }
        return $queryStatus;
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
    public function getCustomerUniqueIdByEmail($email)
    {
        if ($this->checkEmail($email)) {
            $query = "SELECT * FROM `customer` WHERE `Email`=?";
            $statement = $this->connect()->prepare($query);
            $statement->execute([$email]);
            $resultSet = $statement->fetchAll();

            return $resultSet[0]["Unique_ID"];
        } else {
            return 0;
        }
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
    public function getUserDetails($em)
    {
        $query = "SELECT * FROM `customer` WHERE `customer`.`Email` = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$em]);
        $row = $statement->rowCount();
        if ($row == 1) {
            $details = $statement->fetchAll();
            return $details;
        } else {
            return null;
        }
    }
    public function signInUsers($pwd, $em)
    {
        $state = true;
        $query = "SELECT `Password` FROM customer WHERE `Email`=?";
        $statement1 = $this->connect()->prepare($query);
        $statement1->execute([$em]);
        if ($statement1->rowCount() == 1) {
            $hashedPassword = $statement1->fetchAll(PDO::FETCH_ASSOC);
            $checkPassword = password_verify($pwd, $hashedPassword[0]["Password"]);

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
    public  function updatePasswordForVerification($e, $p, $currentDnT)
    {
        $hashPassword = password_hash($p, PASSWORD_DEFAULT);
        $state = true;
        $queryCheck = "SELECT * FROM verify_code_customer
        INNER JOIN customer
        ON customer.CustomerID = verify_code_customer.customer_CustomerID
        WHERE customer.Email = ?";
        $statementCheck = $this->connect()->prepare($queryCheck);
        $statementCheckResult = $statementCheck->execute([$e]);
        $statementCheckFetchedResult = $statementCheck->fetchAll();
        $lastAttemptTime = strtotime($statementCheckFetchedResult[0][2]);
        $strtocurrentDnT = strtotime($currentDnT);
        $timeDifference = $strtocurrentDnT - $lastAttemptTime;
        $this->timeDifferenceGlobal = $timeDifference;
        if ($timeDifference >= 300) {


            $statementCheckResultRowCount = count($statementCheckFetchedResult);
            if ($statementCheckResultRowCount == 1) {
                $query = "UPDATE `customer`
            INNER JOIN `verify_code_customer`
            ON verify_code_customer.customer_CustomerID = customer.CustomerID
            SET verify_code_customer.verify_Code =?,attempted_Time=?
            WHERE customer.Email =?";
                $statement = $this->connect()->prepare($query);
                $statementResult = $statement->execute([$hashPassword, $currentDnT, $e]);
            } else {
                $userIDquery = "SELECT * FROM `customer`  WHERE `Email`=?";
                $getUserIDStatement = $this->connect()->prepare($userIDquery);
                $getUserIDStatement->execute([$e]);
                $fetchedResults = $getUserIDStatement->fetchAll();
                $getUserRowCount = count($fetchedResults);
                if ($getUserRowCount == 1) {
                    $cusIDGet = $fetchedResults;
                    $cusID =  $cusIDGet[0][4];
                    $insertVerifyRowQuery = "INSERT INTO `verify_code_customer`(`verify_Code`,`customer_CustomerID`,`attempted_Time`)
                VALUES(?,?);";
                    $insertVerifyStatement = $this->connect()->prepare($insertVerifyRowQuery);
                    $statementResult =   $insertVerifyStatement->execute([$hashPassword, $cusID, $currentDnT]);
                }
            }

            if ($statementResult) {
                $state = true;
            } else {
                $state = false;
            }
            return $state;
        } else {

            $state = false;
            return $state;
        }
    }
    public function reCreatePassword($e, $p)
    {
        $hashPassword = password_hash($p, PASSWORD_DEFAULT);
        $state = true;
        $query = "UPDATE `customer` SET `Password`=? WHERE `Email`=?";
        $statement = $this->connect()->prepare($query);
        $statementResult = $statement->execute([$hashPassword, $e]);
        if ($statementResult) {
            $state = true;
        } else {
            $state = false;
        }
        return $state;
    }
    public function getUpdatedPassword($e)
    {
        $state = true;

        $query = "SELECT verify_code_customer.verify_Code FROM customer 
        INNER JOIN verify_code_customer
        ON verify_code_customer.customer_CustomerID = customer.CustomerID
        WHERE customer.Email = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$e]);
    }
}
