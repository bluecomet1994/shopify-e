<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("db");
require_once $db_path;
class Util extends Db{

    //unique id generaion process
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

        $query = "SELECT * FROM `customer_purchase` ";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        $rows = count($resultSet);

        if ($rows > 0) {
            for ($i = 0; $i < $rows; $i++) {
                $uid = $resultSet[$i]["customer_id"];

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
    public function isGeneratedIdUniqueCPHistory($ranUniId)
    {
        $uniqueIdGenerated = TRUE;

        $query = "SELECT * FROM `customer_purchase_history` ";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        $rows = count($resultSet);

        if ($rows > 0) {
            for ($i = 0; $i < $rows; $i++) {
                $uid = $resultSet[$i]["customer_purchase_id"];

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

    public function getCheckedRandomUniqueIdCPHistory()
    {
        $ok = true;
        while ($ok) {
      

            $uniqueId = $this->genRandomUniqueId();

            $state = $this->isGeneratedIdUniqueCPHistory($uniqueId);

            if ($state) {

                $ok = false;
                return $uniqueId;
            }
        }
    }
}



?>