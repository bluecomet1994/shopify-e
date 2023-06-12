<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("db");
require_once $db_path;
class Samples extends Db
{
  public function getSamples()
  {
    $query = "SELECT * FROM `samples`";
    $statement = $this->connect()->prepare($query);
    $resultset = $this->$statement->execute([]);
    $rows = count($resultset);
    if ($rows > 0) {
      return $resultset;
    }
  }

  public function checkId($id)
  {
    $state = false;
    $query = "SELECT * FROM `samples` WHERE `UniqueId`=?";
    $statement = $this->connect()->prepare($query);
    $statement->execute([$id]);
    $rows = count($statement->fetchAll());
    if ($rows == 1) {
      $state = true;
      return $state;
    }
    return $state;
  }

  public function getSampleDetails($id)
  {
    $state = false;
    $query = "SELECT * FROM `samples` INNER JOIN `sampleimages` ON `sampleimages`.`sampleID` = `samples`.`sampleID` WHERE `samples`.`UniqueId`=?";
    $statement = $this->connect()->prepare($query);
    $statement->execute([$id]);
    $resultset = $statement->fetchAll();
    $rows = count($resultset);

    if ($rows == 1) {

      return  $resultset;
    } else {
      return array();
    }
  }
}
