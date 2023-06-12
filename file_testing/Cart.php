<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("db");
require_once $db_path;

class Cart extends Db
{
    public function confirmCustomerPurchase($purchase_id, $dnt)
    {
        $state = false;
        $query = "SELECT * FROM `customer_purchase` WHERE `unique_id` =? AND `dnt`=? ";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$purchase_id, $dnt]);
        $resultset = $statement->fetchAll();
        $row_count = count($resultset);
        if ($row_count == 1) {
            $state = true;
        }
        return $state;
    }

    public function get_customer_purchase_id($purchase_unique_id, $dnt)
    {
        $purchase_id = "";
        $query = "SELECT * FROM `customer_purchase` WHERE `unique_id` =? AND `dnt`=? ";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$purchase_unique_id, $dnt]);
        $resultset = $statement->fetchAll();
        $row_count = count($resultset);
        if ($row_count == 1) {
            $purchase_id = $resultset[0]["customer_purchase_id"];
        }
        return $purchase_id;
    }

    public function get_products($purchase_unique_id, $dnt)
    {
        $product_paths = array();
        if ($this->confirmCustomerPurchase($purchase_unique_id, $dnt)) {

            $purchase_id = $this->get_customer_purchase_id($purchase_unique_id, $dnt);

            $query = "SELECT * FROM `customer_purchase_history` 
            INNER JOIN `samplepath` 
            ON `samplepath`.`sampleID` = `customer_purchase_history`.`sampleID`
            WHERE `customer_purchase_id` =?";
            $statement = $this->connect()->prepare($query);
            $statement->execute([$purchase_id]);
            $resultset = $statement->fetchAll();
            $row_count = count($resultset);

            if ($row_count >= 1) {

                for ($i = 0; $i < $row_count; $i++) {
                    $product_path = $resultset[$i]["samplePath"];
                    array_push($product_paths, $product_path);
                }
            }
            return $product_paths;
        } else {
            echo "nothing";
        }
    }
}
