<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("db");
require_once $db_path;
class DownloadLink extends Db
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
            INNER JOIN `samples`
            ON `samples`.`sampleID` = `samplepath`.`sampleID`
            WHERE `customer_purchase_history`.`customer_purchase_id` =?";
            $statement = $this->connect()->prepare($query);
            $statement->execute([$purchase_id]);
            $resultset = $statement->fetchAll();
            $row_count = count($resultset);

            if ($row_count >= 1) {

                for ($i = 0; $i < $row_count; $i++) {
                    $product_path = $resultset[$i];
                    array_push($product_paths, $product_path);
                }
            }
            return $product_paths;
        } else {
            echo "nothing";
        }
    }
    public function checkDownloadStatus($unique_id, $dnt)
    {
        $already_downloaded= false;
        $query = "SELECT * FROM `product_download_history` 
        INNER JOIN `customer_purchase` 
        ON `customer_purchase`.`customer_purchase_id` = `product_download_history`.`customer_purchase_id`
         WHERE  `customer_purchase`.`unique_id` = ? AND `customer_purchase`.`dnt` = ? ";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$unique_id,$dnt]);
        $resultset = $statement->fetchAll();
        $row_count = count($resultset);
        if($row_count==1){
            $already_downloaded = true;
        }
        return $already_downloaded ;
    }

        public function updateDownloadStatus($unique_id, $dnt)
    {
        echo "<br>";
        echo "unique_id is ". $unique_id;
        $downloaded_times = 1;
        $download_unique_id = uniqid(); 
   
        $purchase_id = $this->get_customer_purchase_id($unique_id,$dnt);
        echo "<br>";
        echo "purchase id is ";
        echo $purchase_id;
        $query = "INSERT INTO `product_download_history` (`downloaded_times`,`unique_id`,`customer_purchase_id`)
        VALUES (?,?,?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$downloaded_times,$download_unique_id,$purchase_id]);
      
    }

}
