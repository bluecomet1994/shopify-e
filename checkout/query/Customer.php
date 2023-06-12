<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("db");
require_once $db_path;
class Customer extends Db
{

    public function verify_customer_by_id($customer_id)
    {
        $state = false;
        $query = "SELECT * FROM `customer` WHERE `CustomerID`=?";
        $statement = $this->connect()->prepare($query);
        $row_count = count($statement->fetchAll());
        if ($row_count == 1) {
            $state = true;
        }
        return $state;
    }
    public function insert_customer_purchase($unique_id, $dnt,  $customer_id, $customer_email)
    {
        $query = "INSERT INTO `customer_purchase` (`unique_id`,`dnt`,`customer_id`,`customer_email`) 
        VALUES (?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$unique_id, $dnt, $customer_id, $customer_email]);
    }

    public function get_customer_purchase_id_by_unique_id_and_customer_email($unique_id, $customer_email)
    {
        $customer_purchase_id = "";
        $query = "SELECT * FROM `customer_purchase` WHERE `unique_id` =? AND `customer_email`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$unique_id, $customer_email]);
        $resultset = $statement->fetchAll();
        $row_count = count($resultset);
        if ($row_count == 1) {
            $customer_purchase_id = $resultset[0]["customer_purchase_id"];
        }
        return $customer_purchase_id;
    }

    public function insert_abc($unique_id)
    {
        $query = "INSERT INTO `abc` (`unique_id`) 
        VALUES (?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$unique_id]);
    }
    public function insert_customer_purchase_history($unique_id, $qty, $sample_id, $customer_purchase_id)
    {
        $query = "INSERT INTO `customer_purchase_history` (`unique_id`,`qty`,`sampleID`,`customer_purchase_id`) 
        VALUES (?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$unique_id, $qty, $sample_id, $customer_purchase_id]);
    }
    public function insert_just($unique_id, $event_name)
    {
        $query = "INSERT INTO `just_check` (`column_1`,`event_name`) 
        VALUE (?,?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$unique_id, $event_name]);
    }

    public function get_sample_id($sample_unique_id)
    {
        $id = 0;
        $query = "SELECT * FROM `samples` WHERE `UniqueId` = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$sample_unique_id]);
        $resultset = $statement->fetchAll();
        $row_count = count($resultset);
        if ($row_count == 1) {
            $id = $resultset[0]["sampleID"];
        }
        return $id;
    }
    public function get_user_id($user_unique_id)
    {
        $id = 0;
        $query = "SELECT * FROM `customer` WHERE `Unique_ID` = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$user_unique_id]);
        $resultset = $statement->fetchAll();
        $row_count = count($resultset);
        if ($row_count == 1) {
            $id = $resultset[0]["CustomerID"];
        }
        return $id;
    }
    public function get_user_id_from_stripe($email)
    {
        $id = 0;
        $query = "SELECT * FROM `customer` WHERE `Email` = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$email]);
        $resultset = $statement->fetchAll();
        $row_count = count($resultset);
        if ($row_count == 1) {
            $id = $resultset[0]["CustomerID"];
        }
        return $id;
    }


}


