<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("db");
require_once $db_path;
class Sample_query_functions extends Db
{


    private $totalcount;
    private $fetcharray;
    private $exactResultsPerPage = 8;
    private $subSamplesQuery = "SELECT * FROM samples 
    INNER JOIN subsampletype
    ON subsampletype.subsampleID =samples.SubsampleID
    INNER JOIN sampletype
    ON sampletype.sampleTypeID = subsampletype.sampleTypeID
    INNER JOIN sampleaudio
    ON sampleaudio.sampleID=samples.sampleID
    INNER JOIN sampleimages
    ON sampleimages.sampleID=samples.sampleID";

    private $sampleTypeQuery = "SELECT * FROM samples 
    INNER JOIN subsampletype
    ON subsampletype.subsampleID =samples.SubsampleID
    INNER JOIN sampletype
    ON sampletype.sampleTypeID = subsampletype.sampleTypeID
    INNER JOIN sampleaudio
    ON sampleaudio.sampleID=samples.sampleID
    INNER JOIN sampleimages
    ON sampleimages.sampleID=samples.sampleID";

private $sample_query = "SELECT * FROM samples 
INNER JOIN subsampletype
ON subsampletype.subsampleID =samples.SubsampleID
INNER JOIN sampletype
ON sampletype.sampleTypeID = subsampletype.sampleTypeID
INNER JOIN sampleimages
ON sampleimages.sampleID=samples.sampleID";


   public function getSampleDetails($id){
      $query = $this->sample_query. " WHERE samples.sampleID = ?";
      $statement = $this->connect()->prepare($query);
      $statement->execute([$id]);
      $resultset = $statement->fetchAll();
      $row_count = count($resultset);
      if($row_count ==1){
        return $resultset;
      }
   } 
  

   





 
    public function returnTotalCount()
    {
        return $this->totalcount;
    }
    public function validateCardproductID($cardID)
    {
        $cal = " SELECT * FROM samples WHERE samples.sampleID = ?";
        $propertext = $cardID;
        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute(([$propertext]));
        $this->totalcount = count($statement1->fetchAll());
        if ($this->totalcount == 0) {
            $this->fetcharray = array("Nothing");
            return 0;
        } else {
            return $this->totalcount;
        }
    }
    public function checkCartrows($id)
    {
        $cal = "SELECT * FROM samples WHERE samples.sampleID =?";
        $properID  = $id;
        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute([$id]);
        $this->totalcount = count($statement1->fetchAll());
        if ($this->totalcount == 0) {
            $this->fetcharray = array("Nothing");
            return 0;
        } else {
            return $this->totalcount;
        }
    }
    public function showCartRows($id)
    {
        $cal = "SELECT * FROM `samples` WHERE `samples`.`sampleID` =?";
        $properID  = $id;
        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute([$properID]);
        $this->totalcount = count($statement1->fetchAll());
        if ($this->totalcount == 0) {

            $this->fetcharray = array("Nothing");
            return $this->fetcharray;
        } else {

            $sql = "SELECT *
            FROM samples INNER JOIN
            sampleimages
            ON
            sampleimages.sampleID = samples.sampleID
            WHERE samples.sampleID =?";

            $statement2 = $this->connect()->prepare($sql);
            $statement2->execute([$id]);

            return $statement2->fetchAll();
        }
    }

    public function showSampleTypes()
    {
        $cal = "SELECT * FROM sampletype";
        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute();
        return $statement1->fetchAll();
    }
    public function showSubSampleTypes($id)
    {
        $cal = "SELECT * FROM subsampletype WHERE sampleTypeID =?";
        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute([$id]);
        return $statement1->fetchAll();
    }
    public function get_top_three_products()
    {
        $query = "SELECT SUM(qty),sampleID,unique_id,CustomerID,dnt,customer_email 
        FROM customer_purchase_history GROUP BY sampleID  ORDER BY qty  DESC LIMIT 3 ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $rows = count($statement->fetchAll());
        if ($rows > 2) {
            return $statement->fetchAll();
        }
    }
}

// $bbc = "INNER JOIN sampletype
//         ON sampletype.sampleTypeID = subsampletype.sampleTypeID
//         WHERE 
//         samples.SampleDescription REGEXP '^$value?'
//         OR samples.Sample_Name REGEXP '^$value?'
//         OR sampletype.typeName REGEXP '^$value?'
//         OR subsampletype.subsampleName REGEXP '^$value?';";
